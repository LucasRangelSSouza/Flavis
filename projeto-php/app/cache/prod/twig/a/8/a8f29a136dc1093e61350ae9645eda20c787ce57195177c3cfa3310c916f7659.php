<?php

/* AppBundle:CRUD:list__action_pdf.html.twig */
class __TwigTemplate_a8f29a136dc1093e61350ae9645eda20c787ce57195177c3cfa3310c916f7659 extends Twig_Template
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
        echo "<a target=\"_blank\" class=\"btn btn-sm btn-default view_link\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "print", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
        echo "\">
    <i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\"></i> PDF</a>";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_pdf.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
