package br.com.logics.flavis.model.routes;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import java.util.concurrent.TimeUnit;

import okhttp3.OkHttpClient;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

/**
 * Created by murilo aires on 21/03/2017.
 */

public enum RetrofitSingleton {
    INSTANCE;
    public static final String APP_TOKEN = "iFH46!^K7LD0lwTu%Wn6#uD6Ow!WeqRHObE8qw!5eJtOo3KWq^jT";
    private static RetrofitSingleton instance;

    public static final String DATE_FORMAT = "yyyy-MM-dd'T'HH:mm:ssZ";
//    public static final String BASE_URL = "https://prod.flavis.com.br/"; //Endereço de produção da Flavis
//    public static final String BASE_URL = "http://www.orsin.com.br/"; //Endereço de produção da Orsin
    public static final String BASE_URL = "http://192.169.40.183/"; //Endereço de teste
//    public static final String BASE_URL = "http://192.168.40.133:8080/flavis/projeto-php/web/app.php/";
    public static final String API_V1 = "api/v1/";


    public Retrofit getRetrofiInstance() {
        Gson gson = new GsonBuilder().setDateFormat(DATE_FORMAT).disableHtmlEscaping().create();
        OkHttpClient.Builder builder = new OkHttpClient.Builder();
        builder.connectTimeout(60, TimeUnit.SECONDS).readTimeout(60, TimeUnit.SECONDS);

        return new Retrofit.Builder()
                .baseUrl(BASE_URL)
                .addConverterFactory(GsonConverterFactory.create(gson)).client(builder.build()).build();
    }

    public String getErrorBody(String string) {
        return string;
    }
}
