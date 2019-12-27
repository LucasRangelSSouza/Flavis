package br.com.logics.flavis.application;

import android.app.AlarmManager;
import android.app.Application;
import android.app.PendingIntent;
import android.app.job.JobInfo;
import android.app.job.JobScheduler;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.database.sqlite.SQLiteDatabase;

import com.google.firebase.iid.FirebaseInstanceId;
import com.squareup.otto.Bus;
import com.squareup.otto.ThreadEnforcer;

import br.com.logics.flavis.features.location.AlarmReceiver;
import br.com.logics.flavis.features.location.GetLocationService;
import br.com.logics.flavis.model.repository.dao.DaoMaster;
import br.com.logics.flavis.model.repository.dao.DaoSession;


/**
 * Created by murilo aires on 21/03/2017.
 */
public class MAALLTApplication extends Application {
    private DaoSession daoSession;
    private static Bus bus = new Bus(ThreadEnforcer.MAIN);
    private static final int REQUEST_ALARM = 424242;

    @Override
    public void onCreate() {
        super.onCreate();
        setUpDatabase();
        FirebaseInstanceId.getInstance();
        scheduleAlarm();
    }

    private void scheduleAlarm() {
//        Intent intent = new Intent(this, AlarmReceiver.class);
//        boolean alarmUp = (PendingIntent.getBroadcast(this, REQUEST_ALARM, intent, PendingIntent.FLAG_NO_CREATE) != null);
//
//        if (!alarmUp) {
//            AlarmManager am = (AlarmManager) getSystemService(Context.ALARM_SERVICE);
//            PendingIntent pi = PendingIntent.getBroadcast(this, REQUEST_ALARM, intent, 0);
//            am.setRepeating(AlarmManager.RTC_WAKEUP, System.currentTimeMillis() + 1000, 1000 * 60 * 5, pi);
//        }

        ComponentName componentName = new ComponentName(getApplicationContext(), GetLocationService.class);
        JobInfo jobInfo = new JobInfo.Builder(1, componentName).setPeriodic(1000 * 60 * 10)
                .setRequiredNetworkType(JobInfo.NETWORK_TYPE_ANY).build();

        JobScheduler tm =
                (JobScheduler) getApplicationContext().getSystemService(Context.JOB_SCHEDULER_SERVICE);
        tm.schedule(jobInfo);
    }

    private void setUpDatabase() {
        DaoMaster.OpenHelper helper = new DbOpenHelper(this, "maalt-db", null);
        SQLiteDatabase db = helper.getWritableDatabase();
        DaoMaster daoMaster = new DaoMaster(db);
        daoSession = daoMaster.newSession();
    }


    public DaoSession getDaoSession() {
        return daoSession;
    }

    public Bus getBus() {
        return bus;
    }
}
