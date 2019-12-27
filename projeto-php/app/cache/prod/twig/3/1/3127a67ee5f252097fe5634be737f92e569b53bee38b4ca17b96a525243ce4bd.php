<?php

/* AppBundle:CRUD:list__action_deshomologa_os_admin.html.twig */
class __TwigTemplate_3127a67ee5f252097fe5634be737f92e569b53bee38b4ca17b96a525243ce4bd extends Twig_Template
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
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isHomologada", array())) {
            // line 2
            echo "\t<a class=\"btn btn-sm btn-warning view_link\" style=\"width: 120px;\"
       href=\"";
            // line 3
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "deshomologa", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
            echo "\">
\t   <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i>
        Desohomologadar
    </a>
";
        }
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_deshomologa_os_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 3,  21 => 2,  19 => 1,);
    }
}
