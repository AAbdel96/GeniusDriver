package com.example.genius.dato;

import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.graphics.Bitmap;
import android.graphics.Matrix;
import android.media.ExifInterface;
import android.net.Uri;
import android.opengl.ETC1;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;

import com.kosalgeek.genasync12.*;
import com.kosalgeek.genasync12.AsyncResponse;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.util.HashMap;


public class Gestor_camara extends AppCompatActivity {


    static final String IP = "geniusdriver.ddns.net";
    //static final String IP = "192.168.0.109";
    CameraPhoto cameraPhoto;
    GalleryPhoto galleryPhoto;
    Button button3;
    ImageButton button1, button2;
    ImageView ivImage;
    EditText  nombre_foto;


    final int CAMERA_REQUEST = 13323;
    final int GALLERY_REQUEST = 12345;
    String selectedPhoto;
    boolean entrado  = false;
    private final String TAG = this.getClass().getName();

    int clickerId;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);

        setContentView(R.layout.capturadora_imagen);

        Gestor_camara.this.setTitle("Mapa");

        cameraPhoto = new CameraPhoto(getApplicationContext());
        galleryPhoto = new GalleryPhoto(getApplicationContext());

        button1 = (ImageButton) findViewById(R.id.camara);
        button2 = (ImageButton) findViewById(R.id.galeria);
        button3 = (Button) findViewById(R.id.subir);
        ivImage = (ImageView) findViewById(R.id.imagen);

        nombre_foto = (EditText) findViewById(R.id.nombre_imagen);

        button1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {


                try {
                    startActivityForResult(cameraPhoto.takePhotoIntent(), CAMERA_REQUEST);

                } catch (IOException e) {
                    Toast.makeText(getApplicationContext(), "Error mientras se tomaba la foto", Toast.LENGTH_LONG).show();
                }
            }
        });

        button2.setOnClickListener(new View.OnClickListener() {


            @Override
            public void onClick(View v) {

                startActivityForResult(galleryPhoto.openGalleryIntent(), GALLERY_REQUEST);

            }

        });

        button3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(entrado == false ||  nombre_foto.equals("") == true){
                    Toast.makeText(getApplicationContext(), "No hay una foto seleccionada!", Toast.LENGTH_LONG).show();
                    return;
                }

                try {
                    entrado = false;
                    Bitmap bitmap = ImageLoader.init().from(selectedPhoto).requestSize(1024,1024).getBitmap();
                    String encodedImage = ImageBase64.encode(bitmap);
                    Log.d(TAG,encodedImage);

                    HashMap<String,String> postData = new HashMap<String, String>();
                    postData.put("image",encodedImage);

                    String email = getIntent().getStringExtra("correo");
                    postData.put("email",email);
                    final String nombre_imagen =  nombre_foto.getText().toString();
                    postData.put("nombre_imagen",nombre_imagen);
                    PostResponseAsyncTask task = new PostResponseAsyncTask(Gestor_camara.this, postData, new AsyncResponse() {
                        @Override
                        public void processFinish(String s) {

                            if(s.contains("upload_success")){
                                AlertDialog.Builder builder = new AlertDialog.Builder(Gestor_camara.this);
                                builder.setMessage("¡Mapa enviado correctamente!").setTitle("Información.").setIcon(R.drawable.checked).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {


                                    }
                                });

                                Dialog dialog = builder.create();
                                dialog.show();
                            }
                            else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(Gestor_camara.this);
                                builder.setMessage("¡No se ha podido enviar el mapa!").setTitle("Error.").setIcon(R.drawable.error).setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {


                                    }
                                });

                                Dialog dialog = builder.create();
                                dialog.show();
                            }

                        }
                    });

                    task.execute("http://"+IP+"/SampleWS/upload.php");
                    task.setEachExceptionsHandler(new EachExceptionsHandler() {
                        @Override
                        public void handleIOException(IOException e) {

                            Toast.makeText(getApplicationContext(), "No se ha podido conectar al servidor", Toast.LENGTH_LONG).show();
                        }

                        @Override
                        public void handleMalformedURLException(MalformedURLException e) {
                            Toast.makeText(getApplicationContext(), "Error en la url", Toast.LENGTH_LONG).show();
                        }

                        @Override
                        public void handleProtocolException(ProtocolException e) {

                            Toast.makeText(getApplicationContext(), "Error del protocolo", Toast.LENGTH_LONG).show();
                        }

                        @Override
                        public void handleUnsupportedEncodingException(UnsupportedEncodingException e) {

                            Toast.makeText(getApplicationContext(), "Error en la codificacion de la imagen", Toast.LENGTH_LONG).show();
                        }
                    });
                } catch (FileNotFoundException e) {
                    Toast.makeText(getApplicationContext(), "No se ha podido codificar la imagen.", Toast.LENGTH_LONG).show();
                }

            }
        });

    }
    public static Bitmap rotateBitmap(Bitmap bitmap, int orientation) {

        Matrix matrix = new Matrix();
        switch (orientation) {
            case ExifInterface.ORIENTATION_NORMAL:
                return bitmap;
            case ExifInterface.ORIENTATION_FLIP_HORIZONTAL:
                matrix.setScale(-1, 1);
                break;
            case ExifInterface.ORIENTATION_ROTATE_180:
                matrix.setRotate(180);
                break;
            case ExifInterface.ORIENTATION_FLIP_VERTICAL:
                matrix.setRotate(180);
                matrix.postScale(-1, 1);
                break;
            case ExifInterface.ORIENTATION_TRANSPOSE:
                matrix.setRotate(90);
                matrix.postScale(-1, 1);
                break;
            case ExifInterface.ORIENTATION_ROTATE_90:
                matrix.setRotate(90);
                break;
            case ExifInterface.ORIENTATION_TRANSVERSE:
                matrix.setRotate(-90);
                matrix.postScale(-1, 1);
                break;
            case ExifInterface.ORIENTATION_ROTATE_270:
                matrix.setRotate(-90);
                break;
            default:
                return bitmap;
        }
        try {
            Bitmap bmRotated = Bitmap.createBitmap(bitmap, 0, 0, bitmap.getWidth(), bitmap.getHeight(), matrix, true);
            bitmap.recycle();
            return bmRotated;
        }
        catch (OutOfMemoryError e) {
            e.printStackTrace();
            return null;
        }
    }
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if(resultCode == RESULT_OK){
            if(requestCode == CAMERA_REQUEST){
                entrado = true;
                String photoPath = cameraPhoto.getPhotoPath();
                selectedPhoto = photoPath;
                Log.d(TAG,photoPath);
                try {
                    Bitmap bitmap = ImageLoader.init().from(photoPath).requestSize(512, 512).getBitmap();

                    rotateBitmap(bitmap, 90);
                    ivImage.setImageBitmap(bitmap); //imageView is your ImageView


                } catch (FileNotFoundException e) {
                    Toast.makeText(getApplicationContext(), "Error mientras se cargaba la foto.", Toast.LENGTH_LONG).show();

                }
            }
            else if (requestCode == GALLERY_REQUEST){

                entrado = true;
                Uri uri = data.getData();
                galleryPhoto.setPhotoUri(uri);
                String photoPath = galleryPhoto.getPath();
                selectedPhoto = photoPath;
                Log.d(TAG,photoPath);

                try {
                    Bitmap bitmap = ImageLoader.init().from(photoPath).requestSize(512, 512).getBitmap();
                    rotateBitmap(bitmap, 90);
                    ivImage.setImageBitmap(bitmap); //imageView is your ImageView
                } catch (FileNotFoundException e) {
                    Toast.makeText(getApplicationContext(), "Error mientras se elegia la foto.", Toast.LENGTH_LONG).show();

                }

            }
        }//end if resultCode
    }



}
