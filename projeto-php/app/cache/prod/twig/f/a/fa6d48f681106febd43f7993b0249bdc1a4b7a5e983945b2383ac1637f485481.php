<?php

/* SonataAdminBundle:CRUD:list__action_delete.html.twig */
class __TwigTemplate_fa6d48f681106febd43f7993b0249bdc1a4b7a5e983945b2383ac1637f485481 extends Twig_Template
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
        // line 11
        echo "
";
        // line 12
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : null)), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "hasRoute", array(0 => "delete"), "method"))) {
            // line 13
            echo "    <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
            echo "\" class=\"btn btn-sm btn-default delete_link\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_delete", array(), "SonataAdminBundle"), "html", null, true);
            echo "\">
        <i class=\"glyphicon glyphicon-remove\"></i>
        ";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_delete", array(), "SonataAdminBundle"), "html", null, true);
            echo "
    </a>
";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list__action_delete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 15,  24 => 13,  22 => 12,  19 => 11,);
    }
}
