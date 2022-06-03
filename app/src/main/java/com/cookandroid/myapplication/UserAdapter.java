package com.cookandroid.myapplication;

import android.app.Activity;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.ArrayList;


class UserAdapter extends RecyclerView.Adapter<UserAdapter.CustomViewHolder> {

    private ArrayList<PersonalDate> mList = null;
    private Activity context = null;


    public UserAdapter(Activity context, ArrayList<PersonalDate> list) {
        this.context = context;
        this.mList = list;
    }

    class CustomViewHolder extends RecyclerView.ViewHolder {
        protected TextView date;
        protected TextView text;



        public CustomViewHolder(View view) {
            super(view);
            this.date = (TextView) view.findViewById(R.id.textView_list_date);
            this.text = (TextView) view.findViewById(R.id.textView_list_text);

        }
    }


    @Override
    public CustomViewHolder onCreateViewHolder(ViewGroup viewGroup, int viewType) {
        View view = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.item_list, null);
        CustomViewHolder viewHolder = new CustomViewHolder(view);

        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull CustomViewHolder viewholder, int position) {

        viewholder.date.setText(mList.get(position).getMember_date());
        viewholder.text.setText(mList.get(position).getMember_text());

    }

    @Override
    public int getItemCount() {
        return (null != mList ? mList.size() : 0);
    }

}