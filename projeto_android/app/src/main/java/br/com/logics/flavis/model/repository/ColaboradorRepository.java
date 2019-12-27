package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.colaborador.Colaborador;
import br.com.logics.flavis.model.repository.dao.ColaboradorDao;

/**
 * Created by murilo aires on 03/05/2017.
 */

public enum ColaboradorRepository {
    R;

    public void insertFullColaborador(Context context, Colaborador colaborador) {
        restructureFields(colaborador);
        UserRepository.R.insertUser(context, colaborador.getDetachedUser());
        getColaboradorDao(context).insertOrReplace(colaborador);
    }

    private void restructureFields(Colaborador colaborador) {
        colaborador.setUser(colaborador.getDetachedUser());
    }

    private ColaboradorDao getColaboradorDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getColaboradorDao();
    }

    public Colaborador getUsuarioLogado(Context context) {
        try {
            return getColaboradorDao(context).loadAll().get(0);
        } catch (IndexOutOfBoundsException e) {
            return null;
        }


    }
}
