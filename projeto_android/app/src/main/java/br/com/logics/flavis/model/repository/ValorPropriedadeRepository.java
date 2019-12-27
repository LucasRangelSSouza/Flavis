package br.com.logics.flavis.model.repository;

import android.content.Context;

import java.util.List;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.equipamento.TituloValor;
import br.com.logics.flavis.model.entities.equipamento.Valor;
import br.com.logics.flavis.model.repository.dao.ValorDao;

/**
 * Created by murilo aires on 24/05/2017.
 */

public enum ValorPropriedadeRepository {
    I;

    public void insertValores(Context context, List<Valor> valores) {
        for (Valor valor : valores) {
            insertTituloValor(context, valor.getTitulo());
            getValorDao(context).insertOrReplace(valor);
        }
    }

    private ValorDao getValorDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getValorDao();
    }

    private void insertTituloValor(Context context, TituloValor titulo) {
        ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getTituloValorDao().insertOrReplace(titulo);
    }
}
