package br.com.logics.flavis.model.entities.colaborador;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;

import java.util.Date;

import br.com.logics.flavis.model.repository.dao.ColaboradorDao;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.FuncaoDao;
import br.com.logics.flavis.model.repository.dao.UserDao;

/**
 * Created by murilo aires on 21/03/2017.
 */

@Entity
public class Colaborador {
    @Id
    private Long id;

    private Long userId;

    @ToOne(joinProperty = "userId")
    private User user;


    private String status;

    private String nome;

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
    @Generated(hash = 427757963)
    private transient ColaboradorDao myDao;

    @Generated(hash = 251390918)
    private transient Long user__resolvedKey;

    @Generated(hash = 1765791578)
    public Colaborador(Long id, Long userId, String status, String nome, Date createdAt,
            Date updatedAt) {
        this.id = id;
        this.userId = userId;
        this.status = status;
        this.nome = nome;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 557522670)
    public Colaborador() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }





    public String getStatus() {
        return this.status;
    }

    public void setStatus(String status) {
        this.status = status;
    }



    public Long getUserId() {
        return this.userId;
    }

    public void setUserId(Long userId) {
        this.userId = userId;
    }

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 859885876)
    public User getUser() {
        Long __key = this.userId;
        if (user__resolvedKey == null || !user__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            UserDao targetDao = daoSession.getUserDao();
            User userNew = targetDao.load(__key);
            synchronized (this) {
                user = userNew;
                user__resolvedKey = __key;
            }
        }
        return user;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 1065606912)
    public void setUser(User user) {
        synchronized (this) {
            this.user = user;
            userId = user == null ? null : user.getId();
            user__resolvedKey = userId;
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
    @Generated(hash = 415359041)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getColaboradorDao() : null;
    }

    public User getDetachedUser() {
        return user;
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
