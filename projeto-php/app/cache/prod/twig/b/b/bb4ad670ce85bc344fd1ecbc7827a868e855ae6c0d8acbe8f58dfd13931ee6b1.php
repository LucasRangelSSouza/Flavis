<?php

/* AppBundle:Os:list_status_os_homologada.html.twig */
class __TwigTemplate_bb4ad670ce85bc344fd1ecbc7827a868e855ae6c0d8acbe8f58dfd13931ee6b1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Os:list_status_os_homologada.html.twig", 1);
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
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isHomologada", array())) {
            // line 4
            echo "        <p style=\"text-align: center\">
            <i class=\"fa fa-check-circle\" aria-hidden=\"true\" style=\"color: #32CD32;\"></i>
        </p>
    ";
        } else {
            // line 8
            echo "        <p style=\"text-align: center\">
            <i class=\"fa fa-circle\" aria-hidden=\"true\" style=\"color: #B22222;\"></i>
        </p>
    ";
        }
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:list_status_os_homologada.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 8,  34 => 4,  31 => 3,  28 => 2,  11 => 1,);
    }
}
