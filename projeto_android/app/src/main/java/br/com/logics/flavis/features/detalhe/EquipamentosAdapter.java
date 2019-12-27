package br.com.logics.flavis.features.detalhe;

import android.content.Context;
import android.graphics.Rect;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.TextView;

import java.util.List;

import br.com.logics.flavis.R;
import br.com.logics.flavis.model.entities.equipamento.Valor;
import br.com.logics.flavis.model.entities.os.procedimento.ExecucaoProcedimento;
import br.com.logics.flavis.utils.fotos.viewutils.SimpleDividerItemDecoration;
import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;

/**
 * Created by murilo aires on 02/06/2017.
 */

public class EquipamentosAdapter extends RecyclerView.Adapter<EquipamentosAdapter.EquipamentoViewHolder> {

    private List<ExecucaoProcedimento> execucoesProcedimentos;
    private DetalheOSActivity activity;

    public EquipamentosAdapter(List<ExecucaoProcedimento> execucoesProcedimentos, DetalheOSActivity activity) {
        this.execucoesProcedimentos = execucoesProcedimentos;
        this.activity = activity;
    }

    @Override
    public EquipamentoViewHolder onCreateViewHolder(ViewGroup parent, int i) {
        return new EquipamentoViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.execucao_procedimento_item, parent, false));
    }

    @Override
    public void onBindViewHolder(EquipamentoViewHolder equipamentoViewHolder, int i) {
        ExecucaoProcedimento execucaoProcedimento = execucoesProcedimentos.get(i);
        equipamentoViewHolder.bindView(execucaoProcedimento);
    }


    @Override
    public int getItemCount() {
        return execucoesProcedimentos.size();
    }

    class EquipamentoViewHolder extends RecyclerView.ViewHolder {
        private final Context context;

        @BindView(R.id.textExecucaoProcedimento)
        TextView textExecucaoProcedimento;

        @BindView(R.id.viewExecucaoProcedimento)
        View viewExecucaoProcedimento;

        @BindView(R.id.editRelatorioExecucao)
        EditText editRelatorioExecucao;

        @BindView(R.id.recyclerFotosProcedimento)
        RecyclerView recyclerFotosProcedimento;

        @BindView(R.id.viewValores)
        View viewValores;

        @BindView(R.id.textTituloPropriedade)
        TextView textTituloPropriedade;

        @BindView(R.id.recyclerValores)
        RecyclerView recyclerValores;

        @BindView(R.id.imgItemCompleto)
        View imageCompleto;

        private boolean isPropriedade;
        private ExecucaoProcedimento execucaoProcedimento;

        @OnClick(R.id.btnSalvarProcedimento)
        public void btnSalvarProcedimentoAction(View view) {
            validar();
        }

        private View.OnClickListener onClickFotoListener;

        private FotosAdapter fotosAdapter;

        private ValoresAdapter valoresAdapter;

        @OnClick(R.id.textExecucaoProcedimento)
        public void hideExecucao(View view) {
            for (int i = 0; i < execucoesProcedimentos.size(); i++) {
                if (i == getAdapterPosition()) {
                    execucoesProcedimentos.get(i).setVisible(!execucoesProcedimentos.get(i).isVisible());
                } else {
                    execucoesProcedimentos.get(i).setVisible(false);
                }
            }
            notifyDataSetChanged();
        }

        public EquipamentoViewHolder(View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
            this.context = itemView.getContext();
        }

        public void bindView(ExecucaoProcedimento execucaoProcedimento) {
            setUpRecyclerView(execucaoProcedimento);
            viewExecucaoProcedimento.setVisibility(execucaoProcedimento.isVisible() ? View.VISIBLE : View.GONE);
            String format = String.format(context.getString(R.string.execucao_procedimento_format), execucaoProcedimento.getClienteEquipamento().getEquipamento().getModelo().getTitulo(), execucaoProcedimento.getProcedimentoPmoc().getTitulo().getTitulo());
            textExecucaoProcedimento.setText((getAdapterPosition() + 1) + " - " + format);
            isPropriedade = execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento() != null;
            editRelatorioExecucao.setVisibility(isPropriedade ? View.GONE : View.VISIBLE);
            editRelatorioExecucao.setText(execucaoProcedimento.getRelatorioAvaliacao());
            viewValores.setVisibility(isPropriedade ? View.VISIBLE : View.GONE);
            recyclerValores.setVisibility(isPropriedade ? View.VISIBLE : View.GONE);
            imageCompleto.setVisibility(execucaoProcedimento.isCompleta() ? View.VISIBLE : View.GONE);
            if (isPropriedade) {
                String formatPropriedade = String.format(context.getString(R.string.formato_propriedade), execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento().getTitulo().getTitulo());
                textTituloPropriedade.setText(formatPropriedade);
                setUpRecyclerViewValores(execucaoProcedimento.getProcedimentoPmoc().getPropriedadeEquipamento().getValores());
            }

        }

        private void setUpRecyclerViewValores(List<Valor> valores) {
            valoresAdapter = new ValoresAdapter(valores);
            recyclerValores.setLayoutManager(new LinearLayoutManager(context));
            recyclerValores.setAdapter(valoresAdapter);
            recyclerValores.addItemDecoration(new SimpleDividerItemDecoration(context));
        }

        private void setUpRecyclerView(ExecucaoProcedimento execucaoProcedimento) {
            this.execucaoProcedimento = execucaoProcedimento;
            onClickFotoListener = new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    activity.createDialogAddFotoProcedimento(getAdapterPosition());
                }
            };
            fotosAdapter = new FotosAdapter(execucaoProcedimento.getFotosProcedimento(), onClickFotoListener, FotosAdapter.ADAPTER_FOTO_PROCEDIMENTO);
            LinearLayoutManager manager = new LinearLayoutManager(context, LinearLayoutManager.HORIZONTAL, false);
            recyclerFotosProcedimento.setLayoutManager(manager);
            recyclerFotosProcedimento.setAdapter(fotosAdapter);
            recyclerFotosProcedimento.addItemDecoration(new RecyclerView.ItemDecoration() {
                @Override
                public void getItemOffsets(Rect outRect, View view, RecyclerView parent, RecyclerView.State state) {
                    outRect.right = 20;
                }
            });
        }

        private void validar() {
            if (isPropriedade) {
                if (valoresAdapter.validate()) {
                    execucaoProcedimento.setCompleta(true);
                    execucaoProcedimento.update();
                    execucaoProcedimento.refresh();
                }
            } else {
                if (editRelatorioExecucao.getText().toString().equals("")) {
                    editRelatorioExecucao.setError(context.getString(R.string.campo_obrigatorio));
                } else {
                    execucaoProcedimento.setRelatorioAvaliacao(editRelatorioExecucao.getText().toString());
                    execucaoProcedimento.setCompleta(true);
                    execucaoProcedimento.update();
                    execucaoProcedimento.refresh();

                }
            }
            notifyDataSetChanged();
        }
    }


}
