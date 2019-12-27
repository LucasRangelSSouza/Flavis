package br.com.logics.flavis.model.repository;

import android.content.Context;

import org.greenrobot.greendao.query.QueryBuilder;

import java.util.List;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.colaborador.Funcao;
import br.com.logics.flavis.model.entities.idle_activity.IdleActivity;
import br.com.logics.flavis.model.repository.dao.FuncaoDao;
import br.com.logics.flavis.model.repository.dao.IdleActivityDao;

public enum IdleActivityRepository {

    R;

    public Long insertIdleActivity(Context context, IdleActivity activity) {
        return getIdleActivityDao(context).insertOrReplace(activity);
    }

    private IdleActivityDao getIdleActivityDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getIdleActivityDao();
    }

    public List<IdleActivity> getNotSyncIdleActivitties(Context context) {
        QueryBuilder<IdleActivity> qb = getIdleActivityDao(context).queryBuilder();
        return qb.where(IdleActivityDao.Properties.IsSync.eq(false)).list();
    }
}
