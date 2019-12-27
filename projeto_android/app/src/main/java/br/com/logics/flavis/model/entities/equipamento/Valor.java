package br.com.logics.flavis.model.entities.equipamento;

import com.google.gson.annotations.Expose;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;
import org.greenrobot.greendao.annotation.Transient;

import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.TituloValorDao;
import br.com.logics.flavis.model.repository.dao.ValorDao;

/**
 * Created by murilo aires on 23/05/2017.
 */

@Entity
public class Valor {
    @Expose
    @Id
    private Long id;

    private Long propriedadeId;

    @ToOne(joinProperty = "tituloId")
    private TituloValor titulo;

    private Long tituloId;

    @Expose
    private String valor;

    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 892752014)
    private transient ValorDao myDao;

    @Transient
    private boolean validate;

    private boolean inserido;

    @Generated(hash = 887601156)
    public Valor(Long id, Long propriedadeId, Long tituloId, String valor, boolean inserido) {
        this.id = id;
        this.propriedadeId = propriedadeId;
        this.tituloId = tituloId;
        this.valor = valor;
        this.inserido = inserido;
    }

    @Generated(hash = 342474776)
    public Valor() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getPropriedadeId() {
        return this.propriedadeId;
    }

    public void setPropriedadeId(Long propriedadeId) {
        this.propriedadeId = propriedadeId;
    }

    public Long getTituloId() {
        return this.tituloId;
    }

    public void setTituloId(Long tituloId) {
        this.tituloId = tituloId;
    }

    public String getValor() {
        return this.valor;
    }

    public void setValor(String valor) {
        this.valor = valor;
    }

    @Generated(hash = 34179145)
    private transient Long titulo__resolvedKey;

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 1553665792)
    public TituloValor getTitulo() {
        Long __key = this.tituloId;
        if (titulo__resolvedKey == null || !titulo__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            TituloValorDao targetDao = daoSession.getTituloValorDao();
            TituloValor tituloNew = targetDao.load(__key);
            synchronized (this) {
                titulo = tituloNew;
                titulo__resolvedKey = __key;
            }
        }
        return titulo;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 472510395)
    public void setTitulo(TituloValor titulo) {
        synchronized (this) {
            this.titulo = titulo;
            tituloId = titulo == null ? null : titulo.getId();
            titulo__resolvedKey = tituloId;
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
    @Generated(hash = 1925612214)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getValorDao() : null;
    }

    public void restructureFields(Long propriedadeId) {
        if (titulo != null) {
            setTitulo(titulo);
            setPropriedadeId(propriedadeId);
            setValor(null);
        }
    }

    public void setValidate(boolean validate) {
        this.validate = validate;
    }

    public boolean isValidate() {
        return validate;
    }

    public boolean isInserido() {
        return inserido;
    }

    public boolean getInserido() {
        return this.inserido;
    }

    public void setInserido(boolean inserido) {
        this.inserido = inserido;
    }
}
