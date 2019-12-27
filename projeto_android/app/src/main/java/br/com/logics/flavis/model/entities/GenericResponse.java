package br.com.logics.flavis.model.entities;

import br.com.logics.flavis.model.entities.colaborador.Colaborador;

/**
 * Created by murilo aires on 03/05/2017.
 */

public class GenericResponse {

    private Colaborador colaborador;
    private String apiToken;

    public Colaborador getColaborador() {
        return colaborador;
    }

    public void setColaborador(Colaborador colaborador) {
        this.colaborador = colaborador;
    }

    public String getApiToken() {
        return apiToken;
    }

    public void setApiToken(String apiToken) {
        this.apiToken = apiToken;
    }

}
