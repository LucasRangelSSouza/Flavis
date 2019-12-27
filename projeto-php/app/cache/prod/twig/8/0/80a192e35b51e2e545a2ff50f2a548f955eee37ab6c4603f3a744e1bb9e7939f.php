<?php

/* SonataMediaBundle:Provider:view_youtube.html.twig */
class __TwigTemplate_80a192e35b51e2e545a2ff50f2a548f955eee37ab6c4603f3a744e1bb9e7939f extends Twig_Template
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
";
        // line 12
        if ($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "html5", array())) {
            // line 13
            echo "    <iframe width=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "width", array()), "html", null, true);
            echo "\" height=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "height", array()), "html", null, true);
            echo "\" src=\"//www.youtube.com/embed/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "providerreference", array()), "html", null, true);
            echo "?";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_url_parameters", array()), "html", null, true);
            echo "\" frameborder=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "border", array()), "html", null, true);
            echo "\"";
            if ($this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "allowFullScreen", array())) {
                echo " allowfullscreen";
            }
            echo "></iframe>
";
        } else {
            // line 15
            echo "    ";
            if ($this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "allowFullScreen", array())) {
                // line 16
                echo "        ";
                $context["allowFullScreen"] = "true";
                // line 17
                echo "    ";
            } else {
                // line 18
                echo "        ";
                $context["allowFullScreen"] = "false";
                // line 19
                echo "    ";
            }
            // line 20
            echo "    <object width=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "width", array()), "html", null, true);
            echo "\" height=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "height", array()), "html", null, true);
            echo "\">
        <param name=\"movie\" value=\"//www.youtube.com/v/";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "providerreference", array()), "html", null, true);
            echo "?";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_url_parameters", array()), "html", null, true);
            echo "\"></param>
        <param name=\"allowFullScreen\" value=\"";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["allowFullScreen"]) ? $context["allowFullScreen"] : null), "html", null, true);
            echo "\"></param>
        <param name=\"allowscriptaccess\" value=\"";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "allowScriptAccess", array()), "html", null, true);
            echo "\"></param>
        <param name=\"wmode\" value=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "wmode", array()), "html", null, true);
            echo "\">

        <embed
            src=\"//www.youtube.com/v/";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "providerreference", array()), "html", null, true);
            echo "?";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_url_parameters", array()), "html", null, true);
            echo "\"
            type=\"application/x-shockwave-flash\"
            allowscriptaccess=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "allowScriptAccess", array()), "html", null, true);
            echo "\"
            allowfullscreen=\"";
            // line 30
            echo twig_escape_filter($this->env, (isset($context["allowFullScreen"]) ? $context["allowFullScreen"] : null), "html", null, true);
            echo "\"
            width=\"";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "width", array()), "html", null, true);
            echo "\"
            height=\"";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "height", array()), "html", null, true);
            echo "\"
            wmode=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "player_parameters", array()), "wmode", array()), "html", null, true);
            echo "\">
        </embed>
    </object>
";
        }
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Provider:view_youtube.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 33,  103 => 32,  99 => 31,  95 => 30,  91 => 29,  84 => 27,  78 => 24,  74 => 23,  70 => 22,  64 => 21,  57 => 20,  54 => 19,  51 => 18,  48 => 17,  45 => 16,  42 => 15,  24 => 13,  22 => 12,  19 => 11,);
    }
}
