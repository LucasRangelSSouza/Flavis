package br.com.logics.flavis.model.entities.colaborador;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by murilo aires on 21/03/2017.
 */

@Entity
public class User {
    @Id
    private Long id;

    private String username;

    private String email;

    private String gender;

    @Generated(hash = 1901223345)
    public User(Long id, String username, String email, String gender) {
        this.id = id;
        this.username = username;
        this.email = email;
        this.gender = gender;
    }

    @Generated(hash = 586692638)
    public User() {
    }

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getUsername() {
        return this.username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getEmail() {
        return this.email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getGender() {
        return this.gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }
}
