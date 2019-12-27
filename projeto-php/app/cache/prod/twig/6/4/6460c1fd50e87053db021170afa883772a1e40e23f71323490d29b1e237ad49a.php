<?php

/* SonataMediaBundle:MediaAdmin:inner_row_media.html.twig */
class __TwigTemplate_6460c1fd50e87053db021170afa883772a1e40e23f71323490d29b1e237ad49a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_flat_inner_row.html.twig", "SonataMediaBundle:MediaAdmin:inner_row_media.html.twig", 12);
        $this->blocks = array(
            'row' => array($this, 'block_row'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_flat_inner_row.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_row($context, array $blocks = array())
    {
        // line 15
        echo "
    <div class=\"col-sm-12\">
        <div class=\"pull-left\">
            ";
        // line 18
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : null)), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "hasRoute", array(0 => "edit"), "method"))) {
            // line 19
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "method"), "html", null, true);
            echo "\" style=\"float: left; margin-right: 6px;\">";
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["object"]) ? $context["object"] : null), "admin", array("width" => 90));
            echo "</a>
            ";
        } else {
            // line 21
            echo "                ";
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["object"]) ? $context["object"] : null), "admin", array("height" => 90));
            // line 22
            echo "            ";
        }
        // line 23
        echo "        </div>
        <span class=\"badge pull-right\">";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "providerName", array()), array(), "SonataMediaBundle"), "html", null, true);
        echo "</span>
        ";
        // line 25
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : null)), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "hasRoute", array(0 => "edit"), "method"))) {
            // line 26
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "method"), "html", null, true);
            echo "\"><strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "name", array()), "html", null, true);
            echo "</strong></a>
        ";
        } else {
            // line 28
            echo "            <strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "name", array()), "html", null, true);
            echo "</strong>
        ";
        }
        // line 30
        echo "

        <br />
        ";
        // line 33
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "width", array())) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "width", array()), "html", null, true);
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "height", array())) {
                echo "x";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "height", array()), "html", null, true);
            }
            echo "px";
        }
        // line 34
        echo "        ";
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "length", array()) > 0)) {
            // line 35
            echo "            (";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "length", array()), "html", null, true);
            echo ")
        ";
        }
        // line 37
        echo "
        <br />

        ";
        // line 40
        if ( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "authorname", array()))) {
            // line 41
            echo "           ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "authorname", array()), "html", null, true);
            echo "
        ";
        }
        // line 43
        echo "
        ";
        // line 44
        if (( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "copyright", array())) &&  !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "authorname", array())))) {
            // line 45
            echo "            ~
        ";
        }
        // line 47
        echo "
        ";
        // line 48
        if ( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "copyright", array()))) {
            // line 49
            echo "            &copy; ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "copyright", array()), "html", null, true);
            echo "
        ";
        }
        // line 51
        echo "
        ";
        // line 53
        echo "        ";
        // line 54
        echo "        ";
        // line 55
        echo "            ";
        // line 56
        echo "        ";
        // line 57
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:inner_row_media.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 57,  141 => 56,  139 => 55,  137 => 54,  135 => 53,  132 => 51,  126 => 49,  124 => 48,  121 => 47,  117 => 45,  115 => 44,  112 => 43,  106 => 41,  104 => 40,  99 => 37,  93 => 35,  90 => 34,  80 => 33,  75 => 30,  69 => 28,  61 => 26,  59 => 25,  55 => 24,  52 => 23,  49 => 22,  46 => 21,  38 => 19,  36 => 18,  31 => 15,  28 => 14,  11 => 12,);
    }
}
