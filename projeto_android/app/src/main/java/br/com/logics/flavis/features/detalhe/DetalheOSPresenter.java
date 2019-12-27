package br.com.logics.flavis.features.detalhe;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;

import com.yalantis.ucrop.UCrop;

import java.io.File;
import java.lang.ref.WeakReference;
import java.util.Date;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.endereco.Endereco;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.utils.fotos.FotoUtils;

/**
 * Created by murilo aires on 24/05/2017.
 */

public class DetalheOSPresenter implements DetalheOSMVP.DetalhePresenterOps, DetalheOSMVP.RequiredDetalhePresenterOps {

    private OS os;
    private DetalheOSMVP.DetalheModelOps model;
    private WeakReference<DetalheOSMVP.RequiredDetalheViewOps> mView;
    private int posicaoProcedimento;
    private boolean isFotoProcedimento;
    private int lastExecucaoOpenPosition;

    public DetalheOSPresenter(DetalheOSMVP.RequiredDetalheViewOps detalheViewOps) {
        this.mView = new WeakReference<>(detalheViewOps);
        this.model = new DetalheOSModel(this);
    }

    @Override
    public void loadOs(Intent intent) {
        this.os = model.loadOs((Context) mView.get(), intent.getExtras().getLong("osId"));
        mView.get().setPmocVisibilities(os.getIsPmoc());
        mView.get().setNomeCliente(os.getCliente().getNome());
        String endereco = getStringEndereco(os.getEndereco());
        mView.get().setEndereco(endereco);
        mView.get().setOcorrencia(os.getOcorrencia());
        mView.get().loadSavedField(os);
    }

    @Override
    public OS getOs() {
        return os;
    }

    @Override
    public void ajdustPicture(Context context, String mCurrentPhotoPath) {
        UCrop.Options options = new UCrop.Options();
        options.setFreeStyleCropEnabled(true);
        options.setHideBottomControls(true);
        options.setToolbarColor(context.getResources().getColor(R.color.colorPrimary));
        options.setStatusBarColor(context.getResources().getColor(R.color.colorPrimaryDark));
        options.setToolbarTitle(context.getString(R.string.cortar));
        options.setMaxBitmapSize(1920);
        options.withMaxResultSize(1920, 1920);
        try {
            Uri destination = null;
            destination = Uri.fromFile(new File(mCurrentPhotoPath));
            mView.get().openCropActivity(options, destination);
        } catch (Exception e) {
            mView.get().showToast(context.getString(R.string.erro_criacao_arquivo));
        }
    }

    @Override
    public void onPhotoCropped(Uri output) {
        String croppedPath = FotoUtils.getPath((Context) mView.get(), output);
        mView.get().showTituloFotoOsDialog(new File(croppedPath));
    }

    @Override
    public void openCropActivity(Uri source) {
        UCrop.Options options = new UCrop.Options();
        options.setFreeStyleCropEnabled(true);
        options.setHideBottomControls(true);
        options.setToolbarColor(((Context) mView.get()).getResources().getColor(R.color.colorPrimary));
        options.setStatusBarColor(((Context) mView.get()).getResources().getColor(R.color.colorPrimaryDark));
        options.setToolbarTitle(((Context) mView.get()).getString(R.string.cortar));
        options.setMaxBitmapSize(1920);
        options.withMaxResultSize(1920, 1920);
        Uri destination = null;
        destination = Uri.fromFile(FotoUtils.getOutputMediaFile());

        mView.get().openCropActivity(options, source, destination);
    }

    @Override
    public void onTituloFotoInserido(String absolutePath, String titulo, boolean isFotoProcedimento, int posicaoProcedimento) {
        this.isFotoProcedimento = isFotoProcedimento;
        this.posicaoProcedimento = posicaoProcedimento;
        if (isFotoProcedimento) {
            model.createFotoProcedimento((Context) mView.get(), os.getExecucoesProcedimentos().get(posicaoProcedimento), absolutePath, titulo);
        } else {
            model.createFotoOs((Context) mView.get(), os, absolutePath, titulo);
        }
    }

    @Override
    public void finalizarOS(String relatorioOs, String justificativa, String nomeReceptor, String rgReceptor, boolean isEncerrada, String assinaturaPath) {
        if (!os.getIsPmoc() && relatorioOs.equals("")) {
            mView.get().setRelatorioOSError();
            return;
        }

        if (isEncerrada && justificativa.equals("")) {
            mView.get().setJustificativaOSError();
            return;
        }

        if (nomeReceptor.equals("")) {
            mView.get().setNomeReceptorError();
            return;
        }

        if (rgReceptor.equals("")) {
            mView.get().setRgReceptorError();
            return;
        }

        if (assinaturaPath == null) {
            mView.get().showToast(((Context) mView.get()).getString(R.string.assinatura_obrigatoria));
            return;
        }
        if (os.getIsPmoc() && !os.isProcedimentosEncerrados()) {
            mView.get().showToast(((Context) mView.get()).getString(R.string.finalize_procedimentos));
            return;
        }

        os.setJustificativaEncerramento(justificativa);
        os.setRelatorioAvaliacao(relatorioOs);
        os.setReceptorNome(nomeReceptor);
        os.setReceptorRg(rgReceptor);
        os.setIsEncerrada(isEncerrada);
        os.setIsFinalizada(true);
        os.setAberta(false);
        os.setPathAssinatura(assinaturaPath);
        os.setDataEncerramento(new Date());
        model.saveOSFinalizada(os);

    }


    @Override
    public void salvarOs(String justificativa, String relatorioOS, String nomeReceptor, String rgReceptor, boolean isEncerrada, String assinatura) {
        os.setJustificativaEncerramento(justificativa);
        os.setRelatorioAvaliacao(relatorioOS);
        os.setReceptorNome(nomeReceptor);
        os.setReceptorRg(rgReceptor);
        os.setIsEncerrada(isEncerrada);
        os.setPathAssinatura(assinatura);
        model.saveOS(os);
    }

    private String getStringEndereco(Endereco endereco) {
        return String.format(((Context) mView.get()).getString(R.string.format_endereco), endereco.getLogradouro(), endereco.getComplemento(), endereco.getBairro().getNome(), endereco.getBairro().getCidade().getNome(), endereco.getBairro().getCidade().getUf(), endereco.getCep());
    }

    @Override
    public void onFotoOsCriada() {
        if (!isFotoProcedimento) {
            os.resetFotosOs();
            mView.get().updateRecyclerFotos(os.getFotosOs());
        } else {
            os.getExecucoesProcedimentos().get(posicaoProcedimento).resetFotosProcedimento();
            mView.get().updateRecyclerFotosProcedimentos(posicaoProcedimento, os.getExecucoesProcedimentos().get(posicaoProcedimento).getFotosProcedimento());
        }
    }

    @Override
    public void onOSFinalizada() {
        mView.get().finalizarOS();
    }
}
