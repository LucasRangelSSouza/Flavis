package br.com.logics.flavis.features.listagem;

import android.content.Context;
import android.os.Bundle;

import java.util.List;

import br.com.logics.flavis.model.entities.os.OS;

/**
 * Created by murilo aires on 25/03/2017.
 */

public interface ListagemMVP {

    interface RequiredListagemViewOps {
        void updateOS();

        void showProgress();

        void dismissProgress();

        void showToast(String msg);

        void openOsDialog(String tituloDialog, String mensagemDialog, int position);

        void navigateDetalheOS(Bundle bundle);

        void updateRecycler();


    }

    interface ListagemPresenterOps {
        void loadNewOs();

        List<OS> getOsList();

        void loadFromDB();

        void loadOsByClienteName(String nomeCliente);

        void openOS(int position);

        void checkOs(int position);

        void setDataAbertura(int position);
    }

    interface RequiredListagemPresenterOps {

        void onOSLoadedFromDB(List<OS> osList);

        void onOSLoaded();

        void onLoadOSFail(String msg);

    }

    interface ListagemModelOps {
        void loadOS(Context context);

        void loadFromDB(Context context);

        void loadOsByClientName(String nomeCliente, Context context);

        boolean hasOpenOs(Context context);

        void setOsAsOpen(OS os);

        void setDataAberturaOs(OS os);
    }
}
