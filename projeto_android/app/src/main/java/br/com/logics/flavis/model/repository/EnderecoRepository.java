package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.endereco.Bairro;
import br.com.logics.flavis.model.entities.endereco.Cidade;
import br.com.logics.flavis.model.entities.endereco.Endereco;
import br.com.logics.flavis.model.entities.endereco.TipoEndereco;
import br.com.logics.flavis.model.repository.dao.BairroDao;
import br.com.logics.flavis.model.repository.dao.CidadeDao;
import br.com.logics.flavis.model.repository.dao.EnderecoDao;
import br.com.logics.flavis.model.repository.dao.TipoEnderecoDao;

/**
 * Created by murilo aires on 15/05/2017.
 */

public enum EnderecoRepository {
    I;

    public void insertEndereco(Context context, Endereco endereco) {
        getEnderecoDao(context).insertOrReplace(endereco);
        insertBairro(context, endereco.getBairro());
        insertTipoEndereco(context, endereco.getTipo());
    }

    public void insertTipoEndereco(Context context, TipoEndereco tipoEndereco) {
        getTipoEnderecoDao(context).insertOrReplace(tipoEndereco);
    }

    private TipoEnderecoDao getTipoEnderecoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getTipoEnderecoDao();
    }

    public void insertBairro(Context context, Bairro bairro) {
        getBairroDao(context).insertOrReplace(bairro);
        insertCidade(context, bairro.getCidade());
    }

    public void insertCidade(Context context, Cidade cidade) {
        getCidadeDao(context).insertOrReplace(cidade);
    }

    private CidadeDao getCidadeDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getCidadeDao();
    }

    private BairroDao getBairroDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getBairroDao();
    }

    private EnderecoDao getEnderecoDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getEnderecoDao();
    }
}
