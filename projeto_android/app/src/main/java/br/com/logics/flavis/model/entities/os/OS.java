package br.com.logics.flavis.model.entities.os;

import com.google.gson.annotations.Expose;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToMany;
import org.greenrobot.greendao.annotation.ToOne;

import java.util.Date;
import java.util.List;

import br.com.logics.flavis.model.entities.cliente.Cliente;
import br.com.logics.flavis.model.entities.endereco.Endereco;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;
import br.com.logics.flavis.model.repository.dao.ClienteDao;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.EnderecoDao;
import br.com.logics.flavis.model.repository.dao.ExecucaoProcedimentoDao;
import br.com.logics.flavis.model.repository.dao.FotoOSDao;
import br.com.logics.flavis.model.repository.dao.OSDao;

/**
 * Created by murilo aires on 21/03/2017.
 */

@Entity
public class OS {
    @Expose
    @Id
    private Long id;

    private Long clienteId;

    @ToOne(joinProperty = "clienteId")
    private Cliente cliente;

    private Long enderecoId;

    @ToOne(joinProperty = "enderecoId")
    private Endereco endereco;

    @ToMany(referencedJoinProperty = "osId")
    private List<FotoOS> fotosOs;

    @Expose
    @ToMany(referencedJoinProperty = "osId")
    private List<ExecucaoProcedimento> execucoesProcedimentos;

    private Date createdAt;

    private Date updatedAt;

    private Date dataAbertura;

    private Date dataEncerramento;

    private String ocorrencia;

    private String observacao;

    private String solicitante;

    private String justificativaEncerramento;

    private boolean isPmoc;

    @Expose
    private boolean isEncerrada;

    private boolean isHomologada;

    private boolean isSync;

    private boolean aberta;

    private Date dataAgendada;

    private Date horaAgendada;

    @Expose
    private String receptorRg;

    @Expose
    private String receptorNome;

    @Expose
    private String relatorioAvaliacao;

    private String pathAssinatura;

    private boolean isFinalizada;

