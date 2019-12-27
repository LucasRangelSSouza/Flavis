package br.com.logics.flavis.model.entities.cliente;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 22/03/2017.
 */


@Entity
public class Responsavel {

    @Id
    private Long id;

    private String nome;

    private String email;

    private String funcao;

    private String telefone;

    @Generated(hash = 1460527001)
    public Responsavel(Long id, String nome, String email, String funcao,
            String telefone) {
        this.id = id;
        this.nome = nome;
        this.email = email;
        this.funcao = funcao;
        this.telefone = telefone;
    }

    @Generated(hash = 1060883376)
    public Responsavel() {
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

    public String getEmail() {
        return this.email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getFuncao() {
        return this.funcao;
    }

    public void setFuncao(String funcao) {
        this.funcao = funcao;
    }

    public String getTelefone() {
        return this.telefone;
    }

    public void setTelefone(String telefone) {
        this.telefone = telefone;
    }
}
