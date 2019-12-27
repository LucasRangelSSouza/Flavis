<?php

/* SonataMediaBundle:MediaAdmin:list.html.twig */
class __TwigTemplate_8a264d0dbf8e3d836ff9060414bab41dbb7817a9fdce02ad9b66e21597e8810d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig", "SonataMediaBundle:MediaAdmin:list.html.twig", 12);
        $this->blocks = array(
            'list_table' => array($this, 'block_list_table'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 14
        $context["tree"] = $this;
        // line 12
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 37
    public function block_list_table($context, array $blocks = array())
    {
        // line 38
        echo "    <div class=\"col-xs-6 col-md-3\">
        ";
        // line 39
        echo $context["tree"]->getnavigate_child(array(0 => (isset($context["root_category"]) ? $context["root_category"] : null)), (isset($context["admin"]) ? $context["admin"] : null), true, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "values", array()), "category", array(), "array"), "value", array(), "array"), 1);
        echo "
    </div>
    <div class=\"col-xs-12 col-md-9\">
        ";
        // line 42
        $this->displayParentBlock("list_table", $context, $blocks);
        echo "
    </div>
";
    }

    // line 15
    public function getnavigate_child($__collection__ = null, $__admin__ = null, $__root__ = null, $__current_category__ = null, $__depth__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "collection" => $__collection__,
            "admin" => $__admin__,
            "root" => $__root__,
            "current_category" => $__current_category__,
            "depth" => $__depth__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "    ";
            if (((isset($context["root"]) ? $context["root"] : null) && (twig_length_filter($this->env, (isset($context["collection"]) ? $context["collection"] : null)) == 0))) {
                // line 17
                echo "        <div>
            <p class=\"bg-warning\">";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => "warning_no_category", 1 => array(), 2 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "translationdomain", array())), "method"), "html", null, true);
                echo "</p>
        </div>
    ";
            }
            // line 21
            echo "    <ul";
            if ((isset($context["root"]) ? $context["root"] : null)) {
                echo " class=\"sonata-tree sonata-tree--small js-treeview sonata-tree--toggleable\"";
            }
            echo ">
        ";
            // line 22
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["collection"]) ? $context["collection"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 23
                echo "            <li>
                <div class=\"sonata-tree__item";
                // line 24
                if (($this->getAttribute($context["element"], "id", array()) == (isset($context["current_category"]) ? $context["current_category"] : null))) {
                    echo " is-active";
                }
                echo "\"";
                if (((isset($context["depth"]) ? $context["depth"] : null) < 2)) {
                    echo " data-treeview-toggled";
                }
                echo ">
                    ";
                // line 25
                if (($this->getAttribute($context["element"], "parent", array()) || (isset($context["root"]) ? $context["root"] : null))) {
                    echo "<i class=\"fa fa-caret-right\" data-treeview-toggler></i>";
                }
                // line 26
                echo "                    <a class=\"sonata-tree__item__edit\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("category" => $this->getAttribute($context["element"], "id", array())))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "name", array()), "html", null, true);
                echo "</a>
                </div>

                ";
                // line 29
                if (twig_length_filter($this->env, $this->getAttribute($context["element"], "children", array()))) {
                    // line 30
                    echo "                    ";
                    echo $this->getAttribute($this, "navigate_child", array(0 => $this->getAttribute($context["element"], "children", array()), 1 => (isset($context["admin"]) ? $context["admin"] : null), 2 => false, 3 => (isset($context["current_category"]) ? $context["current_category"] : null), 4 => ((isset($context["depth"]) ? $context["depth"] : null) + 1)), "method");
                    echo "
                ";
                }
                // line 32
                echo "            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
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
        return "SonataMediaBundle:MediaAdmin:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 34,  122 => 32,  116 => 30,  114 => 29,  105 => 26,  101 => 25,  91 => 24,  88 => 23,  84 => 22,  77 => 21,  71 => 18,  68 => 17,  65 => 16,  50 => 15,  43 => 42,  37 => 39,  34 => 38,  31 => 37,  27 => 12,  25 => 14,  11 => 12,);
    }
}
