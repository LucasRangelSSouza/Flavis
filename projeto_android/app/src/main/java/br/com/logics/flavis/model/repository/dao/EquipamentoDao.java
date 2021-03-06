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

import br.com.logics.flavis.model.entities.equipamento.Marca;
import br.com.logics.flavis.model.entities.equipamento.Modelo;

import br.com.logics.flavis.model.entities.equipamento.Equipamento;

// THIS CODE IS GENERATED BY greenDAO, DO NOT EDIT.
/** 
 * DAO for table "EQUIPAMENTO".
*/
public class EquipamentoDao extends AbstractDao<Equipamento, Long> {

    public static final String TABLENAME = "EQUIPAMENTO";

    /**
     * Properties of entity Equipamento.<br/>
     * Can be used for QueryBuilder and for referencing column names.
     */
    public static class Properties {
        public final static Property Id = new Property(0, Long.class, "id", true, "_id");
        public final static Property ModeloId = new Property(1, Long.class, "modeloId", false, "MODELO_ID");
        public final static Property MarcaId = new Property(2, Long.class, "marcaId", false, "MARCA_ID");
        public final static Property Especificacoes = new Property(3, String.class, "especificacoes", false, "ESPECIFICACOES");
        public final static Property CreatedAt = new Property(4, java.util.Date.class, "createdAt", false, "CREATED_AT");
        public final static Property UpdatedAt = new Property(5, java.util.Date.class, "updatedAt", false, "UPDATED_AT");
    }

    private DaoSession daoSession;


    public EquipamentoDao(DaoConfig config) {
        super(config);
    }
    
    public EquipamentoDao(DaoConfig config, DaoSession daoSession) {
        super(config, daoSession);
        this.daoSession = daoSession;
    }

    /** Creates the underlying database table. */
    public static void createTable(Database db, boolean ifNotExists) {
        String constraint = ifNotExists? "IF NOT EXISTS ": "";
        db.execSQL("CREATE TABLE " + constraint + "\"EQUIPAMENTO\" (" + //
                "\"_id\" INTEGER PRIMARY KEY ," + // 0: id
                "\"MODELO_ID\" INTEGER," + // 1: modeloId
                "\"MARCA_ID\" INTEGER," + // 2: marcaId
                "\"ESPECIFICACOES\" TEXT," + // 3: especificacoes
                "\"CREATED_AT\" INTEGER," + // 4: createdAt
                "\"UPDATED_AT\" INTEGER);"); // 5: updatedAt
    }

    /** Drops the underlying database table. */
    public static void dropTable(Database db, boolean ifExists) {
        String sql = "DROP TABLE " + (ifExists ? "IF EXISTS " : "") + "\"EQUIPAMENTO\"";
        db.execSQL(sql);
    }

    @Override
    protected final void bindValues(DatabaseStatement stmt, Equipamento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        Long modeloId = entity.getModeloId();
        if (modeloId != null) {
            stmt.bindLong(2, modeloId);
        }
 
        Long marcaId = entity.getMarcaId();
        if (marcaId != null) {
            stmt.bindLong(3, marcaId);
        }
 
        String especificacoes = entity.getEspecificacoes();
        if (especificacoes != null) {
            stmt.bindString(4, especificacoes);
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
    protected final void bindValues(SQLiteStatement stmt, Equipamento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        Long modeloId = entity.getModeloId();
        if (modeloId != null) {
            stmt.bindLong(2, modeloId);
        }
 
        Long marcaId = entity.getMarcaId();
        if (marcaId != null) {
            stmt.bindLong(3, marcaId);
        }
 
        String especificacoes = entity.getEspecificacoes();
        if (especificacoes != null) {
            stmt.bindString(4, especificacoes);
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
    protected final void attachEntity(Equipamento entity) {
        super.attachEntity(entity);
        entity.__setDaoSession(daoSession);
    }

    @Override
    public Long readKey(Cursor cursor, int offset) {
        return cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0);
    }    

    @Override
    public Equipamento readEntity(Cursor cursor, int offset) {
        Equipamento entity = new Equipamento( //
            cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0), // id
            cursor.isNull(offset + 1) ? null : cursor.getLong(offset + 1), // modeloId
            cursor.isNull(offset + 2) ? null : cursor.getLong(offset + 2), // marcaId
            cursor.isNull(offset + 3) ? null : cursor.getString(offset + 3), // especificacoes
            cursor.isNull(offset + 4) ? null : new java.util.Date(cursor.getLong(offset + 4)), // createdAt
            cursor.isNull(offset + 5) ? null : new java.util.Date(cursor.getLong(offset + 5)) // updatedAt
        );
        return entity;
    }
     
    @Override
    public void readEntity(Cursor cursor, Equipamento entity, int offset) {
        entity.setId(cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0));
        entity.setModeloId(cursor.isNull(offset + 1) ? null : cursor.getLong(offset + 1));
        entity.setMarcaId(cursor.isNull(offset + 2) ? null : cursor.getLong(offset + 2));
        entity.setEspecificacoes(cursor.isNull(offset + 3) ? null : cursor.getString(offset + 3));
        entity.setCreatedAt(cursor.isNull(offset + 4) ? null : new java.util.Date(cursor.getLong(offset + 4)));
        entity.setUpdatedAt(cursor.isNull(offset + 5) ? null : new java.util.Date(cursor.getLong(offset + 5)));
     }
    
    @Override
    protected final Long updateKeyAfterInsert(Equipamento entity, long rowId) {
        entity.setId(rowId);
        return rowId;
    }
    
    @Override
    public Long getKey(Equipamento entity) {
        if(entity != null) {
            return entity.getId();
        } else {
            return null;
        }
    }

    @Override
    public boolean hasKey(Equipamento entity) {
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
            SqlUtils.appendColumns(builder, "T0", daoSession.getModeloDao().getAllColumns());
            builder.append(',');
            SqlUtils.appendColumns(builder, "T1", daoSession.getMarcaDao().getAllColumns());
            builder.append(" FROM EQUIPAMENTO T");
            builder.append(" LEFT JOIN MODELO T0 ON T.\"MODELO_ID\"=T0.\"_id\"");
            builder.append(" LEFT JOIN MARCA T1 ON T.\"MARCA_ID\"=T1.\"_id\"");
            builder.append(' ');
            selectDeep = builder.toString();
        }
        return selectDeep;
    }
    
    protected Equipamento loadCurrentDeep(Cursor cursor, boolean lock) {
        Equipamento entity = loadCurrent(cursor, 0, lock);
        int offset = getAllColumns().length;

        Modelo modelo = loadCurrentOther(daoSession.getModeloDao(), cursor, offset);
        entity.setModelo(modelo);
        offset += daoSession.getModeloDao().getAllColumns().length;

        Marca marca = loadCurrentOther(daoSession.getMarcaDao(), cursor, offset);
        entity.setMarca(marca);

        return entity;    
    }

    public Equipamento loadDeep(Long key) {
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
    public List<Equipamento> loadAllDeepFromCursor(Cursor cursor) {
        int count = cursor.getCount();
        List<Equipamento> list = new ArrayList<Equipamento>(count);
        
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
    
    protected List<Equipamento> loadDeepAllAndCloseCursor(Cursor cursor) {
        try {
            return loadAllDeepFromCursor(cursor);
        } finally {
            cursor.close();
        }
    }
    

    /** A raw-style query where you can pass any WHERE clause and arguments. */
    public List<Equipamento> queryDeep(String where, String... selectionArg) {
        Cursor cursor = db.rawQuery(getSelectDeep() + where, selectionArg);
        return loadDeepAllAndCloseCursor(cursor);
    }
 
}
