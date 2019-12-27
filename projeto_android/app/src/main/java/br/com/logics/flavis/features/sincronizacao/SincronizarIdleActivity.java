package br.com.logics.flavis.features.sincronizacao;

import android.app.IntentService;
import android.content.Context;
import android.content.Intent;

import com.google.gson.GsonBuilder;

import java.util.List;

import br.com.logics.flavis.model.entities.idle_activity.IdleActivity;
import br.com.logics.flavis.model.repository.IdleActivityRepository;
import br.com.logics.flavis.model.repository.UserRepository;
import br.com.logics.flavis.model.routes.RetrofitSingleton;
import br.com.logics.flavis.model.routes.Users;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Response;


public class SincronizarIdleActivity extends IntentService {

    public SincronizarIdleActivity() {
        super("SincronizarIdleActivity");
    }

    @Override
    protected void onHandleIntent(Intent intent) {
        if (intent != null) {
            List<IdleActivity> list = IdleActivityRepository.R.getNotSyncIdleActivitties(this);
            if (list.size() > 0 && ColaboradorSingleton.SINGLETON.isUsuarioLogado(this)) {
                String json = new GsonBuilder().setDateFormat(RetrofitSingleton.DATE_FORMAT).create().toJson(list);
                Call<ResponseBody> call = RetrofitSingleton.INSTANCE.getRetrofiInstance()
                        .create(Users.class).postRemainingIdleActivities(ColaboradorSingleton.SINGLETON.getApiToken(this), json);
                Response<ResponseBody> response = null;
                try {
                    response = call.execute();
                    if (response.isSuccessful()) {
                        for (IdleActivity activity : list) {
                            activity.setIsSync(true);
                            IdleActivityRepository.R.insertIdleActivity(this, activity);
                        }
                    }
                } catch (Exception e) {

                }

            }
        }
    }

    public static void startSync(Context context) {
        Intent intent = new Intent(context, SincronizarIdleActivity.class);
        context.startService(intent);
    }

}
