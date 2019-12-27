package br.com.logics.flavis.model.entities.idle_activity;

import com.google.gson.annotations.SerializedName;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;

import java.util.Date;

import org.greenrobot.greendao.annotation.Generated;

@Entity
public class IdleActivity {

    @Id(autoincrement = true)
    private Long id;

    @SerializedName("tempoGasto")
    private Integer timeInMinutes;

    @SerializedName("observacao")
    private String obs;

    private Boolean isSync;

    private Date dataHoraAtividade;

    @Generated(hash = 758735398)
    public IdleActivity(Long id, Integer timeInMinutes, String obs, Boolean isSync,
            Date dataHoraAtividade) {
        this.id = id;
        this.timeInMinutes = timeInMinutes;
        this.obs = obs;
        this.isSync = isSync;
        this.dataHoraAtividade = dataHoraAtividade;
    }

    @Generated(hash = 191624165)
    public IdleActivity() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Integer getTimeInMinutes() {
        return this.timeInMinutes;
    }

    public void setTimeInMinutes(Integer timeInMinutes) {
        this.timeInMinutes = timeInMinutes;
    }

    public String getObs() {
        return this.obs;
    }

    public void setObs(String obs) {
        this.obs = obs;
    }


    public Boolean getIsSync() {
        return this.isSync;
    }

    public void setIsSync(Boolean isSync) {
        this.isSync = isSync;
    }

    public Date getDataHoraAtividade() {
        return this.dataHoraAtividade;
    }

    public void setDataHoraAtividade(Date dataHoraAtividade) {
        this.dataHoraAtividade = dataHoraAtividade;
    }

}
