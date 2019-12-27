package br.com.logics.flavis.model.entities.cliente;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToMany;

import java.util.Date;
import java.util.List;

import br.com.logics.flavis.model.repository.dao.ClienteDao;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.TelefoneDao;

/**
 * Created by murilo aires on 22/03/2017.
 */

@Entity
public class Cliente {

    @Id
    private Long id;

    private String tipoPessoa;

    private String nome;

    private String cpfCnpj;

    private String razaoSocial;

    private String tipoLocal;

    private Date horarioAbertura;

    private Date horarioFechamento;

    private Date createdAt;

    private Date updatedAt;

    private Integer intervaloAlmoco;

    @ToMany(referencedJoinProperty = "clienteId")
    private List<Telefone> telefones;


    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 356477667)
    private transient ClienteDao myDao;

    @Generated(hash = 1759780613)
    public Cliente(Long id, String tipoPessoa, String nome, String cpfCnpj, String razaoSocial,
                   String tipoLocal, Date horarioAbertura, Date horarioFechamento, Date createdAt,
                   Date updatedAt, Integer intervaloAlmoco) {
        this.id = id;
        this.tipoPessoa = tipoPessoa;
        this.nome = nome;
        this.cpfCnpj = cpfCnpj;
        this.razaoSocial = razaoSocial;
        this.tipoLocal = tipoLocal;
        this.horarioAbertura = horarioAbertura;
        this.horarioFechamento = horarioFechamento;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.intervaloAlmoco = intervaloAlmoco;
    }

    @Generated(hash = 1805939709)
    public Cliente() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }


    public String getCpfCnpj() {
        return this.cpfCnpj;
    }

    public void setCpfCnpj(String cpfCnpj) {
        this.cpfCnpj = cpfCnpj;
    }

    public String getRazaoSocial() {
        return this.razaoSocial;
    }

    public void setRazaoSocial(String razaoSocial) {
        this.razaoSocial = razaoSocial;
    }

    public String getTipoLocal() {
        return this.tipoLocal;
    }

    public void setTipoLocal(String tipoLocal) {
        this.tipoLocal = tipoLocal;
    }

    /**
     * To-many relationship, resolved on first access (and after reset).
     * Changes to to-many relations are not persisted, make changes to the target entity.
     */
    @Generated(hash = 325720336)
    public List<Telefone> getTelefones() {
        if (telefones == null) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            TelefoneDao targetDao = daoSession.getTelefoneDao();
            List<Telefone> telefonesNew = targetDao._queryCliente_Telefones(id);
            synchronized (this) {
                if (telefones == null) {
                    telefones = telefonesNew;
                }
            }
        }
        return telefones;
    }

    /**
     * Resets a to-many relationship, making the next get call to query for a fresh result.
     */
    @Generated(hash = 1388741976)
    public synchronized void resetTelefones() {
        telefones = null;
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
    @Generated(hash = 48169481)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getClienteDao() : null;
    }

    public String getNome() {
        return this.nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getTipoPessoa() {
        return this.tipoPessoa;
    }

    public void setTipoPessoa(String tipoPessoa) {
        this.tipoPessoa = tipoPessoa;
    }

    public Date getHorarioAbertura() {
        return this.horarioAbertura;
    }

    public void setHorarioAbertura(Date horarioAbertura) {
        this.horarioAbertura = horarioAbertura;
    }

    public Date getHorarioFechamento() {
        return this.horarioFechamento;
    }

    public void setHorarioFechamento(Date horarioFechamento) {
        this.horarioFechamento = horarioFechamento;
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

    public Integer getIntervaloAlmoco() {
        return this.intervaloAlmoco;
    }

    public void setIntervaloAlmoco(Integer intervaloAlmoco) {
        this.intervaloAlmoco = intervaloAlmoco;
    }

    public void restructureFields() {
        if (telefones != null) {
            for (Telefone telefone : telefones) {
                telefone.restructureFields(id);
            }
        }

    }
}
