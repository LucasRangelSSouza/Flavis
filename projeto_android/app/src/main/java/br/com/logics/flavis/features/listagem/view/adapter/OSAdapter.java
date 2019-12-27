package br.com.logics.flavis.features.listagem.view.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.graphics.Color;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.features.listagem.view.ListagemOsActivity;
import br.com.logics.flavis.model.entities.os.OS;
import butterknife.BindView;
import butterknife.ButterKnife;

/**
 * Created by murilo aires on 27/03/2017.
 */
@SuppressLint("SimpleDateFormat")
public class OSAdapter extends RecyclerView.Adapter<OSAdapter.OSViewHolder> {


    private List<OS> osList;
    private ListagemOsActivity activity;

    public OSAdapter(List<OS> osList, ListagemOsActivity activity) {
        this.osList = osList;
        this.activity = activity;
    }

    @Override
    public OSViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_os, parent, false);
        OSViewHolder viewHolder = new OSViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(OSViewHolder holder, int position) {
        OS os = osList.get(position);
        holder.bindView(os);
    }

    @Override
    public int getItemCount() {
        return osList.size();
    }

    class OSViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {

        private final Context context;

        @BindView(R.id.textOsStatus)
        TextView textOsStatus;

        @BindView(R.id.textOsId)
        TextView textOsId;

        @BindView(R.id.textNomeCliente)
        TextView textNomeCliente;

        @BindView(R.id.textLogradouro)
        TextView textLogradouro;

        @BindView(R.id.txtOsData)
        TextView textOsData;

        @BindView(R.id.textOcorrencia)
        TextView textOcorrencia;

        @BindView(R.id.rootView)
        View rootView;

        public OSViewHolder(View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
            this.context = itemView.getContext();
            rootView.setOnClickListener(this);
        }

        public void bindView(OS os) {
            textOsId.setText(os.getId().toString());
            textNomeCliente.setText(os.getCliente().getNome());
            textLogradouro.setText(os.getEndereco().getLogradouro());
            textOcorrencia.setText(os.getIsPmoc() ? "PMOC" : "Ocorrência: " + os.getOcorrencia());
            setOsData(os);
            setStatus(os);

        }

        private void setOsData(OS os) {
            DateFormat dateFormat = SimpleDateFormat.getDateInstance();
            SimpleDateFormat sd = new SimpleDateFormat("dd/MM/yyy");
            DateFormat timeFormat = new SimpleDateFormat("HH:mm");
            String format = String.format(context.getString(R.string.os_data_format), sd.format(os.getDataAgendada()), timeFormat.format(os.getHoraAgendada()));
            textOsData.setText(format);
        }

        private void setStatus(OS os) {
            if (os.getAberta()) {
                textOsStatus.setTextColor(context.getResources().getColor(R.color.greenDark));
                textOsStatus.setText("Aberta");
            } else if (os.getIsFinalizada() && os.getIsSync()) {
                textOsStatus.setTextColor(Color.BLACK);
                textOsStatus.setText("Sincronizada");
            } else if (os.getIsFinalizada()) {
                textOsStatus.setTextColor(Color.BLACK);
                textOsStatus.setText("Finalizada");
            } else {
                textOsStatus.setTextColor(context.getResources().getColor(R.color.redDark));
                textOsStatus.setText("Pendente");
            }
        }

        @Override
        public void onClick(View v) {
            activity.openOs(getAdapterPosition());

        }
    }
}
