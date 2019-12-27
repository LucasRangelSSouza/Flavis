package br.com.logics.flavis.model.repository;

import android.content.Context;

import org.greenrobot.greendao.query.QueryBuilder;

import java.util.List;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;
import br.com.logics.flavis.model.repository.dao.ExecucaoProcedimentoDao;

/**
 * Created by murilo aires on 15/05/2017.
 */

public enum ExecucaoProcedimentoRepository {
    I;

    public void insertExecucoesProcedimentos(Context context, List<ExecucaoProcedimento> execucoesProcedimentos) {
        for (ExecucaoProcedimento execucaoProcedimento : execucoesProcedimentos) {
            getExecucaoProcedimentoDao(context).insertOrReplace(execucaoProcedimento);
            ClienteRepository.I.insertClienteEquipamento(context, execucaoProcedimento.getClienteEquipamento());
            ProcedimentoRepository.I.insertProcedimento(context, execucaoProcedimento.getProcedimentoPmoc());
        }
    }

    private ExecucaoProcedimentoDao getExecucaoProcedimentoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getExecucaoProcedimentoDao();
    }

}
