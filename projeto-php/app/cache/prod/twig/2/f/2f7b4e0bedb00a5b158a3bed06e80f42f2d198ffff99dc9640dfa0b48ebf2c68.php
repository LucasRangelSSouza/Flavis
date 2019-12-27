<?php

/* AppBundle:CRUD:list__action_etiqueta.html.twig */
class __TwigTemplate_2f7b4e0bedb00a5b158a3bed06e80f42f2d198ffff99dc9640dfa0b48ebf2c68 extends Twig_Template
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
        if ($this->getAttribute((isset($context["cliente_model"]) ? $context["cliente_model"] : null), "clienteTemEquipamento", array(0 => (isset($context["object"]) ? $context["object"] : null)), "method")) {
            // line 2
            echo "
<a target=\"_blank\" class=\"btn btn-sm btn-primary view_link\"
   href=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "etiqueta", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
            echo "\">
    <i class=\"fa fa-print\" aria-hidden=\"true\"></i> Etiquetas</a>

";
        } else {
            // line 8
            echo "
    <a target=\"_blank\" class=\"btn btn-sm btn-default view_link disabled\"
       href=\"#\"><i class=\"fa fa-close\" aria-hidden=\"true\"></i> Etiquetas</a>

";
        }
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_etiqueta.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 8,  25 => 4,  21 => 2,  19 => 1,);
    }
}
