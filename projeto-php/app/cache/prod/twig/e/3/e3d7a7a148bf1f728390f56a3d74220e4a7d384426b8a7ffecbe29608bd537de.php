<?php

/* AppBundle:Almoxarifado:produtos-compra-list.html.twig */
class __TwigTemplate_e3d7a7a148bf1f728390f56a3d74220e4a7d384426b8a7ffecbe29608bd537de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Almoxarifado:produtos-compra-list.html.twig", 1);
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
            echo "            <li style=\"background: #f9f9f9;padding: 5px;\">
                <ul>
                    <li><strong>Produto:</strong> ";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["val"], "produto", array()), "titulo", array()), "html", null, true);
            echo "</li>
                    <li><strong>Quantidade:</strong> ";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "quantidade", array()), "html", null, true);
            echo "</li>
                    <li><strong>Valor:</strong> ";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["val"], "valor", array()), "html", null, true);
            echo "</li>
                </ul>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Almoxarifado:produtos-compra-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 14,  50 => 10,  46 => 9,  42 => 8,  38 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
