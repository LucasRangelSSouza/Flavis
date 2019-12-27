<?php

/* AppBundle:Cliente:telefone-list.html.twig */
class __TwigTemplate_d8a9eb518abec95c1f19551604b54b672ec6337c991195de1ddc70925c9290cb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Cliente:telefone-list.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        // line 4
        echo "
    <span>
    ";
        // line 6
        if (twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "telefones", array()))) {
            // line 7
            echo "        Nenhum Telefone cadastrado
    ";
        } else {
            // line 9
            echo "        ";
            $telefone = twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "telefones", array()), 0, array(), "array"), "numero", array()), "html", null, true);
             if(strlen($telefone)==11){
                 $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5)
                     . '-' . substr($telefone, 7);
             }
            if(strlen($telefone)==10){
                $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4)
                    . '-' . substr($telefone, 6);
            }
            echo $telefone;

            echo "
    ";
        }
        // line 11
        echo "    </span>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:Cliente:telefone-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 11,  41 => 9,  37 => 7,  35 => 6,  31 => 4,  28 => 3,  11 => 1,);
    }
}
