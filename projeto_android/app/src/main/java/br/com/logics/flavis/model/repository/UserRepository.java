package br.com.logics.flavis.model.repository;

import android.content.Context;

import br.com.logics.flavis.application.MAALLTApplication;
import br.com.logics.flavis.model.entities.colaborador.User;
import br.com.logics.flavis.model.repository.dao.UserDao;

/**
 * Created by murilo aires on 03/05/2017.
 */

public enum UserRepository {
    R;

    public void insertUser(Context context, User user) {
        getUserDao(context).insertOrReplace(user);
    }

    private UserDao getUserDao(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getDaoSession().getUserDao();
    }
}
