<?php

/* AppBundle:Os:os_original.html.twig */
class __TwigTemplate_424aadac069eef44fb27b2205a9652582a7c26e381a4ed459338373e48db7191 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Os:os_original.html.twig", 1);
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["object"], "nomePerfil", array()), "string", array()), "html", null, true);

        // line 3
        echo "    <span class=\"label label-warning\"> Esta OS é derivada de outra. <a target=\"_blank\"  href=http://www.orsin.com.br/app.php/app/os/ordemservico/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "osOriginal", array()), "id", array()), "html", null, true);
        echo "/show />Clique aqui</a> para visualizar a OS</span>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:os_original.html.twig";
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
