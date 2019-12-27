package br.com.logics.flavis.model.entities.endereco;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 22/03/2017.
 */

@Entity
public class Cidade {

    @Id
    private Long id;

    private String nome;

    private String uf;

    @Generated(hash = 296617851)
    public Cidade(Long id, String nome, String uf) {
        this.id = id;
        this.nome = nome;
        this.uf = uf;
    }

    @Generated(hash = 1235207452)
    public Cidade() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getUf() {
        return this.uf;
    }

    public void setUf(String uf) {
        this.uf = uf;
    }

    public String getNome() {
        return this.nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

}
