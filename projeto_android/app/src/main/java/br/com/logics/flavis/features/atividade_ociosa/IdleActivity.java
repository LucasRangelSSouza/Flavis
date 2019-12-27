package br.com.logics.flavis.features.atividade_ociosa;

import android.app.ProgressDialog;
import android.os.Bundle;
import com.google.android.material.textfield.TextInputEditText;
import com.google.android.material.textfield.TextInputLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.AppCompatSpinner;
import androidx.appcompat.widget.Toolbar;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Toast;

import java.util.Date;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.repository.IdleActivityRepository;
import br.com.logics.flavis.model.routes.RetrofitSingleton;
import br.com.logics.flavis.model.routes.Users;
import br.com.logics.flavis.model.singleton.ColaboradorSingleton;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class IdleActivity extends AppCompatActivity {

    @BindView(R.id.toolbar2)
    Toolbar toolbar;

    @BindView(R.id.textInputLayoutObs)
    TextInputLayout textInputLayoutObs;

    @BindView(R.id.editObservacao)
    TextInputEditText editObservacao;

    @BindView(R.id.textInputLayoutTimeInMinutes)
    TextInputLayout textInputLayoutTimeInMinutes;

    @BindView(R.id.editTimeInMinutes)
    EditText editTimeInMinutes;

    private ProgressDialog progress;

    @OnClick(R.id.btnConfirmar)
    public void btnConfirmarAction(View view) {
        if (validate()) {
            createIdleActivity();
        }
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_idle);
        ButterKnife.bind(this);
        setSupportActionBar(toolbar);
        configureProgress();
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });
    }

    private void configureProgress() {
        progress = new ProgressDialog(this);
        progress.setTitle(getString(R.string.aguarde));
        progress.setMessage(getString(R.string.enviando));
        progress.setIndeterminate(true);
        progress.setCancelable(false);
    }

    private void createIdleActivity() {
        try {
            br.com.logics.flavis.model.entities.idle_activity.IdleActivity activity
                    = new br.com.logics.flavis.model.entities.idle_activity.IdleActivity(null, Integer.parseInt(editTimeInMinutes.getText().toString()), editObservacao.getText().toString()
                    , false, new Date());
            Long id = IdleActivityRepository.R.insertIdleActivity(this, activity);
            activity.setId(id);
            sendActivity(activity);
        } catch (Exception e) {
            Toast.makeText(this, getString(R.string.something_wrong), Toast.LENGTH_SHORT).show();
        }
    }

    private void sendActivity(final br.com.logics.flavis.model.entities.idle_activity.IdleActivity activity) {
        progress.show();

        Call<ResponseBody> call = RetrofitSingleton.INSTANCE.getRetrofiInstance().create(Users.class)
                .postIdleActivity(ColaboradorSingleton.SINGLETON.getApiToken(this), activity.getObs(), activity.getTimeInMinutes(), activity.getDataHoraAtividade());
        call.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()) {
                    activity.setIsSync(true);
                    IdleActivityRepository.R.insertIdleActivity(IdleActivity.this, activity);
                }
                progress.dismiss();
                IdleActivity.this.finish();
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {
                progress.dismiss();
                IdleActivity.this.finish();
            }
        });
    }

    private boolean validate() {
        if (editObservacao.getText().toString().equals("")) {
            textInputLayoutObs.setError(getString(R.string.campo_obrigatorio));
            return false;
        } else if (editTimeInMinutes.getText().toString().equals("")) {
            textInputLayoutTimeInMinutes.setError(getString(R.string.campo_obrigatorio));
            return false;
        } else {
            return true;
        }
    }
}
