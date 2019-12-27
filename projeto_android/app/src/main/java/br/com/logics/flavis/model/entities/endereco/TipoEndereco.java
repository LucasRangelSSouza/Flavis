package br.com.logics.flavis.model.entities.endereco;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by qillq on 11/05/17.
 */

@Entity
public class TipoEndereco {

    @Id
    private Long id;

    private String nome;

    @Generated(hash = 2068428609)
    public TipoEndereco(Long id, String nome) {
        this.id = id;
        this.nome = nome;
    }

    @Generated(hash = 1693573753)
    public TipoEndereco() {
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
