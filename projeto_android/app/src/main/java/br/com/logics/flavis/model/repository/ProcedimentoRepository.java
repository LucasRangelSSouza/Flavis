package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.os.procedimento.Procedimento;
import br.com.logics.flavis.model.entities.os.procedimento.TituloProcedimento;
import br.com.logics.flavis.model.repository.dao.ProcedimentoDao;
import br.com.logics.flavis.model.repository.dao.TituloProcedimentoDao;

/**
 * Created by murilo aires on 16/05/2017.
 */

public enum ProcedimentoRepository {
    I;

    public void insertProcedimento(Context context, Procedimento procedimentoPmoc) {
        getProcedimentoDao(context).insertOrReplace(procedimentoPmoc);
        insertTituloProcedimento(context, procedimentoPmoc.getTitulo());
        if (procedimentoPmoc.getPropriedadeEquipamento() != null) {
            PropriedadeRepository.I.insertPropriedade(context, procedimentoPmoc.getPropriedadeEquipamento());
        }
    }

    public void insertTituloProcedimento(Context context, TituloProcedimento titulo) {
        getTitutloProcedimento(context).insertOrReplace(titulo);
    }

    private TituloProcedimentoDao getTitutloProcedimento(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getTituloProcedimentoDao();
    }

    private ProcedimentoDao getProcedimentoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getProcedimentoDao();
    }
}
