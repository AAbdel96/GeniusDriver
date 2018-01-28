package com.example.genius.dato;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Build;
import android.support.annotation.RequiresApi;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
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
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

import cz.msebera.android.httpclient.protocol.HTTP;

public class Perfil_usuario extends AppCompatActivity implements AsyncResponse {


    //@RequiresApi(api = Build.VERSION_CODES.M)

    //variables
    static final String IP = "geniusdriver.ddns.net";
    //static final String IP = "192.168.0.109";
    TextView nombre;
    TextView correo;
    TextView contrasena;

    EditText nombre_edit;
    EditText correo_edit;
    EditText contrasena_vieja;
    EditText contrasena_nueva;

    Button button_nombre;
    Button button_correo;
    Button button_contrsena;
    //Button guardar_cambios = (Button) findViewById(R.id.guardar_cambios);

    boolean[] nombre_b = {false};
    boolean[] correo_b = {false};
    boolean[] contrasena_b = {false};


    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.perfil);

        //para poder cambiar el nombre a la actividad
        Perfil_usuario.this.setTitle("Perfil");



        //textview
        nombre = (TextView) findViewById(R.id.nombre);
        correo = (TextView) findViewById(R.id.correo);
        contrasena =  (TextView) findViewById(R.id.contrasena);

        //edittext

        nombre_edit = (EditText) findViewById(R.id.editext_nombre);
        correo_edit =  (EditText) findViewById(R.id.editext_correo);


        contrasena_vieja = (EditText) findViewById(R.id.contrasena_vieja);
        contrasena_nueva = (EditText) findViewById(R.id.contrasena_nueva);

        correo.setText(getIntent().getStringExtra("parametro1"));
        nombre.setText(getIntent().getStringExtra("parametro2"));
        String contrasenna = getIntent().getStringExtra("parametro3");

        //botones
        button_nombre = (Button) findViewById(R.id.cambiar_nombre);
        button_correo = (Button) findViewById(R.id.cambiar_email);
        button_contrsena = (Button) findViewById(R.id.cambiar_contrasena);
        int len = contrasenna.length();
        StringBuilder sb = new StringBuilder(len);

        for (int i = 0; i < len; i++) {
            sb.append('*');
        }

        contrasena.setText(sb.toString());

        button_nombre.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //si vemos que hemos dado al boton vamos a deshabiliar los otros
                button_contrsena.setEnabled(false);
                button_correo.setEnabled(false);

                nombre_b[0] = true;
                if (nombre_edit.getAlpha() == 0f) {
                    nombre_edit.setAlpha(1f);
                    nombre_edit.setSelection(0);
                    button_nombre.setEnabled(false);
                    nombre_edit.setHint("Nuevo nombre...");

                }
            }
        });

        button_correo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                button_contrsena.setEnabled(false);
                button_nombre.setEnabled(false);

                correo_b[0] = true;
                if (correo_edit.getAlpha() == 0f) {
                    correo_edit.setAlpha(1f);
                    correo_edit.setSelection(0);
                    button_correo.setEnabled(false);
                    correo_edit.setHint("Nuevo correo...");
                    button_correo.setEnabled(false);
                }
            }
        });

        button_contrsena.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                button_correo.setEnabled(false);
                button_nombre.setEnabled(false);
                contrasena_b[0] = true;
                if (contrasena_vieja.getAlpha() == 0f && contrasena_nueva.getAlpha() == 0f) {
                    contrasena_vieja.setAlpha(1f);
                    contrasena_nueva.setAlpha(1f);
                    contrasena_vieja.setFocusable(true);
                    contrasena_vieja.setSelection(0);
                    contrasena_nueva.setSelection(0);
                    button_contrsena.setEnabled(false);
                    contrasena_vieja.setHint("Contrasena antigua...");
                    contrasena_nueva.setHint("Nueva contraseña...");
                }
            }
        });


    }
    public static final String md5(final String s) {
        final String MD5 = "MD5";
        try {
            // Create MD5 Hash
            MessageDigest digest = java.security.MessageDigest
                    .getInstance(MD5);
            digest.update(s.getBytes());
            byte messageDigest[] = digest.digest();

            // Create Hex String
            StringBuilder hexString = new StringBuilder();
            for (byte aMessageDigest : messageDigest) {
                String h = Integer.toHexString(0xFF & aMessageDigest);
                while (h.length() < 2)
                    h = "0" + h;
                hexString.append(h);
            }
            return hexString.toString();

        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        return "";
    }



    private class LoginService extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            /*La clase HttpClient, permite crear un objeto capaz de manejar peticiones
            HTTP desde el lado del cliente, esta clase es la que se encargara de realizar la petición y obtener la respuesta de la misma*/

            HttpClient httpClient = new DefaultHttpClient();

            /*HttpPost, la cual permite armar la petición Http de tipo POST con los parámetros necesarios,
            este objeto actúa como un contenedor de los datos que necesitamos enviar a un servidor, en este caso nosotros enviarmos enviaremos el usuario y la pass a parte de la url
            que la tenemos que poner a la hora de instanciar el objeto HTTPOST
             */
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Cambiar_name.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("name", params[0]);
                dato.put("email", params[1]);

                //dato.put("token", "11f4aebd66702cd867dc87d6f6071609f49a18603469b09a6fcc7d5843b5d5701");

                StringEntity entity = new StringEntity(dato.toString());
                entity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));
                //enviamos el json con los datos

                request.setEntity(entity);
                /*La clase HttpResponse, la cual nos permite recibir la respuesta del servidor y hacer uso de la misma dentro de la aplicación,
                 para ello debemos ejecutar el método execute de la clase esta clase HttpClient para ejecutar la petición HTTP y esperar la respuesta del servidor
                  */
                HttpResponse response = httpClient.execute(request);
                //Realizamos la petición y capturamos la respuesta en el objeto response
                String respStr = EntityUtils.toString(response.getEntity());
                //lo volvemos a parsear a JSON porque lo teniamos en string igual que antes
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


                    Toast.makeText(Perfil_usuario.this, "Nombre cambiado Correctamente!", Toast.LENGTH_LONG).show();

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } else {
                Toast.makeText(Perfil_usuario.this, "Nombre en uso!", Toast.LENGTH_LONG).show();

            }
        }
    }
    private class LoginService_correo extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            /*La clase HttpClient, permite crear un objeto capaz de manejar peticiones
            HTTP desde el lado del cliente, esta clase es la que se encargara de realizar la petición y obtener la respuesta de la misma*/

            HttpClient httpClient = new DefaultHttpClient();

            /*HttpPost, la cual permite armar la petición Http de tipo POST con los parámetros necesarios,
            este objeto actúa como un contenedor de los datos que necesitamos enviar a un servidor, en este caso nosotros enviarmos enviaremos el usuario y la pass a parte de la url
            que la tenemos que poner a la hora de instanciar el objeto HTTPOST
             */
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Cambiar_email.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("email", params[1]);
                dato.put("email_nuevo", params[0]);

                //dato.put("token", "11f4aebd66702cd867dc87d6f6071609f49a18603469b09a6fcc7d5843b5d5701");

                StringEntity entity = new StringEntity(dato.toString());
                entity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));
                //enviamos el json con los datos

                request.setEntity(entity);
                /*La clase HttpResponse, la cual nos permite recibir la respuesta del servidor y hacer uso de la misma dentro de la aplicación,
                 para ello debemos ejecutar el método execute de la clase esta clase HttpClient para ejecutar la petición HTTP y esperar la respuesta del servidor
                  */
                HttpResponse response = httpClient.execute(request);
                //Realizamos la petición y capturamos la respuesta en el objeto response
                String respStr = EntityUtils.toString(response.getEntity());
                //lo volvemos a parsear a JSON porque lo teniamos en string igual que antes
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


                    Toast.makeText(Perfil_usuario.this, "Entra con tu nuevo email!", Toast.LENGTH_LONG).show();

                    Intent previewMessagee = new Intent(Perfil_usuario.this, MainActivity.class);
                    startActivity(previewMessagee);
                    finish();


                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } else {
                Toast.makeText(Perfil_usuario.this, "Email en uso!", Toast.LENGTH_LONG).show();

            }
        }
    }
    private class LoginService_contrasena extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            /*La clase HttpClient, permite crear un objeto capaz de manejar peticiones
            HTTP desde el lado del cliente, esta clase es la que se encargara de realizar la petición y obtener la respuesta de la misma*/

            HttpClient httpClient = new DefaultHttpClient();

            /*HttpPost, la cual permite armar la petición Http de tipo POST con los parámetros necesarios,
            este objeto actúa como un contenedor de los datos que necesitamos enviar a un servidor, en este caso nosotros enviarmos enviaremos el usuario y la pass a parte de la url
            que la tenemos que poner a la hora de instanciar el objeto HTTPOST
             */
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Cambiar_pass.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".

                dato.put("contrasena_vieja", params[0]);
                dato.put("email", params[1]);
                dato.put("confirma_nueva",params[2]);


                StringEntity entity = new StringEntity(dato.toString());
                entity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));
                //enviamos el json con los datos

                request.setEntity(entity);
                /*La clase HttpResponse, la cual nos permite recibir la respuesta del servidor y hacer uso de la misma dentro de la aplicación,
                 para ello debemos ejecutar el método execute de la clase esta clase HttpClient para ejecutar la petición HTTP y esperar la respuesta del servidor
                  */
                HttpResponse response = httpClient.execute(request);
                //Realizamos la petición y capturamos la respuesta en el objeto response
                String respStr = EntityUtils.toString(response.getEntity());
                //lo volvemos a parsear a JSON porque lo teniamos en string igual que antes
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

                    String mensaje = datos.getString("resultado");

                    if(mensaje.equals("s")){
                        Toast.makeText(Perfil_usuario.this, "Entra con tu nueva contraseña", Toast.LENGTH_LONG).show();

                        Intent previewMessagee = new Intent(Perfil_usuario.this, MainActivity.class);
                        startActivity(previewMessagee);
                        finish();
                    }
                    else {
                        Toast.makeText(Perfil_usuario.this, "Ha ocurrido un error en el cambio!", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } else {
                Toast.makeText(Perfil_usuario.this, "Contrasenña antigua incorrecta!", Toast.LENGTH_LONG).show();
                contrasena_vieja.getText().clear();
                contrasena_nueva.getText().clear();
                contrasena_vieja.requestFocus();
                contrasena_vieja.setHint("Contrasena antigua...");
                contrasena_nueva.setHint("Nueva contraseña...");



                /*LoginService_recarga loginServicee = new LoginService_recarga();
                loginServicee.execute(getIntent().getStringExtra("parametro1"));
                */
            }
        }
    }

    private class LoginService_recarga extends AsyncTask<String, String, Boolean> {
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

                    Intent intent = new Intent(Perfil_usuario.this, Perfil_usuario.class);
                    intent.putExtra("parametro1", datos.getString("email"));
                    intent.putExtra("parametro2", datos.getString("name"));
                    intent.putExtra("parametro3", datos.getString("contrasena"));
                    startActivity(intent);
                    finish();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.main, menu);
        return true;
    }


    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.guardar:

                if (nombre_b[0] == true && (!(nombre_edit.getText().toString().equals("")))) {
                    LoginService loginService = new LoginService();
                    loginService.execute(nombre_edit.getText().toString(), getIntent().getStringExtra("parametro1"));

                    LoginService_recarga loginServicee = new LoginService_recarga();
                    loginServicee.execute(getIntent().getStringExtra("parametro1"));

                    nombre_b[0] = false;
                } else if (correo_b[0] == true && (!(correo_edit.getText().toString().equals("")))) {

                    LoginService_correo loginService_correo = new LoginService_correo();
                    loginService_correo.execute(correo_edit.getText().toString(), getIntent().getStringExtra("parametro1"));
                    correo_b[0] = false;
                } else if (contrasena_b[0] == true && (!(contrasena_vieja.getText().toString().equals(""))) && (!(contrasena_nueva.getText().toString().equals("")))) {

                    LoginService_contrasena loginService_contrasena = new LoginService_contrasena();

                    String contrasena_vieja_md5  = md5(contrasena_vieja.getText().toString());
                    String contrasena_nueva_md5 = md5(contrasena_nueva.getText().toString());

                    loginService_contrasena.execute(contrasena_vieja_md5, getIntent().getStringExtra("parametro1"),contrasena_nueva_md5);

                }
                else{
                    Toast.makeText(Perfil_usuario.this, "El campo no puede estar vacio!", Toast.LENGTH_LONG).show();

                }
                break;
        }
        return true;
    }


}