<?php

/* SonataMediaBundle:Block:block_gallery.html.twig */
class __TwigTemplate_2294e393c2d5a74a1976425af6fe08d6fffc34a831228fccd3f2df8bf849fd6f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        $this->parent = $this->loadTemplate("SonataBlockBundle:Block:block_base.html.twig", "SonataMediaBundle:Block:block_gallery.html.twig", 11);
        $this->blocks = array(
            'block' => array($this, 'block_block'),
            'element_indicator' => array($this, 'block_element_indicator'),
            'element_display' => array($this, 'block_element_display'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataBlockBundle:Block:block_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "format", array())) {
            // line 15
            echo "        ";
            if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array())) {
                // line 16
                echo "            <h3 class=\"sonata-media-block-media-title\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array()), "html", null, true);
                echo "</h3>
        ";
            }
            // line 18
            echo "
        ";
            // line 19
            // token for sonata_template_box, however the box is disabled
            // line 20
            echo "
        <div id=\"carousel-";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "id", array()), "html", null, true);
            echo "\" class=\"carousel slide sonata-media-block-gallery-container\"
             data-interval=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "pauseTime", array()), "html", null, true);
            echo "\"
             ";
            // line 23
            if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "startPaused", array()) != 1)) {
                echo "data-ride=\"carousel\"";
            }
            // line 24
            echo "                >

            <!-- Indicators -->
            <ol class=\"carousel-indicators\">
                ";
            // line 28
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["elements"]) ? $context["elements"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 29
                echo "                    ";
                $this->displayBlock("element_indicator", $context, $blocks);
                echo "
                ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "            </ol>

            <!-- Wrapper for slides -->
            <div class=\"carousel-inner\">
                ";
            // line 35
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["elements"]) ? $context["elements"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 36
                echo "                    ";
                $this->displayBlock("element_display", $context, $blocks);
                echo "
                ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "            </div>

            <!-- Controls -->
            <a class=\"left carousel-control\" href=\"#carousel-";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "id", array()), "html", null, true);
            echo "\" data-slide=\"prev\">
                <span class=\"glyphicon glyphicon-chevron-left\"></span>
            </a>
            <a class=\"right carousel-control\" href=\"#carousel-";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "id", array()), "html", null, true);
            echo "\" data-slide=\"next\">
                <span class=\"glyphicon glyphicon-chevron-right\"></span>
            </a>
        </div>
    ";
        }
    }

    // line 51
    public function block_element_indicator($context, array $blocks = array())
    {
        // line 52
        echo "    <li data-target=\"#carousel-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "id", array()), "html", null, true);
        echo "\" data-slide-to=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index0", array()), "html", null, true);
        echo "\"";
        if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first", array())) {
            echo " class=\"active\"";
        }
        echo "></li>
";
    }

    // line 55
    public function block_element_display($context, array $blocks = array())
    {
        // line 56
        echo "    <div class=\"item";
        if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first", array())) {
            echo " active";
        }
        echo "\">
        ";
        // line 57
        echo $this->env->getExtension('sonata_media')->media($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "media", array()), $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "format", array()), array());
        // line 58
        echo "        <div class=\"carousel-caption\">
            <h4>";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "title", array()), "html", null, true);
        echo "</h4>
            <p>";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "caption", array()), "html", null, true);
        echo "</p>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Block:block_gallery.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 60,  197 => 59,  194 => 58,  192 => 57,  185 => 56,  182 => 55,  169 => 52,  166 => 51,  156 => 44,  150 => 41,  145 => 38,  128 => 36,  111 => 35,  105 => 31,  88 => 29,  71 => 28,  65 => 24,  61 => 23,  57 => 22,  53 => 21,  50 => 20,  48 => 19,  45 => 18,  39 => 16,  36 => 15,  33 => 14,  30 => 13,  11 => 11,);
    }
}
