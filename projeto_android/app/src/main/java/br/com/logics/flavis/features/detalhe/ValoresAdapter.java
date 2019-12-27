package br.com.logics.flavis.features.detalhe;

import android.content.Context;
import android.graphics.drawable.Drawable;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.TextView;

import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.equipamento.Valor;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;

/**
 * Created by murilo aires on 02/06/2017.
 */

public class ValoresAdapter extends RecyclerView.Adapter<ValoresAdapter.ValorViewHolder> {


    private List<Valor> valores;

    public ValoresAdapter(List<Valor> valores) {
        this.valores = valores;
    }

    @Override
    public ValorViewHolder onCreateViewHolder(ViewGroup parent, int i) {
        return new ValoresAdapter.ValorViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.valor_item, parent, false));
    }

    @Override
    public void onBindViewHolder(ValorViewHolder valorViewHolder, int i) {
        try {
            Valor valor = valores.get(i);
            valorViewHolder.bindView(valor);
        } catch (Exception e) {

        }

    }

    @Override
    public int getItemCount() {
        return valores.size();
    }

    public boolean validate() {
        for (int i = 0; i < valores.size(); i++) {
            if (valores.get(i).getValor() == null || valores.get(i).getValor().equals("")) {
                for (Valor valor : valores) {
                    valor.setValidate(true);
                }
                notifyDataSetChanged();
                return false;
            }
        }

        notifyDataSetChanged();
        return true;
    }

    class ValorViewHolder extends RecyclerView.ViewHolder {
        private final Context context;

        @BindView(R.id.textValorTitulo)
        TextView textValorTitulo;

        @BindView(R.id.edtValor)
        EditText edtValor;

        @BindView(R.id.imgCheck)
        View viewCheck;

        private Valor valor;

        @OnClick(R.id.btnOk)
        public void btnOkAction() {
            if (edtValor.getText().toString().equals("")) {
                edtValor.setError(context.getString(R.string.campo_obrigatorio));
                return;
            }
            valor.setValor(edtValor.getText().toString());
            valor.setInserido(true);
            valor.update();
            valor.refresh();
            notifyDataSetChanged();
        }

        public ValorViewHolder(View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
            context = itemView.getContext();
        }

        public void bindView(Valor valor) {
            textValorTitulo.setText(valor.getTitulo().getTitulo());
            edtValor.setText(valor.getValor());
            this.valor = valor;
            if (valor.isValidate() && edtValor.getText().toString().equals("")) {
                Drawable dr = ContextCompat.getDrawable(context, R.drawable.ic_error);
                dr.setBounds(0, 0, dr.getIntrinsicWidth(),
                        dr.getIntrinsicHeight());
                edtValor.setError(context.getString(R.string.campo_obrigatorio), dr);
            }
            viewCheck.setVisibility(valor.isInserido() ? View.VISIBLE : View.GONE);
        }
    }
}
