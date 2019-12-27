<?php

/* AppBundle:Os:relatorio_pmoc.html.twig */
class __TwigTemplate_c215522c86aaa8eb5ef8a5af9fbdd54aa704c350c31affeff94ec51c9c3f4275 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Os:relatorio_pmoc.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        // line 4
        echo "
    <style>
        .box-relatorio-propriedades{
            background: #eee;
            padding: 5px 15px 15px 15px;
        }
        .box-relatorio-propriedades h4{
            background: #7F223D;
            color: #fff;
            padding: 5px;
            margin-bottom: 0;
        }
        .box-relatorio-propriedades p{
            padding-bottom: 0;
            margin-bottom: 0;
            padding-top: 10px;
        }
        .property-box .property-item{
        }
        .foto-item{width: 150px; height:100px;margin-left: 15px;display: inline-block;}
        .foto-item .foto-bg{
            width: 100%;
            height: 100%;
            background-position: center center;
            background-size: 100% auto;
            padding: 3px;
            color: #000 !important;
            text-align: center;
            font-weight: bold;
            border:1px solid #7F223D;
            line-height: 12px;
        }
        .foto-item .foto-bg:hover{
            border:1px solid #0000ff;
        }
    </style>

    <div class=\"box-relatorio-propriedades\">
        ";
        // line 42
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "relatoriosExecucoesProcedimentos", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["relatorio"]) {
            // line 43
            echo "
            <h4>#";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["relatorio"], "execucaoDeProcedimentoEquipamento", array()), "id", array()), "html", null, true);
            echo " Procedimento executado: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["relatorio"], "execucaoDeProcedimentoEquipamento", array()), "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);
            echo "</h4>
            <p><strong>Relatório da execução</strong></p>

            ";
            // line 47
            if ( !twig_test_empty($this->getAttribute($context["relatorio"], "relatorioDeExecucao", array()))) {
                // line 48
                echo "
                ";
                // line 49
                echo twig_escape_filter($this->env, $this->getAttribute($context["relatorio"], "relatorioDeExecucao", array()), "html", null, true);
                echo "

            ";
            } else {
                // line 52
                echo "                <div class=\"property-box row\">
                    ";
                // line 53
                $context["valores"] = $this->getAttribute((isset($context["pmoc_model"]) ? $context["pmoc_model"] : null), "printPropriedadesRelatorioPmoc", array(0 => $this->getAttribute($context["relatorio"], "propriedadeEquipamentoComValoresColetado", array())), "method");
                // line 54
                echo "                    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["valores"]) ? $context["valores"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["valor"]) {
                    // line 55
                    echo "                        <div class=\"property-item col-md-2\">
                            <strong>";
                    // line 56
                    echo twig_escape_filter($this->env, $this->getAttribute($context["valor"], "label", array()), "html", null, true);
                    echo "</strong>: ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["valor"], "valor", array()), "html", null, true);
                    echo "
                        </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['valor'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 59
                echo "                </div>
            ";
            }
            // line 61
            echo "
            <div class=\"fotos\"><p><strong>Fotos da execução</strong></p></div>
            <div class=\"foto-box row\">
                ";
            // line 64
            $context["fotos"] = $this->getAttribute($this->getAttribute($context["relatorio"], "execucaoDeProcedimentoEquipamento", array()), "fotos", array());
            // line 65
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["fotos"]) ? $context["fotos"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["foto"]) {
                // line 66
                echo "                    <a href=\"/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "pathFile", array()), "html", null, true);
                echo "\" target=\"_blank\" class=\"foto-item\">
                        <div class=\"foto-bg\" style=\"background-image:url(/";
                // line 67
                echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "pathFile", array()), "html", null, true);
                echo ") \">
                            <p>";
                // line 68
                echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "titulo", array()), "html", null, true);
                echo "</p>
                        </div>
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['foto'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "            </div>

        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['relatorio'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "    </div>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:relatorio_pmoc.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 75,  156 => 72,  146 => 68,  142 => 67,  137 => 66,  132 => 65,  130 => 64,  125 => 61,  121 => 59,  110 => 56,  107 => 55,  102 => 54,  100 => 53,  97 => 52,  91 => 49,  88 => 48,  86 => 47,  78 => 44,  75 => 43,  71 => 42,  31 => 4,  28 => 3,  11 => 1,);
    }
}
