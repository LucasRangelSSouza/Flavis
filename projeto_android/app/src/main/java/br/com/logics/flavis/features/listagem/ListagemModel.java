package br.com.logics.flavis.features.listagem;


import android.content.Context;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.GenericList;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.repository.OSRepository;
import br.com.logics.flavis.model.routes.RetrofitSingleton;
import br.com.logics.flavis.model.routes.RotaOS;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * Created by murilo aires on 25/03/2017.
 */
public class ListagemModel implements ListagemMVP.ListagemModelOps {
    private ListagemMVP.RequiredListagemPresenterOps presenter;
    private Call<GenericList<OS>> call;
    private Call<ResponseBody> callOsSync;
    private Call<ResponseBody> callOsSyncPmoc;

    public ListagemModel(ListagemMVP.RequiredListagemPresenterOps presenter) {
        this.presenter = presenter;
    }

    @Override
    public void loadOS(final Context context) {
        call = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(RotaOS.class).getOs(ColaboradorSingleton.SINGLETON.getApiToken(context), getLastOSDate(context), 0, 10);
        call.enqueue(new Callback<GenericList<OS>>() {
            @Override
            public void onResponse(Call<GenericList<OS>> call, Response<GenericList<OS>> response) {
                if (response.isSuccessful()) {
                    List<OS> os = response.body().getData();
                    OSRepository.I.insertList(os, context);
                    presenter.onOSLoaded();
                } else {
                    try {
                        presenter.onLoadOSFail(RetrofitSingleton.INSTANCE.getErrorBody(response.errorBody().string()));
                    } catch (IOException e) {
                        presenter.onLoadOSFail(RetrofitSingleton.INSTANCE.getErrorBody(context.getString(R.string.something_wrong)));
                    }
                    presenter.onOSLoaded();
                }

            }

            @Override
            public void onFailure(Call<GenericList<OS>> call, Throwable t) {
                presenter.onLoadOSFail(RetrofitSingleton.INSTANCE.getErrorBody(context.getString(R.string.something_wrong)));
                presenter.onOSLoaded();
            }
        });
    }

    private String getLastOSDate(Context context) {
        OS os = OSRepository.I.findLastCreatedOS(context);
        if (os == null) {
            return null;
        }
        return new SimpleDateFormat(RetrofitSingleton.DATE_FORMAT).format(os.getCreatedAt());
    }

    @Override
    public void loadFromDB(Context context) {
        presenter.onOSLoadedFromDB(OSRepository.I.loadAll(context));
    }

    @Override
    public void loadOsByClientName(String nomeCliente, Context context) {
        presenter.onOSLoadedFromDB(OSRepository.I.loadByClientName(nomeCliente, context));
    }

    @Override
    public boolean hasOpenOs(Context context) {
        OS openOs = OSRepository.I.findOpenOS(context);
        return openOs != null;
    }

    @Override
    public void setOsAsOpen(OS os) {
        os.setAberta(true);
        os.update();
        os.refresh();
    }

    @Override
    public void setDataAberturaOs(OS os) {
        os.setDataAbertura(new Date());
        os.update();
        os.refresh();
    }
}
