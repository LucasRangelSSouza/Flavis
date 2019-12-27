package br.com.logics.flavis.features.login;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

import android.view.KeyEvent;
import android.view.View;
import android.view.inputmethod.EditorInfo;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.mobsandgeeks.saripaar.ValidationError;
import com.mobsandgeeks.saripaar.Validator;
import com.mobsandgeeks.saripaar.annotation.Email;
import com.mobsandgeeks.saripaar.annotation.NotEmpty;

import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.application.Constants;
import br.com.logics.flavis.features.listagem.view.ListagemOsActivity;
import br.com.logics.flavis.features.notification.MyFirebaseMessagingService;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;

public class LoginActivity extends AppCompatActivity implements Validator.ValidationListener, LoginMVP.RequiredViewOps {

    private Validator validator;
    private LoginMVP.PresenterOps presenter;

    @OnClick(R.id.btn_entrar)
    public void btnEntrarAction(View view) {
        validate();
    }

//    @NotEmpty(messageResId = R.string.ordinary_field)
    @BindView(R.id.edt_email)
//    @Email(messageResId = R.string.invalid_email)
    EditText edtEmail;

    @NotEmpty(messageResId = R.string.ordinary_field)
    @BindView(R.id.edt_password)
    EditText edtPassword;

    private ProgressDialog progressDialog;

    private void validate() {
        validator.validate();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        ButterKnife.bind(this);
        validator = new Validator(this);
        validator.setValidationListener(this);
        presenter = new LoginPresenter(this);
        edtPassword.setOnEditorActionListener(new TextView.OnEditorActionListener() {
            public boolean onEditorAction(TextView v, int actionId, KeyEvent event) {
                if ((event != null && (event.getKeyCode() == KeyEvent.KEYCODE_ENTER)) || (actionId == EditorInfo.IME_ACTION_DONE)) {
                    validate();
                }
                return false;
            }
        });
        createProgressDialog();
    }

    private void createProgressDialog() {
        progressDialog = new ProgressDialog(this);
        progressDialog.setTitle(getString(R.string.aguarde));
        progressDialog.setMessage(getString(R.string.efetuando_login));
        progressDialog.setCancelable(false);
    }

    @Override
    public void onValidationSucceeded() {
        SharedPreferences preferences = getSharedPreferences(Constants.APP_CONFIGS, Context.MODE_PRIVATE);
        String token = preferences.getString(MyFirebaseMessagingService.NEW_TOKEN, null);
        presenter.login(edtEmail.getText().toString(), edtPassword.getText().toString(), token);
    }

    @Override
    public void onValidationFailed(List<ValidationError> errors) {
        for (ValidationError error : errors) {
            View view = error.getView();
            String message = error.getCollatedErrorMessage(this);

            if (view instanceof EditText) {
                ((EditText) view).setError(message);
            } else {
                Toast.makeText(this, message, Toast.LENGTH_LONG).show();
            }
        }
    }

    @Override
    public void showToast(String msg) {
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void navigateToHome() {
        startActivity(new Intent(this, ListagemOsActivity.class));
        finish();
    }

    @Override
    public void showProgress() {
        progressDialog.show();
    }

    @Override
    public void hideProgress() {
        progressDialog.dismiss();
    }
}
