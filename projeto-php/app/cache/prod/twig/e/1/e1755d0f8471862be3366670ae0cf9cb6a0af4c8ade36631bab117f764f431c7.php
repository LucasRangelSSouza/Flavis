<?php

/* SonataAdminBundle:CRUD:tree.html.twig */
class __TwigTemplate_e1755d0f8471862be3366670ae0cf9cb6a0af4c8ade36631bab117f764f431c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 16
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig", "SonataAdminBundle:CRUD:tree.html.twig", 16);
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
        $this->loadTemplate("SonataAdminBundle:CRUD:list_tab_menu.html.twig", "SonataAdminBundle:CRUD:tree.html.twig", 41)->display(array("mode" => "tree", "action" =>         // line 43
(isset($context["action"]) ? $context["action"] : null), "admin" =>         // line 44
(isset($context["admin"]) ? $context["admin"] : null)));
    }

    // line 48
    public function block_list_table($context, array $blocks = array())
    {
        // line 49
        echo "    <div class=\"box box-primary\">
        <div class=\"box-header\">
            <h1 class=\"box-title\">
                ";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => "element.tree_site_label"), "method"), "html", null, true);
        echo "
                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                        <strong class=\"text-info\">";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["currentSite"]) ? $context["currentSite"] : null), "name", array()), "html", null, true);
        echo "</strong> <span class=\"caret\"></span>
                    </button>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        ";
        // line 58
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["contexts"]) ? $context["contexts"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["context"]) {
            // line 59
            echo "                            <li>
                                <a href=\"";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "tree", 1 => array("context" => $this->getAttribute($context["context"], "id", array()))), "method"), "html", null, true);
            echo "\">
                                    ";
            // line 61
            if (((isset($context["currentContext"]) ? $context["currentContext"] : null) && ($this->getAttribute($context["context"], "id", array()) == $this->getAttribute((isset($context["currentContext"]) ? $context["currentContext"] : null), "id", array())))) {
                // line 62
                echo "                                        <span class=\"pull-right\">
                                            <i class=\"fa fa-check\"></i>
                                        </span>
                                    ";
            }
            // line 66
            echo "                                    ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["site"]) ? $context["site"] : null), "name", array()), "html", null, true);
            echo "
                                </a>
                            </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['context'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "                    </ul>
                </div>
            </h1>
        </div>
        <div class=\"box-content\">
            ";
        // line 75
        echo $context["tree"]->getnavigate_child((isset($context["collection"]) ? $context["collection"] : null), (isset($context["admin"]) ? $context["admin"] : null), true);
        echo "
        </div>
    </div>
";
    }

    // line 19
    public function getnavigate_child($__collection__ = null, $__admin__ = null, $__root__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "collection" => $__collection__,
            "admin" => $__admin__,
            "root" => $__root__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 20
            echo "    <ul";
            if ((isset($context["root"]) ? $context["root"] : null)) {
                echo " class=\"sonata-tree\"";
            }
            echo ">
        ";
            // line 21
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["collection"]) ? $context["collection"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                if ( !(isset($context["root"]) ? $context["root"] : null)) {
                    // line 22
                    echo "            <li>
                <div class=\"sonata-tree__item\">
                    ";
                    // line 24
                    if ($this->getAttribute($context["element"], "parent", array())) {
                        echo "<i class=\"fa fa-caret-right\"></i>";
                    }
                    // line 25
                    echo "                    <i class=\"fa fa-code\"></i>
                    <a class=\"sonata-tree__item__edit\" href=\"";
                    // line 26
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "edit", 1 => $context["element"]), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "name", array()), "html", null, true);
                    echo "</a>
                    <i class=\"text-muted\">";
                    // line 27
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "description", array()), "html", null, true);
                    echo "</i>
                    <a class=\"label label-default pull-right\" href=\"";
                    // line 28
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "edit", 1 => $context["element"]), "method"), "html", null, true);
                    echo "\">edit <i class=\"fa fa-magic\"></i></a>
                    ";
                    // line 29
                    if (true) {
                        echo "<span class=\"label label-warning pull-right\">true</span>";
                    }
                    // line 30
                    echo "                </div>

                ";
                    // line 32
                    if (twig_length_filter($this->env, $this->getAttribute($context["element"], "children", array()))) {
                        // line 33
                        echo "                    ";
                        echo $this->getAttribute($this, "navigate_child", array(0 => $this->getAttribute($context["element"], "children", array()), 1 => (isset($context["admin"]) ? $context["admin"] : null), 2 => false), "method");
                        echo "
                ";
                    }
                    // line 35
                    echo "            </li>
        ";
                }
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
        return "SonataAdminBundle:CRUD:tree.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  181 => 37,  173 => 35,  167 => 33,  165 => 32,  161 => 30,  157 => 29,  153 => 28,  149 => 27,  143 => 26,  140 => 25,  136 => 24,  132 => 22,  127 => 21,  120 => 20,  107 => 19,  99 => 75,  92 => 70,  81 => 66,  75 => 62,  73 => 61,  69 => 60,  66 => 59,  62 => 58,  56 => 55,  50 => 52,  45 => 49,  42 => 48,  38 => 44,  37 => 43,  35 => 41,  32 => 40,  28 => 16,  26 => 18,  11 => 16,);
    }
}
