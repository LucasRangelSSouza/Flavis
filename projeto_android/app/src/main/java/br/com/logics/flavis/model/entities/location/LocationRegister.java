package br.com.logics.flavis.model.entities.location;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;

import java.util.Date;

import org.greenrobot.greendao.annotation.Generated;

@Entity
public class LocationRegister {

    @Id(autoincrement = true)
    private Long id;

    private Double latitude;

    private Double longitude;

    private Date dataHora;

    private boolean isSync;

    private Integer batteryLevel;

    @Generated(hash = 1400412543)
    public LocationRegister(Long id, Double latitude, Double longitude,
                            Date dataHora, boolean isSync, Integer batteryLevel) {
        this.id = id;
        this.latitude = latitude;
        this.longitude = longitude;
        this.dataHora = dataHora;
        this.isSync = isSync;
        this.batteryLevel = batteryLevel;
    }

    @Generated(hash = 1532946523)
    public LocationRegister() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Double getLatitude() {
        return this.latitude;
    }

    public void setLatitude(Double latitude) {
        this.latitude = latitude;
    }

    public Double getLongitude() {
        return this.longitude;
    }

    public void setLongitude(Double longitude) {
        this.longitude = longitude;
    }

    public boolean getIsSync() {
        return this.isSync;
    }

    public void setIsSync(boolean isSync) {
        this.isSync = isSync;
    }

    public Integer getBatteryLevel() {
        return this.batteryLevel;
    }

    public void setBatteryLevel(Integer batteryLevel) {
        this.batteryLevel = batteryLevel;
    }

    public Date getDataHora() {
        return this.dataHora;
    }

    public void setDataHora(Date dataHora) {
        this.dataHora = dataHora;
    }


}
