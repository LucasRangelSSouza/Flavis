package br.com.logics.flavis.model.entities.equipamento;

import org.greenrobot.greendao.annotation.Entity;

import java.util.Date;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;

/**
 * Created by murilo aires on 28/03/2017.
 */
@Entity
public class Modelo {

    @Id
    private Long id;

    private Date createdAt;

    private Date updatedAt;

    private String titulo;

    @Generated(hash = 1032338438)
    public Modelo(Long id, Date createdAt, Date updatedAt, String titulo) {
        this.id = id;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.titulo = titulo;
    }

    @Generated(hash = 1217832698)
    public Modelo() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
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

    public String getTitulo() {
        return this.titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }
}