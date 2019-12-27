<?php

/* SimpleThingsEntityAuditBundle:Audit:compare.html.twig */
class __TwigTemplate_09db3e43c02cb666cb8d2cb21a051cac9dc7002f202d73e981192ba9a23ce563 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SimpleThingsEntityAuditBundle::layout.html.twig", "SimpleThingsEntityAuditBundle:Audit:compare.html.twig", 1);
        $this->blocks = array(
            'simplethings_entityaudit_content' => array($this, 'block_simplethings_entityaudit_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SimpleThingsEntityAuditBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 17
        $context["helper"] = $this;
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 19
    public function block_simplethings_entityaudit_content($context, array $blocks = array())
    {
        // line 20
        echo "<h1>Comparing ";
        echo twig_escape_filter($this->env, (isset($context["className"]) ? $context["className"] : null), "html", null, true);
        echo " with identifiers of ";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo " between revisions ";
        echo twig_escape_filter($this->env, (isset($context["oldRev"]) ? $context["oldRev"] : null), "html", null, true);
        echo " and ";
        echo twig_escape_filter($this->env, (isset($context["newRev"]) ? $context["newRev"] : null), "html", null, true);
        echo "</h1>

<table>
    <thead><tr>
        <th>Field</th>
        <th>Deleted</th>
        <th>Same</th>
        <th>Updated</th>
    </tr></thead>
    <tbody>
    ";
        // line 30
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["diff"]) ? $context["diff"] : null));
        foreach ($context['_seq'] as $context["field"] => $context["value"]) {
            // line 31
            echo "    <tr>
        <td>";
            // line 32
            echo twig_escape_filter($this->env, $context["field"], "html", null, true);
            echo "</td>
        <td>
            ";
            // line 34
            echo $context["helper"]->getshowValue($this->getAttribute($context["value"], "old", array()));
            echo "
        </td>
        <td>
            ";
            // line 37
            echo $context["helper"]->getshowValue($this->getAttribute($context["value"], "same", array()));
            echo "
        </td>
        <td>
            ";
            // line 40
            echo $context["helper"]->getshowValue($this->getAttribute($context["value"], "new", array()));
            echo "
        </td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['field'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "    </tbody>
</table>

";
    }

    // line 3
    public function getshowValue($__value__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "value" => $__value__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 4
            echo "    ";
            if ($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "timestamp", array(), "any", true, true)) {
                // line 5
                echo "        ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "m/d/Y"), "html", null, true);
                echo "
    ";
            } elseif (twig_test_iterable(            // line 6
(isset($context["value"]) ? $context["value"] : null))) {
                // line 7
                echo "        <ul>
        ";
                // line 8
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                    // line 9
                    echo "            <li>";
                    echo twig_escape_filter($this->env, $context["element"], "html", null, true);
                    echo "</li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 11
                echo "        </ul>
    ";
            } else {
                // line 13
                echo "        ";
                echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
                echo "
    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "SimpleThingsEntityAuditBundle:Audit:compare.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 13,  132 => 11,  123 => 9,  119 => 8,  116 => 7,  114 => 6,  109 => 5,  106 => 4,  95 => 3,  88 => 44,  78 => 40,  72 => 37,  66 => 34,  61 => 32,  58 => 31,  54 => 30,  34 => 20,  31 => 19,  27 => 1,  25 => 17,  11 => 1,);
    }
}
