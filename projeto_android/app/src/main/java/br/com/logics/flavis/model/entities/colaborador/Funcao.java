package br.com.logics.flavis.model.entities.colaborador;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;

import java.util.Date;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 03/05/2017.
 */


@Entity
public class Funcao {
    @Id
    private Long id;

    private String nome;

    private Date createdAt;

    private Date updatedAt;

    @Generated(hash = 573740202)
    public Funcao(Long id, String nome, Date createdAt, Date updatedAt) {
        this.id = id;
        this.nome = nome;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 1017667907)
    public Funcao() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getNome() {
        return this.nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
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
