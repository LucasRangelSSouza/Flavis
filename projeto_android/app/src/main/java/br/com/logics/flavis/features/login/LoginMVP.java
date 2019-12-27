package br.com.logics.flavis.features.login;

import android.content.Context;
import android.content.res.Resources;

/**
 * Created by murilo aires on 21/03/2017.
 */

public interface LoginMVP {

    interface RequiredViewOps {
        void showToast(String msg);

        void navigateToHome();

        void showProgress();

        void hideProgress();
    }

    interface PresenterOps {
        void login(String username, String password, String token);
    }

    interface RequiredPresenterOps {
        void onLogin();

        void onErrorLogin(String errorMsg);
    }

    interface ModelOps {
        void requestLogin(String username, String password, String userToken, Context context);
    }
}
