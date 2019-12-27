<?php

/* SonataClassificationBundle:CategoryAdmin:list_tab_menu.html.twig */
class __TwigTemplate_987da40cce5a01c194c47e4628a20add94993b6c4dc89d0b8434cd803a6353a5 extends Twig_Template
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
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : null)), "method"), array("currentClass" => "active"), "list");
        echo "
<p>
    <div class=\"btn-group\">
        <a type=\"button\" class=\"btn ";
        // line 4
        if (((isset($context["mode"]) ? $context["mode"] : null) == "list")) {
            echo "btn-info active";
        } else {
            echo "btn-default";
        }
        echo "\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "list", 1 => array("filter" => array("context" => array("value" => ((array_key_exists("current_category", $context)) ? ((($this->getAttribute($this->getAttribute((isset($context["current_category"]) ? $context["current_category"] : null), "context", array(), "any", false, true), "id", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["current_category"]) ? $context["current_category"] : null), "context", array(), "any", false, true), "id", array()), "")) : (""))) : ("")))))), "method"), "html", null, true);
        echo "\">
            <i class=\"fa fa-list\"></i> ";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("classification.list_mode", array(), "SonataClassificationBundle"), "html", null, true);
        echo "
        </a>
        <a type=\"button\" class=\"btn ";
        // line 7
        if (((isset($context["mode"]) ? $context["mode"] : null) == "tree")) {
            echo "btn-info active";
        } else {
            echo "btn-default";
        }
        echo "\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "tree"), "method"), "html", null, true);
        echo "\">
            <i class=\"fa fa-sitemap\"></i> ";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("classification.tree_mode", array(), "SonataClassificationBundle"), "html", null, true);
        echo "
        </a>
    </div>
</p>
";
    }

    public function getTemplateName()
    {
        return "SonataClassificationBundle:CategoryAdmin:list_tab_menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 8,  40 => 7,  35 => 5,  25 => 4,  19 => 1,);
    }
}
