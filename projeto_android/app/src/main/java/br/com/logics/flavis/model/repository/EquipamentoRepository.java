package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.equipamento.Equipamento;
import br.com.logics.flavis.model.entities.equipamento.Marca;
import br.com.logics.flavis.model.entities.equipamento.Modelo;
import br.com.logics.flavis.model.repository.dao.EquipamentoDao;
import br.com.logics.flavis.model.repository.dao.MarcaDao;
import br.com.logics.flavis.model.repository.dao.ModeloDao;

/**
 * Created by murilo aires on 16/05/2017.
 */


public enum EquipamentoRepository {
    I;

    public void insertEquipamento(Context context, Equipamento equipamento) {
        getEquipamentoDao(context).insertOrReplace(equipamento);
        insertModelo(context, equipamento.getModelo());
        insertMarca(context, equipamento.getMarca());
    }

    public void insertMarca(Context context, Marca marca) {
        getMarcaDao(context).insertOrReplace(marca);
    }

    private MarcaDao getMarcaDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getMarcaDao();
    }

    public void insertModelo(Context context, Modelo modelo) {
        getModeloDao(context).insertOrReplace(modelo);
    }

    private ModeloDao getModeloDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getModeloDao();
    }

    private EquipamentoDao getEquipamentoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getEquipamentoDao();
    }
}
