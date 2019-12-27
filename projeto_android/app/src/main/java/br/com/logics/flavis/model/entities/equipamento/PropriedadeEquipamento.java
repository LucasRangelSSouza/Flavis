package br.com.logics.flavis.model.entities.equipamento;

import com.google.gson.annotations.Expose;

import org.greenrobot.greendao.DaoException;
import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Generated;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.ToMany;
import org.greenrobot.greendao.annotation.ToOne;

import java.util.List;

import br.com.logics.flavis.model.entities.os.procedimento.TituloProcedimento;
import br.com.logics.flavis.model.repository.dao.DaoSession;
import br.com.logics.flavis.model.repository.dao.PropriedadeEquipamentoDao;
import br.com.logics.flavis.model.repository.dao.TituloProcedimentoDao;
import br.com.logics.flavis.model.repository.dao.ValorDao;
import br.com.logics.flavis.model.repository.dao.TituloPropriedadeDao;

/**
 * Created by murilo aires on 23/05/2017.
 */
@Entity
public class PropriedadeEquipamento {
    @Expose
    @Id
    private Long id;

    @ToOne(joinProperty = "tituloId")
    private TituloPropriedade titulo;

    private Long tituloId;

    @Expose
    @ToMany(referencedJoinProperty = "propriedadeId")
    private List<Valor> valores;

    /**
     * Used to resolve relations
     */
    @Generated(hash = 2040040024)
    private transient DaoSession daoSession;

    /**
     * Used for active entity operations.
     */
    @Generated(hash = 1260163348)
    private transient PropriedadeEquipamentoDao myDao;

    @Generated(hash = 647945135)
    public PropriedadeEquipamento(Long id, Long tituloId) {
        this.id = id;
        this.tituloId = tituloId;
    }

    @Generated(hash = 844841787)
    public PropriedadeEquipamento() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Long getTituloId() {
        return this.tituloId;
    }

    public void setTituloId(Long tituloId) {
        this.tituloId = tituloId;
    }

    @Generated(hash = 34179145)
    private transient Long titulo__resolvedKey;

    /** To-one relationship, resolved on first access. */
    @Generated(hash = 401964924)
    public TituloPropriedade getTitulo() {
        Long __key = this.tituloId;
        if (titulo__resolvedKey == null || !titulo__resolvedKey.equals(__key)) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            TituloPropriedadeDao targetDao = daoSession.getTituloPropriedadeDao();
            TituloPropriedade tituloNew = targetDao.load(__key);
            synchronized (this) {
                titulo = tituloNew;
                titulo__resolvedKey = __key;
            }
        }
        return titulo;
    }

    /**
     * To-many relationship, resolved on first access (and after reset).
     * Changes to to-many relations are not persisted, make changes to the target entity.
     */
    @Generated(hash = 1609397275)
    public List<Valor> getValores() {
        if (valores == null) {
            final DaoSession daoSession = this.daoSession;
            if (daoSession == null) {
                throw new DaoException("Entity is detached from DAO context");
            }
            ValorDao targetDao = daoSession.getValorDao();
            List<Valor> valoresNew = targetDao
                    ._queryPropriedadeEquipamento_Valores(id);
            synchronized (this) {
                if (valores == null) {
                    valores = valoresNew;
                }
            }
        }
        return valores;
    }

    /**
     * Resets a to-many relationship, making the next get call to query for a fresh result.
     */
    @Generated(hash = 1455446017)
    public synchronized void resetValores() {
        valores = null;
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
    @Generated(hash = 136880156)
    public void __setDaoSession(DaoSession daoSession) {
        this.daoSession = daoSession;
        myDao = daoSession != null ? daoSession.getPropriedadeEquipamentoDao()
                : null;
    }

    public void restructureFields() {
        if (titulo != null) {
            setTitulo(titulo);
        }
        if (valores != null) {
            for (Valor valor : valores) {
                valor.restructureFields(id);
            }
        }
    }

    /** called by internal mechanisms, do not call yourself. */
    @Generated(hash = 522401077)
    public void setTitulo(TituloPropriedade titulo) {
        synchronized (this) {
            this.titulo = titulo;
            tituloId = titulo == null ? null : titulo.getId();
            titulo__resolvedKey = tituloId;
        }
    }
}
