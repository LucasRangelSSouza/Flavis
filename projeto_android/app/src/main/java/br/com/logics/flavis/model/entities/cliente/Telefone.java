package br.com.logics.flavis.model.entities.cliente;

import android.util.Log;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.ToOne;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.DaoException;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.ClienteDao;
import br.com.logics.flavis.model.repository.dao.TelefoneDao;
import br.com.logics.flavis.model.repository.dao.TipoTelefoneDao;

/**
 * Created by murilo aires on 22/03/2017.
 */

@Entity
public class Telefone {

    private Long id;

    private String numero;

    private Long clienteId;

    @ToOne(joinProperty = "tipoTelefone")
    private TipoTelefone tipo;

    private Long tipoTelefone;

    /** Used to resolve relations */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /** Used for active entity operations. */
    @Generated(hash = 445762170)
    private transient TelefoneDao myDao;

    @Generated(hash = 606252662)
    private transient Long tipo__resolvedKey;

    @Generated(hash = 341348927)
    public Telefone(Long id, String numero, Long clienteId, Long tipoTelefone) {
        this.id = id;
        this.numero = numero;
        this.clienteId = clienteId;
        this.tipoTelefone = tipoTelefone;
    }

    @Generated(hash = 982135684)
    public Telefone() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getClienteId() {
        return this.clienteId;
    }

    public void setClienteId(Long clienteId) {
        this.clienteId = clienteId;
    }

    public Long getTipoTelefone() {
        return this.tipoTelefone;
    }

    public void setTipoTelefone(Long tipoTelefone) {
        this.tipoTelefone = tipoTelefone;
    }

    /** To-one relationship, resolved on first access. */
    @Generated(hash = 1053427899)
    public TipoTelefone getTipo() {
        Long __key = this.tipoTelefone;
        if (tipo__resolvedKey == null || !tipo__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            TipoTelefoneDao targetDao = daoSession.getTipoTelefoneDao();
            TipoTelefone tipoNew = targetDao.load(__key);
            synchronized (this) {
                tipo = tipoNew;
                tipo__resolvedKey = __key;
            }
        }
        return tipo;
    }

    /** called by internal mechanisms, do not call yourself. */
    @Generated(hash = 139654665)
    public void setTipo(TipoTelefone tipo) {
        synchronized (this) {
            this.tipo = tipo;
            tipoTelefone = tipo == null ? null : tipo.getId();
            tipo__resolvedKey = tipoTelefone;
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
    @Generated(hash = 326735697)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getTelefoneDao() : null;
    }

    public String getNumero() {
        return this.numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public void restructureFields(Long clienteId) {
        setClienteId(clienteId);
        setTipo(tipo);
        Log.d("teste","teste");

    }
}
