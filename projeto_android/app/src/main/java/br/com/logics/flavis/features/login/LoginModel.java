package br.com.logics.flavis.features.login;

import android.content.Context;

import java.io.IOException;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.GenericResponse;
import br.com.logics.flavis.model.repository.ColaboradorRepository;
import br.com.logics.flavis.model.routes.RetrofitSingleton;
import br.com.logics.flavis.model.routes.Users;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * Created by murilo aires on 21/03/2017.
 */

public class LoginModel implements LoginMVP.ModelOps {
    private static final String APP_TOKEN = "";
    private final Users rotaUsuario;
    private LoginMVP.RequiredPresenterOps presenter;

    public LoginModel(LoginMVP.RequiredPresenterOps presenter) {
        this.presenter = presenter;
        this.rotaUsuario = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(Users.class);
    }

    @Override
    public void requestLogin(String username, String password, String userToken, final Context context) {
        Call<GenericResponse> call = rotaUsuario.login(username, password, userToken);
        call.enqueue(new Callback<GenericResponse>() {
            @Override
            public void onResponse(Call<GenericResponse> call, Response<GenericResponse> response) {
                if (response.isSuccessful()) {
                    ColaboradorRepository.R.insertFullColaborador(context, response.body().getColaborador());
                    ColaboradorSingleton.SINGLETON.saveApiToken(context,response.body().getApiToken());
                    presenter.onLogin();
                } else {
                    try {
                        presenter.onErrorLogin(RetrofitSingleton.INSTANCE.getErrorBody(response.errorBody().string()));
                    } catch (IOException e) {
                        presenter.onErrorLogin(context.getString(R.string.something_wrong));
                    }
                }
            }

            @Override
            public void onFailure(Call<GenericResponse> call, Throwable t) {
                presenter.onErrorLogin(context.getString(R.string.something_wrong));
            }
        });
    }


}
