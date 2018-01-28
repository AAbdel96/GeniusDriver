package com.example.genius.dato;

import android.app.Activity;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Paint;
import android.os.AsyncTask;
import android.support.annotation.BoolRes;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.method.PasswordTransformationMethod;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.HttpResponseException;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicHeader;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.UnsupportedEncodingException;

import cz.msebera.android.httpclient.NameValuePair;
import cz.msebera.android.httpclient.client.entity.UrlEncodedFormEntity;
import cz.msebera.android.httpclient.message.BasicNameValuePair;
import cz.msebera.android.httpclient.protocol.HTTP;

import java.util.*;
public class MainActivity extends AppCompatActivity implements View.OnClickListener,AsyncResponse {
    //creamos todas las variables que vamos a necesitar.
    static final String IP = "geniusdriver.ddns.net";
    //static final String IP = "192.168.0.109";
    EditText usr;
    Button btnLogin;
    Button btnCloseSession;
    EditText pwd;
    TextView txtWelcome;
    TextView txtNombUser;
    TextView acceso_registro;
    private LoginService loginService;//aqui creamos el objeto de la clase para poder luego llamarla
    //Integer userId;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        MainActivity.this.setTitle("Inicio de sesión");

        //usr.requestFocus();
        //Aqui enlazamos todos los buttons con sus correspondientes en el xml

        btnLogin = (Button) findViewById(R.id.btnLogin);
        //btnCloseSession = (Button) findViewById(R.id.btnCloseSession);
        usr = (EditText) findViewById(R.id.txtUser);
        pwd = (EditText) findViewById(R.id.txtPassword);

        pwd.setTransformationMethod(new PasswordTransformationMethod());

        txtWelcome = (TextView) findViewById(R.id.txtWelcome);

        acceso_registro = (TextView) findViewById(R.id.enlace_registro);

        //llamamos al escuchador del button iniciar sesion
        btnLogin.setOnClickListener(this);


        acceso_registro.setPaintFlags(acceso_registro.getPaintFlags() | Paint.UNDERLINE_TEXT_FLAG);
        acceso_registro.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent reg = new Intent(MainActivity.this,Registro.class);
                startActivity(reg);
            }
        });
    }
    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnLogin:
                String txtUsr = usr.getText().toString();
                String txtPwd = pwd.getText().toString();
                /*Comprobamos antes de darle al button de iniciar session
                si todos los campos han sido rellenados*/

                if (txtUsr.equals("") || txtPwd.equals("")) {
                    /*En caso de que no haya introducido uno de los dos campos le mostraremos un mensaje*/
                    Toast.makeText(this, "Por favor, introduce todos los campos!",
                            Toast.LENGTH_LONG).show();
                }
                else {
                    //Pero si los ha introducido los dos campos que haremos es ejecutar el metodo.
                    loginService = new LoginService();
                    //le pasamos por parametro los dos campos llenos tanto de usuario como de la contraseña.
                    loginService.execute(txtUsr,txtPwd);
                }
                break;

            default:
                break;
        }
    }
    public interface MyInterface {
        public void myMethod(boolean result);
    }
    //@SuppressWarnings("NewApi")
    private class LoginService extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();
        ProgressDialog pDialog;
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
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Login_android.php");

            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("email", params[0]);
                dato.put("contrasena", params[1]);
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
                    result=true;
                    responseJSON =  respJSON;
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

        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(MainActivity.this);
            pDialog.setMessage("Actualizando Servidor, espere..." );
            pDialog.setProgressStyle(ProgressDialog.STYLE_SPINNER);
            pDialog.show();
        }
        protected void onPostExecute(Boolean result) {
            pDialog.dismiss();
            if(result.equals(true)){
                try {
                    //aqui cojemos el campo "Dato" que tenemos dentro del json
                    JSONObject datos=responseJSON.getJSONObject("dato");
                    //el txt de welcome lo ponemos en visib

                    //llamamos a la otra actividad que contendra el nenu del usuario

                    Intent intent = new Intent(MainActivity.this, Entrada.class);
                    intent.putExtra("parametro", datos.getString("email"));
                    startActivity(intent);
                    finish();

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
            else
            {
                final AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);

                builder.setMessage("¡Usuario y/o contrasena incorrectos!");
                builder.setTitle("¡Información!").setIcon(R.drawable.error).setPositiveButton("¡Adelante!", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        builder.setView(R.drawable.logo);
                    }
                });

                Dialog dialog = builder.create();


                dialog.getWindow().setLayout(50, 50);
                dialog.show();

                pwd.setText("");
                usr.requestFocus();
            }
        }
    }



}
