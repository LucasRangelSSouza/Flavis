package br.com.logics.flavis.features.location;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.IntentService;
import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.job.JobInfo;
import android.app.job.JobParameters;
import android.app.job.JobService;
import android.content.Intent;
import android.content.Context;
import android.content.IntentFilter;
import android.content.IntentSender;
import android.content.pm.PackageManager;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.BatteryManager;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.core.app.JobIntentService;
import androidx.core.app.NotificationCompat;
import androidx.core.content.ContextCompat;

import android.os.PersistableBundle;
import android.util.Log;
import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.common.api.PendingResult;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.common.api.Status;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.LocationSettingsRequest;
import com.google.android.gms.location.LocationSettingsResult;
import com.google.android.gms.location.LocationSettingsStatusCodes;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import java.util.Date;
import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.location.LocationRegister;
import br.com.logics.flavis.model.repository.LocationRegisterRepository;
import br.com.logics.flavis.model.repository.UserRepository;
import br.com.logics.flavis.model.routes.RetrofitSingleton;
import br.com.logics.flavis.model.routes.RotaLocation;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * An {@link IntentService} subclass for handling asynchronous task requests in
 * a service on a separate handler thread.
 * <p>
 * TODO: Customize class - update intent actions, extra parameters and static
 * helper methods.
 */
public class GetLocationService extends JobService {

    private boolean isPermissionGranted = false;


    GoogleApiClient mGoogleApiClient;
    private Location mLastLocation;

    @Override
    public void onCreate() {
        super.onCreate();
    }

