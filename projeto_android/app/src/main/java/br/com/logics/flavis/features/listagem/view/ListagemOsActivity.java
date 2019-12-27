package br.com.logics.flavis.features.listagem.view;

import android.Manifest;
import android.app.ProgressDialog;
import android.app.SearchManager;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;

import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.core.view.MenuItemCompat;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.appcompat.widget.SearchView;
import androidx.appcompat.widget.Toolbar;

import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import br.com.logics.flavis.R;
import br.com.logics.flavis.application.Constants;
import br.com.logics.flavis.features.atividade_ociosa.IdleActivity;
import br.com.logics.flavis.features.detalhe.DetalheOSActivity;
import br.com.logics.flavis.features.listagem.ListagemMVP;
import br.com.logics.flavis.features.listagem.ListagemPresenter;
import br.com.logics.flavis.features.listagem.view.adapter.OSAdapter;
import br.com.logics.flavis.features.notification.MyFirebaseMessagingService;
import br.com.logics.flavis.features.sincronizacao.SincronizarFotosIntentService;
import br.com.logics.flavis.features.sincronizacao.SincronizarIdleActivity;
import butterknife.BindView;
import butterknife.ButterKnife;

public class ListagemOsActivity extends AppCompatActivity implements ListagemMVP.RequiredListagemViewOps, SearchView.OnQueryTextListener {
    private static final int LOCATION_REQUEST = 11;
    @BindView(R.id.toolbar_listagem)
    Toolbar toolbar;

    @BindView(R.id.recycler_os)
    RecyclerView recyclerOs;
    private ProgressDialog progress;


    private ListagemMVP.ListagemPresenterOps presenter;
    private OSAdapter osAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_listagem_os);
        ButterKnife.bind(this);
        setSupportActionBar(toolbar);
        configureProgress();
        requestFineLocationPermission();
        presenter = new ListagemPresenter(this);
        setUpRecyclerView();
        presenter.loadFromDB();
        presenter.loadNewOs();

        SharedPreferences preferences = getSharedPreferences(Constants.APP_CONFIGS, Context.MODE_PRIVATE);
        String token = preferences.getString(MyFirebaseMessagingService.NEW_TOKEN, null);
    }

    private void requestFineLocationPermission() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                ActivityCompat.requestPermissions(this, new String[]{
                        Manifest.permission.ACCESS_FINE_LOCATION}, LOCATION_REQUEST);
            }
        }
    }


    private void configureProgress() {
        progress = new ProgressDialog(this);
        progress.setTitle(getString(R.string.aguarde));
        progress.setMessage(getString(R.string.carregando_ordens));
        progress.setIndeterminate(true);
        progress.setCancelable(false);
    }

    @Override
    protected void onResume() {
        super.onResume();
        presenter.loadFromDB();
        SincronizarFotosIntentService.startSincronizacao(this);
        SincronizarIdleActivity.startSync(this);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.atualizar:
                SincronizarFotosIntentService.startSincronizacao(this);
                SincronizarIdleActivity.startSync(this);
                presenter.loadNewOs();
                break;
            case R.id.createActivity:
                startActivity(new Intent(this, IdleActivity.class));
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_search, menu);
        SearchManager searchManager = (SearchManager) getSystemService(Context.SEARCH_SERVICE);
        SearchView searchView = (SearchView) menu.findItem(R.id.search).getActionView();
        searchView.setSearchableInfo(searchManager.getSearchableInfo(getComponentName()));
        searchView.setQueryHint(getString(R.string.nome_cliente));

        searchView.setOnQueryTextListener(this);


        return super.onCreateOptionsMenu(menu);
    }

    private void setUpRecyclerView() {
        recyclerOs.setLayoutManager(new LinearLayoutManager(this));
        osAdapter = new OSAdapter(presenter.getOsList(), this);
        recyclerOs.setAdapter(osAdapter);
    }

    @Override
    public void updateOS() {
        osAdapter.notifyDataSetChanged();
    }

    @Override
    public void showProgress() {
        progress.show();
    }

    @Override
    public void dismissProgress() {
        progress.dismiss();
    }

    @Override
    public void showToast(String msg) {
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void openOsDialog(String titutlo, String mensagemDialog, final int position) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle(titutlo)
                .setMessage(mensagemDialog)
                .setPositiveButton(getString(R.string.confirmar), new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        presenter.setDataAbertura(position);
                        presenter.openOS(position);
                    }
                })
                .setNegativeButton(getString(R.string.cancelar), new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                });
        builder.show();
    }

    @Override
    public void navigateDetalheOS(Bundle bundle) {
        Intent intent = new Intent(this, DetalheOSActivity.class);
        intent.putExtras(bundle);
        startActivity(intent);
    }

    @Override
    public void updateRecycler() {
        osAdapter.notifyDataSetChanged();
    }


    @Override
    public boolean onQueryTextSubmit(String nomeCliente) {
        presenter.loadOsByClienteName(nomeCliente);
        return true;
    }

    @Override
    public boolean onQueryTextChange(String newText) {
        return false;
    }

    public void openOs(int position) {
        presenter.checkOs(position);
    }

    @Override
    protected void onNewIntent(Intent intent) {
        super.onNewIntent(intent);
    }
}
