<?php

/* SonataClassificationBundle:CategoryAdmin:list.html.twig */
class __TwigTemplate_4525441967dd59f0faafb71e94d8c1e85360e94b9dd995025d7ca3f6cab5c785 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig", "SonataClassificationBundle:CategoryAdmin:list.html.twig", 12);
        $this->blocks = array(
            'tab_menu' => array($this, 'block_tab_menu'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->loadTemplate("SonataClassificationBundle:CategoryAdmin:list_tab_menu.html.twig", "SonataClassificationBundle:CategoryAdmin:list.html.twig", 15)->display(array("mode" => "list", "action" =>         // line 17
(isset($context["action"]) ? $context["action"] : null), "admin" =>         // line 18
(isset($context["admin"]) ? $context["admin"] : null)));
    }

    public function getTemplateName()
    {
        return "SonataClassificationBundle:CategoryAdmin:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 18,  33 => 17,  31 => 15,  28 => 14,  11 => 12,);
    }
}
