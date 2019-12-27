<?php

/* AppBundle:Os:list_sinc_os.html.twig */
class __TwigTemplate_496f36186a6b05ea379aba19cde0ac3825c50add760faa81e422feef124bcb99 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Os:list_sinc_os.html.twig", 1);
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
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isSync", array())) {
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
        return "AppBundle:Os:list_sinc_os.html.twig";
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
