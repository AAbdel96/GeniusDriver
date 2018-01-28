package com.example.genius.dato;

import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicHeader;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.UnsupportedEncodingException;

import cz.msebera.android.httpclient.protocol.HTTP;


public class Entrada extends AppCompatActivity {

    static final String IP = "geniusdriver.ddns.net";
    String nombre_usuario;
    //static final String IP = "192.168.0.109";


    String[] elementos = new String[]{
            "Perfil",
            "Coche",
            "Mapa",
            "Galeria Mapas",
            "Acerca de",
    };

    String[] elemento_descripcion = new String[]{
            "En este apartado encontrará información respecto al usuario.",
            "En este apartado encontrará informacion correspondiente al coche, como la matricula, modelo, combustible,...",
            "En este apartado podrá elegir el mapa para el recorrido del coche.",
            "En ese apartado podrás elegir el mapa para la simulacion",
            "¿Quienes somos?"

    };

    int[] imagenes = new int[]{
            R.drawable.cuenta,
            R.drawable.coche,
            R.drawable.mapa,
            R.drawable.galeria_icono,
            R.drawable.info

    };


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.usuario_inicio);

        final String[] correo = new String[1];
        final ListView lista = (ListView) findViewById(R.id.listview_elementos);

        ListViewAdapter adaptador = new ListViewAdapter(this, imagenes, elementos, elemento_descripcion);
        lista.setAdapter(adaptador);



        final String correo_1 = getIntent().getStringExtra("parametro");

        Extraer_nombre fc  = new Extraer_nombre();

        fc.execute(correo_1);

        //damos la bienvenida al usuario



        lista.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View v, int posicion, long id) {
                switch (posicion) {
                    case 0:

                        //vamos a cojer el mail la pass y el nombre y la vamos a pasar por el intent

                        LoginService login_normal = new LoginService();

                        login_normal.execute(correo_1);

                        break;

                    case 2:
                        Intent intentt = new Intent(Entrada.this, Gestor_camara.class);
                        intentt.putExtra("correo", correo_1);
                        startActivity(intentt);
                        break;

                    case 1:

                        Intent f = new Intent(Entrada.this,Coche.class);
                        f.putExtra("correo", correo_1);
                        startActivity(f);

                        break;
                    case 4:
                        Intent acerca = new Intent(Entrada.this
                        ,acerca_de.class);
                        startActivity(acerca);

                        break;
                    case 3:
                        Intent galeria = new Intent(Entrada.this,Galeria_usuario.class);
                        galeria.putExtra("email", correo_1);
                        startActivity(galeria);
                        break;

                }
            }
        });

    }
    public interface MyInterface {
        public void myMethod(boolean result);
    }

    private class LoginService extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            HttpClient httpClient = new DefaultHttpClient();


            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Devolver_persona.php");
            request.setHeader("content-type", "application/json");


            JSONObject dato = new JSONObject();
            try {


                dato.put("email", params[0]);

                StringEntity entity = new StringEntity(dato.toString());
                entity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));


                request.setEntity(entity);

                HttpResponse response = httpClient.execute(request);

                String respStr = EntityUtils.toString(response.getEntity());

                JSONObject respJSON = new JSONObject(respStr);


                if (respJSON.getBoolean("Exito") == false) {
                    result = false;
                } else {
                    result = true;
                    responseJSON = respJSON;
                }
            } catch (JSONException e) {
                e.printStackTrace();
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            } catch (ClientProtocolException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return result;

        }

        protected void onPostExecute(Boolean result) {
            if (result.equals(true)) {
                try {
                    //aqui cojemos el campo "Dato" que tenemos dentro del json
                    JSONObject datos = responseJSON.getJSONObject("dato");
                    //el txt de welcome lo ponemos en visib

                    //llamamos a la otra actividad que contendra el nenu del usuario

                    Intent intent = new Intent(Entrada.this, Perfil_usuario.class);
                    intent.putExtra("parametro1", datos.getString("email"));
                    intent.putExtra("parametro2", datos.getString("name"));
                    intent.putExtra("parametro3", datos.getString("contrasena"));

                    nombre_usuario = datos.getString("name");
                    startActivity(intent);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }
    private class Extraer_nombre extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            HttpClient httpClient = new DefaultHttpClient();


            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Devolver_persona.php");
            request.setHeader("content-type", "application/json");


            JSONObject dato = new JSONObject();
            try {


                dato.put("email", params[0]);

                StringEntity entity = new StringEntity(dato.toString());
                entity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));


                request.setEntity(entity);

                HttpResponse response = httpClient.execute(request);

                String respStr = EntityUtils.toString(response.getEntity());

                JSONObject respJSON = new JSONObject(respStr);


                if (respJSON.getBoolean("Exito") == false) {
                    result = false;
                } else {
                    result = true;
                    responseJSON = respJSON;
                }
            } catch (JSONException e) {
                e.printStackTrace();
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            } catch (ClientProtocolException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return result;

        }

        protected void onPostExecute(Boolean result) {
            if (result.equals(true)) {
                try {
                    //aqui cojemos el campo "Dato" que tenemos dentro del json
                    JSONObject datos = responseJSON.getJSONObject("dato");

                    final AlertDialog.Builder builder = new AlertDialog.Builder(Entrada.this);
                    builder.setMessage(datos.getString("name"));
                    builder.setTitle("Bienvenido/a").setIcon(R.drawable.checked).setPositiveButton("¡Adelante!", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                    builder.setView(R.drawable.logo);
                        }
                    });

                    Dialog dialog = builder.create();


                    dialog.getWindow().setLayout(50, 50);
                    dialog.show();

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }
        public boolean onCreateOptionsMenu(Menu menu) {
            MenuInflater inflater = getMenuInflater();
            inflater.inflate(R.menu.salir, menu);
            return true;
        }


        public boolean onOptionsItemSelected(MenuItem item) {
            switch (item.getItemId()) {
                case R.id.salir:

                    final AlertDialog.Builder edit_nombre = new AlertDialog.Builder(Entrada.this);
                    edit_nombre.setMessage("¿Seguro que quieres salir?").setTitle("¡Atención!");
                    edit_nombre.setIcon(R.drawable.logout);
                    edit_nombre.setPositiveButton("Aceptar", new DialogInterface.OnClickListener()
                    {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {

                            Intent salir = new Intent(Entrada.this,MainActivity.class);
                            startActivity(salir);
                            finish();
                        }
                    }).setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                        }
                    });
                    Dialog dialogh = edit_nombre.create();
                    dialogh.show();

                    break;
            }
            return true;
        }
    }

