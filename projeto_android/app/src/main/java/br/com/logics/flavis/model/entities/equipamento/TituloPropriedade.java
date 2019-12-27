package br.com.logics.flavis.model.entities.equipamento;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 23/05/2017.
 */
@Entity
public class TituloPropriedade {
    @Id
    private Long id;

    private String titulo;

    @Generated(hash = 1123407571)
    public TituloPropriedade(Long id, String titulo) {
        this.id = id;
        this.titulo = titulo;
    }

    @Generated(hash = 383154662)
    public TituloPropriedade() {
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
}
