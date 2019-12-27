<?php

/* AppBundle:CRUD:list__action_homologa_os_admin.html.twig */
class __TwigTemplate_a06cf83c4e9bd7b1831e24d7fa89abc769c336e13f4033b5163f1bcd93b048e8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isCancelada", array()) == false)) {
            // line 2
            echo "
    ";
            // line 3
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isHomologada", array())) {
                // line 4
                echo "        <button class=\"btn btn-sm btn-success view_link disabled\" style=\"width: 120px;\">
           <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
            Homologada
        </button>
    ";
            } else {
                // line 9
                echo "        <button class=\"btn btn-sm btn-primary homologaOs\" style=\"width: 120px;\"
           data-os=\"";
                // line 10
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "id", array()), "html", null, true);
                echo "\">
            <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
            Homologar OS
        </button>
    ";
            }
            // line 15
            echo "
";
        }
        // line 17
        echo "
<style>

    #validate{
        display: none;
        color: #ff0000;
        text-align: center;
        padding-top: 10px;
    }

    .modal-dialog .modal-title, .modal-dialog label{
        color: #111 !important;
    }

</style>

<div class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" id=\"modalHomologacao\" data-backdrop=\"static\" data-keyboard=\"false\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h4 class=\"modal-title\">Homologação de OS</h4>
            </div>
            <div class=\"modal-body\">

                <div class=\"row\">
                    <div class=\"col-md-4\">
                        <label>Valor da OS</label>
                        <input type=\"text\" class=\"form-control dinheiro\" id=\"valorOs\"/>
                    </div>
                    <div class=\"col-md-4\">
                        <label>Qtd. Parcelas</label>
                        <select id=\"numParcelasOs\">
                            <option value=\"\">Selecione</option>
                            <option value=\"1\">01x</option>
                            <option value=\"2\">02x</option>
                            <option value=\"3\">03x</option>
                            <option value=\"4\">04x</option>
                            <option value=\"5\">05x</option>
                            <option value=\"6\">06x</option>
                            <option value=\"7\">07x</option>
                            <option value=\"8\">08x</option>
                            <option value=\"9\">09x</option>
                            <option value=\"10\">10x</option>
                        </select>
                    </div>
                    <div class=\"col-md-4\">
                        <label>Meio de pagamento</label>
                        <select id=\"meioPagamentoOs\">
                            <option value=\"\">Selecione</option>
                            <option value=\"cheque\">Cheque</option>
                            <option value=\"dinheiro\">Dinheiro</option>
                            <option value=\"boleto\">Boleto</option>
                            <option value=\"cartao\">Cartão</option>
                        </select>
                    </div>
                </div>

                <div class=\"row\" style=\"margin-top: 10px;\">
                    <div class=\"col-md-12\">
                        <label>Observações</label>
                        <textarea class=\"form-control\" id=\"obsHomologaOs\"></textarea>
                    </div>
                </div>

                <div class=\"row\" id=\"validateHomologaOs\" style=\"color: #ff0000;padding-top: 10px;text-align: center;\">
                    <div class=\"col-md-12\">
                        <p></p>
                    </div>
                </div>

                <input type=\"hidden\" id=\"idOS\">
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" id=\"btnCloseModal\" data-dismiss=\"modal\">Fechar</button>
                <button type=\"button\" class=\"btn btn-primary\" id=\"btnHomologaOs\">Homologar OS</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_homologa_os_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 17,  44 => 15,  36 => 10,  33 => 9,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
