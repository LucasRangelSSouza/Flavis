package br.com.logics.flavis.features.detalhe;

import android.Manifest;
import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.Rect;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.MediaStore;
import androidx.annotation.NonNull;
import com.google.android.material.textfield.TextInputLayout;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.core.content.FileProvider;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.appcompat.widget.Toolbar;
import android.view.LayoutInflater;
import android.view.SurfaceHolder;
import android.view.View;
import android.view.ViewTreeObserver;
import android.view.Window;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.otto.Subscribe;
import com.squareup.picasso.Callback;
import com.squareup.picasso.Picasso;
import com.yalantis.ucrop.UCrop;

import java.io.File;
import java.io.IOException;
import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.application.Bus;
import br.com.logics.flavis.features.signature.SignatureActivity;
import br.com.logics.flavis.model.entities.os.FotoOS;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.entities.os.procedimento.FotoProcedimento;
import br.com.logics.flavis.utils.fotos.FotoUtils;
import br.com.logics.flavis.utils.fotos.viewutils.SimpleDividerItemDecoration;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import me.panavtec.drawableview.DrawableView;
import me.panavtec.drawableview.DrawableViewConfig;

public class DetalheOSActivity extends AppCompatActivity implements DetalheOSMVP.RequiredDetalheViewOps, SurfaceHolder.Callback {

    private static final int CAMERA = 1;
    private static final int GALERIA = 2;
    private static final int ASSINATURA = 3;
    private static final String TAG = "CAMERA";
    private static final int SIGNATURE = 4;

    @BindView(R.id.textEndereco)
    TextView textEndereco;

    @BindView(R.id.textIsPmoc)
    TextView textIsPmoc;

    @BindView(R.id.textOcorrencia)
    TextView textOcorrencia;

    @BindView(R.id.toolbarDetalhe)
    Toolbar toolbar;

    @BindView(R.id.recyclerFotosOs)
    RecyclerView recyclerFotosOs;

    @BindView(R.id.edtRelatorioOS)
    EditText edtRelatorioOs;

    @BindView(R.id.edtJustificativa)
    EditText edtJustificativa;

    @BindView(R.id.edtNomeReceptor)
    EditText edtNomeReceptor;

    @BindView(R.id.rgReceptor)
    EditText edtRgReceptor;

    @BindView(R.id.chkEncerrada)
    CheckBox chkEncerrada;

    @BindView(R.id.osSemPmocLayout)
    View osSemPmocView;

    @BindView(R.id.viewPmoc)
    View viewPmoc;

    @BindView(R.id.imgAssinatura)
    ImageView imgAssinatura;

    @BindView(R.id.recyclerEquipamentos)
    RecyclerView recyclerEquipamentos;

    private float strokeWidth = 15.0f;
    private EquipamentosAdapter equipamentosAdapter;
    private int adapterProcedimentoPosition;
    private boolean isFotoProcedimento;
    private String assinaturaPath;


    @OnClick(R.id.assinaturaView)
    public void assinaturaViewAction(View view) {
        requestReadAndWritePermission(ASSINATURA);
    }


    @OnClick(R.id.btnFinalizar)
    public void btnFinalizarAction(View view) {
        String justificativa = edtJustificativa.getText().toString();
        String relatorioOS = edtRelatorioOs.getText().toString();
        String nomeReceptor = edtNomeReceptor.getText().toString();
        String rgReceptor = edtRgReceptor.getText().toString();
        boolean isEncerrada = chkEncerrada.isChecked();
        presenter.finalizarOS(relatorioOS, justificativa, nomeReceptor, rgReceptor, isEncerrada, assinaturaPath);
    }

    private FotosAdapter fotosAdapter;

    private DetalheOSMVP.DetalhePresenterOps presenter;

