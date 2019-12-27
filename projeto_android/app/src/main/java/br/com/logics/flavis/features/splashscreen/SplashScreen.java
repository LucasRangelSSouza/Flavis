package br.com.logics.flavis.features.splashscreen;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import androidx.appcompat.app.AppCompatActivity;

import br.com.logics.flavis.R;
import br.com.logics.flavis.features.listagem.view.ListagemOsActivity;
import br.com.logics.flavis.features.login.LoginActivity;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;

public class SplashScreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);
        Handler handler = new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                if (ColaboradorSingleton.SINGLETON.isUsuarioLogado(SplashScreen.this)) {
                    startActivity(new Intent(SplashScreen.this, ListagemOsActivity.class));
                } else {
                    startActivity(new Intent(SplashScreen.this, LoginActivity.class));
                }

                finish();
            }
        }, 2000);
    }
}
