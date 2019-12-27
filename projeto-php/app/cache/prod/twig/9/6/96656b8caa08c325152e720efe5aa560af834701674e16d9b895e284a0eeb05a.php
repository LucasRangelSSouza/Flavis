<?php

/* SonataAdminBundle:Form/Type:sonata_type_model_autocomplete.html.twig */
class __TwigTemplate_96656b8caa08c325152e720efe5aa560af834701674e16d9b895e284a0eeb05a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_type_model_autocomplete_ajax_request_parameters' => array($this, 'block_sonata_type_model_autocomplete_ajax_request_parameters'),
            'sonata_type_model_autocomplete_dropdown_item_format' => array($this, 'block_sonata_type_model_autocomplete_dropdown_item_format'),
            'sonata_type_model_autocomplete_selection_format' => array($this, 'block_sonata_type_model_autocomplete_selection_format'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        ob_start();
        // line 12
        echo "
    <input type=\"text\" id=\"";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input\" value=\"\"";
        // line 14
        if ((isset($context["read_only"]) ? $context["read_only"] : null)) {
            echo " readonly=\"readonly\"";
        }
        // line 15
        if ((isset($context["disabled"]) ? $context["disabled"] : null)) {
            echo " disabled=\"disabled\"";
        }
        // line 16
        if ((isset($context["required"]) ? $context["required"] : null)) {
            echo " required=\"required\"";
        }
        // line 17
        echo "    />

    <div id=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_hidden_inputs_wrap\">
        ";
        // line 20
        if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
            // line 21
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
            foreach ($context['_seq'] as $context["idx"] => $context["val"]) {
                if ((($context["idx"] . "") != "_labels")) {
                    // line 22
                    echo "<input type=\"hidden\" name=\"";
                    echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
                    echo "[]\"";
                    if ((isset($context["disabled"]) ? $context["disabled"] : null)) {
                        echo " disabled=\"disabled\"";
                    }
                    echo " value=\"";
                    echo twig_escape_filter($this->env, $context["val"], "html", null, true);
                    echo "\">";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['idx'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 25
            echo "<input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
            echo "\"";
            if ((isset($context["disabled"]) ? $context["disabled"] : null)) {
                echo " disabled=\"disabled\"";
            }
            echo " value=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["value"]) ? $context["value"] : null), 0, array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["value"]) ? $context["value"] : null), 0, array(), "array"), "")) : ("")), "html", null, true);
            echo "\">
        ";
        }
        // line 27
        echo "</div>

    <script>
        (function (\$) {
            var autocompleteInput = \$('#";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input');
            autocompleteInput.select2({";
        // line 33
        $context["allowClearPlaceholder"] = ((( !(isset($context["multiple"]) ? $context["multiple"] : null) &&  !(isset($context["required"]) ? $context["required"] : null))) ? (" ") : (""));
        // line 34
        echo "placeholder: '";
        echo twig_escape_filter($this->env, (((isset($context["placeholder"]) ? $context["placeholder"] : null)) ? ((isset($context["placeholder"]) ? $context["placeholder"] : null)) : ((isset($context["allowClearPlaceholder"]) ? $context["allowClearPlaceholder"] : null))), "html", null, true);
        echo "', // allowClear needs placeholder to work properly
                allowClear: ";
        // line 35
        echo (((isset($context["required"]) ? $context["required"] : null)) ? ("false") : ("true"));
        echo ",
                enable: ";
        // line 36
        echo (((isset($context["disabled"]) ? $context["disabled"] : null)) ? ("false") : ("true"));
        echo ",
                readonly: ";
        // line 37
        echo (((isset($context["read_only"]) ? $context["read_only"] : null)) ? ("true") : ("false"));
        echo ",
                minimumInputLength: ";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["minimum_input_length"]) ? $context["minimum_input_length"] : null), "html", null, true);
        echo ",
                multiple: ";
        // line 39
        echo (((isset($context["multiple"]) ? $context["multiple"] : null)) ? ("true") : ("false"));
        echo ",
                width: '";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["width"]) ? $context["width"] : null), "html", null, true);
        echo "',
                dropdownAutoWidth: ";
        // line 41
        echo (((isset($context["dropdown_auto_width"]) ? $context["dropdown_auto_width"] : null)) ? ("true") : ("false"));
        echo ",
                containerCssClass: '";
        // line 42
        echo twig_escape_filter($this->env, ((isset($context["container_css_class"]) ? $context["container_css_class"] : null) . " form-control"), "html", null, true);
        echo "',
                dropdownCssClass: '";
        // line 43
        echo twig_escape_filter($this->env, (isset($context["dropdown_css_class"]) ? $context["dropdown_css_class"] : null), "html", null, true);
        echo "',
                ajax: {
                    url:  '";
        // line 45
        echo twig_escape_filter($this->env, (((isset($context["url"]) ? $context["url"] : null)) ? ((isset($context["url"]) ? $context["url"] : null)) : (twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getAttribute((isset($context["route"]) ? $context["route"] : null), "name", array()), (($this->getAttribute((isset($context["route"]) ? $context["route"] : null), "parameters", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["route"]) ? $context["route"] : null), "parameters", array()), array())) : (array()))), "js"))), "html", null, true);
        echo "',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term, page) { // page is the one-based page number tracked by Select2
                        ";
        // line 49
        $this->displayBlock('sonata_type_model_autocomplete_ajax_request_parameters', $context, $blocks);
        // line 84
        echo "                    },
                    results: function (data, page) {
                        // notice we return the value of more so Select2 knows if more results can be loaded
                        return {results: data.items, more: data.more};
                    }
                },
                formatResult: function (item) {
                    return ";
        // line 91
        $this->displayBlock('sonata_type_model_autocomplete_dropdown_item_format', $context, $blocks);
        echo ";// format of one dropdown item
                },
                formatSelection: function (item) {
                    return ";
        // line 94
        $this->displayBlock('sonata_type_model_autocomplete_selection_format', $context, $blocks);
        echo ";// format selected item '<b>'+item.label+'</b>';
                },
                escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
            });

            autocompleteInput.on('change', function(e) {

                // console.log('change '+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));

                // remove input
                if (undefined !== e.removed && null !== e.removed) {
                    var removedItems = e.removed;

                    ";
        // line 107
        if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
            // line 108
            echo "                        if(!\$.isArray(removedItems)) {
                            removedItems = [removedItems];
                        }

                        var length = removedItems.length;
                        for (var i = 0; i < length; i++) {
                            el = removedItems[i];
                            \$('#";
            // line 115
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap input:hidden[value=\"'+el.id+'\"]').remove();
                        }";
        } else {
            // line 118
            echo "\$('#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap input:hidden').val('');";
        }
        // line 120
        echo "                }

                // add new input
                var el = null;
                if (undefined !== e.added) {

                    var addedItems = e.added;

                    ";
        // line 128
        if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
            // line 129
            echo "                        if(!\$.isArray(addedItems)) {
                            addedItems = [addedItems];
                        }

                        var length = addedItems.length;
                        for (var i = 0; i < length; i++) {
                            el = addedItems[i];
                            \$('#";
            // line 136
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap').append('<input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
            echo "[]\" value=\"'+el.id+'\" />');
                        }";
        } else {
            // line 139
            echo "\$('#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap input:hidden').val(addedItems.id);";
        }
        // line 141
        echo "                }
            });

            // Initialise the autocomplete
            var data = [];";
        // line 147
        if ( !twig_test_empty((isset($context["value"]) ? $context["value"] : null))) {
            // line 148
            echo "data =";
            if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
                echo "[";
            }
            // line 149
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["idx"] => $context["val"]) {
                if ((($context["idx"] . "") != "_labels")) {
                    // line 150
                    if ( !$this->getAttribute($context["loop"], "first", array())) {
                        echo ", ";
                    }
                    // line 151
                    echo "{id: '";
                    echo twig_escape_filter($this->env, twig_escape_filter($this->env, $context["val"], "js"), "html", null, true);
                    echo "', label:'";
                    echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "_labels", array(), "array"), $context["idx"], array(), "array"), "js"), "html", null, true);
                    echo "'}";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['idx'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 153
            if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
                echo "]";
            }
            echo ";
            ";
        }
        // line 156
        echo "if (undefined==data.length || 0<data.length) { // Leave placeholder if no data set
                autocompleteInput.select2('data', data);
            }

            // remove unneeded autocomplete text input before form submit
            \$('#";
        // line 161
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input').closest('form').submit(function()
            {
                \$('#";
        // line 163
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input').remove();
                return true;
            });
        })(jQuery);
    </script>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 49
    public function block_sonata_type_model_autocomplete_ajax_request_parameters($context, array $blocks = array())
    {
        // line 50
        echo "                        return {
                                //search term
                                '";
        // line 52
        echo twig_escape_filter($this->env, (isset($context["req_param_name_search"]) ? $context["req_param_name_search"] : null), "html", null, true);
        echo "': term,

                                // page size
                                '";
        // line 55
        echo twig_escape_filter($this->env, (isset($context["req_param_name_items_per_page"]) ? $context["req_param_name_items_per_page"] : null), "html", null, true);
        echo "': ";
        echo twig_escape_filter($this->env, (isset($context["items_per_page"]) ? $context["items_per_page"] : null), "html", null, true);
        echo ",

                                // page number
                                '";
        // line 58
        echo twig_escape_filter($this->env, (isset($context["req_param_name_page_number"]) ? $context["req_param_name_page_number"] : null), "html", null, true);
        echo "': page,

                                // admin
                                ";
        // line 61
        if ( !(null === $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()))) {
            // line 62
            echo "                                    'uniqid': '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "uniqid", array()), "html", null, true);
            echo "',
                                    'admin_code': '";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "code", array()), "html", null, true);
            echo "',
                                ";
        } elseif (        // line 64
(isset($context["admin_code"]) ? $context["admin_code"] : null)) {
            // line 65
            echo "                                    'admin_code':  '";
            echo twig_escape_filter($this->env, (isset($context["admin_code"]) ? $context["admin_code"] : null), "html", null, true);
            echo "',
                                ";
        }
        // line 67
        echo "
                                ";
        // line 68
        if (((isset($context["context"]) ? $context["context"] : null) == "filter")) {
            // line 69
            echo "                                    'field':  '";
            echo twig_escape_filter($this->env, strtr((isset($context["full_name"]) ? $context["full_name"] : null), array("filter[" => "", "][value]" => "", "__" => ".")), "html", null, true);
            echo "',
                                    '_context': 'filter'
                                ";
        } else {
            // line 72
            echo "                                    'field':  '";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "'
                                ";
        }
        // line 74
        echo "
                                // other parameters
                                ";
        // line 76
        if ( !twig_test_empty((isset($context["req_params"]) ? $context["req_params"] : null))) {
            echo ",";
            // line 77
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["req_params"]) ? $context["req_params"] : null));
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
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                // line 78
                echo "'";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, $context["key"], "js"), "html", null, true);
                echo "': '";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, $context["value"], "js"), "html", null, true);
                echo "'";
                // line 79
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
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
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 82
        echo "                        };
                        ";
    }

    // line 91
    public function block_sonata_type_model_autocomplete_dropdown_item_format($context, array $blocks = array())
    {
        echo "'<div class=\"";
        echo twig_escape_filter($this->env, (isset($context["dropdown_item_css_class"]) ? $context["dropdown_item_css_class"] : null), "html", null, true);
        echo "\">'+item.label+'<\\/div>'";
    }

    // line 94
    public function block_sonata_type_model_autocomplete_selection_format($context, array $blocks = array())
    {
        echo "item.label";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Form/Type:sonata_type_model_autocomplete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  429 => 94,  421 => 91,  416 => 82,  399 => 79,  393 => 78,  376 => 77,  373 => 76,  369 => 74,  363 => 72,  356 => 69,  354 => 68,  351 => 67,  345 => 65,  343 => 64,  339 => 63,  334 => 62,  332 => 61,  326 => 58,  318 => 55,  312 => 52,  308 => 50,  305 => 49,  294 => 163,  289 => 161,  282 => 156,  275 => 153,  261 => 151,  257 => 150,  246 => 149,  241 => 148,  239 => 147,  233 => 141,  228 => 139,  221 => 136,  212 => 129,  210 => 128,  200 => 120,  195 => 118,  190 => 115,  181 => 108,  179 => 107,  163 => 94,  157 => 91,  148 => 84,  146 => 49,  139 => 45,  134 => 43,  130 => 42,  126 => 41,  122 => 40,  118 => 39,  114 => 38,  110 => 37,  106 => 36,  102 => 35,  97 => 34,  95 => 33,  91 => 31,  85 => 27,  73 => 25,  57 => 22,  52 => 21,  50 => 20,  46 => 19,  42 => 17,  38 => 16,  34 => 15,  30 => 14,  27 => 13,  24 => 12,  22 => 11,);
    }
}
