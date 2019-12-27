<?php

/* SonataAdminBundle:CRUD:base_acl_macro.html.twig */
class __TwigTemplate_6936c2f624ca8a56a761adbdd902bda06278c7a3010b1ba00187773e5ce9f1ea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
    }

    // line 12
    public function getrender_form($__form__ = null, $__permissions__ = null, $__td_type__ = null, $__admin__ = null, $__admin_pool__ = null, $__object__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "form" => $__form__,
            "permissions" => $__permissions__,
            "td_type" => $__td_type__,
            "admin" => $__admin__,
            "admin_pool" => $__admin_pool__,
            "object" => $__object__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 13
            echo "    <form class=\"form-horizontal\"
          action=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "acl", 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "id", array(0 => (isset($context["object"]) ? $context["object"] : null)), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uniqid", array()), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'enctype');
            echo "
          method=\"POST\"
            ";
            // line 16
            if ( !$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getOption", array(0 => "html5_validate"), "method")) {
                echo "novalidate=\"novalidate\"";
            }
            // line 17
            echo "            >
        ";
            // line 18
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "errors", array())) > 0)) {
                // line 19
                echo "            <div class=\"sonata-ba-form-error\">
                ";
                // line 20
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
                echo "
            </div>
        ";
            }
            // line 23
            echo "
        <div class=\"box box-success\">
            <div class=\"body table-responsive no-padding\">
                <table class=\"table\">
                    <colgroup>
                        <col style=\"width: 100%;\"/>
                        ";
            // line 29
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                // line 30
                echo "                            <col/>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "                    </colgroup>

                    ";
            // line 34
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                if (($this->getAttribute($this->getAttribute($context["child"], "vars", array()), "name", array()) != "_token")) {
                    // line 35
                    echo "                        ";
                    if ((($this->getAttribute($context["loop"], "index0", array()) == 0) || (($this->getAttribute($context["loop"], "index0", array()) % 10) == 0))) {
                        // line 36
                        echo "                            <tr>
                                <th>";
                        // line 37
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["td_type"]) ? $context["td_type"] : null), array(), "SonataAdminBundle"), "html", null, true);
                        echo "</th>
                                ";
                        // line 38
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                            // line 39
                            echo "                                    <th class=\"text-right\">";
                            echo twig_escape_filter($this->env, $context["permission"], "html", null, true);
                            echo "</th>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 41
                        echo "                            </tr>
                        ";
                    }
                    // line 43
                    echo "
                        <tr>
                            <td>
                                ";
                    // line 46
                    $context["typeChild"] = (($this->getAttribute($context["child"], "role", array(), "array", true, true)) ? ($this->getAttribute($context["child"], "role", array(), "array")) : ($this->getAttribute($context["child"], "user", array(), "array")));
                    // line 47
                    echo "                                ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["typeChild"]) ? $context["typeChild"] : null), "vars", array()), "value", array()), "html", null, true);
                    echo "
                                ";
                    // line 48
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["typeChild"]) ? $context["typeChild"] : null), 'widget');
                    echo "
                            </td>
                            ";
                    // line 50
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                        // line 51
                        echo "                                <td class=\"text-right\">";
                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["child"], $context["permission"], array(), "array"), 'widget', array("label" => false));
                        echo "</td>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 53
                    echo "                        </tr>
                    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "                </table>
            </div>
        </div>

        ";
            // line 59
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'row');
            echo "

        <div class=\"well well-small form-actions\">
            <input class=\"btn btn-primary\" type=\"submit\" name=\"btn_create_and_edit\" value=\"";
            // line 62
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_acl", array(), "SonataAdminBundle"), "html", null, true);
            echo "\">
        </div>
    </form>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_acl_macro.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 62,  176 => 59,  170 => 55,  159 => 53,  150 => 51,  146 => 50,  141 => 48,  136 => 47,  134 => 46,  129 => 43,  125 => 41,  116 => 39,  112 => 38,  108 => 37,  105 => 36,  102 => 35,  91 => 34,  87 => 32,  80 => 30,  76 => 29,  68 => 23,  62 => 20,  59 => 19,  57 => 18,  54 => 17,  50 => 16,  43 => 14,  40 => 13,  24 => 12,  19 => 11,);
    }
}
