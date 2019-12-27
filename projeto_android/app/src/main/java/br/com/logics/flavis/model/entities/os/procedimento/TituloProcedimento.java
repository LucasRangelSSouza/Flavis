package br.com.logics.flavis.model.entities.os.procedimento;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;

import java.util.Date;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 12/05/2017.
 */

@Entity
public class TituloProcedimento {
    @Id
    private Long id;

    private String titulo;

    private Date createdAt;

    private Date updatedAt;

    @Generated(hash = 1317621595)
    public TituloProcedimento(Long id, String titulo, Date createdAt,
            Date updatedAt) {
        this.id = id;
        this.titulo = titulo;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 1081841761)
    public TituloProcedimento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getTitulo() {
        return this.titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public Date getCreatedAt() {
        return this.createdAt;
    }

    public void setCreatedAt(Date createdAt) {
        this.createdAt = createdAt;
    }

    public Date getUpdatedAt() {
        return this.updatedAt;
    }

    public void setUpdatedAt(Date updatedAt) {
        this.updatedAt = updatedAt;
    }
}
