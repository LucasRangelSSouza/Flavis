package br.com.logics.flavis.model.repository.dao;

import java.util.List;
import java.util.ArrayList;
import android.database.Cursor;
import android.database.sqlite.SQLiteStatement;

import org.greenrobot.greendao.AbstractDao;
import org.greenrobot.greendao.Property;
import org.greenrobot.greendao.internal.SqlUtils;
import org.greenrobot.greendao.internal.DaoConfig;
import org.greenrobot.greendao.database.Database;
import org.greenrobot.greendao.database.DatabaseStatement;

import br.com.logics.flavis.model.entities.equipamento.PropriedadeEquipamento;
import br.com.logics.flavis.model.entities.os.procedimento.TituloProcedimento;

import br.com.logics.flavis.model.entities.os.procedimento.Procedimento;

// THIS CODE IS GENERATED BY greenDAO, DO NOT EDIT.
/** 
 * DAO for table "PROCEDIMENTO".
*/
public class ProcedimentoDao extends AbstractDao<Procedimento, Long> {

    public static final String TABLENAME = "PROCEDIMENTO";

    /**
     * Properties of entity Procedimento.<br/>
     * Can be used for QueryBuilder and for referencing column names.
     */
    public static class Properties {
        public final static Property Id = new Property(0, Long.class, "id", true, "_id");
        public final static Property TituloProcedimentoId = new Property(1, Long.class, "tituloProcedimentoId", false, "TITULO_PROCEDIMENTO_ID");
        public final static Property PropriedadeId = new Property(2, Long.class, "propriedadeId", false, "PROPRIEDADE_ID");
        public final static Property Periodicidade = new Property(3, Integer.class, "periodicidade", false, "PERIODICIDADE");
        public final static Property CreatedAt = new Property(4, java.util.Date.class, "createdAt", false, "CREATED_AT");
        public final static Property UpdatedAt = new Property(5, java.util.Date.class, "updatedAt", false, "UPDATED_AT");
    }

    private DaoSession daoSession;


    public ProcedimentoDao(DaoConfig config) {
        super(config);
    }
    
    public ProcedimentoDao(DaoConfig config, DaoSession daoSession) {
        super(config, daoSession);
        this.daoSession = daoSession;
    }

    /** Creates the underlying database table. */
    public static void createTable(Database db, boolean ifNotExists) {
        String constraint = ifNotExists? "IF NOT EXISTS ": "";
        db.execSQL("CREATE TABLE " + constraint + "\"PROCEDIMENTO\" (" + //
                "\"_id\" INTEGER PRIMARY KEY ," + // 0: id
                "\"TITULO_PROCEDIMENTO_ID\" INTEGER," + // 1: tituloProcedimentoId
                "\"PROPRIEDADE_ID\" INTEGER," + // 2: propriedadeId
                "\"PERIODICIDADE\" INTEGER," + // 3: periodicidade
                "\"CREATED_AT\" INTEGER," + // 4: createdAt
                "\"UPDATED_AT\" INTEGER);"); // 5: updatedAt
    }

    /** Drops the underlying database table. */
    public static void dropTable(Database db, boolean ifExists) {
        String sql = "DROP TABLE " + (ifExists ? "IF EXISTS " : "") + "\"PROCEDIMENTO\"";
        db.execSQL(sql);
    }

    @Override
    protected final void bindValues(DatabaseStatement stmt, Procedimento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        Long tituloProcedimentoId = entity.getTituloProcedimentoId();
        if (tituloProcedimentoId != null) {
            stmt.bindLong(2, tituloProcedimentoId);
        }
 
        Long propriedadeId = entity.getPropriedadeId();
        if (propriedadeId != null) {
            stmt.bindLong(3, propriedadeId);
        }
 
        Integer periodicidade = entity.getPeriodicidade();
        if (periodicidade != null) {
            stmt.bindLong(4, periodicidade);
        }
 
        java.util.Date createdAt = entity.getCreatedAt();
        if (createdAt != null) {
            stmt.bindLong(5, createdAt.getTime());
        }
 
        java.util.Date updatedAt = entity.getUpdatedAt();
        if (updatedAt != null) {
            stmt.bindLong(6, updatedAt.getTime());
        }
    }

    @Override
    protected final void bindValues(SQLiteStatement stmt, Procedimento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        Long tituloProcedimentoId = entity.getTituloProcedimentoId();
        if (tituloProcedimentoId != null) {
            stmt.bindLong(2, tituloProcedimentoId);
        }
 
        Long propriedadeId = entity.getPropriedadeId();
        if (propriedadeId != null) {
            stmt.bindLong(3, propriedadeId);
        }
 
        Integer periodicidade = entity.getPeriodicidade();
        if (periodicidade != null) {
            stmt.bindLong(4, periodicidade);
        }
 
        java.util.Date createdAt = entity.getCreatedAt();
        if (createdAt != null) {
            stmt.bindLong(5, createdAt.getTime());
        }
 
        java.util.Date updatedAt = entity.getUpdatedAt();
        if (updatedAt != null) {
            stmt.bindLong(6, updatedAt.getTime());
        }
    }

    @Override
    protected final void attachEntity(Procedimento entity) {
        super.attachEntity(entity);
        entity.__setDaoSession(daoSession);
    }

