package br.com.logics.flavis.features.signature;

import android.content.Intent;
import android.net.Uri;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.ViewTreeObserver;
import android.widget.Toast;

import java.io.File;
import java.io.IOException;

import br.com.logics.flavis.R;
import br.com.logics.flavis.application.Bus;
import br.com.logics.flavis.features.detalhe.DetalheOSActivity;
import br.com.logics.flavis.utils.fotos.FotoUtils;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import me.panavtec.drawableview.DrawableView;
import me.panavtec.drawableview.DrawableViewConfig;

public class SignatureActivity extends AppCompatActivity {

    @BindView(R.id.drawableView)
    DrawableView drawableView;

    @OnClick(R.id.btnUndo)
    public void undo(View view) {
        drawableView.undo();
    }

    @OnClick(R.id.btnConfirmar)
    public void btnConfirmarAction(View view) {
        Bus.R.getBus(this).post(drawableView.obtainBitmap());
        finish();
    }

    @OnClick(R.id.btnMais)
    public void btnMaisAction(View view) {
        strokeWidth = strokeWidth + 4.0f;
        DrawableViewConfig config = new DrawableViewConfig();
        config.setStrokeColor(getResources().getColor(android.R.color.black));
        config.setShowCanvasBounds(true);
        config.setStrokeWidth(strokeWidth);
        config.setMinZoom(1.0f);
        config.setMaxZoom(3.0f);
        config.setCanvasHeight(drawableView.getHeight());
        config.setCanvasWidth(drawableView.getWidth());
        drawableView.setConfig(config);
    }

    @OnClick(R.id.btnMenos)
    public void btnMenosAction(View view) {
        if (strokeWidth < 4.0) {
            return;
        }
        strokeWidth = strokeWidth - 4.0f;
        DrawableViewConfig config = new DrawableViewConfig();
        config.setStrokeColor(getResources().getColor(android.R.color.black));
        config.setShowCanvasBounds(true);
        config.setStrokeWidth(strokeWidth);
        config.setMinZoom(1.0f);
        config.setMaxZoom(3.0f);
        config.setCanvasHeight(drawableView.getHeight());
        config.setCanvasWidth(drawableView.getWidth());
        drawableView.setConfig(config);
    }

    private float strokeWidth = 15.0f;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signature);
        ButterKnife.bind(this);
        configureDrawableView();
    }

    private void configureDrawableView() {
        drawableView.getViewTreeObserver().addOnGlobalLayoutListener(new ViewTreeObserver.OnGlobalLayoutListener() {
            @Override
            public void onGlobalLayout() {
                DrawableViewConfig config = new DrawableViewConfig();
                config.setStrokeColor(getResources().getColor(android.R.color.black));
                config.setShowCanvasBounds(true);
                config.setStrokeWidth(strokeWidth);
                config.setMinZoom(1.0f);
                config.setMaxZoom(3.0f);
                config.setCanvasHeight(drawableView.getHeight());
                config.setCanvasWidth(drawableView.getWidth());
                drawableView.setConfig(config);
                drawableView.getViewTreeObserver().removeOnGlobalLayoutListener(this);
            }
        });
    }
}
