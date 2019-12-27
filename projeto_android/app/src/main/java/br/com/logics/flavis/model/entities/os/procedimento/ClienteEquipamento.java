package br.com.logics.flavis.model.entities.os.procedimento;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToOne;

import java.util.Date;

import br.com.logics.flavis.model.entities.cliente.Cliente;
import br.com.logics.flavis.model.entities.equipamento.Equipamento;
import br.com.logics.flavis.model.repository.dao.ClienteDao;
import br.com.logics.flavis.model.repository.dao.ClienteEquipamentoDao;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.EquipamentoDao;

/**
 * Created by murilo aires on 14/05/2017.
 */

@Entity
public class ClienteEquipamento {

    @Id
    private Long id;

    @ToOne(joinProperty = "equipamentoId")
    private Equipamento equipamento;

    private Long equipamentoId;

    private boolean isPmoc;

    private Date dataInicioPmoc;

    @ToOne(joinProperty = "clienteId")
    private Cliente cliente;

    private Long clienteId;

    private String observacoes;

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
    @Generated(hash = 84170817)
    private transient ClienteEquipamentoDao myDao;

    @Generated(hash = 669870530)
    public ClienteEquipamento(Long id, Long equipamentoId, boolean isPmoc,
                              Date dataInicioPmoc, Long clienteId, String observacoes, Date createdAt,
                              Date updatedAt) {
        this.id = id;
        this.equipamentoId = equipamentoId;
        this.isPmoc = isPmoc;
        this.dataInicioPmoc = dataInicioPmoc;
        this.clienteId = clienteId;
        this.observacoes = observacoes;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    @Generated(hash = 1769500156)
    public ClienteEquipamento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getEquipamentoId() {
        return this.equipamentoId;
    }

    public void setEquipamentoId(Long equipamentoId) {
        this.equipamentoId = equipamentoId;
    }

    public boolean getIsPmoc() {
        return this.isPmoc;
    }

    public void setIsPmoc(boolean isPmoc) {
        this.isPmoc = isPmoc;
    }

    public Date getDataInicioPmoc() {
        return this.dataInicioPmoc;
    }

    public void setDataInicioPmoc(Date dataInicioPmoc) {
        this.dataInicioPmoc = dataInicioPmoc;
    }

    public Long getClienteId() {
        return this.clienteId;
    }

    public void setClienteId(Long clienteId) {
        this.clienteId = clienteId;
    }

    public String getObservacoes() {
        return this.observacoes;
    }

    public void setObservacoes(String observacoes) {
        this.observacoes = observacoes;
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

    @Generated(hash = 1563764211)
    private transient Long equipamento__resolvedKey;

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 1032155657)
    public Equipamento getEquipamento() {
        Long __key = this.equipamentoId;
        if (equipamento__resolvedKey == null
                || !equipamento__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            EquipamentoDao targetDao = daoSession.getEquipamentoDao();
            Equipamento equipamentoNew = targetDao.load(__key);
            synchronized (this) {
                equipamento = equipamentoNew;
                equipamento__resolvedKey = __key;
            }
        }
        return equipamento;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 28581661)
    public void setEquipamento(Equipamento equipamento) {
        synchronized (this) {
            this.equipamento = equipamento;
            equipamentoId = equipamento == null ? null : equipamento.getId();
            equipamento__resolvedKey = equipamentoId;
        }
    }

    @Generated(hash = 1668724671)
    private transient Long cliente__resolvedKey;

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 1774349611)
    public Cliente getCliente() {
        Long __key = this.clienteId;
        if (cliente__resolvedKey == null || !cliente__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            ClienteDao targetDao = daoSession.getClienteDao();
            Cliente clienteNew = targetDao.load(__key);
            synchronized (this) {
                cliente = clienteNew;
                cliente__resolvedKey = __key;
            }
        }
        return cliente;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 1331844999)
    public void setCliente(Cliente cliente) {
        synchronized (this) {
            this.cliente = cliente;
            clienteId = cliente == null ? null : cliente.getId();
            cliente__resolvedKey = clienteId;
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
    @Generated(hash = 1411844578)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getClienteEquipamentoDao() : null;
    }


    public void restructureFields() {
        if (equipamento != null) {
            equipamento.restructureFields();
            setEquipamento(equipamento);
        }

        if (cliente != null) {
            cliente.restructureFields();
            setCliente(cliente);
        }

    }
}
