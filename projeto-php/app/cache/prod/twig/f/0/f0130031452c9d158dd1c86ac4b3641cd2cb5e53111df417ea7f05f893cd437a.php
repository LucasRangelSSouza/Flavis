<?php

/* SonataMediaBundle:Form:foto_media_widgets.html.twig */
class __TwigTemplate_f0130031452c9d158dd1c86ac4b3641cd2cb5e53111df417ea7f05f893cd437a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_media_type_widget' => array($this, 'block_sonata_media_type_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('sonata_media_type_widget', $context, $blocks);
    }

    public function block_sonata_media_type_widget($context, array $blocks = array())
    {
        // line 2
        echo "    <div class=\"row\">
        <div class=\"col-md-3 pull-left\">
            ";
        // line 4
        if (( !twig_test_empty((isset($context["value"]) ? $context["value"] : null)) && $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "providerReference", array()))) {
            // line 5
            echo "                <div class=\"pull-left\" style=\"margin-right: 5px\">
                    ";
            // line 6
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["value"]) ? $context["value"] : null), "admin", array("class" => "img-polaroid media-object"));
            // line 7
            echo "                </div>

                ";
            // line 9
            if ((array_key_exists("sonata_admin_enabled", $context) && (isset($context["sonata_admin_enabled"]) ? $context["sonata_admin_enabled"] : null))) {
                // line 10
                echo "                    <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "getConfigurationPool", array(), "method"), "adminByAdminCode", array(0 => "sonata.media.admin.media"), "method"), "generateObjectUrl", array(0 => "edit", 1 => (isset($context["value"]) ? $context["value"] : null)), "method"), "html", null, true);
                echo "\"><strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "name", array()), "html", null, true);
                echo "</strong></a>
                ";
            } else {
                // line 12
                echo "                    <strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "name", array()), "html", null, true);
                echo "</strong>
                ";
            }
            // line 14
            echo "                <br />
                <span type=\"label\">";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "providerName", array()), array(), "SonataMediaBundle"), "html", null, true);
            echo "</span> ~ ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "context", array()), "html", null, true);
            echo "
            ";
        } else {
            // line 17
            echo "                <div class=\"pull-left\" style=\"margin-right: 5px\">
                    <img src=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamedia/grey.png"), "html", null, true);
            echo "\" class=\"img-polaroid media-object\" style=\"width: 85px; height: 85px\"/>
                </div>
                <strong>";
            // line 20
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_linked_media", array(), "SonataMediaBundle"), "html", null, true);
            echo "</strong> <br />
                <span type=\"label\">";
            // line 21
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "provider", array(), "array"), array(), "SonataMediaBundle"), "html", null, true);
            echo " ~ ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "context", array(), "array"), array(), "SonataMediaBundle"), "html", null, true);
            echo "</span>
            ";
        }
        // line 23
        echo "        </div>

        <div class=\"col-md-3 pull-left\">
            ";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_media", array(), "SonataMediaBundle"), "html", null, true);
        echo "
            ";
        // line 27
        $this->displayBlock("form_widget", $context, $blocks);
        echo "
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Form:foto_media_widgets.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  95 => 27,  91 => 26,  86 => 23,  79 => 21,  75 => 20,  70 => 18,  67 => 17,  60 => 15,  57 => 14,  51 => 12,  43 => 10,  41 => 9,  37 => 7,  35 => 6,  32 => 5,  30 => 4,  26 => 2,  20 => 1,);
    }
}