    private void sendLocationsToServer(JobParameters params) {
        final List<LocationRegister> notSendLocations = LocationRegisterRepository.R.getNotSendLocations(this);
        if (notSendLocations.size() > 0) {
            String json = new GsonBuilder().setDateFormat(RetrofitSingleton.DATE_FORMAT).create().toJson(notSendLocations);
            Call<ResponseBody> call = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(RotaLocation.class).syncLocations(ColaboradorSingleton.SINGLETON.getApiToken(this), json);
            call.enqueue(new Callback<ResponseBody>() {
                @Override
                public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                    if (response.isSuccessful()) {
                        for (LocationRegister location : notSendLocations) {
                            location.setIsSync(true);
                            LocationRegisterRepository.R.insertOrReplace(GetLocationService.this, location);
                        }
                    }
                    jobFinished(params,true);
                }

                @Override
                public void onFailure(Call<ResponseBody> call, Throwable t) {
                    Log.d("", "");
                    jobFinished(params,true);
                }
            });
        }

    }


    public static int getBatteryPercentage(Context context) {
        IntentFilter iFilter = new IntentFilter(Intent.ACTION_BATTERY_CHANGED);
        Intent batteryStatus = context.registerReceiver(null, iFilter);

        int level = batteryStatus != null ? batteryStatus.getIntExtra(BatteryManager.EXTRA_LEVEL, -1) : -1;
        int scale = batteryStatus != null ? batteryStatus.getIntExtra(BatteryManager.EXTRA_SCALE, -1) : -1;

        float batteryPct = level / (float) scale;

        return (int) (batteryPct * 100);
    }


    private void buildGoogleApiClient(JobParameters params) {

        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(new GoogleApiClient.ConnectionCallbacks() {
                    @Override
                    public void onConnected(@Nullable Bundle bundle) {
                        mLastLocation = getLocation();
                        if (mLastLocation != null) {
                            Integer batLevel = 100;
                            batLevel = getBatteryPercentage(GetLocationService.this);
                            LocationRegister register = new LocationRegister(null, mLastLocation.getLatitude(), mLastLocation.getLongitude(), new Date(mLastLocation.getTime()), false, batLevel);
                            LocationRegisterRepository.R.insertOrReplace(GetLocationService.this, register);
                            sendLocationsToServer(params);
                        } else {
                            jobFinished(params, true);
                        }
                    }

                    @Override
                    public void onConnectionSuspended(int i) {
                        jobFinished(params, true);
                    }
                })
                .addOnConnectionFailedListener(connectionResult -> {
                    jobFinished(params, true);
                })
                .addApi(LocationServices.API).build();

        mGoogleApiClient.connect();


        LocationRequest mLocationRequest = new LocationRequest();
        mLocationRequest.setInterval(10000);
        mLocationRequest.setFastestInterval(5000);
        mLocationRequest.setPriority(LocationRequest.PRIORITY_BALANCED_POWER_ACCURACY);

        LocationSettingsRequest.Builder builder = new LocationSettingsRequest.Builder()
                .addLocationRequest(mLocationRequest);

        PendingResult<LocationSettingsResult> result = LocationServices.SettingsApi.checkLocationSettings(mGoogleApiClient, builder.build());

        result.setResultCallback(new ResultCallback<LocationSettingsResult>() {
            @Override
            public void onResult(@NonNull LocationSettingsResult locationSettingsResult) {

                final Status status = locationSettingsResult.getStatus();

                switch (status.getStatusCode()) {
                    case LocationSettingsStatusCodes.SUCCESS:
                        // All location settings are satisfied. The client can initialize location requests here
                        mLastLocation = getLocation();
                        break;
                    default:
                        jobFinished(params, true);
                }
            }
        });
    }

    public Location getLocation() {

        if (isPermissionGranted()) {

            try {
                mLastLocation = LocationServices.FusedLocationApi
                        .getLastLocation(mGoogleApiClient);

                return mLastLocation;
            } catch (SecurityException e) {
                e.printStackTrace();

            }

        }

        return null;

    }

    private boolean isPermissionGranted() {
        return isPermissionGranted;
    }

    /**
     * Called to indicate that the job has begun executing.  Override this method with the
     * logic for your job.  Like all other component lifecycle callbacks, this method executes
     * on your application's main thread.
     * <p>
     * Return {@code true} from this method if your job needs to continue running.  If you
     * do this, the job remains active until you call
     * {@link #jobFinished(JobParameters, boolean)} to tell the system that it has completed
     * its work, or until the job's required constraints are no longer satisfied.  For
     * example, if the job was scheduled using
     * {@link JobInfo.Builder#setRequiresCharging(boolean) setRequiresCharging(true)},
     * it will be immediately halted by the system if the user unplugs the device from power,
     * the job's {@link #onStopJob(JobParameters)} callback will be invoked, and the app
     * will be expected to shut down all ongoing work connected with that job.
     * <p>
     * The system holds a wakelock on behalf of your app as long as your job is executing.
     * This wakelock is acquired before this method is invoked, and is not released until either
     * you call {@link #jobFinished(JobParameters, boolean)}, or after the system invokes
     * {@link #onStopJob(JobParameters)} to notify your job that it is being shut down
     * prematurely.
     * <p>
     * Returning {@code false} from this method means your job is already finished.  The
     * system's wakelock for the job will be released, and {@link #onStopJob(JobParameters)}
     * will not be invoked.
     *
     * @param params Parameters specifying info about this job, including the optional
     *               extras configured with {@link JobInfo.Builder#setExtras(PersistableBundle).
     *               This object serves to identify this specific running job instance when calling
     *               {@link #jobFinished(JobParameters, boolean)}.
     * @return {@code true} if your service will continue running, using a separate thread
     * when appropriate.  {@code false} means that this job has completed its work.
     */
    @Override
    public boolean onStartJob(JobParameters params) {
        isPermissionGranted = ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED;
        buildGoogleApiClient(params);
        return true;
    }

    /**
     * This method is called if the system has determined that you must stop execution of your job
     * even before you've had a chance to call {@link #jobFinished(JobParameters, boolean)}.
     *
     * <p>This will happen if the requirements specified at schedule time are no longer met. For
     * example you may have requested WiFi with
     * {@link JobInfo.Builder#setRequiredNetworkType(int)}, yet while your
     * job was executing the user toggled WiFi. Another example is if you had specified
     * {@link JobInfo.Builder#setRequiresDeviceIdle(boolean)}, and the phone left its
     * idle maintenance window. You are solely responsible for the behavior of your application
     * upon receipt of this message; your app will likely start to misbehave if you ignore it.
     * <p>
     * Once this method returns, the system releases the wakelock that it is holding on
     * behalf of the job.</p>
     *
     * @param params The parameters identifying this job, as supplied to
     *               the job in the {@link #onStartJob(JobParameters)} callback.
     * @return {@code true} to indicate to the JobManager whether you'd like to reschedule
     * this job based on the retry criteria provided at job creation-time; or {@code false}
     * to end the job entirely.  Regardless of the value returned, your job must stop executing.
     */
    @Override
    public boolean onStopJob(JobParameters params) {
        return false;
    }
}
