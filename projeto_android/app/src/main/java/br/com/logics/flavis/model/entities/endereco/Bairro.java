package br.com.logics.flavis.model.entities.endereco;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;
import org.greenrobot.greendao.DaoException;

import java.util.Date;

import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.CidadeDao;
import br.com.logics.flavis.model.repository.dao.BairroDao;

/**
 * Created by murilo aires on 22/03/2017.
 */

@Entity
public class Bairro {

    @Id
    private Long id;

    @ToOne(joinProperty = "cidadeId")
    private Cidade cidade;

    private Long cidadeId;

    private String nome;

    private Date createdAt;

    private Date updatedAt;

    /** Used to resolve relations */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /** Used for active entity operations. */
    @Generated(hash = 1031145790)
    private transient BairroDao myDao;

    @Generated(hash = 869691244)
    private transient Long cidade__resolvedKey;


    @Generated(hash = 1001490099)
    public Bairro(Long id, Long cidadeId, String nome, Date createdAt, Date updatedAt) {
        this.id = id;
        this.cidadeId = cidadeId;
        this.nome = nome;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 1710700800)
    public Bairro() {
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

    public Long getCidadeId() {
        return this.cidadeId;
    }

    public void setCidadeId(Long cidadeId) {
        this.cidadeId = cidadeId;
    }

    /** To-one relationship, resolved on first access. */
    @Generated(hash = 715627843)
    public Cidade getCidade() {
        Long __key = this.cidadeId;
        if (cidade__resolvedKey == null || !cidade__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            CidadeDao targetDao = daoSession.getCidadeDao();
            Cidade cidadeNew = targetDao.load(__key);
            synchronized (this) {
                cidade = cidadeNew;
                cidade__resolvedKey = __key;
            }
        }
        return cidade;
    }

    /** called by internal mechanisms, do not call yourself. */
    @Generated(hash = 1091219652)
    public void setCidade(Cidade cidade) {
        synchronized (this) {
            this.cidade = cidade;
            cidadeId = cidade == null ? null : cidade.getId();
            cidade__resolvedKey = cidadeId;
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

    /** called by internal mechanisms, do not call yourself. */
    @Generated(hash = 2055732794)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getBairroDao() : null;
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

    public void restructureFields() {
        setCidade(cidade);
    }
}
