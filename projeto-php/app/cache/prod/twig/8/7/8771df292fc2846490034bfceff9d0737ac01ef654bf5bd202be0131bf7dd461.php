<?php

/* FOSUserBundle:Profile:show.html.twig */
class __TwigTemplate_8771df292fc2846490034bfceff9d0737ac01ef654bf5bd202be0131bf7dd461 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataUserBundle:Profile:action.html.twig", "FOSUserBundle:Profile:show.html.twig", 12);
        $this->blocks = array(
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
    public function block_sonata_profile_content($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        // token for sonata_template_box, however the box is disabled
        // line 16
        echo "
    <div class=\"row row-fluid\">
        ";
        // line 18
        $context["has_center"] = false;
        // line 19
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
            // line 20
            echo "            ";
            if (($this->getAttribute($context["block"], "position", array()) == "center")) {
                // line 21
                echo "                ";
                $context["has_center"] = true;
                // line 22
                echo "            ";
            }
            // line 23
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "
        <div class=\"";
        // line 25
        if ((isset($context["has_center"]) ? $context["has_center"] : null)) {
            echo "span4 col-lg-4";
        } else {
            echo "span6 col-lg-6";
        }
        echo "\">
            ";
        // line 26
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
            // line 27
            echo "                ";
            if (($this->getAttribute($context["block"], "position", array()) == "left")) {
                // line 28
                echo "                    ";
                echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
                echo "
                ";
            }
            // line 30
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "        </div>

        ";
        // line 33
        if ((isset($context["has_center"]) ? $context["has_center"] : null)) {
            // line 34
            echo "            <div class=\"span4 col-lg-4\">
                ";
            // line 35
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                // line 36
                echo "                    ";
                if (($this->getAttribute($context["block"], "position", array()) == "center")) {
                    // line 37
                    echo "                        ";
                    echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
                    echo "
                    ";
                }
                // line 39
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "            </div>
        ";
        }
        // line 42
        echo "
        <div class=\"";
        // line 43
        if ((isset($context["has_center"]) ? $context["has_center"] : null)) {
            echo "span4 col-lg-4";
        } else {
            echo "span6 col-lg-6";
        }
        echo "\">
            ";
        // line 44
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
            // line 45
            echo "                ";
            if (($this->getAttribute($context["block"], "position", array()) == "right")) {
                // line 46
                echo "                    ";
                echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
                echo "
                ";
            }
            // line 48
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 49,  146 => 48,  140 => 46,  137 => 45,  133 => 44,  125 => 43,  122 => 42,  118 => 40,  112 => 39,  106 => 37,  103 => 36,  99 => 35,  96 => 34,  94 => 33,  90 => 31,  84 => 30,  78 => 28,  75 => 27,  71 => 26,  63 => 25,  60 => 24,  54 => 23,  51 => 22,  48 => 21,  45 => 20,  40 => 19,  38 => 18,  34 => 16,  31 => 15,  28 => 14,  11 => 12,);
    }
}
