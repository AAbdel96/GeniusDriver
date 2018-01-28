package com.example.genius.dato;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Response;
import com.bumptech.glide.Glide;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.BitSet;

/**
 * Created by Genius on 14/06/2017.
 */

public class RecyclerAdapter extends RecyclerView.Adapter<RecyclerAdapter.MyViewHolder> {

    static ArrayList<Album> arrayList = new ArrayList<>();
    Activity activity;
    String img_path;
    private  AdapterView.OnItemClickListener onItemClickListener;


    public RecyclerAdapter(ArrayList<Album> arrayList, Context context, String ruta_carpeta, AdapterView.OnItemClickListener onItemClickListener){
        this.arrayList = arrayList;
        activity = (Activity) context;
        this.img_path = ruta_carpeta;
        this.onItemClickListener = onItemClickListener;
    }


    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_view,parent,false);
        return new MyViewHolder(view);
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {

        holder.Title.setText(arrayList.get(position).getNombre());
        String path = img_path+arrayList.get(position).getNombre();
        Glide.with(activity).load(path).into(holder.thubmail);

        //Glide.with(activity).load(path).placeholder(R.drawable.imagen_no_dispible).error(R.drawable.imagen_no_dispible).into(holder.thubmail);
    }

    public void update(ArrayList<Album> arrayListt){

        /*
        arrayList.clear();
        arrayList.addAll(arrayListt);
        notifyDataSetChanged();

        */


        if (arrayListt != null && arrayListt.size() > 0) {
            arrayList.clear();
            arrayList.addAll(arrayListt);
            notifyDataSetChanged();
        }
    }

    @Override
    public int getItemCount() {
        return arrayList.size();
    }

    class MyViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{

        private static final String TAG = "";
        ImageView thubmail;
        TextView Title;


        public MyViewHolder(View itemView) {
            super(itemView);

            thubmail = (ImageView) itemView.findViewById(R.id.thubnail);
            Title = (TextView)itemView.findViewById(R.id.album_title);

            Title.setOnClickListener(this);

            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View v) {
            onItemClickListener.onItemClick(null, itemView, getAdapterPosition(), itemView.getId());

        }
    }
}
