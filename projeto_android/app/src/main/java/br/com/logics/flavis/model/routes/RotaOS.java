package br.com.logics.flavis.model.routes;

import br.com.logics.flavis.model.entities.GenericList;
import br.com.logics.flavis.model.entities.os.OS;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.Headers;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Path;
import retrofit2.http.Query;


/**
 * Created by murilo aires on 25/03/2017.
 */

public interface RotaOS {
    String OS_PATH = "os/";

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @GET(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + "os.json")
    Call<GenericList<OS>> getOs(@Header("apiToken") String apiToken, @Query("createdAfter") String createdAfter, @Query("offset") Integer offset, @Query("limit") Integer limit);

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @POST(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + "os/{osId}/realizadas.json")
    @Multipart
    Call<ResponseBody> sincronizarOsSemPMOC(@Header("apiToken") String apiToken, @Part("relatorioAvaliacao") RequestBody relatorioAvaliacao, @Part("isEncerrada") RequestBody isEncerrada, @Part("justificativaEncerramento") RequestBody justificativaEncerramento, @Part("receptorNome") RequestBody receptorNome, @Part("receptorRg") RequestBody receptorRg, @Path("osId") Long osId, @Part MultipartBody.Part body);

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @POST(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + "os/{osId}/pmocs/realizadas.json")
    @Multipart
    Call<ResponseBody> sincronizarOsPMOC(@Header("apiToken") String apiToken, @Part("data") RequestBody jsonData, @Part MultipartBody.Part body, @Path("osId") Long osId);

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @POST(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + "os/{osId}/fotos.json")
    @Multipart
    Call<ResponseBody> sincronizarFotoOS(@Header("apiToken") String apiToken, @Part("titulo") RequestBody fotoTitulo, @Path("osId") Long osId, @Part MultipartBody.Part body);

    @Headers("appToken:" + RetrofitSingleton.APP_TOKEN)
    @POST(RetrofitSingleton.BASE_URL + RetrofitSingleton.API_V1 + "fotos/{execucaoId}/execucaos/os.json")
    @Multipart
    Call<ResponseBody> sincronizarFotoProcedimento(@Header("apiToken") String apiToken, @Part("titulo") RequestBody titutlo, @Path("execucaoId") Long execucaoProcedimentoId, @Part MultipartBody.Part body);
}