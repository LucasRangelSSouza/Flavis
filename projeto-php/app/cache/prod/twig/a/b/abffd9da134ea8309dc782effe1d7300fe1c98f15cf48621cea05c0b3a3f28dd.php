<?php

/* AppBundle:Colaborador:documentos-list.html.twig */
class __TwigTemplate_abffd9da134ea8309dc782effe1d7300fe1c98f15cf48621cea05c0b3a3f28dd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Colaborador:documentos-list.html.twig", 1);
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
        echo "    <ul class=\"list-files-show-field\">
        ";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 6
            echo "            <li>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["val"], "tipoDocumento", array()), "titulo", array()), "html", null, true);
            echo " - <a target=\"_blank\" href=\"/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "pathFile", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "titulo", array()), "html", null, true);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Colaborador:documentos-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 8,  38 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
