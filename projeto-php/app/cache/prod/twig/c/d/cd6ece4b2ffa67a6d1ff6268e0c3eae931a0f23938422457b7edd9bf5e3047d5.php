<?php

/* AppBundle:Os:fotos-list.html.twig */
class __TwigTemplate_cd6ece4b2ffa67a6d1ff6268e0c3eae931a0f23938422457b7edd9bf5e3047d5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Os:fotos-list.html.twig", 1);
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
        echo "    <ul class=\"list-files-show-field\" style=\"list-style: none;padding-left: 0;\">
        ";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 6
            echo "            <li style=\"background: #f9f9f9;padding: 5px;float: left;text-align: center;\">
                <a href=\"/";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "pathFile", array()), "html", null, true);
            echo "\" target=\"_blank\">
                    <img src=\"/";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "pathFile", array()), "html", null, true);
            echo "\" style=\"max-height: 200px;\">
                </a><br/>
                <strong>";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "titulo", array()), "html", null, true);
            echo "</strong>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:fotos-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 13,  50 => 10,  45 => 8,  41 => 7,  38 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
