<?php

/* SonataMediaBundle:Media:view.html.twig */
class __TwigTemplate_8d9a4b21c8b5aee612c0d4e7f32c39d051664a0f678abbdabcfbcc16c88a210f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_page_breadcrumb' => array($this, 'block_sonata_page_breadcrumb'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        // token for sonata_template_box, however the box is disabled
        // line 13
        echo "
";
        // line 14
        $this->displayBlock('sonata_page_breadcrumb', $context, $blocks);
        // line 19
        echo "
<h1>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "name", array()), "html", null, true);
        echo "</h1>

<div>
    ";
        // line 23
        echo $this->env->getExtension('sonata_media')->media((isset($context["media"]) ? $context["media"] : null), (isset($context["format"]) ? $context["format"] : null), array());
        // line 24
        echo "</div>

<h2>Information</h2>
<ul>
    <li>Size : ";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "size", array()), "html", null, true);
        echo "</li>
    <li>Width : ";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "width", array()), "html", null, true);
        echo "</li>
    <li>Height : ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "height", array()), "html", null, true);
        echo "</li>
    <li>Content Type : ";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "contenttype", array()), "html", null, true);
        echo "</li>
    <li>Copyright : ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "copyright", array()), "html", null, true);
        echo "</li>
    <li>Author name : ";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "authorname", array()), "html", null, true);
        echo "</li>
    <li>CDN : ";
        // line 34
        if ($this->getAttribute((isset($context["media"]) ? $context["media"] : null), "cdnisflushable", array())) {
            echo "to be flushed";
        } else {
            echo " last flush at ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "cdnflushat", array())), "html", null, true);
            echo " ";
        }
        echo "</li>
</ul>

<h2>Formats</h2>
<ul>
    <li><a href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_view", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["media"]) ? $context["media"] : null)), "format" => "reference")), "html", null, true);
        echo "\">reference</a></li>

    ";
        // line 41
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["formats"]) ? $context["formats"] : null));
        foreach ($context['_seq'] as $context["name"] => $context["format"]) {
            // line 42
            echo "        <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_view", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["media"]) ? $context["media"] : null)), "format" => $context["name"])), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['format'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "</ul>
";
    }

    // line 14
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        // line 15
        echo "    <div class=\"row-fluid clearfix\">
        ";
        // line 16
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "media_view", "media" => (isset($context["media"]) ? $context["media"] : null), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Media:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 16,  113 => 15,  110 => 14,  105 => 44,  94 => 42,  90 => 41,  85 => 39,  71 => 34,  67 => 33,  63 => 32,  59 => 31,  55 => 30,  51 => 29,  47 => 28,  41 => 24,  39 => 23,  33 => 20,  30 => 19,  28 => 14,  25 => 13,  23 => 12,  20 => 11,);
    }
}
