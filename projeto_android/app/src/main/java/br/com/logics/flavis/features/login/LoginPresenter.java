package br.com.logics.flavis.features.login;

import android.content.Context;
import android.provider.Settings;

import com.google.firebase.iid.FirebaseInstanceId;

import java.lang.ref.WeakReference;

/**
 * Created by murilo aires on 21/03/2017.
 */

public class LoginPresenter implements LoginMVP.PresenterOps, LoginMVP.RequiredPresenterOps {

    private WeakReference<LoginMVP.RequiredViewOps> mView;

    private LoginMVP.ModelOps model;

    public LoginPresenter(LoginMVP.RequiredViewOps mView) {
        this.mView = new WeakReference<>(mView);
        this.model = new LoginModel(this);
    }

    @Override
    public void login(String username, String password, String token) {
        mView.get().showProgress();
        Context context = ((Context) mView.get());
        model.requestLogin(username, password, token, context);
    }

    private String getDeviceTolen(Context context) {
        return Settings.Secure.getString(context.getContentResolver(), Settings.Secure.ANDROID_ID);
    }

    @Override
    public void onLogin() {
        mView.get().hideProgress();
        this.mView.get().navigateToHome();
    }

    @Override
    public void onErrorLogin(String errorMsg) {
        mView.get().hideProgress();
        this.mView.get().showToast(errorMsg);
    }
}
