<?php

/* AppBundle:Os:execucoes_pmoc.html.twig */
class __TwigTemplate_e2a8de363c9432f5aca0954abafea536bc8f3b10b6c673c58d50a6c088367505 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Os:execucoes_pmoc.html.twig", 1);
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
    ";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "execucoesProcedimentos", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["execucao"]) {
            // line 6
            echo "
        ";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["execucao"], "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);
            echo "<br/>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['execucao'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:execucoes_pmoc.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 10,  41 => 7,  38 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
