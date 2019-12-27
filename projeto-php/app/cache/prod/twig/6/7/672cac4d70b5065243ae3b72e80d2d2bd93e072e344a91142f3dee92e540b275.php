<?php

/* SonataClassificationBundle:CategoryAdmin:tree.html.twig */
class __TwigTemplate_672cac4d70b5065243ae3b72e80d2d2bd93e072e344a91142f3dee92e540b275 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 16
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig", "SonataClassificationBundle:CategoryAdmin:tree.html.twig", 16);
        $this->blocks = array(
            'tab_menu' => array($this, 'block_tab_menu'),
            'list_table' => array($this, 'block_list_table'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 18
        $context["tree"] = $this;
        // line 16
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 40
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 41
        echo "    ";
        $this->loadTemplate("SonataClassificationBundle:CategoryAdmin:list_tab_menu.html.twig", "SonataClassificationBundle:CategoryAdmin:tree.html.twig", 41)->display(array("mode" => "tree", "action" =>         // line 43
(isset($context["action"]) ? $context["action"] : null), "admin" =>         // line 44
(isset($context["admin"]) ? $context["admin"] : null)));
    }

    // line 48
    public function block_list_table($context, array $blocks = array())
    {
        // line 49
        echo "    <div class=\"col-xs-12 col-md-12\">
        <div class=\"box box-primary\">
            <div class=\"box-header\">
                <h1 class=\"box-title\">
                    ";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => "tree_catalog_title", 1 => array(), 2 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "translationdomain", array())), "method"), "html", null, true);
        echo "
                    ";
        // line 54
        if ( !$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "hide_context"), "method")) {
            // line 55
            echo "                        <div class=\"btn-group\">
                            <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                <strong class=\"text-info\">";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["current_context"]) ? $context["current_context"] : null), "name", array()), "html", null, true);
            echo "</strong> <span class=\"caret\"></span>
                            </button>
                            <ul class=\"dropdown-menu\" role=\"menu\">
                                ";
            // line 60
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["root_categories"]) ? $context["root_categories"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 61
                echo "                                    <li>
                                        <a href=\"";
                // line 62
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "tree", 1 => array("context" => $this->getAttribute($this->getAttribute($context["category"], "context", array()), "id", array()))), "method"), "html", null, true);
                echo "\">
                                            ";
                // line 63
                if (((isset($context["current_context"]) ? $context["current_context"] : null) && ($this->getAttribute($this->getAttribute($context["category"], "context", array()), "id", array()) == $this->getAttribute((isset($context["current_context"]) ? $context["current_context"] : null), "id", array())))) {
                    // line 64
                    echo "                                                <span class=\"pull-right\">
                                                    <i class=\"fa fa-check\"></i>
                                                </span>
                                            ";
                }
                // line 68
                echo "                                            ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
                echo "
                                        </a>
                                    </li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "                            </ul>
                        </div>
                    ";
        }
        // line 75
        echo "                </h1>
            </div>
            <div class=\"box-content\">
                ";
        // line 78
        echo $context["tree"]->getnavigate_child(array(0 => (isset($context["main_category"]) ? $context["main_category"] : null)), (isset($context["admin"]) ? $context["admin"] : null), true, 0);
        echo "
            </div>
        </div>
    </div>
";
    }

    // line 19
    public function getnavigate_child($__collection__ = null, $__admin__ = null, $__root__ = null, $__depth__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "collection" => $__collection__,
            "admin" => $__admin__,
            "root" => $__root__,
            "depth" => $__depth__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 20
            echo "    <ul";
            if ((isset($context["root"]) ? $context["root"] : null)) {
                echo " class=\"sonata-tree sonata-tree--toggleable js-treeview\"";
            }
            echo ">
        ";
            // line 21
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["collection"]) ? $context["collection"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 22
                echo "            <li class=\"sonata-ba-list-field\" objectId=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "id", array()), "html", null, true);
                echo "\" >
                <div class=\"sonata-tree__item\"";
                // line 23
                if (((isset($context["depth"]) ? $context["depth"] : null) < 2)) {
                    echo " data-treeview-toggled";
                }
                echo ">
                    ";
                // line 24
                if (($this->getAttribute($context["element"], "parent", array()) || (isset($context["root"]) ? $context["root"] : null))) {
                    echo "<i class=\"fa fa-caret-right\" data-treeview-toggler></i>";
                }
                // line 25
                echo "                    <a class=\"sonata-tree__item__edit\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "edit", 1 => $context["element"]), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "name", array()), "html", null, true);
                echo "</a>
                    <i class=\"text-muted\">";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "description", array()), "html", null, true);
                echo "</i>
                    ";
                // line 28
                echo "                    ";
                if ($this->getAttribute($context["element"], "enabled", array())) {
                    echo "<span class=\"label label-success pull-right\"><i class=\"fa fa-check\"></i> ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => "active", 1 => array(), 2 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "translationDomain", array())), "method"), "html", null, true);
                    echo "</span>";
                }
                // line 29
                echo "                    ";
                if ( !$this->getAttribute($context["element"], "enabled", array())) {
                    echo "<span class=\"label label-danger pull-right\"><i class=\"fa fa-times\"> ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => "disabled", 1 => array(), 2 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "translationDomain", array())), "method"), "html", null, true);
                    echo "</i></span>";
                }
                // line 30
                echo "                </div>

                ";
                // line 32
                if (twig_length_filter($this->env, $this->getAttribute($context["element"], "children", array()))) {
                    // line 33
                    echo "                    ";
                    echo $this->getAttribute($this, "navigate_child", array(0 => $this->getAttribute($context["element"], "children", array()), 1 => (isset($context["admin"]) ? $context["admin"] : null), 2 => false, 3 => ((isset($context["depth"]) ? $context["depth"] : null) + 1)), "method");
                    echo "
                ";
                }
                // line 35
                echo "            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "    </ul>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "SonataClassificationBundle:CategoryAdmin:tree.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 37,  193 => 35,  187 => 33,  185 => 32,  181 => 30,  174 => 29,  167 => 28,  163 => 26,  156 => 25,  152 => 24,  146 => 23,  141 => 22,  137 => 21,  130 => 20,  116 => 19,  107 => 78,  102 => 75,  97 => 72,  86 => 68,  80 => 64,  78 => 63,  74 => 62,  71 => 61,  67 => 60,  61 => 57,  57 => 55,  55 => 54,  51 => 53,  45 => 49,  42 => 48,  38 => 44,  37 => 43,  35 => 41,  32 => 40,  28 => 16,  26 => 18,  11 => 16,);
    }
}
