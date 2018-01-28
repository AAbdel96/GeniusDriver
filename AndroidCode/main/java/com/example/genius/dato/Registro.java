package com.example.genius.dato;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.annotation.BoolRes;
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
public class Registro extends AppCompatActivity implements View.OnClickListener,AsyncResponse {

    static final String IP = "geniusdriver.ddns.net";
    //static final String IP = "192.168.0.109";
    EditText usr;
    Button btnRegistro;
    Button btnCloseSession;
    EditText pwd;
    private LoginService loginService;
    EditText email;
    EditText confirm_pass, confirm_email;
    TextView comprobante;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registro);

        Registro.this.setTitle("Registro");

        btnRegistro = (Button) findViewById(R.id.btnRegistro);
        usr = (EditText) findViewById(R.id.txtnombre);
        email= (EditText) findViewById(R.id.txtemail);
        confirm_pass = (EditText) findViewById(R.id.txtcontrasena_confirmar);
        confirm_email = (EditText) findViewById(R.id.txtemail_confirmar);
        pwd = (EditText) findViewById(R.id.txtcontrasena);
        comprobante = (TextView) findViewById(R.id.Comprobante);
        btnRegistro.setOnClickListener(this);



        //los ponemos de tipo contraseña

        pwd.setTransformationMethod(new PasswordTransformationMethod());

        confirm_pass.setTransformationMethod(new PasswordTransformationMethod());
    }
    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnRegistro:
                String txtUsr = usr.getText().toString();
                String txtemail = email.getText().toString();
                String txtPwd = pwd.getText().toString();


                if (txtUsr.equals("") || txtPwd.equals("") || txtemail.equals("") || confirm_pass.equals("") ||confirm_email.equals("")) {

                    Toast.makeText(this, "Por favor, introduce todos los campos!",
                            Toast.LENGTH_LONG).show();
                }
                else {

                    if(!(txtPwd.equals(confirm_pass.getText().toString()))) {

                        Toast.makeText(this, "Por favor, introduce las contrasenas iguales!",
                                Toast.LENGTH_LONG).show();
                    }
                    if(!(txtemail.equals(confirm_email.getText().toString()))){

                        Toast.makeText(this, "Por favor, introduce los emails iguales!",
                                Toast.LENGTH_LONG).show();
                    }
                    else{
                        if(!(txtemail.contains("@"))){
                            Toast.makeText(this, "Email introducido no valido!",
                                    Toast.LENGTH_LONG).show();
                        }
                        else{

                            if(txtPwd.length() < 8){
                                Toast.makeText(this, "Contraseña minimo 8 caracteres.",
                                        Toast.LENGTH_LONG).show();
                                pwd.setText("");
                                confirm_pass.setText("");
                            }
                            else{
                                loginService = new LoginService();
                                loginService.execute(txtUsr, txtPwd, txtemail);
                            }
                        }
                    }
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
        ProgressDialog pDialog;
        JSONObject responseJSON = new JSONObject();
        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;
            HttpClient httpClient = new DefaultHttpClient();
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Registro_android.php");
            request.setHeader("content-type", "application/json");
            JSONObject dato = new JSONObject();
            try {

                dato.put("email", params[2]);
                dato.put("nombre",params[0]);
                dato.put("contrasena", params[1]);

                StringEntity entity = new StringEntity(dato.toString());
                entity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/json"));

                request.setEntity(entity);

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
            pDialog = new ProgressDialog(Registro.this);
            pDialog.setMessage("Actualizando Servidor, espere..." );
            pDialog.setProgressStyle(ProgressDialog.STYLE_SPINNER);
            pDialog.show();
        }

        protected void onPostExecute(Boolean result) {
            pDialog.dismiss();
            if(result.equals(true)){
                try {
                 JSONObject datos=responseJSON.getJSONObject("dato");
                    comprobante.setText("Registrado Correctamente! ");

                    Toast.makeText(Registro.this, "Introduce tus datos registro!",
                            Toast.LENGTH_LONG).show();
                    Intent intent =
                            new Intent(Registro.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
            else
            {
                Toast.makeText(Registro.this, "Correo en uso!",
                        Toast.LENGTH_LONG).show();

                pwd.setText("");
                confirm_pass.setText("");
                confirm_email.setText("");



            }
        }
    }
}

