package br.com.logics.flavis.model.singleton;

import android.content.Context;
import android.content.SharedPreferences;

import br.com.logics.flavis.application.Constants;
import br.com.logics.flavis.model.entities.colaborador.Colaborador;
import br.com.logics.flavis.model.repository.ColaboradorRepository;

/**
 * Created by murilo aires on 03/05/2017.
 */

public enum ColaboradorSingleton {
    SINGLETON;

    private static final String PREFERENCE_API_TOKEN = "apiToken";

    public boolean isUsuarioLogado(Context context) {
        return getUsuarioLogado(context) != null;
    }

    private Colaborador getUsuarioLogado(Context context) {
        return ColaboradorRepository.R.getUsuarioLogado(context);
    }

    public void saveApiToken(Context context, String apiToken) {
        SharedPreferences preferences = context.getSharedPreferences(Constants.APP_CONFIGS, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putString(PREFERENCE_API_TOKEN, apiToken);
        editor.apply();
    }

    public String getApiToken(Context context) {
        SharedPreferences preferences = context.getSharedPreferences(Constants.APP_CONFIGS, Context.MODE_PRIVATE);
        return preferences.getString(PREFERENCE_API_TOKEN, null);
    }
}
