<?php

/* AppBundle:CRUD:list__action_relatorio.html.twig */
class __TwigTemplate_d2b6674646090b5b540b4eadb275839c0a0f26746b22ca9441a613f82b5476f5 extends Twig_Template
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
        echo "<a target=\"_blank\" class=\"btn btn-sm btn-default view_link\"
   href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "relatorio", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
        echo "\">
    <i class=\"fa fa-print\" aria-hidden=\"true\"></i> Relatório</a>";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_relatorio.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  19 => 1,);
    }
}
