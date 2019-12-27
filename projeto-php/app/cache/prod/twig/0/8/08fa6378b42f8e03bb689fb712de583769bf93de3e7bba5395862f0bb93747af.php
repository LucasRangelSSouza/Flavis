<?php

/* SonataAdminBundle:Menu:sonata_menu.html.twig */
class __TwigTemplate_08fa6378b42f8e03bb689fb712de583769bf93de3e7bba5395862f0bb93747af extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("knp_menu.html.twig", "SonataAdminBundle:Menu:sonata_menu.html.twig", 1);
        $this->blocks = array(
            'root' => array($this, 'block_root'),
            'item' => array($this, 'block_item'),
            'linkElement' => array($this, 'block_linkElement'),
            'spanElement' => array($this, 'block_spanElement'),
            'label' => array($this, 'block_label'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "knp_menu.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_root($context, array $blocks = array())
    {
        // line 4
        $context["listAttributes"] = twig_array_merge($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "childrenAttributes", array()), array("class" => "sidebar-menu"));
        // line 5
        $context["request"] = $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "request"), "method");
        // line 6
        echo "    ";
        $this->displayBlock("list", $context, $blocks);
    }

    // line 9
    public function block_item($context, array $blocks = array())
    {
        // line 10
        if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "displayed", array())) {
            // line 12
            $context["display"] = (twig_test_empty($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "roles"), "method")) || $this->env->getExtension('security')->isGranted("ROLE_SUPER_ADMIN"));
            // line 13
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "roles"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
                if ( !(isset($context["display"]) ? $context["display"] : null)) {
                    // line 14
                    $context["display"] = $this->env->getExtension('security')->isGranted($context["role"]);
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 18
        if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "displayed", array()) && ((array_key_exists("display", $context)) ? (_twig_default_filter((isset($context["display"]) ? $context["display"] : null))) : ("")))) {
            // line 19
            $context["active"] = false;
            // line 20
            if (( !twig_test_empty($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "active"), "method")) && $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "active"), "method"))) {
                // line 21
                $context["active"] = true;
            } elseif (((( !twig_test_empty($this->getAttribute(            // line 22
(isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "admin"), "method")) && $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "admin"), "method"), "hasroute", array(0 => "list"), "method")) && $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "admin"), "method"), "isGranted", array(0 => "LIST"), "method")) && ($this->getAttribute((isset($context["request"]) ? $context["request"] : null), "get", array(0 => "_sonata_admin"), "method") == $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "admin"), "method"), "code", array())))) {
                // line 23
                $context["active"] = true;
            } elseif (($this->getAttribute(            // line 24
(isset($context["item"]) ? $context["item"] : null), "route", array(), "any", true, true) && ($this->getAttribute((isset($context["request"]) ? $context["request"] : null), "get", array(0 => "_route"), "method") == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "route", array())))) {
                // line 25
                $context["active"] = true;
            } else {
                // line 27
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "children", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                    if ( !(isset($context["active"]) ? $context["active"] : null)) {
                        // line 28
                        if (((( !twig_test_empty($this->getAttribute($context["child"], "extra", array(0 => "admin"), "method")) && $this->getAttribute($this->getAttribute($context["child"], "extra", array(0 => "admin"), "method"), "hasroute", array(0 => "list"), "method")) && $this->getAttribute($this->getAttribute($context["child"], "extra", array(0 => "admin"), "method"), "isGranted", array(0 => "LIST"), "method")) && ($this->getAttribute((isset($context["request"]) ? $context["request"] : null), "get", array(0 => "_sonata_admin"), "method") == $this->getAttribute($this->getAttribute($context["child"], "extra", array(0 => "admin"), "method"), "code", array())))) {
                            // line 29
                            $context["active"] = true;
                        } elseif (($this->getAttribute(                        // line 30
$context["child"], "route", array(), "any", true, true) && ($this->getAttribute((isset($context["request"]) ? $context["request"] : null), "get", array(0 => "_route"), "method") == $this->getAttribute($context["child"], "route", array())))) {
                            // line 31
                            $context["active"] = true;
                        }
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 36
            if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "hasChildren", array())) {
                // line 37
                $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "setAttribute", array(0 => "class", 1 => trim(($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "attribute", array(0 => "class"), "method") . " treeview"))), "method");
            }
            // line 39
            if ((isset($context["active"]) ? $context["active"] : null)) {
                // line 40
                $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "setAttribute", array(0 => "class", 1 => trim(($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "attribute", array(0 => "class"), "method") . " active"))), "method");
                // line 41
                $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "setChildrenAttribute", array(0 => "class", 1 => trim(($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "childrenAttribute", array(0 => "class"), "method") . " active"))), "method");
            }
            // line 44
            $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "setChildrenAttribute", array(0 => "class", 1 => trim(($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "childrenAttribute", array(0 => "class"), "method") . " treeview-menu"))), "method");
            // line 45
            echo "        ";
            $this->displayParentBlock("item", $context, $blocks);
            echo "
    ";
        }
    }

    // line 49
    public function block_linkElement($context, array $blocks = array())
    {
        // line 50
        echo "    ";
        ob_start();
        // line 51
        echo "        ";
        $context["translation_domain"] = $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "translation_domain", 1 => "messages"), "method");
        // line 52
        echo "        ";
        $context["icon"] = (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "attribute", array(0 => "icon"), "method", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "attribute", array(0 => "icon"), "method"), ((($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "level", array()) > 1)) ? ("<i class=\"fa fa-angle-double-right\"></i>") : ("")))) : (((($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "level", array()) > 1)) ? ("<i class=\"fa fa-angle-double-right\"></i>") : (""))));
        // line 53
        echo "        ";
        $context["is_link"] = true;
        // line 54
        echo "        ";
        $this->displayParentBlock("linkElement", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 58
    public function block_spanElement($context, array $blocks = array())
    {
        // line 59
        echo "    ";
        ob_start();
        // line 60
        echo "        <a href=\"#\">
            ";
        // line 61
        $context["translation_domain"] = $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "label_catalogue"), "method");
        // line 62
        echo "            ";
        $context["icon"] = (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "icon"), "method", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "icon"), "method"), "")) : (""));
        // line 63
        echo "            ";
        echo (isset($context["icon"]) ? $context["icon"] : null);
        echo "
            ";
        // line 64
        $this->displayParentBlock("spanElement", $context, $blocks);
        echo "
            <i class=\"fa pull-right fa-angle-left\"></i>
        </a>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 70
    public function block_label($context, array $blocks = array())
    {
        if ((array_key_exists("is_link", $context) && (isset($context["is_link"]) ? $context["is_link"] : null))) {
            echo ((array_key_exists("icon", $context)) ? (_twig_default_filter((isset($context["icon"]) ? $context["icon"] : null))) : (""));
        }
        if (($this->getAttribute((isset($context["options"]) ? $context["options"] : null), "allow_safe_labels", array()) && $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extra", array(0 => "safe_label", 1 => false), "method"))) {
            echo $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "label", array());
        } else {
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "label", array()), array(), ((array_key_exists("translation_domain", $context)) ? (_twig_default_filter((isset($context["translation_domain"]) ? $context["translation_domain"] : null), "messages")) : ("messages"))), "html", null, true);
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Menu:sonata_menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 70,  165 => 64,  160 => 63,  157 => 62,  155 => 61,  152 => 60,  149 => 59,  146 => 58,  138 => 54,  135 => 53,  132 => 52,  129 => 51,  126 => 50,  123 => 49,  115 => 45,  113 => 44,  110 => 41,  108 => 40,  106 => 39,  103 => 37,  101 => 36,  92 => 31,  90 => 30,  88 => 29,  86 => 28,  81 => 27,  78 => 25,  76 => 24,  74 => 23,  72 => 22,  70 => 21,  68 => 20,  66 => 19,  64 => 18,  56 => 14,  51 => 13,  49 => 12,  47 => 10,  44 => 9,  39 => 6,  37 => 5,  35 => 4,  32 => 3,  11 => 1,);
    }
}
