package br.com.logics.flavis.model.routes;

import java.util.Date;

import br.com.logics.flavis.model.entities.GenericResponse;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.Query;

/**
 * Created by murilo aires on 21/03/2017.
 */

public interface Users {
    String USER = "users/";
    String TEMPOS = "tempos/";
    String ARRAYS = "arrays/";

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @GET(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + USER + "login.json")
    Call<GenericResponse> login(@Query("email") String username, @Query("code") String password, @Query("userToken") String userToken);

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @POST(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + TEMPOS + "ociosos/tecnicos.json")
    @FormUrlEncoded
    Call<ResponseBody> postIdleActivity(@Header("apiToken") String apiToken, @Field("observacao") String observacao, @Field("tempoGasto") Integer tempoGasto, @Field("dataHoraAtividade") Date dataHoraAtividade);

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @POST(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + ARRAYS + TEMPOS + "ociosos/tecnicos.json")
    @FormUrlEncoded
    Call<ResponseBody> postRemainingIdleActivities(@Header("apiToken") String apiToken, @Field("data") String data);


}
