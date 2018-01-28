package com.example.genius.dato;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class Inicio extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.inicio);

        

        Inicio.this.setTitle("Iniciar sesion o Registrarme");
        Button entrar  =  (Button) findViewById((R.id.button_login));
        Button registrar  =  (Button) findViewById((R.id.button_registro));

        entrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent intent =
                        new Intent(Inicio.this, MainActivity.class);
                startActivity(intent);

            }
        });


        registrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                Intent intent = new Intent(Inicio.this, Registro.class);
                startActivity(intent);



            }
        });

    }
}
