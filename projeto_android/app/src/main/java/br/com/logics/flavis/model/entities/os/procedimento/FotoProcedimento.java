package br.com.logics.flavis.model.entities.os.procedimento;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 13/05/2017.
 */

@Entity
public class FotoProcedimento {

    @Id(autoincrement = true)
    private Long id;

    private Long execucaoProcedimentoId;

    private String path;

    private String titulo;

    private boolean isSync;

    @Generated(hash = 382647131)
    public FotoProcedimento(Long id, Long execucaoProcedimentoId, String path,
            String titulo, boolean isSync) {
        this.id = id;
        this.execucaoProcedimentoId = execucaoProcedimentoId;
        this.path = path;
        this.titulo = titulo;
        this.isSync = isSync;
    }

    @Generated(hash = 2038146644)
    public FotoProcedimento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getPath() {
        return this.path;
    }

    public void setPath(String path) {
        this.path = path;
    }


    public Long getExecucaoProcedimentoId() {
        return this.execucaoProcedimentoId;
    }

    public void setExecucaoProcedimentoId(Long execucaoProcedimentoId) {
        this.execucaoProcedimentoId = execucaoProcedimentoId;
    }

    public boolean getIsSync() {
        return this.isSync;
    }

    public void setIsSync(boolean isSync) {
        this.isSync = isSync;
    }

    public String getTitulo() {
        return this.titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }
}
