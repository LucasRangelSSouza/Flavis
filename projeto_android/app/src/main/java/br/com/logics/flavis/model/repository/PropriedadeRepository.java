package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.equipamento.PropriedadeEquipamento;
import br.com.logics.flavis.model.entities.equipamento.TituloPropriedade;
import br.com.logics.flavis.model.entities.os.procedimento.TituloProcedimento;
import br.com.logics.flavis.model.repository.dao.PropriedadeEquipamentoDao;
import br.com.logics.flavis.model.repository.dao.TituloPropriedadeDao;

/**
 * Created by murilo aires on 24/05/2017.
 */

public enum PropriedadeRepository {
    I;

    public void insertPropriedade(Context context, PropriedadeEquipamento propriedadeEquipamento) {
        insertTituloPropriedadeEquipamento(context, propriedadeEquipamento.getTitulo());
        ValorPropriedadeRepository.I.insertValores(context,propriedadeEquipamento.getValores());
        getPropriedadeEquipamentoDao(context).insertOrReplace(propriedadeEquipamento);
    }

    private void insertTituloPropriedadeEquipamento(Context context, TituloPropriedade titulo) {
        getTituloPropriedadeDao(context).insertOrReplace(titulo);
    }

    private PropriedadeEquipamentoDao getPropriedadeEquipamentoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getPropriedadeEquipamentoDao();
    }

    private TituloPropriedadeDao getTituloPropriedadeDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getTituloPropriedadeDao();
    }
}
