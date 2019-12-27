package br.com.logics.flavis.model.entities.equipamento;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;

import java.util.Date;

import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.EquipamentoDao;
import br.com.logics.flavis.model.repository.dao.MarcaDao;
import br.com.logics.flavis.model.repository.dao.ModeloDao;

/**
 * Created by murilo aires on 15/05/2017.
 */

@Entity
public class Equipamento {
    @Id
    private Long id;

    @ToOne(joinProperty = "modeloId")
    private Modelo modelo;

    private Long modeloId;

    @ToOne(joinProperty = "marcaId")
    private Marca marca;

    private Long marcaId;

    private String especificacoes;

    private Date createdAt;

    private Date updatedAt;

    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 708064992)
    private transient EquipamentoDao myDao;

    @Generated(hash = 1757367088)
    public Equipamento(Long id, Long modeloId, Long marcaId, String especificacoes,
                       Date createdAt, Date updatedAt) {
        this.id = id;
        this.modeloId = modeloId;
        this.marcaId = marcaId;
        this.especificacoes = especificacoes;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 1098354837)
    public Equipamento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getModeloId() {
        return this.modeloId;
    }

    public void setModeloId(Long modeloId) {
        this.modeloId = modeloId;
    }

    public Long getMarcaId() {
        return this.marcaId;
    }

    public void setMarcaId(Long marcaId) {
        this.marcaId = marcaId;
    }

    public String getEspecificacoes() {
        return this.especificacoes;
    }

    public void setEspecificacoes(String especificacoes) {
        this.especificacoes = especificacoes;
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

    @Generated(hash = 1517650707)
    private transient Long modelo__resolvedKey;

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 2002700838)
    public Modelo getModelo() {
        Long __key = this.modeloId;
        if (modelo__resolvedKey == null || !modelo__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            ModeloDao targetDao = daoSession.getModeloDao();
            Modelo modeloNew = targetDao.load(__key);
            synchronized (this) {
                modelo = modeloNew;
                modelo__resolvedKey = __key;
            }
        }
        return modelo;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 2118918960)
    public void setModelo(Modelo modelo) {
        synchronized (this) {
            this.modelo = modelo;
            modeloId = modelo == null ? null : modelo.getId();
            modelo__resolvedKey = modeloId;
        }
    }

    @Generated(hash = 1335588083)
    private transient Long marca__resolvedKey;

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 1525485073)
    public Marca getMarca() {
        Long __key = this.marcaId;
        if (marca__resolvedKey == null || !marca__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            MarcaDao targetDao = daoSession.getMarcaDao();
            Marca marcaNew = targetDao.load(__key);
            synchronized (this) {
                marca = marcaNew;
                marca__resolvedKey = __key;
            }
        }
        return marca;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 198499530)
    public void setMarca(Marca marca) {
        synchronized (this) {
            this.marca = marca;
            marcaId = marca == null ? null : marca.getId();
            marca__resolvedKey = marcaId;
        }
    }

    /**
     * Convenient call for {@link org.greenrobot.greendao.AbstractDao#delete(Object)}.
     * Entity must attached to an entity context.
     */
    @Generated(hash = 128553479)
    public void delete() {
        if (myDao == null) {
            throw new DaoException("Entity is detached from DAO context");
        }
        myDao.delete(this);
    }

    /**
     * Convenient call for {@link org.greenrobot.greendao.AbstractDao#refresh(Object)}.
     * Entity must attached to an entity context.
     */
    @Generated(hash = 1942392019)
    public void refresh() {
        if (myDao == null) {
            throw new DaoException("Entity is detached from DAO context");
        }
        myDao.refresh(this);
    }

    /**
     * Convenient call for {@link org.greenrobot.greendao.AbstractDao#update(Object)}.
     * Entity must attached to an entity context.
     */
    @Generated(hash = 713229351)
    public void update() {
        if (myDao == null) {
            throw new DaoException("Entity is detached from DAO context");
        }
        myDao.update(this);
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 1863127372)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getEquipamentoDao() : null;
    }

    public void restructureFields() {
        if (marca != null) {
            setMarca(marca);
        }

        if (modelo != null) {
            setModelo(modelo);
        }
    }
}
