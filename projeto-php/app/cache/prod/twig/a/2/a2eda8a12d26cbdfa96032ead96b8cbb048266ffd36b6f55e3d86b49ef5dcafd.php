<?php

/* AppBundle:CRUD:list__action_relatoriopmoc.html.twig */
class __TwigTemplate_a2eda8a12d26cbdfa96032ead96b8cbb048266ffd36b6f55e3d86b49ef5dcafd extends Twig_Template
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
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "relatoriopmoc", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
        echo "\">
    <i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\"></i> PMOC</a>";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_relatoriopmoc.html.twig";
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
