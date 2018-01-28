package com.example.genius.dato;

/**
 * Created by Genius on 14/06/2017.
 */

public class Album {

    private String id,nombre;

    public Album(String id, String nombre) {
        this.id = id;
        this.nombre = nombre;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }
}
