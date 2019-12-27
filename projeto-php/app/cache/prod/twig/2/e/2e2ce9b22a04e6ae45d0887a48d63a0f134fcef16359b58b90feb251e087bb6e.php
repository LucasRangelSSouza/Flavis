<?php

/* AppBundle:Os:assinatura.html.twig */
class __TwigTemplate_2e2ce9b22a04e6ae45d0887a48d63a0f134fcef16359b58b90feb251e087bb6e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Os:assinatura.html.twig", 1);
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
        echo "    ";
        if ( !twig_test_empty((isset($context["value"]) ? $context["value"] : null))) {
            // line 5
            echo "        <a href=\"/";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            echo "\" target=\"_blank\"><img src=\"/";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            echo "\" style=\"max-height: 80px;\"></a>
    ";
        }
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:assinatura.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
