<?php

/* AppBundle:Pergunta:list_texto.html.twig */
class __TwigTemplate_ed4b8b18aa709f5cc86a1b3220a73709002b097d66d14a9a104b5ab5cbc361a7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Pergunta:list_texto.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_field($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        echo twig_escape_filter($this->env, (twig_slice($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "texto", array()), 0, 60) . "..."), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Pergunta:list_texto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 3,  28 => 2,  11 => 1,);
    }
}