    @Override
    public Long readKey(Cursor cursor, int offset) {
        return cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0);
    }    

    @Override
    public Procedimento readEntity(Cursor cursor, int offset) {
        Procedimento entity = new Procedimento( //
            cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0), // id
            cursor.isNull(offset + 1) ? null : cursor.getLong(offset + 1), // tituloProcedimentoId
            cursor.isNull(offset + 2) ? null : cursor.getLong(offset + 2), // propriedadeId
            cursor.isNull(offset + 3) ? null : cursor.getInt(offset + 3), // periodicidade
            cursor.isNull(offset + 4) ? null : new java.util.Date(cursor.getLong(offset + 4)), // createdAt
            cursor.isNull(offset + 5) ? null : new java.util.Date(cursor.getLong(offset + 5)) // updatedAt
        );
        return entity;
    }
     
    @Override
    public void readEntity(Cursor cursor, Procedimento entity, int offset) {
        entity.setId(cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0));
        entity.setTituloProcedimentoId(cursor.isNull(offset + 1) ? null : cursor.getLong(offset + 1));
        entity.setPropriedadeId(cursor.isNull(offset + 2) ? null : cursor.getLong(offset + 2));
        entity.setPeriodicidade(cursor.isNull(offset + 3) ? null : cursor.getInt(offset + 3));
        entity.setCreatedAt(cursor.isNull(offset + 4) ? null : new java.util.Date(cursor.getLong(offset + 4)));
        entity.setUpdatedAt(cursor.isNull(offset + 5) ? null : new java.util.Date(cursor.getLong(offset + 5)));
     }
    
    @Override
    protected final Long updateKeyAfterInsert(Procedimento entity, long rowId) {
        entity.setId(rowId);
        return rowId;
    }
    
    @Override
    public Long getKey(Procedimento entity) {
        if(entity != null) {
            return entity.getId();
        } else {
            return null;
        }
    }

    @Override
    public boolean hasKey(Procedimento entity) {
        return entity.getId() != null;
    }

    @Override
    protected final boolean isEntityUpdateable() {
        return true;
    }
    
    private String selectDeep;

    protected String getSelectDeep() {
        if (selectDeep == null) {
            StringBuilder builder = new StringBuilder("SELECT ");
            SqlUtils.appendColumns(builder, "T", getAllColumns());
            builder.append(',');
            SqlUtils.appendColumns(builder, "T0", daoSession.getTituloProcedimentoDao().getAllColumns());
            builder.append(',');
            SqlUtils.appendColumns(builder, "T1", daoSession.getPropriedadeEquipamentoDao().getAllColumns());
            builder.append(" FROM PROCEDIMENTO T");
            builder.append(" LEFT JOIN TITULO_PROCEDIMENTO T0 ON T.\"TITULO_PROCEDIMENTO_ID\"=T0.\"_id\"");
            builder.append(" LEFT JOIN PROPRIEDADE_EQUIPAMENTO T1 ON T.\"PROPRIEDADE_ID\"=T1.\"_id\"");
            builder.append(' ');
            selectDeep = builder.toString();
        }
        return selectDeep;
    }
    
    protected Procedimento loadCurrentDeep(Cursor cursor, boolean lock) {
        Procedimento entity = loadCurrent(cursor, 0, lock);
        int offset = getAllColumns().length;

        TituloProcedimento titulo = loadCurrentOther(daoSession.getTituloProcedimentoDao(), cursor, offset);
        entity.setTitulo(titulo);
        offset += daoSession.getTituloProcedimentoDao().getAllColumns().length;

        PropriedadeEquipamento propriedadeEquipamento = loadCurrentOther(daoSession.getPropriedadeEquipamentoDao(), cursor, offset);
        entity.setPropriedadeEquipamento(propriedadeEquipamento);

        return entity;    
    }

    public Procedimento loadDeep(Long key) {
        assertSinglePk();
        if (key == null) {
            return null;
        }

        StringBuilder builder = new StringBuilder(getSelectDeep());
        builder.append("WHERE ");
        SqlUtils.appendColumnsEqValue(builder, "T", getPkColumns());
        String sql = builder.toString();
        
        String[] keyArray = new String[] { key.toString() };
        Cursor cursor = db.rawQuery(sql, keyArray);
        
        try {
            boolean available = cursor.moveToFirst();
            if (!available) {
                return null;
            } else if (!cursor.isLast()) {
                throw new IllegalStateException("Expected unique result, but count was " + cursor.getCount());
            }
            return loadCurrentDeep(cursor, true);
        } finally {
            cursor.close();
        }
    }
    
    /** Reads all available rows from the given cursor and returns a list of new ImageTO objects. */
    public List<Procedimento> loadAllDeepFromCursor(Cursor cursor) {
        int count = cursor.getCount();
        List<Procedimento> list = new ArrayList<Procedimento>(count);
        
        if (cursor.moveToFirst()) {
            if (identityScope != null) {
                identityScope.lock();
                identityScope.reserveRoom(count);
            }
            try {
                do {
                    list.add(loadCurrentDeep(cursor, false));
                } while (cursor.moveToNext());
            } finally {
                if (identityScope != null) {
                    identityScope.unlock();
                }
            }
        }
        return list;
    }
    
    protected List<Procedimento> loadDeepAllAndCloseCursor(Cursor cursor) {
        try {
            return loadAllDeepFromCursor(cursor);
        } finally {
            cursor.close();
        }
    }
    

    /** A raw-style query where you can pass any WHERE clause and arguments. */
    public List<Procedimento> queryDeep(String where, String... selectionArg) {
        Cursor cursor = db.rawQuery(getSelectDeep() + where, selectionArg);
        return loadDeepAllAndCloseCursor(cursor);
    }
 
}