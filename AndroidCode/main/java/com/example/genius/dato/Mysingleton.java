package com.example.genius.dato;

import android.content.Context;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

/**
 * Created by Genius on 14/06/2017.
 */

public class Mysingleton {

    private static Mysingleton mInstance;
    private Context ctx;
    private RequestQueue requestQueue;

    public Mysingleton(Context ctx) {
        this.ctx = ctx;
        requestQueue = getRequestQueue();
    }

    private RequestQueue getRequestQueue(){
        if(requestQueue == null){
            requestQueue = Volley.newRequestQueue(ctx.getApplicationContext());

        }
        return requestQueue;
    }

    public static synchronized Mysingleton getmInstance(Context context){
        if(mInstance == null){
            mInstance = new Mysingleton(context);
        }
        return mInstance;
    }
    public <T> void addToRequestQue(Request<T> request){
        getRequestQueue().add(request);

    }
}