    private boolean isFotosSincronizadas;

    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 581811533)
    private transient OSDao myDao;

    @Generated(hash = 1611585557)
    public OS(Long id, Long clienteId, Long enderecoId, Date createdAt, Date updatedAt,
            Date dataAbertura, Date dataEncerramento, String ocorrencia, String observacao,
            String solicitante, String justificativaEncerramento, boolean isPmoc,
            boolean isEncerrada, boolean isHomologada, boolean isSync, boolean aberta,
            Date dataAgendada, Date horaAgendada, String receptorRg, String receptorNome,
            String relatorioAvaliacao, String pathAssinatura, boolean isFinalizada,
            boolean isFotosSincronizadas) {
        this.id = id;
        this.clienteId = clienteId;
        this.enderecoId = enderecoId;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.dataAbertura = dataAbertura;
        this.dataEncerramento = dataEncerramento;
        this.ocorrencia = ocorrencia;
        this.observacao = observacao;
        this.solicitante = solicitante;
        this.justificativaEncerramento = justificativaEncerramento;
        this.isPmoc = isPmoc;
        this.isEncerrada = isEncerrada;
        this.isHomologada = isHomologada;
        this.isSync = isSync;
        this.aberta = aberta;
        this.dataAgendada = dataAgendada;
        this.horaAgendada = horaAgendada;
        this.receptorRg = receptorRg;
        this.receptorNome = receptorNome;
        this.relatorioAvaliacao = relatorioAvaliacao;
        this.pathAssinatura = pathAssinatura;
        this.isFinalizada = isFinalizada;
        this.isFotosSincronizadas = isFotosSincronizadas;
    }

    @Generated(hash = 1773052122)
    public OS() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }


    @Generated(hash = 1668724671)
    private transient Long cliente__resolvedKey;


    @Generated(hash = 1241562132)
    private transient Long endereco__resolvedKey;

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
    @Generated(hash = 478625675)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getOSDao() : null;
    }

    public Long getClienteId() {
        return this.clienteId;
    }

    public void setClienteId(Long clienteId) {
        this.clienteId = clienteId;
    }

    public String getOcorrencia() {
        return this.ocorrencia;
    }

    public void setOcorrencia(String ocorrencia) {
        this.ocorrencia = ocorrencia;
    }

    public String getObservacao() {
        return this.observacao;
    }

    public void setObservacao(String observacao) {
        this.observacao = observacao;
    }

    public String getJustificativaEncerramento() {
        return this.justificativaEncerramento;
    }

    public void setJustificativaEncerramento(String justificativaEncerramento) {
        this.justificativaEncerramento = justificativaEncerramento;
    }

    public boolean getIsPmoc() {
        return this.isPmoc;
    }

    public void setIsPmoc(boolean isPmoc) {
        this.isPmoc = isPmoc;
    }

    public boolean getIsEncerrada() {
        return this.isEncerrada;
    }

    public void setIsEncerrada(boolean isEncerrada) {
        this.isEncerrada = isEncerrada;
    }

    public Date getDataAgendada() {
        return this.dataAgendada;
    }

    public void setDataAgendada(Date dataAgendada) {
        this.dataAgendada = dataAgendada;
    }

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
     * To-one relationship, resolved on first access.
     */
    @Generated(hash = 355084609)
    public Endereco getEndereco() {
        Long __key = this.enderecoId;
        if (endereco__resolvedKey == null || !endereco__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            EnderecoDao targetDao = daoSession.getEnderecoDao();
            Endereco enderecoNew = targetDao.load(__key);
            synchronized (this) {
                endereco = enderecoNew;
                endereco__resolvedKey = __key;
            }
        }
        return endereco;
    }

    /**
     * called by internal mechanisms, do not call yourself.
     */
    @Generated(hash = 1740016691)
    public void setEndereco(Endereco endereco) {
        synchronized (this) {
            this.endereco = endereco;
            enderecoId = endereco == null ? null : endereco.getId();
            endereco__resolvedKey = enderecoId;
        }
    }

    public void restructureFields() {
        if (endereco != null) {
            endereco.restructureFields();
            setEndereco(endereco);
        }
        if (cliente != null) {
            cliente.restructureFields();
            setCliente(cliente);
        }

        if (execucoesProcedimentos != null) {
            for (ExecucaoProcedimento execucaoProcedimento : execucoesProcedimentos) {
                execucaoProcedimento.restructureFields(id);
            }
        }
    }

    public Date getCreatedAt() {
        return this.createdAt;
    }

    public void setCreatedAt(Date createdAt) {
        this.createdAt = createdAt;
    }

    public Long getEnderecoId() {
        return this.enderecoId;
    }

    public void setEnderecoId(Long enderecoId) {
        this.enderecoId = enderecoId;
    }

    public boolean getAberta() {
        return this.aberta;
    }

    public void setAberta(boolean aberta) {
        this.aberta = aberta;
    }

    public Date getUpdatedAt() {
        return this.updatedAt;
    }

    public void setUpdatedAt(Date updatedAt) {
        this.updatedAt = updatedAt;
    }

    public boolean getIsHomologada() {
        return this.isHomologada;
    }

    public void setIsHomologada(boolean isHomologada) {
        this.isHomologada = isHomologada;
    }

    public boolean getIsSync() {
        return this.isSync;
    }

    public void setIsSync(boolean isSync) {
        this.isSync = isSync;
    }

    public String getSolicitante() {
        return this.solicitante;
    }

    public void setSolicitante(String solicitante) {
        this.solicitante = solicitante;
    }

    /**
     * To-many relationship, resolved on first access (and after reset).
     * Changes to to-many relations are not persisted, make changes to the target entity.
     */
    @Generated(hash = 1904226749)
    public List<FotoOS> getFotosOs() {
        if (fotosOs == null) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            FotoOSDao targetDao = daoSession.getFotoOSDao();
            List<FotoOS> fotosOsNew = targetDao._queryOS_FotosOs(id);
            synchronized (this) {
                if (fotosOs == null) {
                    fotosOs = fotosOsNew;
                }
            }
        }
        return fotosOs;
    }

    /**
     * Resets a to-many relationship, making the next get call to query for a fresh result.
     */
    @Generated(hash = 1748692209)
    public synchronized void resetFotosOs() {
        fotosOs = null;
    }

    /**
     * To-many relationship, resolved on first access (and after reset).
     * Changes to to-many relations are not persisted, make changes to the target entity.
     */
    @Generated(hash = 201997077)
    public List<ExecucaoProcedimento> getExecucoesProcedimentos() {
        if (execucoesProcedimentos == null) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            ExecucaoProcedimentoDao targetDao = daoSession.getExecucaoProcedimentoDao();
            List<ExecucaoProcedimento> execucoesProcedimentosNew = targetDao
                    ._queryOS_ExecucoesProcedimentos(id);
            synchronized (this) {
                if (execucoesProcedimentos == null) {
                    execucoesProcedimentos = execucoesProcedimentosNew;
                }
            }
        }
        return execucoesProcedimentos;
    }

    /**
     * Resets a to-many relationship, making the next get call to query for a fresh result.
     */
    @Generated(hash = 254072458)
    public synchronized void resetExecucoesProcedimentos() {
        execucoesProcedimentos = null;
    }


    public String getRelatorioAvaliacao() {
        return this.relatorioAvaliacao;
    }

    public void setRelatorioAvaliacao(String relatorioAvaliacao) {
        this.relatorioAvaliacao = relatorioAvaliacao;
    }

    public boolean getIsFinalizada() {
        return this.isFinalizada;
    }

    public void setIsFinalizada(boolean isFinalizada) {
        this.isFinalizada = isFinalizada;
    }

    public String getPathAssinatura() {
        return this.pathAssinatura;
    }

    public void setPathAssinatura(String pathAssinatura) {
        this.pathAssinatura = pathAssinatura;
    }

    public String getReceptorRg() {
        return this.receptorRg;
    }

    public void setReceptorRg(String receptorRg) {
        this.receptorRg = receptorRg;
    }

    public String getReceptorNome() {
        return this.receptorNome;
    }

    public void setReceptorNome(String receptorNome) {
        this.receptorNome = receptorNome;
    }

    public boolean getIsFotosSincronizadas() {
        return this.isFotosSincronizadas;
    }

    public void setIsFotosSincronizadas(boolean isFotosSincronizadas) {
        this.isFotosSincronizadas = isFotosSincronizadas;
    }

    public boolean isProcedimentosEncerrados() {
        for (int i = 0; i < execucoesProcedimentos.size(); i++) {
            if (!execucoesProcedimentos.get(i).getCompleta()) {
                return false;
            }
        }
        return true;
    }


    public Date getHoraAgendada() {
        return this.horaAgendada;
    }

    public void setHoraAgendada(Date horaAgendada) {
        this.horaAgendada = horaAgendada;
    }

    public Date getDataAbertura() {
        return this.dataAbertura;
    }

    public void setDataAbertura(Date dataAbertura) {
        this.dataAbertura = dataAbertura;
    }

    public Date getDataEncerramento() {
        return this.dataEncerramento;
    }

    public void setDataEncerramento(Date dataEncerramento) {
        this.dataEncerramento = dataEncerramento;
    }
}
