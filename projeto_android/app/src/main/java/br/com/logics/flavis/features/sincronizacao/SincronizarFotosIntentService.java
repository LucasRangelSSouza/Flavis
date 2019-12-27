package br.com.logics.flavis.features.sincronizacao;

import android.app.IntentService;
import android.content.Context;
import android.content.Intent;

import com.google.gson.GsonBuilder;

import java.io.File;
import java.io.IOException;
import java.util.List;

import br.com.logics.flavis.model.entities.os.FotoOS;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;
import br.com.logics.flavis.model.entities.os.procedimento.FotoProcedimento;
import br.com.logics.flavis.model.repository.FotoRepository;
import br.com.logics.flavis.model.repository.OSRepository;
import br.com.logics.flavis.model.routes.RetrofitSingleton;
import br.com.logics.flavis.model.routes.RotaOS;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;
import br.com.logics.flavis.utils.fotos.FotoUtils;
import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Response;

/**
 * An {@link IntentService} subclass for handling asynchronous task requests in
 * a service on a separate handler thread.
 * <p>
 * TODO: Customize class - update intent actions, extra parameters and static
 * helper methods.
 */
public class SincronizarFotosIntentService extends IntentService {
    private static final String TAG = SincronizarFotosIntentService.class.getName();
    private RotaOS rotaOs;

    public SincronizarFotosIntentService() {
        super("SincronizarFotosIntentService");
    }

    /**
     * Starts this service to perform action Foo with the given parameters. If
     * the service is already performing a task this action will be queued.
     *
     * @see IntentService
     */
    // TODO: Customize helper method
    public static void startSincronizacao(Context context) {
        Intent intent = new Intent(context, SincronizarFotosIntentService.class);
        context.startService(intent);
    }


    @Override
    protected void onHandleIntent(Intent intent) {
        syncOSs(intent);
        syncFotosOS(intent);
        synFotoExecucoes(intent);

    }

    private void syncOSs(Intent intent) {
        if (intent != null) {
            List<OS> osesToSync = OSRepository.I.loadOsToSync(this);
            for (OS os : osesToSync) {
                if (os.getIsPmoc()) {
                    syncOsPMOC(os);
                } else {
                    syncOS(os);
                }
            }
        }
    }

