package br.com.logics.flavis.model.entities.os.procedimento;

import com.google.gson.annotations.Expose;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToMany;
import org.greenrobot.greendao.annotation.ToOne;
import org.greenrobot.greendao.annotation.Transient;

import java.util.Date;
import java.util.List;

import br.com.logics.flavis.model.repository.dao.ClienteEquipamentoDao;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.ExecucaoProcedimentoDao;
import br.com.logics.flavis.model.repository.dao.FotoProcedimentoDao;
import br.com.logics.flavis.model.repository.dao.ProcedimentoDao;

/**
 * Created by murilo aires on 12/05/2017.
 */

@Entity
public class ExecucaoProcedimento {
    @Expose
    @Id
    private Long id;

    private Long osId;

    @Expose
    @ToOne(joinProperty = "procedimentoPmocId")
    private Procedimento procedimentoPmoc;

    private Long procedimentoPmocId;

    @ToOne(joinProperty = "clienteEquipamentoId")
    private ClienteEquipamento clienteEquipamento;

    private Long clienteEquipamentoId;

    private Date createdAt;

    private Date updatedAt;

    @ToMany(referencedJoinProperty = "execucaoProcedimentoId")
    private List<FotoProcedimento> fotosProcedimento;

    private Date dataAgendadaExecucao;

    @Expose
    private String relatorioAvaliacao;

    private boolean fotosSincronizadas;

    @Transient
    private boolean isVisible;

    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 1592176266)
    private transient ExecucaoProcedimentoDao myDao;

    @Generated(hash = 983054518)
    private transient Long procedimentoPmoc__resolvedKey;

    @Generated(hash = 1859550428)
    private transient Long clienteEquipamento__resolvedKey;
    
    private boolean completa;
    


    @Generated(hash = 1688541357)
    public ExecucaoProcedimento(Long id, Long osId, Long procedimentoPmocId, Long clienteEquipamentoId,
            Date createdAt, Date updatedAt, Date dataAgendadaExecucao, String relatorioAvaliacao,
            boolean fotosSincronizadas, boolean completa) {
        this.id = id;
        this.osId = osId;
        this.procedimentoPmocId = procedimentoPmocId;
        this.clienteEquipamentoId = clienteEquipamentoId;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.dataAgendadaExecucao = dataAgendadaExecucao;
        this.relatorioAvaliacao = relatorioAvaliacao;
        this.fotosSincronizadas = fotosSincronizadas;
        this.completa = completa;
    }

    @Generated(hash = 360382814)
    public ExecucaoProcedimento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    /**
     * To-many relationship, resolved on first access (and after reset).
     * Changes to to-many relations are not persisted, make changes to the target entity.
     */
    @Generated(hash = 560665305)
    public List<FotoProcedimento> getFotosProcedimento() {
        if (fotosProcedimento == null) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            FotoProcedimentoDao targetDao = daoSession.getFotoProcedimentoDao();
            List<FotoProcedimento> fotosProcedimentoNew = targetDao
                    ._queryExecucaoProcedimento_FotosProcedimento(id);
            synchronized (this) {
                if (fotosProcedimento == null) {
                    fotosProcedimento = fotosProcedimentoNew;
                }
            }
        }
        return fotosProcedimento;
    }

    /**
     * Resets a to-many relationship, making the next get call to query for a fresh result.
     */
    @Generated(hash = 2084898094)
    public synchronized void resetFotosProcedimento() {
        fotosProcedimento = null;
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
    @Generated(hash = 1656574233)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getExecucaoProcedimentoDao() : null;
    }

    public Long getProcedimentoPmocId() {
        return this.procedimentoPmocId;
    }

    public void setProcedimentoPmocId(Long procedimentoPmocId) {
        this.procedimentoPmocId = procedimentoPmocId;
    }

    public Long getClienteEquipamentoId() {
        return this.clienteEquipamentoId;
    }

    public void setClienteEquipamentoId(Long clienteEquipamentoId) {
        this.clienteEquipamentoId = clienteEquipamentoId;
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

    public Date getDataAgendadaExecucao() {
        return this.dataAgendadaExecucao;
    }

    public void setDataAgendadaExecucao(Date dataAgendadaExecucao) {
        this.dataAgendadaExecucao = dataAgendadaExecucao;
    }

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 1335974864)
    public Procedimento getProcedimentoPmoc() {
        Long __key = this.procedimentoPmocId;
        if (procedimentoPmoc__resolvedKey == null || !procedimentoPmoc__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            ProcedimentoDao targetDao = daoSession.getProcedimentoDao();
            Procedimento procedimentoPmocNew = targetDao.load(__key);
            synchronized (this) {
                procedimentoPmoc = procedimentoPmocNew;
                procedimentoPmoc__resolvedKey = __key;
            }
        }
        return procedimentoPmoc;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 1870146854)
    public void setProcedimentoPmoc(Procedimento procedimentoPmoc) {
        synchronized (this) {
            this.procedimentoPmoc = procedimentoPmoc;
            procedimentoPmocId = procedimentoPmoc == null ? null : procedimentoPmoc.getId();
            procedimentoPmoc__resolvedKey = procedimentoPmocId;
        }
    }

    /**
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 543136022)
    public ClienteEquipamento getClienteEquipamento() {
        Long __key = this.clienteEquipamentoId;
        if (clienteEquipamento__resolvedKey == null || !clienteEquipamento__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            ClienteEquipamentoDao targetDao = daoSession.getClienteEquipamentoDao();
            ClienteEquipamento clienteEquipamentoNew = targetDao.load(__key);
            synchronized (this) {
                clienteEquipamento = clienteEquipamentoNew;
                clienteEquipamento__resolvedKey = __key;
            }
        }
        return clienteEquipamento;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 809246578)
    public void setClienteEquipamento(ClienteEquipamento clienteEquipamento) {
        synchronized (this) {
            this.clienteEquipamento = clienteEquipamento;
            clienteEquipamentoId = clienteEquipamento == null ? null : clienteEquipamento.getId();
            clienteEquipamento__resolvedKey = clienteEquipamentoId;
        }
    }

    public Long getOsId() {
        return this.osId;
    }

    public void setOsId(Long osId) {
        this.osId = osId;
    }

    public void restructureFields(Long osId) {
        setOsId(osId);
        if (procedimentoPmoc != null) {
            procedimentoPmoc.restructureFields();
            setProcedimentoPmoc(procedimentoPmoc);
        }
        if (clienteEquipamento != null) {
            clienteEquipamento.restructureFields();
            setClienteEquipamento(clienteEquipamento);
        }

    }

    public boolean isVisible() {
        return isVisible;
    }

    public void setVisible(boolean visible) {
        isVisible = visible;
    }

    public boolean isCompleta() {
        return completa;
    }

    public boolean getCompleta() {
        return this.completa;
    }

    public void setCompleta(boolean completa) {
        this.completa = completa;
    }

    public void setRelatorioAvaliacao(String relatorioAvaliacao) {
        this.relatorioAvaliacao = relatorioAvaliacao;
    }

    public String getRelatorioAvaliacao() {
        return this.relatorioAvaliacao;
    }

    public boolean getFotosSincronizadas() {
        return this.fotosSincronizadas;
    }

    public void setFotosSincronizadas(boolean fotosSincronizadas) {
        this.fotosSincronizadas = fotosSincronizadas;
    }
}
