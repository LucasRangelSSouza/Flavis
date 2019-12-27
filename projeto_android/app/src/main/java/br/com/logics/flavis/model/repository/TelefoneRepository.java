package br.com.logics.flavis.model.repository;

import android.content.Context;

import java.util.List;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.cliente.Telefone;
import br.com.logics.flavis.model.repository.dao.TelefoneDao;
import br.com.logics.flavis.model.repository.dao.TipoTelefoneDao;

/**
 * Created by murilo aires on 15/05/2017.
 */

public enum TelefoneRepository {
    I;

    public void insertAll(Context context, List<Telefone> telefones) {
        for (Telefone telefone : telefones) {
            getTelefoneDao(context).insertOrReplace(telefone);
            getTipoTelefoneDao(context).insertOrReplace(telefone.getTipo());

        }
    }

    private TelefoneDao getTelefoneDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getTelefoneDao();
    }

    private TipoTelefoneDao getTipoTelefoneDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getTipoTelefoneDao();
    }
}
