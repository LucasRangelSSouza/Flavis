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

import br.com.logics.flavis.model.entities.equipamento.TituloPropriedade;

import br.com.logics.flavis.model.entities.equipamento.PropriedadeEquipamento;

// THIS CODE IS GENERATED BY greenDAO, DO NOT EDIT.
/** 
 * DAO for table "PROPRIEDADE_EQUIPAMENTO".
*/
public class PropriedadeEquipamentoDao extends AbstractDao<PropriedadeEquipamento, Long> {

    public static final String TABLENAME = "PROPRIEDADE_EQUIPAMENTO";

    /**
     * Properties of entity PropriedadeEquipamento.<br/>
     * Can be used for QueryBuilder and for referencing column names.
     */
    public static class Properties {
        public final static Property Id = new Property(0, Long.class, "id", true, "_id");
        public final static Property TituloId = new Property(1, Long.class, "tituloId", false, "TITULO_ID");
    }

    private DaoSession daoSession;


    public PropriedadeEquipamentoDao(DaoConfig config) {
        super(config);
    }
    
    public PropriedadeEquipamentoDao(DaoConfig config, DaoSession daoSession) {
        super(config, daoSession);
        this.daoSession = daoSession;
    }

    /** Creates the underlying database table. */
    public static void createTable(Database db, boolean ifNotExists) {
        String constraint = ifNotExists? "IF NOT EXISTS ": "";
        db.execSQL("CREATE TABLE " + constraint + "\"PROPRIEDADE_EQUIPAMENTO\" (" + //
                "\"_id\" INTEGER PRIMARY KEY ," + // 0: id
                "\"TITULO_ID\" INTEGER);"); // 1: tituloId
    }

    /** Drops the underlying database table. */
    public static void dropTable(Database db, boolean ifExists) {
        String sql = "DROP TABLE " + (ifExists ? "IF EXISTS " : "") + "\"PROPRIEDADE_EQUIPAMENTO\"";
        db.execSQL(sql);
    }

    @Override
    protected final void bindValues(DatabaseStatement stmt, PropriedadeEquipamento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        Long tituloId = entity.getTituloId();
        if (tituloId != null) {
            stmt.bindLong(2, tituloId);
        }
    }

    @Override
    protected final void bindValues(SQLiteStatement stmt, PropriedadeEquipamento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        Long tituloId = entity.getTituloId();
        if (tituloId != null) {
            stmt.bindLong(2, tituloId);
        }
    }

    @Override
    protected final void attachEntity(PropriedadeEquipamento entity) {
        super.attachEntity(entity);
        entity.__setDaoSession(daoSession);
    }

    @Override
    public Long readKey(Cursor cursor, int offset) {
        return cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0);
    }    

    @Override
    public PropriedadeEquipamento readEntity(Cursor cursor, int offset) {
        PropriedadeEquipamento entity = new PropriedadeEquipamento( //
            cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0), // id
            cursor.isNull(offset + 1) ? null : cursor.getLong(offset + 1) // tituloId
        );
        return entity;
    }
     
    @Override
    public void readEntity(Cursor cursor, PropriedadeEquipamento entity, int offset) {
        entity.setId(cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0));
        entity.setTituloId(cursor.isNull(offset + 1) ? null : cursor.getLong(offset + 1));
     }
    
    @Override
    protected final Long updateKeyAfterInsert(PropriedadeEquipamento entity, long rowId) {
        entity.setId(rowId);
        return rowId;
    }
    
    @Override
    public Long getKey(PropriedadeEquipamento entity) {
        if(entity != null) {
            return entity.getId();
        } else {
            return null;
        }
    }

    @Override
    public boolean hasKey(PropriedadeEquipamento entity) {
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
            SqlUtils.appendColumns(builder, "T0", daoSession.getTituloPropriedadeDao().getAllColumns());
            builder.append(" FROM PROPRIEDADE_EQUIPAMENTO T");
            builder.append(" LEFT JOIN TITULO_PROPRIEDADE T0 ON T.\"TITULO_ID\"=T0.\"_id\"");
            builder.append(' ');
            selectDeep = builder.toString();
        }
        return selectDeep;
    }
    
    protected PropriedadeEquipamento loadCurrentDeep(Cursor cursor, boolean lock) {
        PropriedadeEquipamento entity = loadCurrent(cursor, 0, lock);
        int offset = getAllColumns().length;

        TituloPropriedade titulo = loadCurrentOther(daoSession.getTituloPropriedadeDao(), cursor, offset);
        entity.setTitulo(titulo);

        return entity;    
    }

    public PropriedadeEquipamento loadDeep(Long key) {
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
    public List<PropriedadeEquipamento> loadAllDeepFromCursor(Cursor cursor) {
        int count = cursor.getCount();
        List<PropriedadeEquipamento> list = new ArrayList<PropriedadeEquipamento>(count);
        
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
    
    protected List<PropriedadeEquipamento> loadDeepAllAndCloseCursor(Cursor cursor) {
        try {
            return loadAllDeepFromCursor(cursor);
        } finally {
            cursor.close();
        }
    }
    

    /** A raw-style query where you can pass any WHERE clause and arguments. */
    public List<PropriedadeEquipamento> queryDeep(String where, String... selectionArg) {
        Cursor cursor = db.rawQuery(getSelectDeep() + where, selectionArg);
        return loadDeepAllAndCloseCursor(cursor);
    }
 
}