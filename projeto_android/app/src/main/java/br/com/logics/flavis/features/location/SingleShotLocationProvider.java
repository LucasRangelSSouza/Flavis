package br.com.logics.flavis.features.location;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import androidx.core.app.ActivityCompat;
import android.util.Log;

public class SingleShotLocationProvider {

    public static interface LocationCallback {
        public void onNewLocationAvailable(Location location);
    }

    // calls back to calling thread, note this is for low grain: if you want higher precision, swap the
    // contents of the else and if. Also be sure to check gps permission/settings are allowed.
    // call usually takes <10ms
    @SuppressLint("MissingPermission")
    public static void requestSingleUpdate(final Context context, final LocationCallback callback) {

        final LocationManager locationManager = (LocationManager) context.getSystemService(Context.LOCATION_SERVICE);
        boolean isGPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
        boolean isNetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
        if (isNetworkEnabled) {
            Criteria criteria = new Criteria();
            criteria.setAccuracy(Criteria.ACCURACY_COARSE);
            locationManager.requestSingleUpdate(LocationManager.NETWORK_PROVIDER, new LocationListener() {
                @Override
                public void onLocationChanged(Location location) {
                    callback.onNewLocationAvailable(location);
                }

                @Override
                public void onStatusChanged(String s, int i, Bundle bundle) {
                    Log.d("", "");
                }

                @Override
                public void onProviderEnabled(String s) {
                    Log.d("", "");
                }

                @Override
                public void onProviderDisabled(String s) {
                    Log.d("", "");
                }
            }, null);
        } else if (isGPSEnabled) {
            Criteria criteria = new Criteria();
            criteria.setAccuracy(Criteria.ACCURACY_FINE);

            locationManager.requestSingleUpdate(criteria, new LocationListener() {
                @Override
                public void onLocationChanged(Location location) {
                    callback.onNewLocationAvailable(location);
                }

                @Override
                public void onStatusChanged(String provider, int status, Bundle extras) {
                    Log.d("", "");
                }

                @Override
                public void onProviderEnabled(String provider) {
                    Log.d("", "");
                }

                @Override
                public void onProviderDisabled(String provider) {
                    Log.d("", "");
                }
            }, null);
        }


    }


}