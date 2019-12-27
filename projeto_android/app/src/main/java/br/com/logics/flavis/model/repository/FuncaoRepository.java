package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.colaborador.Funcao;
import br.com.logics.flavis.model.repository.dao.FuncaoDao;

/**
 * Created by murilo aires on 03/05/2017.
 */

public enum FuncaoRepository {
    R;

    public void insertFuncao(Context context, Funcao funcao) {
        getFuncaoDao(context).insertOrReplace(funcao);
    }

    private FuncaoDao getFuncaoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getFuncaoDao();
    }
}
