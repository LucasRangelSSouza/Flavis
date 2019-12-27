package br.com.logics.flavis.application;

import android.content.Context;

public enum Bus {
    R;

    public com.squareup.otto.Bus getBus(Context context) {
        return ((MAALLTApplication) context.getApplicationContext()).getBus();
    }
}
