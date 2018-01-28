package com.example.genius.dato;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.AttributeSet;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.SpinnerAdapter;
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
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Handler;
import java.util.logging.LogRecord;

import cz.msebera.android.httpclient.client.methods.CloseableHttpResponse;
import cz.msebera.android.httpclient.protocol.HTTP;

import static android.R.attr.mode;
import static android.R.attr.text;
import static android.R.attr.value;

public class Coche extends AppCompatActivity {

    static final String IP = "geniusdriver.ddns.net";
    //static final String IP = "192.168.0.109";
    Spinner modelos;
    TextView bateria;
    TextView precio;
    TextView matricula;
    TextView velocidad;
    TextView marca;
    String correo;
    String respuesta;

    boolean tiene = false;
    boolean cambiado_matricula = false;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.coche);

        //titulo de la actividad
        Coche.this.setTitle("Coche");

        //recibimos el correo de la otra actividad

        Intent intent = getIntent();
        correo = intent.getStringExtra("correo");

        //vinculamos las variables
        modelos = (Spinner) findViewById(R.id.modelo_lista);
        bateria = (TextView) findViewById(R.id.capacidad_bateria);
        precio = (TextView) findViewById(R.id.precio);
        velocidad = (TextView) findViewById(R.id.velocidad);
        matricula = (TextView) findViewById(R.id.matricula);
        marca = (TextView) findViewById(R.id.marca);


        //rellenamos el spinner
        Lista_modelo f = new Lista_modelo();
        f.execute();

        //ahora vamos a comprobar si el usuario ya tiene un coche en su base de datos, en caso de que no lo tenga le dejaremos sleccionarlo pero en otro caso vamos a dejarle seleccionado el que tiene

        Comprobar_matricula com = new Comprobar_matricula();
        com.execute(correo.toString());

        //en caso de que el usuario haya seleccionado un modelo
        modelos.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

                cambiado_matricula = true;
                String Text = modelos.getSelectedItem().toString();


                Rellenar_datos r = new Rellenar_datos();

                r.execute(Text.toString());




            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });


    }

    private void selectSpinnerValue(Spinner spinner, String myString) {
        int index = 0;
        for (int i = 0; i < spinner.getCount(); i++) {
            if (spinner.getItemAtPosition(i).toString().equals(myString)) {
                spinner.setSelection(i);
                break;
            }
        }
    }

    private class Lista_modelo extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            HttpClient httpClient = new DefaultHttpClient();


            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Coche_modelo.php");
            request.setHeader("content-type", "application/json");


            JSONObject dato = new JSONObject();
            try {

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
                    //JSONObject datos = responseJSON.getJSONObject("dato");

                    JSONArray jsonarray = responseJSON.getJSONArray("dato");


                    List<String> list = new ArrayList<String>();

                    llenar_spinner(list, jsonarray);

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }


    private class Comprobar_matricula extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            HttpClient httpClient = new DefaultHttpClient();


            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/comprobar_matricula.php");
            request.setHeader("content-type", "application/json");


            JSONObject dato = new JSONObject();
            try {

                dato.put("correo", params[0]);
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
                    respuesta = respJSON.getString("message");
                    if (respuesta.equals("No tiene matricula")) {
                        tiene = false;
                    } else {
                        tiene = true;
                    }
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

                    JSONArray jsonarray = responseJSON.getJSONArray("dato");


                    if (tiene == true) {

                        String modeloo = jsonarray.getJSONObject(0).getString("Modelo");
                        selectSpinnerValue(modelos, modeloo);
                        tiene = false;

                    }


                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }

    private class cambiar_matricula_modelo extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            HttpClient httpClient = new DefaultHttpClient();


            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/cambiar_matricula.php");
            request.setHeader("content-type", "application/json");


            JSONObject dato = new JSONObject();
            try {

                dato.put("matricula", params[0]);
                dato.put("correo", params[1]);
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
                    respuesta = respJSON.getString("message");
                    if (respuesta.equals("No tiene matricula")) {
                        tiene = false;
                    } else {
                        tiene = true;
                    }
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

            }
        }
    }
    private class Rellenar_datos extends AsyncTask<String, String, Boolean> {
        JSONObject responseJSON = new JSONObject();
        ProgressDialog pDialog;

        @Override
        protected Boolean doInBackground(String... params) {
            boolean result = false;

            HttpClient httpClient = new DefaultHttpClient();


            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Coche_datos.php");
            request.setHeader("content-type", "application/json");


            JSONObject dato = new JSONObject();
            try {
                dato.put("modelo", params[0]);


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

            pDialog.dismiss();
            if (result.equals(true)) {
                try {

                    JSONArray jsonarray = responseJSON.getJSONArray("dato");

                    if (jsonarray.length() > 0) {

                        matricula.setText(jsonarray.getJSONObject(0).getString("Matricula"));
                        precio.setText(jsonarray.getJSONObject(0).getString("Precio"));
                        marca.setText(jsonarray.getJSONObject(0).getString("Marca"));
                        velocidad.setText(jsonarray.getJSONObject(0).getInt("Vel_max") + " " + "km/h");
                        bateria.setText(jsonarray.getJSONObject(0).getInt("Cap_bateria") + " " + "mAh");
                    }

                } catch (JSONException e) {
                    e.printStackTrace();

                }
            }
        }

        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(Coche.this);
            pDialog.setMessage("Cargando, espere...");
            pDialog.setProgressStyle(ProgressDialog.STYLE_SPINNER);
            pDialog.show();
        }
    }

    public void llenar_spinner(List<String> list,JSONArray jsonarray) throws JSONException {

        for (int i = 0; i < jsonarray.length(); i++){

            list.add(jsonarray.getJSONObject(i).getString("Modelo"));

        }
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(Coche.this, android.R.layout.simple_spinner_dropdown_item,list) {


            @Override
            public View getView(int position, View convertView, ViewGroup parent) {

                View v = super.getView(position, convertView, parent);
                if (position == getCount()) {
                    ((TextView)v.findViewById(android.R.id.text1)).setText("");
                    ((TextView)v.findViewById(android.R.id.text1)).setHint(getItem(getCount())); //"Hint to be displayed"
                }
                return v;
            }

            @Override
            public int getCount() {
                return super.getCount()-1; // you dont display last item. It is used as hint.
            }

        };

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        adapter.add("[Selecciona el modelo...]");


        modelos.setAdapter(adapter);

        modelos.setSelection(adapter.getCount()); //display hint
    }

    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.main, menu);
        return true;
    }


    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.guardar:


                String matricula_nueva = matricula.getText().toString();

                cambiar_matricula_modelo k = new cambiar_matricula_modelo();
                k.execute(matricula.getText().toString(),correo);



                Toast.makeText(this, "Modelo cambiado!",
                        Toast.LENGTH_LONG).show();
                break;
        }
        return true;
    }
}



