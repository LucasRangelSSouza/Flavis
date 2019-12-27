package br.com.logics.flavis.model.entities.os;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 13/05/2017.
 */

@Entity
public class FotoOS implements Foto{

    @Id(autoincrement = true)
    private Long id;

    private Long osId;

    private String path;

    private String titulo;

    private boolean isSync;


    @Generated(hash = 1237834517)
    public FotoOS(Long id, Long osId, String path, String titulo, boolean isSync) {
        this.id = id;
        this.osId = osId;
        this.path = path;
        this.titulo = titulo;
        this.isSync = isSync;
    }

    @Generated(hash = 831430329)
    public FotoOS() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getOsId() {
        return this.osId;
    }

    public void setOsId(Long osId) {
        this.osId = osId;
    }

    public String getPath() {
        return this.path;
    }

    public void setPath(String path) {
        this.path = path;
    }


    public String getTitulo() {
        return this.titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public boolean getIsSync() {
        return this.isSync;
    }

    public void setIsSync(boolean isSync) {
        this.isSync = isSync;
    }

}
