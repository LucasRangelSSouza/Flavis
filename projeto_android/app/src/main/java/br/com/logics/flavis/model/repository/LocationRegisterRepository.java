package br.com.logics.flavis.model.repository;

import android.content.Context;

import org.greenrobot.greendao.query.QueryBuilder;

import java.util.List;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.features.location.GetLocationService;
import br.com.logics.flavis.model.entities.location.LocationRegister;
import br.com.logics.flavis.model.repository.dao.LocationRegisterDao;

public enum LocationRegisterRepository {
    R;

    private LocationRegisterDao getLocationRegisterDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getLocationRegisterDao();
    }

    public void insertOrReplace(Context context, LocationRegister register) {
        getLocationRegisterDao(context).insertOrReplace(register);
    }

    public List<LocationRegister> getNotSendLocations(Context context) {
        QueryBuilder<LocationRegister> queryBuilder = getLocationRegisterDao(context).queryBuilder();
        queryBuilder.where(LocationRegisterDao.Properties.IsSync.eq(false));
        return queryBuilder.list();
    }
}
