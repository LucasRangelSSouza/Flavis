package br.com.logics.flavis.model.entities.os.procedimento;

import com.google.gson.annotations.Expose;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;

import java.util.Date;

import br.com.logics.flavis.model.entities.equipamento.PropriedadeEquipamento;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.ProcedimentoDao;
import br.com.logics.flavis.model.repository.dao.PropriedadeEquipamentoDao;
import br.com.logics.flavis.model.repository.dao.TituloProcedimentoDao;

/**
 * Created by murilo aires on 12/05/2017.
 */

@Entity
public class Procedimento {
    @Expose
    @Id
    private Long id;

    @ToOne(joinProperty = "tituloProcedimentoId")
    private TituloProcedimento titulo;

    private Long tituloProcedimentoId;

    @Expose
    @ToOne(joinProperty = "propriedadeId")
    private PropriedadeEquipamento propriedadeEquipamento;

    private Long propriedadeId;

    private Integer periodicidade;

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
    @Generated(hash = 47231205)
    private transient ProcedimentoDao myDao;

    @Generated(hash = 1345162549)
    public Procedimento(Long id, Long tituloProcedimentoId, Long propriedadeId,
                        Integer periodicidade, Date createdAt, Date updatedAt) {
        this.id = id;
        this.tituloProcedimentoId = tituloProcedimentoId;
        this.propriedadeId = propriedadeId;
        this.periodicidade = periodicidade;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 1231927276)
    public Procedimento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getTituloProcedimentoId() {
        return this.tituloProcedimentoId;
    }

    public void setTituloProcedimentoId(Long tituloProcedimentoId) {
        this.tituloProcedimentoId = tituloProcedimentoId;
    }

    public Integer getPeriodicidade() {
        return this.periodicidade;
    }

    public void setPeriodicidade(Integer periodicidade) {
        this.periodicidade = periodicidade;
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

    @Generated(hash = 34179145)
    private transient Long titulo__resolvedKey;

    @Generated(hash = 1440153302)
    private transient Long propriedadeEquipamento__resolvedKey;

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 893794679)
    public TituloProcedimento getTitulo() {
        Long __key = this.tituloProcedimentoId;
        if (titulo__resolvedKey == null || !titulo__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            TituloProcedimentoDao targetDao = daoSession.getTituloProcedimentoDao();
            TituloProcedimento tituloNew = targetDao.load(__key);
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
    @Generated(hash = 1725114316)
    public void setTitulo(TituloProcedimento titulo) {
        synchronized (this) {
            this.titulo = titulo;
            tituloProcedimentoId = titulo == null ? null : titulo.getId();
            titulo__resolvedKey = tituloProcedimentoId;
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
    @Generated(hash = 816905949)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getProcedimentoDao() : null;
    }

    public void restructureFields() {
        if (titulo != null) {
            setTitulo(titulo);
        }

        if (propriedadeEquipamento != null) {
            propriedadeEquipamento.restructureFields();
            setPropriedadeEquipamento(propriedadeEquipamento);
        }
    }

    public Long getPropriedadeId() {
        return this.propriedadeId;
    }

    public void setPropriedadeId(Long propriedadeId) {
        this.propriedadeId = propriedadeId;
    }

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 1864160464)
    public PropriedadeEquipamento getPropriedadeEquipamento() {
        Long __key = this.propriedadeId;
        if (propriedadeEquipamento__resolvedKey == null
                || !propriedadeEquipamento__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            PropriedadeEquipamentoDao targetDao = daoSession.getPropriedadeEquipamentoDao();
            PropriedadeEquipamento propriedadeEquipamentoNew = targetDao.load(__key);
            synchronized (this) {
                propriedadeEquipamento = propriedadeEquipamentoNew;
                propriedadeEquipamento__resolvedKey = __key;
            }
        }
        return propriedadeEquipamento;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 283187655)
    public void setPropriedadeEquipamento(PropriedadeEquipamento propriedadeEquipamento) {
        synchronized (this) {
            this.propriedadeEquipamento = propriedadeEquipamento;
            propriedadeId = propriedadeEquipamento == null ? null
                    : propriedadeEquipamento.getId();
            propriedadeEquipamento__resolvedKey = propriedadeId;
        }
    }
}
