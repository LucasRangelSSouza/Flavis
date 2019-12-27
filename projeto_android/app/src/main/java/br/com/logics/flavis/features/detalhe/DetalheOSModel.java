package br.com.logics.flavis.features.detalhe;

import android.content.Context;

import br.com.logics.flavis.model.entities.os.FotoOS;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;
import br.com.logics.flavis.model.entities.os.procedimento.FotoProcedimento;
import br.com.logics.flavis.model.repository.FotoRepository;
import br.com.logics.flavis.model.repository.OSRepository;

/**
 * Created by murilo aires on 24/05/2017.
 */

public class DetalheOSModel implements DetalheOSMVP.DetalheModelOps {
    private DetalheOSMVP.RequiredDetalhePresenterOps requiredDetalhePresenterOps;

    public DetalheOSModel(DetalheOSMVP.RequiredDetalhePresenterOps requiredDetalhePresenterOps) {
        this.requiredDetalhePresenterOps = requiredDetalhePresenterOps;
    }


    @Override
    public OS loadOs(Context context, long osId) {
        return OSRepository.I.loadOs(context, osId);
    }

    @Override
    public void createFotoOs(Context context, OS os, String croppedPath, String titulo) {
        FotoOS foto = new FotoOS(null, os.getId(), croppedPath, titulo, false);
        FotoRepository.I.insertFotoOS(context, foto);
        requiredDetalhePresenterOps.onFotoOsCriada();
    }

    @Override
    public void saveOSFinalizada(OS os) {
        os.update();
        requiredDetalhePresenterOps.onOSFinalizada();
    }

    @Override
    public void createFotoProcedimento(Context context, ExecucaoProcedimento execucaoProcedimento, String absolutePath, String titulo) {
        FotoProcedimento foto = new FotoProcedimento(null, execucaoProcedimento.getId(), absolutePath, titulo, false);
        FotoRepository.I.insertFotoProcedimento(context, foto);
        requiredDetalhePresenterOps.onFotoOsCriada();
    }

    @Override
    public void saveOS(OS os) {
        os.update();
    }
}
