<?php

/* AppBundle:Colaborador:list.html.twig */
class __TwigTemplate_478648a43f004768d65e5420c427bfe66a192b07dc6677aed2bf49629472cc29 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig", "AppBundle:Colaborador:list.html.twig", 1);
        $this->blocks = array(
            'table_body' => array($this, 'block_table_body'),
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

    // line 3
    public function block_table_body($context, array $blocks = array())
    {
        // line 4
        echo "    <tbody>
        ";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "results", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["object"]) {
            // line 6
            echo "            ";
            if (($this->getAttribute($context["object"], "status", array()) != "AT")) {
                // line 7
                echo "                <tr style=\"background: rgb(255, 140, 52);color:white;\">
                    ";
                // line 8
                $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "getTemplate", array(0 => "inner_list_row"), "method"), "AppBundle:Colaborador:list.html.twig", 8)->display($context);
                // line 9
                echo "                </tr>
            ";
            } else {
                // line 11
                echo "                <tr>
                    ";
                // line 12
                $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "getTemplate", array(0 => "inner_list_row"), "method"), "AppBundle:Colaborador:list.html.twig", 12)->display($context);
                // line 13
                echo "                </tr>
            ";
            }
            // line 15
            echo "        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['object'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "    </tbody>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Colaborador:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 16,  72 => 15,  68 => 13,  66 => 12,  63 => 11,  59 => 9,  57 => 8,  54 => 7,  51 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