    private View.OnClickListener onClickFotoListener;
    private String mCurrentPhotoPath;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhe_os);
        ButterKnife.bind(this);
        Bus.R.getBus(this).register(this);
        setSupportActionBar(toolbar);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });
        toolbar.setNavigationIcon(R.drawable.ic_arrow_back);
        presenter = new DetalheOSPresenter(this);
        presenter.loadOs(getIntent());
        setUpRecyclerViewFotos();
        setUpRecyclerViewEquipamentos();

    }

    @Override
    protected void onStop() {
        super.onStop();
        String justificativa = edtJustificativa.getText().toString();
        String relatorioOS = edtRelatorioOs.getText().toString();
        String nomeReceptor = edtNomeReceptor.getText().toString();
        String rgReceptor = edtRgReceptor.getText().toString();
        boolean isEncerrada = chkEncerrada.isChecked();
        presenter.salvarOs(justificativa, relatorioOS, nomeReceptor, rgReceptor, isEncerrada, assinaturaPath);
    }

    private void setUpRecyclerViewEquipamentos() {
        equipamentosAdapter = new EquipamentosAdapter(presenter.getOs().getExecucoesProcedimentos(), this);
        LinearLayoutManager manager = new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false);
        recyclerEquipamentos.setLayoutManager(manager);
        recyclerEquipamentos.addItemDecoration(new SimpleDividerItemDecoration(this));
        recyclerEquipamentos.setAdapter(equipamentosAdapter);
    }

    private void setUpRecyclerViewFotos() {
        onClickFotoListener = new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                isFotoProcedimento = false;
                createDialogAddFoto();
            }
        };
        fotosAdapter = new FotosAdapter(presenter.getOs(), onClickFotoListener, FotosAdapter.ADAPTER_FOTO_OS);
        LinearLayoutManager manager = new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false);
        recyclerFotosOs.setLayoutManager(manager);
        recyclerFotosOs.setAdapter(fotosAdapter);
        recyclerFotosOs.addItemDecoration(new RecyclerView.ItemDecoration() {
            @Override
            public void getItemOffsets(Rect outRect, View view, RecyclerView parent, RecyclerView.State state) {
                outRect.right = 20;
            }
        });
    }

    @Override
    public void setPmocVisibilities(boolean isPmoc) {
        textIsPmoc.setVisibility(isPmoc ? View.VISIBLE : View.GONE);
        osSemPmocView.setVisibility(isPmoc ? View.GONE : View.VISIBLE);
        viewPmoc.setVisibility(isPmoc ? View.VISIBLE : View.GONE);
    }

    @Override
    public void setNomeCliente(String nomeCliente) {
        getSupportActionBar().setTitle(nomeCliente);
    }

    @Override
    public void setEndereco(String endereco) {
        textEndereco.setText(endereco);
    }

    @Override
    public void setOcorrencia(String ocorrencia) {
        textOcorrencia.setText(ocorrencia);
    }

    @Override
    public void openCropActivity(UCrop.Options options, Uri destination) {
        UCrop.of(destination, destination)
                .withOptions(options)
                .start(this);
    }

    @Override
    public void updateRecyclerFotos(List<FotoOS> fotosOS) {
        fotosAdapter.notifyDataSetChanged(fotosOS);
    }

    @Override
    public void openCropActivity(UCrop.Options options, Uri source, Uri destination) {
        UCrop.of(source, destination)
                .withOptions(options)
                .start(this);
    }

    @Override
    public void showTituloFotoOsDialog(final File file) {
        final Dialog d = new Dialog(this);
        d.requestWindowFeature(Window.FEATURE_NO_TITLE);
        d.setContentView(R.layout.dialog_title_foto);
        TextView btnCancelar = (TextView) d.findViewById(R.id.btnCancelar);
        TextView btnConfirmar = (TextView) d.findViewById(R.id.btnConfirmar);
        final RadioButton rdAntes = (RadioButton) d.findViewById(R.id.rdAntes);
        final RadioButton rdDepois = (RadioButton) d.findViewById(R.id.rdDepois);
        btnConfirmar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String titulo = rdAntes.isChecked()? rdAntes.getText().toString() : rdDepois.getText().toString();
                presenter.onTituloFotoInserido(file.getAbsolutePath(), titulo, isFotoProcedimento, adapterProcedimentoPosition);
                d.dismiss();
            }
        });
        btnCancelar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                d.dismiss();
            }
        });
        ImageView img = (ImageView) d.findViewById(R.id.img);
        Picasso.get().load(file).into(img);
        d.show();
    }

    @Override
    public void setRelatorioOSError() {
        edtRelatorioOs.setError(getString(R.string.campo_obrigatorio));
    }

    @Override
    public void setJustificativaOSError() {
        edtJustificativa.setError(getString(R.string.campo_obrigatorio));
        Toast.makeText(this, getString(R.string.justificativa_necessaria), Toast.LENGTH_LONG).show();
    }

    @Override
    public void setNomeReceptorError() {
        ((TextInputLayout) edtNomeReceptor.getParent().getParent()).setError(getString(R.string.campo_obrigatorio));
    }

    @Override
    public void setRgReceptorError() {
        ((TextInputLayout) edtRgReceptor.getParent().getParent()).setError(getString(R.string.campo_obrigatorio));
    }

    @Override
    public void finalizarOS() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage(getString(R.string.os_finalizada_sucesso)).setPositiveButton(getString(R.string.OK), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        }).setOnDismissListener(new DialogInterface.OnDismissListener() {
            @Override
            public void onDismiss(DialogInterface dialog) {
                finish();
            }
        }).show();
    }

    @Override
    public void showToast(String message) {
        Toast.makeText(this, message, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void updateRecyclerFotosProcedimentos(int posicaoProcedimento, List<FotoProcedimento> fotosProcedimento) {
        equipamentosAdapter.notifyItemChanged(posicaoProcedimento);
    }

    @Override
    public void loadSavedField(OS os) {
        edtRgReceptor.setText(os.getReceptorRg());
        edtNomeReceptor.setText(os.getReceptorNome());
        chkEncerrada.setChecked(os.getIsEncerrada());
        edtJustificativa.setText(os.getJustificativaEncerramento());
        edtRelatorioOs.setText(os.getRelatorioAvaliacao());
        this.assinaturaPath = os.getPathAssinatura();
        if (os.getPathAssinatura() != null) {
            Picasso.get().load(new File(os.getPathAssinatura())).into(imgAssinatura);
        }
    }

    private void createDialogAddFoto() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle(R.string.selecione_acao)
                .setItems(R.array.foto_options, new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        switch (which) {
                            case 0:
                                requestCameraPermission(CAMERA);
                                break;

                            default:
                                requestReadAndWritePermission(GALERIA);
                                break;

                        }
                    }
                });
        builder.show();
    }

    private void requestReadAndWritePermission(int from) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.READ_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED ||
                    ContextCompat.checkSelfPermission(this, Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
                ActivityCompat.requestPermissions(this, new String[]{
                        Manifest.permission.READ_EXTERNAL_STORAGE,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE}, from);
            } else {
                if (from == ASSINATURA) {
                    showDialogAssinatura();
                } else {
                    openGalery(from);
                }
            }
        } else {
            if (from == ASSINATURA) {
                showDialogAssinatura();
            } else {
                openGalery(from);
            }
        }
    }

    private void showDialogAssinatura() {
        startActivity(new Intent(this, SignatureActivity.class));
//        final AlertDialog.Builder builder = new AlertDialog.Builder(this);
//        LayoutInflater inflater = getLayoutInflater();
//        View viewAssinatura = inflater.inflate(R.layout.dialog_assinatura, null);
//        builder.setView(viewAssinatura);
//        final DrawableView drawableView = (DrawableView) viewAssinatura.findViewById(R.id.drawableView);
//        View btnMais = viewAssinatura.findViewById(R.id.btnMais);
//        btnMais.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                strokeWidth = strokeWidth + 4.0f;
//                DrawableViewConfig config = new DrawableViewConfig();
//                config.setStrokeColor(getResources().getColor(android.R.color.black));
//                config.setShowCanvasBounds(true);
//                config.setStrokeWidth(strokeWidth);
//                config.setMinZoom(1.0f);
//                config.setMaxZoom(3.0f);
//                config.setCanvasHeight(drawableView.getHeight());
//                config.setCanvasWidth(drawableView.getWidth());
//                drawableView.setConfig(config);
//            }
//        });
//        View btnMenos = viewAssinatura.findViewById(R.id.btnMenos);
//        btnMenos.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                if (strokeWidth < 4.0) {
//                    return;
//                }
//                strokeWidth = strokeWidth - 4.0f;
//                DrawableViewConfig config = new DrawableViewConfig();
//                config.setStrokeColor(getResources().getColor(android.R.color.black));
//                config.setShowCanvasBounds(true);
//                config.setStrokeWidth(strokeWidth);
//                config.setMinZoom(1.0f);
//                config.setMaxZoom(3.0f);
//                config.setCanvasHeight(drawableView.getHeight());
//                config.setCanvasWidth(drawableView.getWidth());
//                drawableView.setConfig(config);
//            }
//        });
//        View btnUndo = viewAssinatura.findViewById(R.id.btnUndo);
//        btnUndo.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//
//            }
//        });
//        drawableView.getViewTreeObserver().addOnGlobalLayoutListener(new ViewTreeObserver.OnGlobalLayoutListener() {
//            @Override
//            public void onGlobalLayout() {
//                DrawableViewConfig config = new DrawableViewConfig();
//                config.setStrokeColor(getResources().getColor(android.R.color.black));
//                config.setShowCanvasBounds(true);
//                config.setStrokeWidth(strokeWidth);
//                config.setMinZoom(1.0f);
//                config.setMaxZoom(3.0f);
//                config.setCanvasHeight(drawableView.getHeight());
//                config.setCanvasWidth(drawableView.getWidth());
//                drawableView.setConfig(config);
//                drawableView.getViewTreeObserver().removeOnGlobalLayoutListener(this);
//            }
//        });
//        builder.setPositiveButton(getString(R.string.confirmar), new DialogInterface.OnClickListener() {
//
//            @Override
//            public void onClick(DialogInterface dialog, int which) {
//                try {
//                    File assinatura = FotoUtils.getBitmapFile(drawableView.obtainBitmap());
//                    DetalheOSActivity.this.assinaturaPath = assinatura.getAbsolutePath();
//                    imgAssinatura.setImageBitmap(drawableView.obtainBitmap());
//                } catch (IOException e) {
//
//                }
//
//                dialog.dismiss();
//            }
//        }).setNegativeButton(getString(R.string.cancelar), new DialogInterface.OnClickListener() {
//            @Override
//            public void onClick(DialogInterface dialog, int which) {
//                dialog.dismiss();
//            }
//        });
//
//        builder.show();
    }


    private void requestCameraPermission(int from) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED ||
                    ContextCompat.checkSelfPermission(this, Manifest.permission.READ_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED ||
                    ContextCompat.checkSelfPermission(this, Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
                ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.CAMERA,
                        Manifest.permission.READ_EXTERNAL_STORAGE,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE}, from);
            } else {
                openCamera(from);
            }
        } else {
            openCamera(from);
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
            if (requestCode == GALERIA) {
                openGalery(requestCode);
            } else if (requestCode == CAMERA) {
                openCamera(requestCode);
            } else {
                showDialogAssinatura();
            }
        }
    }

    private void openGalery(int from) {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(Intent.createChooser(intent,
                "Select Picture"), from);
    }

    private void openCamera(int from) {
        Intent cameraIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        if (cameraIntent.resolveActivity(getPackageManager()) != null) {
            File photoFile = FotoUtils.getOutputMediaFile();
            if (photoFile == null) {
                Toast.makeText(this, getString(R.string.app_nao_conseguiu_criar_diretorio), Toast.LENGTH_LONG).show();
                return;
            }
            Uri photoUri = null;
            if (Build.VERSION.SDK_INT > Build.VERSION_CODES.M) {
                photoUri = FileProvider.getUriForFile(this, this.getApplicationContext().getPackageName() + ".my.package.name.provider", photoFile);
            } else {
                photoUri = Uri.fromFile(photoFile);
            }
            cameraIntent.putExtra(MediaStore.EXTRA_OUTPUT, photoUri);
            mCurrentPhotoPath = photoFile.getAbsolutePath();
            startActivityForResult(cameraIntent, from);
        }
    }


    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (resultCode == RESULT_OK) {
            if (requestCode == CAMERA) {
                presenter.ajdustPicture(this, mCurrentPhotoPath);
            } else if (requestCode == GALERIA) {
                Uri uri = data.getData();
                presenter.openCropActivity(uri);
            } else if (requestCode == UCrop.REQUEST_CROP) {
                presenter.onPhotoCropped(UCrop.getOutput(data));
            } else if (requestCode == SIGNATURE) {
                try {
                    Bitmap bitmap = data.getParcelableExtra("bitmap");
                    File assinatura = FotoUtils.getBitmapFile(bitmap);
                    DetalheOSActivity.this.assinaturaPath = assinatura.getAbsolutePath();
                    imgAssinatura.setImageBitmap(bitmap);
                } catch (IOException e) {

                }

            }
        } else {
            isFotoProcedimento = false;
        }

    }

    @Subscribe
    public void getBitmap(Bitmap bitmap) {

        try {
            File assinatura = FotoUtils.getBitmapFile(bitmap);
            DetalheOSActivity.this.assinaturaPath = assinatura.getAbsolutePath();
            imgAssinatura.setImageBitmap(bitmap);
        } catch (IOException e) {
            e.printStackTrace();
        }

    }

    public void createDialogAddFotoProcedimento(int adapterPosition) {
        this.adapterProcedimentoPosition = adapterPosition;
        this.isFotoProcedimento = true;
        createDialogAddFoto();
    }

    @Override
    public void surfaceCreated(SurfaceHolder holder) {

    }

    @Override
    public void surfaceChanged(SurfaceHolder holder, int format, int width, int height) {

    }

    @Override
    public void surfaceDestroyed(SurfaceHolder holder) {

    }

}
