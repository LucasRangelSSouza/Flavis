package br.com.logics.flavis.features.listagem;

import android.content.Context;
import android.os.Bundle;

import java.lang.ref.WeakReference;
import java.util.ArrayList;
import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;

/**
 * Created by murilo aires on 25/03/2017.
 */

public class ListagemPresenter implements ListagemMVP.ListagemPresenterOps, ListagemMVP.RequiredListagemPresenterOps {

    private WeakReference<ListagemMVP.RequiredListagemViewOps> mView;

    private ListagemMVP.ListagemModelOps model;
    private List<OS> osList = new ArrayList<>();

    public ListagemPresenter(ListagemMVP.RequiredListagemViewOps mView) {
        this.mView = new WeakReference<>(mView);
        this.model = new ListagemModel(this);
    }

    @Override
    public void loadNewOs() {
        mView.get().showProgress();
        model.loadOS((Context) mView.get());
    }

    @Override
    public List<OS> getOsList() {
        return osList;
    }

    @Override
    public void loadFromDB() {
        model.loadFromDB((Context) mView.get());
    }

    @Override
    public void loadOsByClienteName(String nomeCliente) {
        model.loadOsByClientName(nomeCliente, (Context) mView.get());
    }

    @Override
    public void openOS(int position) {
        model.setOsAsOpen(osList.get(position));
        Bundle bundle = new Bundle();
        bundle.putLong("osId", osList.get(position).getId());
        mView.get().navigateDetalheOS(bundle);
    }

    @Override
    public void checkOs(int position) {
        OS os = osList.get(position);
        if (os.getAberta()) {
            openOS(position);
        } else {
            if (model.hasOpenOs((Context) mView.get())) {
                mView.get().showToast(((Context) mView.get()).getString(R.string.existe_os_aberta));
            } else if (os.getIsFinalizada()) {
                mView.get().showToast(((Context) mView.get()).getString(R.string.os_ja_finalizada));
            } else {
                String titulo = String.format(((Context) mView.get()).getString(R.string.titulo_os), os.getId().toString());
                String mensagem = String.format(((Context) mView.get()).getString(R.string.message_dialog_open_os), os.getCliente().getNome());
                mView.get().openOsDialog(titulo, mensagem, position);
            }
        }
    }

    @Override
    public void setDataAbertura(int position) {
        model.setDataAberturaOs(osList.get(position));
    }

    private void restructureData(OS os) {
        for (ExecucaoProcedimento execucaoProcedimento : os.getExecucoesProcedimentos()) {
            if (execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento() != null) {
                execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento().getValores();
            }
        }
    }

    @Override
    public void onOSLoadedFromDB(List<OS> osList) {
        this.osList.clear();
        this.osList.addAll(osList);
        mView.get().updateOS();
    }

    @Override
    public void onOSLoaded() {
        mView.get().dismissProgress();
        model.loadFromDB((Context) mView.get());
    }

    @Override
    public void onLoadOSFail(String msg) {
        mView.get().showToast(msg);
    }

}
