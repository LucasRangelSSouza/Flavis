package br.com.logics.flavis.model.repository.dao;

import android.database.Cursor;
import android.database.sqlite.SQLiteStatement;

import org.greenrobot.greendao.AbstractDao;
import org.greenrobot.greendao.Property;
import org.greenrobot.greendao.internal.DaoConfig;
import org.greenrobot.greendao.database.Database;
import org.greenrobot.greendao.database.DatabaseStatement;

import br.com.logics.flavis.model.entities.os.procedimento.TituloProcedimento;

// THIS CODE IS GENERATED BY greenDAO, DO NOT EDIT.
/** 
 * DAO for table "TITULO_PROCEDIMENTO".
*/
public class TituloProcedimentoDao extends AbstractDao<TituloProcedimento, Long> {

    public static final String TABLENAME = "TITULO_PROCEDIMENTO";

    /**
     * Properties of entity TituloProcedimento.<br/>
     * Can be used for QueryBuilder and for referencing column names.
     */
    public static class Properties {
        public final static Property Id = new Property(0, Long.class, "id", true, "_id");
        public final static Property Titulo = new Property(1, String.class, "titulo", false, "TITULO");
        public final static Property CreatedAt = new Property(2, java.util.Date.class, "createdAt", false, "CREATED_AT");
        public final static Property UpdatedAt = new Property(3, java.util.Date.class, "updatedAt", false, "UPDATED_AT");
    }


    public TituloProcedimentoDao(DaoConfig config) {
        super(config);
    }
    
    public TituloProcedimentoDao(DaoConfig config, DaoSession daoSession) {
        super(config, daoSession);
    }

    /** Creates the underlying database table. */
    public static void createTable(Database db, boolean ifNotExists) {
        String constraint = ifNotExists? "IF NOT EXISTS ": "";
        db.execSQL("CREATE TABLE " + constraint + "\"TITULO_PROCEDIMENTO\" (" + //
                "\"_id\" INTEGER PRIMARY KEY ," + // 0: id
                "\"TITULO\" TEXT," + // 1: titulo
                "\"CREATED_AT\" INTEGER," + // 2: createdAt
                "\"UPDATED_AT\" INTEGER);"); // 3: updatedAt
    }

    /** Drops the underlying database table. */
    public static void dropTable(Database db, boolean ifExists) {
        String sql = "DROP TABLE " + (ifExists ? "IF EXISTS " : "") + "\"TITULO_PROCEDIMENTO\"";
        db.execSQL(sql);
    }

    @Override
    protected final void bindValues(DatabaseStatement stmt, TituloProcedimento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        String titulo = entity.getTitulo();
        if (titulo != null) {
            stmt.bindString(2, titulo);
        }
 
        java.util.Date createdAt = entity.getCreatedAt();
        if (createdAt != null) {
            stmt.bindLong(3, createdAt.getTime());
        }
 
        java.util.Date updatedAt = entity.getUpdatedAt();
        if (updatedAt != null) {
            stmt.bindLong(4, updatedAt.getTime());
        }
    }

    @Override
    protected final void bindValues(SQLiteStatement stmt, TituloProcedimento entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        String titulo = entity.getTitulo();
        if (titulo != null) {
            stmt.bindString(2, titulo);
        }
 
        java.util.Date createdAt = entity.getCreatedAt();
        if (createdAt != null) {
            stmt.bindLong(3, createdAt.getTime());
        }
 
        java.util.Date updatedAt = entity.getUpdatedAt();
        if (updatedAt != null) {
            stmt.bindLong(4, updatedAt.getTime());
        }
    }

    @Override
    public Long readKey(Cursor cursor, int offset) {
        return cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0);
    }    

    @Override
    public TituloProcedimento readEntity(Cursor cursor, int offset) {
        TituloProcedimento entity = new TituloProcedimento( //
            cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0), // id
            cursor.isNull(offset + 1) ? null : cursor.getString(offset + 1), // titulo
            cursor.isNull(offset + 2) ? null : new java.util.Date(cursor.getLong(offset + 2)), // createdAt
            cursor.isNull(offset + 3) ? null : new java.util.Date(cursor.getLong(offset + 3)) // updatedAt
        );
        return entity;
    }
     
    @Override
    public void readEntity(Cursor cursor, TituloProcedimento entity, int offset) {
        entity.setId(cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0));
        entity.setTitulo(cursor.isNull(offset + 1) ? null : cursor.getString(offset + 1));
        entity.setCreatedAt(cursor.isNull(offset + 2) ? null : new java.util.Date(cursor.getLong(offset + 2)));
        entity.setUpdatedAt(cursor.isNull(offset + 3) ? null : new java.util.Date(cursor.getLong(offset + 3)));
     }
    
    @Override
    protected final Long updateKeyAfterInsert(TituloProcedimento entity, long rowId) {
        entity.setId(rowId);
        return rowId;
    }
    
    @Override
    public Long getKey(TituloProcedimento entity) {
        if(entity != null) {
            return entity.getId();
        } else {
            return null;
        }
    }

    @Override
    public boolean hasKey(TituloProcedimento entity) {
        return entity.getId() != null;
    }

    @Override
    protected final boolean isEntityUpdateable() {
        return true;
    }
    
}
