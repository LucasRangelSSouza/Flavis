package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.cliente.Cliente;
import br.com.logics.flavis.model.entities.os.procedimento.ClienteEquipamento;
import br.com.logics.flavis.model.repository.dao.ClienteDao;
import br.com.logics.flavis.model.repository.dao.ClienteEquipamentoDao;

/**
 * Created by murilo aires on 15/05/2017.
 */

public enum ClienteRepository {
    I;

    private static ClienteDao getClienteDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getClienteDao();
    }

    public void insertCliente(Context context, Cliente cliente) {
        getClienteDao(context).insertOrReplace(cliente);
        TelefoneRepository.I.insertAll(context, cliente.getTelefones());
    }

    public void insertClienteEquipamento(Context context, ClienteEquipamento clienteEquipamento) {
        getClienteEquipamentoDao(context).insertOrReplace(clienteEquipamento);
        insertCliente(context, clienteEquipamento.getCliente());
        EquipamentoRepository.I.insertEquipamento(context, clienteEquipamento.getEquipamento());

    }

    private ClienteEquipamentoDao getClienteEquipamentoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getClienteEquipamentoDao();

    }
}
