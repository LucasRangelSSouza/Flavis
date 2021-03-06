package br.com.logics.flavis.model.repository.dao;

import android.database.Cursor;
import android.database.sqlite.SQLiteStatement;

import org.greenrobot.greendao.AbstractDao;
import org.greenrobot.greendao.Property;
import org.greenrobot.greendao.internal.DaoConfig;
import org.greenrobot.greendao.database.Database;
import org.greenrobot.greendao.database.DatabaseStatement;

import br.com.logics.flavis.model.entities.equipamento.TituloPropriedade;

// THIS CODE IS GENERATED BY greenDAO, DO NOT EDIT.
/** 
 * DAO for table "TITULO_PROPRIEDADE".
*/
public class TituloPropriedadeDao extends AbstractDao<TituloPropriedade, Long> {

    public static final String TABLENAME = "TITULO_PROPRIEDADE";

    /**
     * Properties of entity TituloPropriedade.<br/>
     * Can be used for QueryBuilder and for referencing column names.
     */
    public static class Properties {
        public final static Property Id = new Property(0, Long.class, "id", true, "_id");
        public final static Property Titulo = new Property(1, String.class, "titulo", false, "TITULO");
    }


    public TituloPropriedadeDao(DaoConfig config) {
        super(config);
    }
    
    public TituloPropriedadeDao(DaoConfig config, DaoSession daoSession) {
        super(config, daoSession);
    }

    /** Creates the underlying database table. */
    public static void createTable(Database db, boolean ifNotExists) {
        String constraint = ifNotExists? "IF NOT EXISTS ": "";
        db.execSQL("CREATE TABLE " + constraint + "\"TITULO_PROPRIEDADE\" (" + //
                "\"_id\" INTEGER PRIMARY KEY ," + // 0: id
                "\"TITULO\" TEXT);"); // 1: titulo
    }

    /** Drops the underlying database table. */
    public static void dropTable(Database db, boolean ifExists) {
        String sql = "DROP TABLE " + (ifExists ? "IF EXISTS " : "") + "\"TITULO_PROPRIEDADE\"";
        db.execSQL(sql);
    }

    @Override
    protected final void bindValues(DatabaseStatement stmt, TituloPropriedade entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        String titulo = entity.getTitulo();
        if (titulo != null) {
            stmt.bindString(2, titulo);
        }
    }

    @Override
    protected final void bindValues(SQLiteStatement stmt, TituloPropriedade entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        String titulo = entity.getTitulo();
        if (titulo != null) {
            stmt.bindString(2, titulo);
        }
    }

    @Override
    public Long readKey(Cursor cursor, int offset) {
        return cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0);
    }    

    @Override
    public TituloPropriedade readEntity(Cursor cursor, int offset) {
        TituloPropriedade entity = new TituloPropriedade( //
            cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0), // id
            cursor.isNull(offset + 1) ? null : cursor.getString(offset + 1) // titulo
        );
        return entity;
    }
     
    @Override
    public void readEntity(Cursor cursor, TituloPropriedade entity, int offset) {
        entity.setId(cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0));
        entity.setTitulo(cursor.isNull(offset + 1) ? null : cursor.getString(offset + 1));
     }
    
    @Override
    protected final Long updateKeyAfterInsert(TituloPropriedade entity, long rowId) {
        entity.setId(rowId);
        return rowId;
    }
    
    @Override
    public Long getKey(TituloPropriedade entity) {
        if(entity != null) {
            return entity.getId();
        } else {
            return null;
        }
    }

    @Override
    public boolean hasKey(TituloPropriedade entity) {
        return entity.getId() != null;
    }

    @Override
    protected final boolean isEntityUpdateable() {
        return true;
    }
    
}
