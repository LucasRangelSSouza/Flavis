package br.com.logics.flavis.model.repository.dao;

import android.database.Cursor;
import android.database.sqlite.SQLiteStatement;

import org.greenrobot.greendao.AbstractDao;
import org.greenrobot.greendao.Property;
import org.greenrobot.greendao.internal.DaoConfig;
import org.greenrobot.greendao.database.Database;
import org.greenrobot.greendao.database.DatabaseStatement;

import br.com.logics.flavis.model.entities.cliente.TipoTelefone;

// THIS CODE IS GENERATED BY greenDAO, DO NOT EDIT.
/** 
 * DAO for table "TIPO_TELEFONE".
*/
public class TipoTelefoneDao extends AbstractDao<TipoTelefone, Long> {

    public static final String TABLENAME = "TIPO_TELEFONE";

    /**
     * Properties of entity TipoTelefone.<br/>
     * Can be used for QueryBuilder and for referencing column names.
     */
    public static class Properties {
        public final static Property Id = new Property(0, Long.class, "id", true, "_id");
        public final static Property Nome = new Property(1, String.class, "nome", false, "NOME");
    }


    public TipoTelefoneDao(DaoConfig config) {
        super(config);
    }
    
    public TipoTelefoneDao(DaoConfig config, DaoSession daoSession) {
        super(config, daoSession);
    }

    /** Creates the underlying database table. */
    public static void createTable(Database db, boolean ifNotExists) {
        String constraint = ifNotExists? "IF NOT EXISTS ": "";
        db.execSQL("CREATE TABLE " + constraint + "\"TIPO_TELEFONE\" (" + //
                "\"_id\" INTEGER PRIMARY KEY ," + // 0: id
                "\"NOME\" TEXT);"); // 1: nome
    }

    /** Drops the underlying database table. */
    public static void dropTable(Database db, boolean ifExists) {
        String sql = "DROP TABLE " + (ifExists ? "IF EXISTS " : "") + "\"TIPO_TELEFONE\"";
        db.execSQL(sql);
    }

    @Override
    protected final void bindValues(DatabaseStatement stmt, TipoTelefone entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        String nome = entity.getNome();
        if (nome != null) {
            stmt.bindString(2, nome);
        }
    }

    @Override
    protected final void bindValues(SQLiteStatement stmt, TipoTelefone entity) {
        stmt.clearBindings();
 
        Long id = entity.getId();
        if (id != null) {
            stmt.bindLong(1, id);
        }
 
        String nome = entity.getNome();
        if (nome != null) {
            stmt.bindString(2, nome);
        }
    }

    @Override
    public Long readKey(Cursor cursor, int offset) {
        return cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0);
    }    

    @Override
    public TipoTelefone readEntity(Cursor cursor, int offset) {
        TipoTelefone entity = new TipoTelefone( //
            cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0), // id
            cursor.isNull(offset + 1) ? null : cursor.getString(offset + 1) // nome
        );
        return entity;
    }
     
    @Override
    public void readEntity(Cursor cursor, TipoTelefone entity, int offset) {
        entity.setId(cursor.isNull(offset + 0) ? null : cursor.getLong(offset + 0));
        entity.setNome(cursor.isNull(offset + 1) ? null : cursor.getString(offset + 1));
     }
    
    @Override
    protected final Long updateKeyAfterInsert(TipoTelefone entity, long rowId) {
        entity.setId(rowId);
        return rowId;
    }
    
    @Override
    public Long getKey(TipoTelefone entity) {
        if(entity != null) {
            return entity.getId();
        } else {
            return null;
        }
    }

    @Override
    public boolean hasKey(TipoTelefone entity) {
        return entity.getId() != null;
    }

    @Override
    protected final boolean isEntityUpdateable() {
        return true;
    }
    
}
