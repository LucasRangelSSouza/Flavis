package br.com.logics.flavis.model.entities.cliente;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 22/03/2017.
 */
@Entity
public class JoinClienteWithResponsavel {
    @Id
    private Long id;
    private Long clienteId;
    private Long responsavelId;
    @Generated(hash = 741068168)
    public JoinClienteWithResponsavel(Long id, Long clienteId, Long responsavelId) {
        this.id = id;
        this.clienteId = clienteId;
        this.responsavelId = responsavelId;
    }
    @Generated(hash = 1293907925)
    public JoinClienteWithResponsavel() {
    }
    public Long getId() {
        return this.id;
    }
    public void setId(Long id) {
        this.id = id;
    }
    public Long getClienteId() {
        return this.clienteId;
    }
    public void setClienteId(Long clienteId) {
        this.clienteId = clienteId;
    }
    public Long getResponsavelId() {
        return this.responsavelId;
    }
    public void setResponsavelId(Long responsavelId) {
        this.responsavelId = responsavelId;
    }
}
