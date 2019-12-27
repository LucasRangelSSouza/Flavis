<?php

/* SonataMediaBundle:MediaAdmin:select_provider.html.twig */
class __TwigTemplate_da0c7f0140a8ab1f6dea7e43e42792d857f2c6ca4078b7f51b49d255c9ebc187 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:action.html.twig", "SonataMediaBundle:MediaAdmin:select_provider.html.twig", 12);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_select_provider", array(), "SonataMediaBundle"), "html", null, true);
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "    <div class=\"box box-success\">
        <div class=\"box-header\">
            <h3 class=\"box-title\">
                ";
        // line 20
        $this->displayBlock("title", $context, $blocks);
        echo "
            </h3>
        </div>
        <div class=\"box-body\">
            ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["providers"]) ? $context["providers"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["code"] => $context["provider"]) {
            // line 25
            echo "                <div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">
                    <a href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "create", 1 => array("provider" => $this->getAttribute($context["provider"], "name", array()))), "method"), "html", null, true);
            echo "\"
                       class=\"btn btn-app btn-block\"
                       data-toggle=\"tooltip\"
                       data-placement=\"top\"
                       title=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "description", array()), array(), (($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array()), "SonataMediaBundle")) : ("SonataMediaBundle"))), "html", null, true);
            echo "\"
                            >
                        ";
            // line 32
            if ( !$this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "image", array())) {
                // line 33
                echo "                            <i class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "option", array(0 => "class"), "method"), "html", null, true);
                echo "\"></i>
                        ";
            } else {
                // line 35
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "image", array())), "html", null, true);
                echo "\" style=\"max-height: 20px; max-width: 100px;\"/>
                            <br />
                        ";
            }
            // line 38
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "title", array()), array(), (($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array()), "SonataMediaBundle")) : ("SonataMediaBundle"))), "html", null, true);
            echo "
                    </a>
                </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 42
            echo "                <span class=\"alert alert-info\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_provider_available", array(), "SonataMediaBundle"), "html", null, true);
            echo "</span>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['provider'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "            <div class=\"clearfix\"></div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:select_provider.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 44,  95 => 42,  85 => 38,  78 => 35,  72 => 33,  70 => 32,  65 => 30,  58 => 26,  55 => 25,  50 => 24,  43 => 20,  38 => 17,  35 => 16,  29 => 14,  11 => 12,);
    }
}