    private void syncOS(OS os) {
        rotaOs = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(RotaOS.class);
        RequestBody relatorioAvaliacao = RequestBody.create(MediaType.parse("multipart/form-data"), os.getRelatorioAvaliacao());
        RequestBody isEncerrada = RequestBody.create(MediaType.parse("multipart/form-data"), String.valueOf(os.getIsEncerrada()));
        RequestBody justificativaEncerramento = RequestBody.create(MediaType.parse("multipart/form-data"), os.getJustificativaEncerramento());
        RequestBody receptorNome = RequestBody.create(MediaType.parse("multipart/form-data"), os.getReceptorNome());
        RequestBody receptorRg = RequestBody.create(MediaType.parse("multipart/form-data"), os.getReceptorRg());
        File assinatura = new File(os.getPathAssinatura());
        MultipartBody.Part body = MultipartBody.Part.createFormData("assinatura", assinatura.getName(), RequestBody.create(MediaType.parse("image/*"), assinatura));
        Call<ResponseBody> call = rotaOs.sincronizarOsSemPMOC(ColaboradorSingleton.SINGLETON.getApiToken(this), relatorioAvaliacao, isEncerrada, justificativaEncerramento, receptorNome, receptorRg, os.getId(), body);
        Response<ResponseBody> response;
        try {
            response = call.execute();
            if (response.isSuccessful()) {
                os.setIsSync(true);
                os.update();
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void syncOsPMOC(OS os) {
        restructureData(os);
        rotaOs = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(RotaOS.class);
        RequestBody osJson = RequestBody.create(MediaType.parse("multipart/form-data"), new GsonBuilder().excludeFieldsWithoutExposeAnnotation().create().toJson(os));
        File assinatura = new File(os.getPathAssinatura());
        MultipartBody.Part body = MultipartBody.Part.createFormData("assinatura", assinatura.getName(), RequestBody.create(MediaType.parse("image/*"), assinatura));
        Call<ResponseBody> call = rotaOs.sincronizarOsPMOC(ColaboradorSingleton.SINGLETON.getApiToken(this), osJson, body, os.getId());
        Response<ResponseBody> response;
        try {
            response = call.execute();
            if (response.isSuccessful()) {
                os.setIsSync(true);
                os.update();
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void restructureData(OS os) {
        for (ExecucaoProcedimento execucaoProcedimento : os.getExecucoesProcedimentos()) {
            if (execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento() != null) {
                execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento().getValores();
            }
        }
    }

    private void synFotoExecucoes(Intent intent) {
        rotaOs = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(RotaOS.class);
        if (intent != null) {
            List<OS> osPmoc = OSRepository.I.getOSPmocComFotosNaoSincronizadas(this);
            for (OS os : osPmoc) {
                List<ExecucaoProcedimento> execucoes = os.getExecucoesProcedimentos();
                for (ExecucaoProcedimento execucaoProcedimento : execucoes) {
                    if (execucaoProcedimento.getFotosSincronizadas()) {
                        continue;
                    }
                    for (FotoProcedimento fotoProcedimento : execucaoProcedimento.getFotosProcedimento()) {
                        if (fotoProcedimento.getIsSync()) {
                            continue;
                        }
                        RequestBody titutlo = RequestBody.create(MediaType.parse("multipart/form-data"), fotoProcedimento.getTitulo());
                        File file = new File(fotoProcedimento.getPath());
                        MultipartBody.Part body = MultipartBody.Part.createFormData("file", file.getName(), RequestBody.create(MediaType.parse("image/*"), file));
                        Call<ResponseBody> call = rotaOs.sincronizarFotoProcedimento(ColaboradorSingleton.SINGLETON.getApiToken(this), titutlo, fotoProcedimento.getExecucaoProcedimentoId(), body);
                        Response<ResponseBody> response;
                        try {
                            response = call.execute();
                            if (response.isSuccessful()) {
                                fotoProcedimento.setIsSync(true);
                                FotoRepository.I.insertFotoProcedimento(this, fotoProcedimento);
                                FotoUtils.deleteFile(fotoProcedimento.getPath());
                            }
                        } catch (IOException e) {
                        }

                    }

                    execucaoProcedimento.setFotosSincronizadas(todasFotosProcedimentosSincronizadas(execucaoProcedimento.getFotosProcedimento()));
                    execucaoProcedimento.update();
                }
                os.setIsFotosSincronizadas(todasExecucoesSincronizadas(os.getExecucoesProcedimentos()));
                os.update();
            }
        }

    }

    private boolean todasExecucoesSincronizadas(List<ExecucaoProcedimento> execucoesProcedimentos) {
        for (ExecucaoProcedimento execucaoProcedimento : execucoesProcedimentos) {
            if (!execucaoProcedimento.getFotosSincronizadas()) {
                return false;
            }
        }
        return true;
    }

    private boolean todasFotosProcedimentosSincronizadas(List<FotoProcedimento> fotosProcedimento) {
        for (FotoProcedimento fotoProcedimento : fotosProcedimento) {
            if (!fotoProcedimento.getIsSync()) {
                return false;
            }
        }
        return true;
    }

    private void syncFotosOS(Intent intent) {
        rotaOs = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(RotaOS.class);
        if (intent != null) {
            List<OS> osComFotosNaoSincronizadas = OSRepository.I.getOScomFotosNaoSincronizadas(this);
            for (OS os : osComFotosNaoSincronizadas) {
                List<FotoOS> fotos = os.getFotosOs();
                for (FotoOS fotoOS : fotos) {
                    if (fotoOS.getIsSync()) {
                        continue;
                    }
                    RequestBody titutlo = RequestBody.create(MediaType.parse("multipart/form-data"), fotoOS.getTitulo());
                    File file = new File(fotoOS.getPath());
                    MultipartBody.Part body = MultipartBody.Part.createFormData("file", file.getName(), RequestBody.create(MediaType.parse("image/*"), file));
                    Call<ResponseBody> call = rotaOs.sincronizarFotoOS(ColaboradorSingleton.SINGLETON.getApiToken(this), titutlo, fotoOS.getOsId(), body);
                    Response<ResponseBody> response;
                    try {
                        response = call.execute();
                        if (response.isSuccessful()) {
                            fotoOS.setIsSync(true);
                            FotoRepository.I.insertFotoOS(this, fotoOS);
                            FotoUtils.deleteFile(fotoOS.getPath());
                        }
                    } catch (IOException e) {
                    }
                }
                os.setIsFotosSincronizadas(todasFotosSincronizadas(os.getFotosOs()));
                os.update();
            }
        }
    }

    private boolean todasFotosSincronizadas(List<FotoOS> fotosOs) {
        for (FotoOS fotoOS : fotosOs) {
            if (!fotoOS.getIsSync()) {
                return false;
            }
        }
        return true;
    }

}
