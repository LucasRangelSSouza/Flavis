<?php

/* SonataMediaBundle:Provider:view_dailymotion.html.twig */
class __TwigTemplate_02280984d22324220adcf55c384c0e6ec5d53bbbfc94f59092a6945232e9fb16 extends Twig_Template
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
<object width=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "width", array()), "html", null, true);
        echo "\" height=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "height", array()), "html", null, true);
        echo "\">
    <param name=\"movie\" value=\"//www.dailymotion.com/swf/video/";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "providerreference", array()), "html", null, true);
        echo "?";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "html", null, true);
        echo "\"></param>
    <param name=\"allowFullScreen\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "allowFullScreen", array()), "html", null, true);
        echo "\"></param>
    <param name=\"allowScriptAccess\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "allowScriptAccess", array()), "html", null, true);
        echo "\"></param>

    <embed
        type=\"application/x-shockwave-flash\"
        src=\"//www.dailymotion.com/swf/video/";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "providerreference", array()), "html", null, true);
        echo "?";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "html", null, true);
        echo "\"
        width=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "width", array()), "html", null, true);
        echo "\"
        height=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "height", array()), "html", null, true);
        echo "\"
        allowfullscreen=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "allowFullScreen", array()), "html", null, true);
        echo "\"
        allowscriptaccess=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "allowScriptAccess", array()), "html", null, true);
        echo "\">
    </embed>
</object>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Provider:view_dailymotion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 23,  59 => 22,  55 => 21,  51 => 20,  45 => 19,  38 => 15,  34 => 14,  28 => 13,  22 => 12,  19 => 11,);
    }
}
