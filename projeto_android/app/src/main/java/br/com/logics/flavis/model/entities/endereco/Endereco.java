package br.com.logics.flavis.model.entities.endereco;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;

import br.com.logics.flavis.model.repository.dao.BairroDao;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.EnderecoDao;
import br.com.logics.flavis.model.repository.dao.TipoEnderecoDao;

/**
 * Created by murilo aires on 22/03/2017.
 */

@Entity
public class Endereco {

    @Id
    private Long id;

    @ToOne(joinProperty = "tipoEnderecoId")
    TipoEndereco tipo;

    private Long tipoEnderecoId;

    @ToOne(joinProperty = "bairroId")
    private Bairro bairro;

    private Long bairroId;

    private String referencia;

    private String complemento;

    private String numero;

    private String cep;

    private String logradouro;

    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 1367133151)
    private transient EnderecoDao myDao;

    @Generated(hash = 933786729)
    private transient Long bairro__resolvedKey;

    @Generated(hash = 606252662)
    private transient Long tipo__resolvedKey;

    @Generated(hash = 573355301)
    public Endereco(Long id, Long tipoEnderecoId, Long bairroId, String referencia,
                    String complemento, String numero, String cep, String logradouro) {
        this.id = id;
        this.tipoEnderecoId = tipoEnderecoId;
        this.bairroId = bairroId;
        this.referencia = referencia;
        this.complemento = complemento;
        this.numero = numero;
        this.cep = cep;
        this.logradouro = logradouro;
    }

    @Generated(hash = 968625477)
    public Endereco() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getReferencia() {
        return this.referencia;
    }

    public void setReferencia(String referencia) {
        this.referencia = referencia;
    }

    public String getComplemento() {
        return this.complemento;
    }

    public void setComplemento(String complemento) {
        this.complemento = complemento;
    }

    public String getNumero() {
        return this.numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public String getCep() {
        return this.cep;
    }

    public void setCep(String cep) {
        this.cep = cep;
    }

    public String getLogradouro() {
        return this.logradouro;
    }

    public void setLogradouro(String logradouro) {
        this.logradouro = logradouro;
    }

    public Long getBairroId() {
        return this.bairroId;
    }

    public void setBairroId(Long bairroId) {
        this.bairroId = bairroId;
    }

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 2055463442)
    public Bairro getBairro() {
        Long __key = this.bairroId;
        if (bairro__resolvedKey == null || !bairro__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            BairroDao targetDao = daoSession.getBairroDao();
            Bairro bairroNew = targetDao.load(__key);
            synchronized (this) {
                bairro = bairroNew;
                bairro__resolvedKey = __key;
            }
        }
        return bairro;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 497489004)
    public void setBairro(Bairro bairro) {
        synchronized (this) {
            this.bairro = bairro;
            bairroId = bairro == null ? null : bairro.getId();
            bairro__resolvedKey = bairroId;
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
    @Generated(hash = 522914645)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getEnderecoDao() : null;
    }

    public Long getTipoEnderecoId() {
        return this.tipoEnderecoId;
    }

    public void setTipoEnderecoId(Long tipoEnderecoId) {
        this.tipoEnderecoId = tipoEnderecoId;
    }

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 490336336)
    public TipoEndereco getTipo() {
        Long __key = this.tipoEnderecoId;
        if (tipo__resolvedKey == null || !tipo__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            TipoEnderecoDao targetDao = daoSession.getTipoEnderecoDao();
            TipoEndereco tipoNew = targetDao.load(__key);
            synchronized (this) {
                tipo = tipoNew;
                tipo__resolvedKey = __key;
            }
        }
        return tipo;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 1777643210)
    public void setTipo(TipoEndereco tipo) {
        synchronized (this) {
            this.tipo = tipo;
            tipoEnderecoId = tipo == null ? null : tipo.getId();
            tipo__resolvedKey = tipoEnderecoId;
        }
    }


    public void restructureFields() {
        if(bairro != null){
            bairro.restructureFields();
            setBairro(bairro);
        }
        if (tipo != null) {
            setTipo(tipo);
        }
    }
}
