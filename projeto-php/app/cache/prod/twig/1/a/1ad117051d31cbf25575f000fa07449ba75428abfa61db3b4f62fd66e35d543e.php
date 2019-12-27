<?php

/* SonataUserBundle:Profile:edit_profile.html.twig */
class __TwigTemplate_1ad117051d31cbf25575f000fa07449ba75428abfa61db3b4f62fd66e35d543e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataUserBundle:Profile:action.html.twig", "SonataUserBundle:Profile:edit_profile.html.twig", 12);
        $this->blocks = array(
            'sonata_profile_title' => array($this, 'block_sonata_profile_title'),
            'sonata_profile_content' => array($this, 'block_sonata_profile_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle:Profile:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_sonata_profile_title($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_account", array(), "SonataUserBundle"), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_edit_profile", array(), "SonataUserBundle"), "html", null, true);
        echo "
";
    }

    // line 18
    public function block_sonata_profile_content($context, array $blocks = array())
    {
        // line 19
        echo "    ";
        // token for sonata_template_box, however the box is disabled
        // line 20
        echo "
    ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
        echo "

    ";
        // line 23
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : null), array(0 => $this));
        // line 24
        echo "
    <div class=\"panel panel-info\">
        <div class=\"panel-heading\">
            <h3 class=\"panel-title\">";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_account", array(), "SonataUserBundle"), "html", null, true);
        echo "</h3>
        </div>
        <div class=\"panel-body\">
            <form action=\"";
        // line 30
        echo $this->env->getExtension('routing')->getPath("sonata_user_profile_edit");
        echo "\" method=\"POST\" class=\"form-horizontal\">
                ";
        // line 31
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "
                <div class=\"form-actions\">
                    <button type=\"submit\" name=\"submit\"  class=\"btn btn-primary pull-right\">";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata_user_submit", array(), "SonataUserBundle"), "html", null, true);
        echo "</button>
                </div>
            </form>
        </div>
    </div>

    ";
        // line 39
        echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('routing')->getUrl("sonata_user_profile_edit_authentication"), array());
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:Profile:edit_profile.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 39,  77 => 33,  72 => 31,  68 => 30,  62 => 27,  57 => 24,  55 => 23,  50 => 21,  47 => 20,  44 => 19,  41 => 18,  32 => 15,  29 => 14,  11 => 12,);
    }
}
