<?php

/* FOSUserBundle::layout.html.twig */
class __TwigTemplate_eccd6aefeee37dddc7c60e1218869f29805b9f78c6882a904a7436775748a74d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div>
    ";
        // line 2
        $this->displayBlock('fos_user_content', $context, $blocks);
        // line 4
        echo "</div>";
    }

    // line 2
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 3
        echo "    ";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle::layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  32 => 3,  29 => 2,  25 => 4,  23 => 2,  20 => 1,);
    }
}
