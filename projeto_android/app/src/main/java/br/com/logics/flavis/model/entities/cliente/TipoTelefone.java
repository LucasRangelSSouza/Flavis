package br.com.logics.flavis.model.entities.cliente;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 09/05/2017.
 */

@Entity
public class TipoTelefone {
    @Id
    private Long id;

    private String nome;

    @Generated(hash = 1059043859)
    public TipoTelefone(Long id, String nome) {
        this.id = id;
        this.nome = nome;
    }

    @Generated(hash = 1986049466)
    public TipoTelefone() {
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
}
