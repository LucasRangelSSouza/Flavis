package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.os.FotoOS;
import br.com.logics.flavis.model.entities.os.procedimento.FotoProcedimento;
import br.com.logics.flavis.model.repository.dao.FotoOSDao;
import br.com.logics.flavis.model.repository.dao.FotoProcedimentoDao;

/**
 * Created by murilo aires on 13/05/2017.
 */

public enum FotoRepository {

    //instance
    I;

    private FotoOSDao getFotoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getFotoOSDao();
    }

    public void insertFotoOS(Context context, FotoOS foto) {
        getFotoDao(context).insertOrReplace(foto);
    }

    public void insertFotoProcedimento(Context context, FotoProcedimento foto) {
        getFotoProcedimentoDao(context).insertOrReplace(foto);
    }

    private FotoProcedimentoDao getFotoProcedimentoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getFotoProcedimentoDao();
    }
}
