package com.example.genius.dato;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;

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

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import cz.msebera.android.httpclient.protocol.HTTP;

public class Galeria_usuario extends AppCompatActivity implements AdapterView.OnItemClickListener {

    EditText nombre_imagen_modificado_input;
    String nombre_carpeta;
    String email_recibido;
    static final String IP = "geniusdriver.ddns.net";
    //static final String IP = "192.168.0.109";
    Toolbar toolbar;
    ArrayList<Album> arrayList =  new ArrayList<>();
    RecyclerView recyclerView;

    RecyclerAdapter adapter;
    RecyclerView.LayoutManager layoutManager;
    String url_server = "http://"+IP+"/SampleWS/images_path.php";
    String url_carpeta = "http://"+IP+"/SampleWS/uploads/imagenes/";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_galeria);

        Galeria_usuario.this.setTitle("Galeria");

        //toolbar = (Toolbar)findViewById(R.id.toolBar);
        //setSupportActionBar(toolbar);

        email_recibido = getIntent().getStringExtra("email");

        recyclerView = (RecyclerView) findViewById(R.id.recyclerView);
        layoutManager = new GridLayoutManager(this, 2);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setHasFixedSize(true);

        Extractor_imagenes ex = new Extractor_imagenes();
        ex.execute(email_recibido);


        //para poder saber cual es la carpeta del usuario vamos a tener que separar el email


        String CurrentString = email_recibido;
        String[] separated = CurrentString.split("@");
        nombre_carpeta = separated[0];

        adapter = new RecyclerAdapter(arrayList, Galeria_usuario.this, url_carpeta + separated[0] + "/", Galeria_usuario.this);
        recyclerView.setAdapter(adapter);

    }


    public boolean onInterceptTouchEvent(RecyclerView rv, MotionEvent e) {


        return false;
    }


    public void onTouchEvent(RecyclerView rv, MotionEvent e) {

    }


    public void onRequestDisallowInterceptTouchEvent(boolean disallowIntercept) {

    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, final int position, long id) {

        /*Toast.makeText(this, arrayList.get(position).getNombre(),
                Toast.LENGTH_LONG).show();*/

        AlertDialog.Builder builder = new AlertDialog.Builder(this);

        final CharSequence[] items = new CharSequence[3];

        items[0] = "Eliminar mapa";
        items[1] = "Editar mapa";
        items[2] = "Enviar al simulador";

        builder.setTitle("Elige una opción:")
                .setItems(items, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        switch (which){
                            case 0:

                                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                                builder.setMessage("¿Seguro que quieres borrar el mapa?").setTitle("¡Atención!").setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {

                                        Eliminar_mapa maper = new Eliminar_mapa();

                                        maper.execute(arrayList.get(position).getNombre(),nombre_carpeta);
                                    }
                                }).setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {

                                }
                            });
                                Dialog dialogg = builder.create();
                                dialogg.show();
                                break;
                            case 1:
                                final AlertDialog.Builder edit_nombre = new AlertDialog.Builder(Galeria_usuario.this);
                                edit_nombre.setMessage("Introduce el nuevo nombre:").setTitle("¡Atención!");
                                nombre_imagen_modificado_input = new EditText(Galeria_usuario.this);

                                edit_nombre.setView(nombre_imagen_modificado_input);

                                edit_nombre.setPositiveButton("Aceptar", new DialogInterface.OnClickListener()
                                {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {

                                        String new_name = nombre_imagen_modificado_input.getText().toString();
                                        Editar_mapa maper = new Editar_mapa();

                                        maper.execute(arrayList.get(position).getNombre(),nombre_carpeta,new_name);

                                        adapter.update(arrayList);
                                    }
                                }).setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {
                                    }
                                });
                                Dialog dialogh = edit_nombre.create();
                                dialogh.show();
                                break;
                            case 2:
                                Enviar_simulador fc = new Enviar_simulador();
                                fc.execute(nombre_carpeta,arrayList.get(position).getNombre());
                                break;
                        }
                    }
                });

        Dialog dialog = builder.create();
        dialog.show();
    }
    private class Extractor_imagenes extends AsyncTask<String, String, Boolean> {
        JSONArray responseJSON = new JSONArray();

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
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/images_path.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("email", params[0]);


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
                JSONArray respJSON = new JSONArray(respStr);


                if (respJSON.length() <0) {
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
                    int count = 0;
                    while(count < responseJSON.length()){

                        JSONObject datos = responseJSON.getJSONObject(count);
                        arrayList.add(new Album(datos.getString("id"),datos.getString("nombre")));
                        count++;
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } else {

                Toast.makeText(Galeria_usuario.this, "'Error, vuelve a actualizar la galeria!",
                        Toast.LENGTH_LONG).show();

            }
        }
    }

    private class Enviar_simulador extends AsyncTask<String, String, Boolean> {
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
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/insertar_simulaciones.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("nombre_imagen", params[0]);
                dato.put("nombre_carpeta",params[1]);


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

                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                builder.setMessage("¡Mapa enviado correctamente!").setTitle("Información.").setIcon(R.drawable.checked).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        

                    }
                });

                Dialog dialog = builder.create();
                dialog.show();
            } else {

                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                builder.setMessage("¡No se ha podido enviar el mapa al simulador!").setTitle("Error.").setIcon(R.drawable.error).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                    }
                });

                Dialog dialog = builder.create();
                dialog.show();

            }
        }
    }
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.refrescar, menu);
        return true;
    }


    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.refrescar:

                adapter.update(arrayList);

                Toast.makeText(Galeria_usuario.this, "Galeria actualizada!",
                        Toast.LENGTH_LONG).show();
                break;
        }
        return true;
    }


    private class Eliminar_mapa extends AsyncTask<String, String, Boolean> {
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
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/borrar_mapa.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("nombre", params[0]);
                dato.put("nombre_carpeta", params[1]);



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


                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                builder.setMessage("¡Mapa borrado correctamente!").setTitle("Información.").setIcon(R.drawable.checked).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        adapter.update(arrayList);

                    }
                });

                Dialog dialog = builder.create();
                dialog.show();
            } else {

                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                builder.setMessage("¡No se ha podido borrar el mapa!").setTitle("Error.").setIcon(R.drawable.error).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                    }
                });

                Dialog dialog = builder.create();
                dialog.show();

            }
        }
    }

    private class Editar_mapa extends AsyncTask<String, String, Boolean> {
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
            HttpPost request = new HttpPost("http://"+IP+"/SampleWS/Editar_mapa.php");
            request.setHeader("content-type", "application/json");

            //creamos un objeto de la clase JSONObject llamado dato
            JSONObject dato = new JSONObject();
            try {
                //ahora vamos a meter los dos campos que tenemos correo,contraseña y el token dentro del "dato".
                dato.put("nombre", params[0]);
                dato.put("nombre_carpeta", params[1]);
                dato.put("nuevo_nombre", params[2]);



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


                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                builder.setMessage("¡Mapa modificado correctamente!").setTitle("Información.").setIcon(R.drawable.checked).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {



                    }
                });

                Dialog dialog = builder.create();
                dialog.show();


            } else {

                AlertDialog.Builder builder = new AlertDialog.Builder(Galeria_usuario.this);
                builder.setMessage("¡No se ha podido modificar el mapa!").setTitle("Error").setIcon(R.drawable.error).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {



                    }
                });

                Dialog dialog = builder.create();
                dialog.show();

            }
        }
    }
}
