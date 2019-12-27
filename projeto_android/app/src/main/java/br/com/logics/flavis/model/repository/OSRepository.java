package br.com.logics.flavis.model.repository;

import android.content.Context;

import org.greenrobot.greendao.query.Join;
import org.greenrobot.greendao.query.QueryBuilder;

import java.util.List;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.cliente.Cliente;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.repository.dao.ClienteDao;
import br.com.logics.flavis.model.repository.dao.OSDao;

/**
 * Created by murilo aires on 24/03/2017.
 */

public enum OSRepository {
    I;

    public void insertList(List<OS> listOS, Context context) {
        for (OS os : listOS) {
            os.restructureFields();
            getOSDao(context).insertOrReplace(os);
            ClienteRepository.I.insertCliente(context, os.getCliente());
            EnderecoRepository.I.insertEndereco(context, os.getEndereco());
            ExecucaoProcedimentoRepository.I.insertExecucoesProcedimentos(context, os.getExecucoesProcedimentos());
        }
    }

    private OSDao getOSDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getOSDao();
    }

    public List<OS> loadAll(Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        qb.where(OSDao.Properties.IsFinalizada.eq(false), OSDao.Properties.IsSync.eq(false));
        qb.orderAsc(OSDao.Properties.CreatedAt);
        return qb.build().list();
    }

    public List<OS> loadByClientName(String nomeCliente, Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        Join cliente = qb.join(OSDao.Properties.ClienteId, Cliente.class);
        cliente.where(ClienteDao.Properties.Nome.like(nomeCliente));
        return qb.list();
    }

    public OS findOpenOS(Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        qb.where(OSDao.Properties.Aberta.eq(true));
        if (qb.list().size() == 0) {
            return null;
        }
        return qb.list().get(0);
    }

    public OS findLastCreatedOS(Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        qb.orderDesc(OSDao.Properties.CreatedAt);
        if (qb.list().size() == 0) {
            return null;
        }
        return qb.list().get(0);
    }

    public OS loadOs(Context context, Long osId) {
        return getOSDao(context).load(osId);
    }

    public List<OS> getOScomFotosNaoSincronizadas(Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        qb.where(OSDao.Properties.IsFotosSincronizadas.eq(false), OSDao.Properties.IsPmoc.eq(false), OSDao.Properties.IsSync.eq(true));
        return qb.list();
    }

    public List<OS> getOSPmocComFotosNaoSincronizadas(Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        qb.where(OSDao.Properties.IsFotosSincronizadas.eq(false), OSDao.Properties.IsPmoc.eq(true), OSDao.Properties.IsSync.eq(true));
        return qb.list();
    }

    public List<OS> loadOsToSync(Context context) {
        QueryBuilder<OS> qb = getOSDao(context).queryBuilder();
        qb.where(OSDao.Properties.IsFinalizada.eq(true), OSDao.Properties.IsSync.eq(false));
        return qb.list();
    }
}
