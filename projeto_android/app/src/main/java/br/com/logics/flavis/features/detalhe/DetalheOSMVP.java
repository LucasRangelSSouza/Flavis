package br.com.logics.flavis.features.detalhe;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;

import com.yalantis.ucrop.UCrop;

import java.io.File;
import java.util.List;

import br.com.logics.flavis.model.entities.os.FotoOS;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;
import br.com.logics.flavis.model.entities.os.procedimento.FotoProcedimento;

/**
 * Created by murilo aires on 23/05/2017.
 */

public interface DetalheOSMVP {

    interface RequiredDetalheViewOps {

        void setPmocVisibilities(boolean isPmoc);

        void setNomeCliente(String nomeCliente);

        void setEndereco(String endereco);

        void setOcorrencia(String ocorrencia);

        void openCropActivity(UCrop.Options options, Uri destination);

        void updateRecyclerFotos(List<FotoOS> fotos);

        void openCropActivity(UCrop.Options options, Uri source, Uri destination);

        void showTituloFotoOsDialog(File file);

        void setRelatorioOSError();

        void setJustificativaOSError();

        void setNomeReceptorError();

        void setRgReceptorError();

        void finalizarOS();

        void showToast(String message);

        void updateRecyclerFotosProcedimentos(int posicaoProcedimento, List<FotoProcedimento> fotosProcedimento);

        void loadSavedField(OS os);

    }

    interface DetalhePresenterOps {

        void loadOs(Intent intent);

        OS getOs();

        void ajdustPicture(Context context, String mCurrentPhotoPath);

        void onPhotoCropped(Uri output);

        void openCropActivity(Uri uri);

        void onTituloFotoInserido(String absolutePath, String titulo, boolean isFotoProcedimento,int posicaoAdapterProcedimento);

        void finalizarOS(String relatorioOs, String justificativa, String nomeReceptor, String rgReceptor, boolean isEncerrada, String assinaturaPath);

        void salvarOs(String justificativa, String relatorioOS, String nomeReceptor, String rgReceptor, boolean isEncerrada, String assinaturaPath);
    }

    interface RequiredDetalhePresenterOps {

        void onFotoOsCriada();

        void onOSFinalizada();
    }

    interface DetalheModelOps {

        OS loadOs(Context context, long osId);

        void createFotoOs(Context context,OS os, String croppedPath, String titulo);

        void saveOSFinalizada(OS os);

        void createFotoProcedimento(Context context, ExecucaoProcedimento execucaoProcedimento, String absolutePath, String titulo);

        void saveOS(OS os);
    }
}
