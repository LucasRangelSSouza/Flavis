package br.com.logics.flavis.features.detalhe;

import android.content.Context;

import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;

import java.io.File;
import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.os.FotoOS;
import br.com.logics.flavis.model.entities.os.OS;
import br.com.logics.flavis.model.entities.os.procedimento.FotoProcedimento;
import butterknife.BindView;
import butterknife.ButterKnife;

/**
 * Created by murilo aires on 24/05/2017.
 */

public class FotosAdapter extends RecyclerView.Adapter {

    private static final int TYPE_ADD = 0;
    private static final int TYPE_FOTO = 1;
    public static final int ADAPTER_FOTO_OS = 2;
    public static final int ADAPTER_FOTO_PROCEDIMENTO = 3;
    private int tipoAdapter;
    private View.OnClickListener onClickAddPhotoListener;
    private List<FotoOS> fotos;
    private List<FotoProcedimento> fotosProcedimento;

    public FotosAdapter(OS os, View.OnClickListener onClickAddPhotoListener, int tipoAdapter) {
        this.fotos = os.getFotosOs();
        this.onClickAddPhotoListener = onClickAddPhotoListener;
        this.tipoAdapter = tipoAdapter;
    }

    public FotosAdapter(List<FotoProcedimento> fotosProcedimento, View.OnClickListener onClickAddPhotoListener, int tipoAdapter) {
        this.fotosProcedimento = fotosProcedimento;
        this.onClickAddPhotoListener = onClickAddPhotoListener;
        this.tipoAdapter = tipoAdapter;
    }

    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v;
        RecyclerView.ViewHolder vh;
        switch (viewType) {
            case TYPE_ADD:
                v = LayoutInflater.from(parent.getContext()).inflate(R.layout.add_foto_item, parent, false);
                vh = new AddFotoViewHolder(v);
                break;
            default:
                v = LayoutInflater.from(parent.getContext()).inflate(R.layout.foto_item, parent, false);
                vh = new FotoViewHolder(v);
                break;
        }
        return vh;
    }

    @Override
    public void onBindViewHolder(RecyclerView.ViewHolder viewHolder, int i) {
        if (i != 0) {
            if (tipoAdapter == ADAPTER_FOTO_OS) {
                ((FotoViewHolder) viewHolder).load(fotos.get(i - 1).getPath());
            } else {
                ((FotoViewHolder) viewHolder).load(fotosProcedimento.get(i - 1).getPath());
            }
        }

    }

    @Override
    public int getItemCount() {
        if (tipoAdapter == ADAPTER_FOTO_OS) {
            return fotos.size() + 1;
        } else {
            return fotosProcedimento.size() + 1;
        }
    }

    @Override
    public int getItemViewType(int position) {
        if (position == 0) {
            return TYPE_ADD;
        } else {
            return TYPE_FOTO;
        }
    }

    public void notifyDataSetChanged(List<FotoOS> fotosOS) {
        this.fotos = fotosOS;
        notifyDataSetChanged();
    }

    class AddFotoViewHolder extends RecyclerView.ViewHolder {
        @BindView(R.id.addFotoItemRoot)
        View viewAddFoto;

        public AddFotoViewHolder(View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
            viewAddFoto.setOnClickListener(onClickAddPhotoListener);
        }
    }

    class FotoViewHolder extends RecyclerView.ViewHolder {
        private final Context context;
        @BindView(R.id.foto)
        ImageView foto;

        public FotoViewHolder(View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
            this.context = itemView.getContext();
        }

        public void load(String path) {
            Picasso.get().load(new File(path)).into(foto);
        }
    }
}
