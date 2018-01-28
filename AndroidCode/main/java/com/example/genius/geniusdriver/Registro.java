package com.example.genius.geniusdriver;

import android.app.Activity;
import android.os.AsyncTask;
import android.support.annotation.BoolRes;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
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
public class Registro extends Activity implements View.OnClickListener,AsyncResponse {

    EditText usr;
    Button btnRegistro;
    Button btnCloseSession;
    EditText pwd;
    private LoginService loginService;
    EditText email;
    TextView comprobante;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registro);

        btnRegistro = (Button) findViewById(R.id.btnRegistro);
        usr = (EditText) findViewById(R.id.txtnombre);
        email= (EditText) findViewById(R.id.txtemail);
        pwd = (EditText) findViewById(R.id.txtcontrasena);
        comprobante = (TextView) findViewById(R.id.Comprobante);

        btnRegistro.setOnClickListener(this);
    }
    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnRegistro:
                String txtUsr = usr.getText().toString();
                String txtemail = email.getText().toString();
                String txtPwd = pwd.getText().toString();

                if (txtUsr.equals("") || txtPwd.equals("") || txtemail.equals("")) {

                    Toast.makeText(this, "Por favor, introduce todos los campos!",
                            Toast.LENGTH_LONG).show();
                }
                else {

                    loginService = new LoginService();

                    loginService.execute(txtUsr,txtPwd,txtemail);
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

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;
            HttpClient httpClient = new DefaultHttpClient();
            HttpPost request = new HttpPost("http://192.168.0.105/SampleWS/Registro_android.php");
            request.setHeader("content-type", "application/json");

            JSONObject dato = new JSONObject();
            try {

                dato.put("email", params[2]);
                dato.put("nombre",params[0]);
                dato.put("contrasena", params[1]);

                //dato.put("token", "11f4aebd66702cd867dc87d6f6071609f49a18603469b09a6fcc7d5843b5d5701");

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
        protected void onPostExecute(Boolean result) {
            if(result.equals(true)){
                try {
                 JSONObject datos=responseJSON.getJSONObject("dato");

                    comprobante.setText("Registrado Correctamente! ");

                    comprobante.setAlpha(1.0f);
                    usr.setText("");
                    usr.setAlpha(0.0f);
                    pwd.setText("");
                    pwd.setAlpha(0.0f);
                    email.setText("");
                    email.setAlpha(0.0f);

                    btnRegistro.setEnabled(false);
                } catch (JSONException e) {
                    e.printStackTrace();

                }
            }
            else
            {
                Toast.makeText(Registro.this, "Correo en uso!",
                        Toast.LENGTH_LONG).show();
                usr.setText("");
                pwd.setText("");
                email.setText("");
                usr.requestFocus();
            }
        }
    }
}

