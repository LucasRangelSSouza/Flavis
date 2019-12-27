<?php

/* AppBundle:Os:boolean.html.twig */
class __TwigTemplate_1998694d3de2e0d4b59311f96bb4d52ff1b7234bfa86b06776949ed8580ad716 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Os:boolean.html.twig", 1);
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
    <span class=\"label label-warning\">

        ";
        if($context["value"] == 'PEN' || $context["value"] == ''){
            echo 'Pendente';
        }
        else if($context["value"] == 'ABE'){
            echo 'Aberta';
        }
        else if($context["value"] == 'PAR'){
            echo 'Paralisada';
        }
        else if($context["value"] == 'REP'){
            echo 'Replanejada';
        }
        else if($context["value"] == 'HOM'){
            echo 'Homologada';
        }
        else if($context["value"] == 'ENC'){
            echo 'Encerrada';
        }
        else if($context["value"] == 'CAN'){
            echo 'Cancelada';
        }
        else if($context["value"] == 'CON'){
            echo 'Concluída';
        }
        // line 7
//        if ((isset($context["value"]) ? $context["value"] : null)) {
//            // line 8
//            echo "             OS Fechada
//        ";
//        } else {
//            // line 10
//            echo "            OS Aberta
//        ";
//        }
        // line 12
        echo "
    </span>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:boolean.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 12,  42 => 10,  38 => 8,  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }
}
