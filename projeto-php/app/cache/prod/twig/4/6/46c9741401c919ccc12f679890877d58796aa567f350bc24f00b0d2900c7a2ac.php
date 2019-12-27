<?php

/* AppBundle:Custom:custom_one_one_to_many.html.twig */
class __TwigTemplate_46c9741401c919ccc12f679890877d58796aa567f350bc24f00b0d2900c7a2ac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_admin_orm_one_to_many_widget' => array($this, 'block_sonata_admin_orm_one_to_many_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('sonata_admin_orm_one_to_many_widget', $context, $blocks);
    }

    public function block_sonata_admin_orm_one_to_many_widget($context, array $blocks = array())
    {
        // line 2
        echo "
    ";
        // line 3
        if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "hasassociationadmin", array())) {
            // line 4
            echo "
        <div id=\"field_container_";
            // line 5
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"field-container\">
        <span id=\"field_widget_";
            // line 6
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" >
        <div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
            ";
            // line 8
            if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "edit", array()) == "inline")) {
                // line 9
                echo "                ";
                if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "inline", array()) == "table")) {
                    // line 10
                    echo "                    ";
                    if ((twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())) > 0)) {
                        // line 11
                        echo "
                            ";
                        // line 12
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
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
                        foreach ($context['_seq'] as $context["nested_group_field_name"] => $context["nested_group_field"]) {
                            // line 13
                            echo "                                <div class=\"panel panel-default container-row-form-custom-many-to-many\">
                                    <div class=\"panel-heading\" role=\"tab\" id=\"heading_";
                            // line 14
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\">
                                        <h4 class=\"panel-title\">
                                            <a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\"
                                               href=\"#collapse_";
                            // line 17
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\" aria-expanded=\"true\"
                                               aria-controls=\"collapse_";
                            // line 18
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\">
                                                ";
                            // line 19
                            $context["titleLine"] = "titulo";
                            // line 20
                            echo "                                                <i class=\"fa fa-chevron-down\" aria-hidden=\"true\"></i>

                                                ";
                            // line 22
                            $context["tituloLine"] = $this->getAttribute($this->getAttribute($context["nested_group_field"], "vars", array()), "value", array());
                            // line 23
                            echo "
                                                ";
                            // line 24
                            if (((isset($context["tituloLine"]) ? $context["tituloLine"] : null) == "-")) {
                                // line 25
                                echo "                                                    <label style=\"color: #0000ff;\">Conclua o cadastro deste registro!</label>
                                                ";
                            } else {
                                // line 27
                                echo "                                                    <label>";
                                echo twig_escape_filter($this->env, (isset($context["tituloLine"]) ? $context["tituloLine"] : null), "html", null, true);
                                echo "</label>
                                                ";
                            }
                            // line 29
                            echo "                                            </a>

                                            <button type=\"button\" class=\"btn btn-sm btn-danger pull-right bt-deletar-row-form-custom-many-to-many\"
                                                    style=\"margin-top: -4px;margin-right: -9px;\"><i class=\"fa fa-minus-circle\"></i> Deletar</button>

                                        </h4>
                                    </div>
                                    <div id=\"collapse_";
                            // line 36
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\" class=\"panel-collapse collapse\"
                                         role=\"tabpanel\" aria-labelledby=\"heading_";
                            // line 37
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\">
                                        <div class=\"panel-body\">
                                            ";
                            // line 39
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["nested_group_field"], "children", array()));
                            foreach ($context['_seq'] as $context["field_name"] => $context["nested_field"]) {
                                // line 40
                                echo "                                                ";
                                // line 41
                                echo "
                                                ";
                                // line 42
                                if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "associationadmin", array(), "any", false, true), "hasformfielddescriptions", array(0 => $context["field_name"]), "method", true, true)) {
                                    // line 43
                                    echo "
                                                    <div class=\"row\" style=\"margin-bottom: 10px;\">
                                                        <div class=\"col-md-12\">
                                                            ";
                                    // line 46
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'label');
                                    echo "<br/>
                                                            ";
                                    // line 47
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'widget');
                                    echo "
                                                        </div>
                                                    </div>

                                                    ";
                                    // line 51
                                    $context["dummy"] = $this->getAttribute($context["nested_group_field"], "setrendered", array());
                                    // line 52
                                    echo "
                                                ";
                                } else {
                                    // line 54
                                    echo "                                                    <div class=\"row\" style=\"margin-bottom: 10px;\">
                                                        <div class=\"col-md-12\">
                                                            ";
                                    // line 56
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'label');
                                    echo "<br/>
                                                            ";
                                    // line 57
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'widget');
                                    echo "
                                                        </div>
                                                    </div>
                                                ";
                                }
                                // line 61
                                echo "                                                <div class=\"help-inline sonata-ba-field-error-messages\"></div>
                                                ";
                                // line 62
                                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "errors", array())) > 0)) {
                                    // line 63
                                    echo "                                                    <div class=\"help-inline sonata-ba-field-error-messages\">
                                                        ";
                                    // line 64
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'errors');
                                    echo "
                                                    </div>
                                                ";
                                }
                                // line 67
                                echo "
                                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['field_name'], $context['nested_field'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 69
                            echo "                                        </div>
                                    </div>
                                </div>

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
                        unset($context['_seq'], $context['_iterated'], $context['nested_group_field_name'], $context['nested_group_field'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 74
                        echo "
                    ";
                    }
                    // line 76
                    echo "                ";
                } elseif ((twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())) > 0)) {
                    // line 77
                    echo "                    <div>
                        ";
                    // line 78
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
                    foreach ($context['_seq'] as $context["nested_group_field_name"] => $context["nested_group_field"]) {
                        // line 79
                        echo "                            ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["nested_group_field"], "children", array()));
                        foreach ($context['_seq'] as $context["field_name"] => $context["nested_field"]) {
                            // line 80
                            echo "                                ";
                            if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "associationadmin", array(), "any", false, true), "hasformfielddescriptions", array(0 => $context["field_name"]), "method", true, true)) {
                                // line 81
                                echo "                                    ";
                                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'row', array("inline" => "natural", "edit" => "inline"));
                                // line 84
                                echo "
                                    ";
                                // line 85
                                $context["dummy"] = $this->getAttribute($context["nested_group_field"], "setrendered", array());
                                // line 86
                                echo "                                ";
                            } else {
                                // line 87
                                echo "                                    ";
                                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'row');
                                echo "
                                ";
                            }
                            // line 89
                            echo "                            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['field_name'], $context['nested_field'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 90
                        echo "                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['nested_group_field_name'], $context['nested_group_field'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 91
                    echo "                    </div>
                ";
                }
                // line 93
                echo "            ";
            } else {
                // line 94
                echo "                ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
                echo "
            ";
            }
            // line 96
            echo "
        </span>

            ";
            // line 99
            if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "edit", array()) == "inline")) {
                // line 100
                echo "
                ";
                // line 101
                if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "hasroute", array(0 => "create"), "method") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "CREATE"), "method")) && (isset($context["btn_add"]) ? $context["btn_add"] : null))) {
                    // line 102
                    echo "                    <span id=\"field_actions_";
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "\" >
                    <a
                            href=\"";
                    // line 104
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "generateUrl", array(0 => "create", 1 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")), "method"), "html", null, true);
                    echo "\"
                            onclick=\"return start_field_retrieve_";
                    // line 105
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "(this);\"
                            class=\"btn btn-success btn-sm sonata-ba-action\"
                            title=\"";
                    // line 107
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "\"
                            >
                        <i class=\"fa fa-plus-circle\"></i>
                        ";
                    // line 110
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "
                    </a>
                </span>
                ";
                }
                // line 114
                echo "
                ";
                // line 116
                echo "                ";
                $this->loadTemplate("SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig", "AppBundle:Custom:custom_one_one_to_many.html.twig", 116)->display($context);
                // line 117
                echo "
            ";
            } else {
                // line 119
                echo "                <div id=\"field_container_";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" class=\"field-container\">
                <span id=\"field_widget_";
                // line 120
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" >
                    ";
                // line 121
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
                echo "
                </span>

                <span id=\"field_actions_";
                // line 124
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" class=\"field-actions\">
                    ";
                // line 125
                if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "hasRoute", array(0 => "create"), "method") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "CREATE"), "method")) && (isset($context["btn_add"]) ? $context["btn_add"] : null))) {
                    // line 126
                    echo "                        <a
                                href=\"";
                    // line 127
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "generateUrl", array(0 => "create", 1 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")), "method"), "html", null, true);
                    echo "\"
                                onclick=\"return start_field_dialog_form_add_";
                    // line 128
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "(this);\"
                                class=\"btn btn-success btn-sm sonata-ba-action\"
                                title=\"";
                    // line 130
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "\"
                                >
                            <i class=\"fa fa-plus-circle\"></i>
                            ";
                    // line 133
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "
                        </a>
                    ";
                }
                // line 136
                echo "                </span>

                    ";
                // line 138
                $this->loadTemplate("SonataDoctrineORMAdminBundle:CRUD:edit_modal.html.twig", "AppBundle:Custom:custom_one_one_to_many.html.twig", 138)->display($context);
                // line 139
                echo "                </div>

                ";
                // line 151
                echo "

                ";
                // line 158
                echo "
                ";
                // line 160
                echo "
                ";
                // line 161
                $context["associationadmin"] = $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array());
                // line 162
                echo "
                <!-- edit many association -->

                <script type=\"text/javascript\">

                ";
                // line 172
                echo "
                var field_dialog_form_list_link_";
                // line 173
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " = function(event) {
                    initialize_popup_";
                // line 174
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                    var target = jQuery(this);

                    // return if the link is an anchor inside the same page
                    if (this.nodeName == 'A' && (target.attr('href').length == 0 || target.attr('href')[0] == '#')) {
                        Admin.log('[";
                // line 180
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_link] element is an anchor, skipping action', this);
                        return;
                    }

                    event.preventDefault();
                    event.stopPropagation();

                    Admin.log('[";
                // line 187
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_link] handle link click in a list');

                    var element = jQuery(this).parents('#field_dialog_";
                // line 189
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " .sonata-ba-list-field');

                    // the user does not click on a row column
                    if (element.length == 0) {
                        Admin.log('[";
                // line 193
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_link] the user does not click on a row column, make ajax call to retrieve inner html');
                        // make a recursive call (ie: reset the filter)
                        jQuery.ajax({
                            type: 'GET',
                            url: jQuery(this).attr('href'),
                            dataType: 'html',
                            success: function(html) {
                                Admin.log('[";
                // line 200
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_link] callback success, attach valid js event');

                                field_dialog_content_";
                // line 202
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(html);
                                field_dialog_form_list_handle_action_";
                // line 203
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                                Admin.shared_setup(field_dialog_";
                // line 205
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                            }
                        });

                        return;
                    }

                    Admin.log('[";
                // line 212
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_link] the user select one element, update input and hide the modal');

                    jQuery('#";
                // line 214
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "').val(element.attr('objectId'));
                    jQuery('#";
                // line 215
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "').trigger('change');

                    field_dialog_";
                // line 217
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".modal('hide');
                };

                // this function handle action on the modal list when inside a selected list
                var field_dialog_form_list_handle_action_";
                // line 221
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "  =  function() {
                    Admin.log('[";
                // line 222
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_handle_action] attaching valid js event');

                    // capture the submit event to make an ajax call, ie : POST data to the
                    // related create admin
                    jQuery('a', field_dialog_";
                // line 226
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ").on('click', field_dialog_form_list_link_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                    jQuery('form', field_dialog_";
                // line 227
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ").on('submit', function(event) {
                        event.preventDefault();

                        var form = jQuery(this);

                        Admin.log('[";
                // line 232
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_handle_action] catching submit event, sending ajax request');

                        jQuery(form).ajaxSubmit({
                            type: form.attr('method'),
                            url: form.attr('action'),
                            dataType: 'html',
                            data: {_xml_http_request: true},
                            success: function(html) {

                                Admin.log('[";
                // line 241
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list_handle_action] form submit success, restoring event');

                                field_dialog_content_";
                // line 243
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(html);
                                field_dialog_form_list_handle_action_";
                // line 244
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                                Admin.shared_setup(field_dialog_";
                // line 246
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                            }
                        });
                    });
                };

                // handle the list link
                var field_dialog_form_list_";
                // line 253
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " = function(event) {

                    initialize_popup_";
                // line 255
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                    event.preventDefault();
                    event.stopPropagation();

                    Admin.log('[";
                // line 260
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list] open the list modal');

                    var a = jQuery(this);

                    field_dialog_content_";
                // line 264
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html('');

                    // retrieve the form element from the related admin generator
                    jQuery.ajax({
                        url: a.attr('href'),
                        dataType: 'html',
                        success: function(html) {

                            Admin.log('[";
                // line 272
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_list] retrieving the list content');

                            // populate the popup container
                            field_dialog_content_";
                // line 275
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(html);

                            field_dialog_title_";
                // line 277
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(\"";
                echo $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : null), "label", array()), array(), $this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : null), "translationdomain", array()));
                echo "\");

                            Admin.shared_setup(field_dialog_";
                // line 279
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");

                            field_dialog_form_list_handle_action_";
                // line 281
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                            // open the dialog in modal mode
                            field_dialog_";
                // line 284
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".modal();

                            Admin.setup_list_modal(field_dialog_";
                // line 286
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                        }
                    });
                };

                // handle the add link
                var field_dialog_form_add_";
                // line 292
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " = function(event) {
                    initialize_popup_";
                // line 293
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                    event.preventDefault();
                    event.stopPropagation();

                    var a = jQuery(this);

                    field_dialog_content_";
                // line 300
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html('');

                    Admin.log('[";
                // line 302
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_add] add link action');

                    // retrieve the form element from the related admin generator
                    jQuery.ajax({
                        url: a.attr('href'),
                        dataType: 'html',
                        success: function(html) {

                            Admin.log('[";
                // line 310
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_add] ajax success', field_dialog_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");

                            // populate the popup container
                            field_dialog_content_";
                // line 313
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(html);
                            field_dialog_title_";
                // line 314
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(\"";
                echo $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : null), "label", array()), array(), $this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : null), "translationdomain", array()));
                echo "\");

                            Admin.shared_setup(field_dialog_";
                // line 316
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");

                            // capture the submit event to make an ajax call, ie : POST data to the
                            // related create admin
                            jQuery('a', field_dialog_";
                // line 320
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ").on('click', field_dialog_form_action_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                            jQuery('form', field_dialog_";
                // line 321
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ").on('submit', field_dialog_form_action_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");

                            // open the dialog in modal mode
                            field_dialog_";
                // line 324
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".modal();

                            Admin.setup_list_modal(field_dialog_";
                // line 326
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                        }
                    });
                };

                // handle the post data
                var field_dialog_form_action_";
                // line 332
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " = function(event) {

                    var element = jQuery(this);

                    // return if the link is an anchor inside the same page
                    if (this.nodeName == 'A' && (element.attr('href').length == 0 || element.attr('href')[0] == '#')) {
                        Admin.log('[";
                // line 338
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_action] element is an anchor, skipping action', this);
                        return;
                    }

                    event.preventDefault();
                    event.stopPropagation();

                    Admin.log('[";
                // line 345
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_action] action catch', this);

                    initialize_popup_";
                // line 347
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                    if (this.nodeName == 'FORM') {
                        var url  = element.attr('action');
                        var type = element.attr('method');
                    } else if (this.nodeName == 'A') {
                        var url  = element.attr('href');
                        var type = 'GET';
                    } else {
                        alert('unexpected element : @' + this.nodeName + '@');
                        return;
                    }

                    if (element.hasClass('sonata-ba-action')) {
                        Admin.log('[";
                // line 361
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_action] reserved action stop catch all events');
                        return;
                    }

                    var data = {
                        _xml_http_request: true
                    }

                    var form = jQuery(this);

                    Admin.log('[";
                // line 371
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_action] execute ajax call');

                    // the ajax post
                    jQuery(form).ajaxSubmit({
                        url: url,
                        type: type,
                        data: data,
                        success: function(data) {
                            Admin.log('[";
                // line 379
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog_form_action] ajax success');

                            // if the crud action return ok, then the element has been added
                            // so the widget container must be refresh with the last option available
                            if (typeof data != 'string' && data.result == 'ok') {
                                field_dialog_";
                // line 384
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".modal('hide');

                                ";
                // line 386
                if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "edit", array()) == "list")) {
                    // line 387
                    echo "                                ";
                    // line 391
                    echo "                                jQuery('#";
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').val(data.objectId);
                                jQuery('#";
                    // line 392
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').change();

                                ";
                } else {
                    // line 395
                    echo "
                                // reload the form element
                                jQuery('#field_widget_";
                    // line 397
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').closest('form').ajaxSubmit({
                                    url: '";
                    // line 398
                    echo $this->env->getExtension('routing')->getPath("sonata_admin_retrieve_form_element", array("elementId" =>                     // line 399
(isset($context["id"]) ? $context["id"] : null), "subclass" => $this->getAttribute($this->getAttribute(                    // line 400
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "getActiveSubclassCode", array(), "method"), "objectId" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 401
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "id", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "subject", array())), "method"), "uniqid" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 402
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "uniqid", array()), "code" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 403
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "code", array())));
                    // line 404
                    echo "',
                                    data: {_xml_http_request: true },
                                    dataType: 'html',
                                    type: 'POST',
                                    success: function(html) {
                                        jQuery('#field_container_";
                    // line 409
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').replaceWith(html);
                                        var newElement = jQuery('#";
                    // line 410
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo " [value=\"' + data.objectId + '\"]');
                                        if (newElement.is(\"input\")) {
                                            newElement.attr('checked', 'checked');
                                        } else {
                                            newElement.attr('selected', 'selected');
                                        }

                                        jQuery('#field_container_";
                    // line 417
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').trigger('sonata-admin-append-form-element');
                                    }
                                });

                                ";
                }
                // line 422
                echo "
                                return;
                            }

                            // otherwise, display form error
                            field_dialog_content_";
                // line 427
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ".html(data);

                            Admin.shared_setup(field_dialog_";
                // line 429
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");

                            // reattach the event
                            jQuery('form', field_dialog_";
                // line 432
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ").submit(field_dialog_form_action_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                        }
                    });

                    return false;
                };

                var field_dialog_";
                // line 439
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "         = false;
                var field_dialog_content_";
                // line 440
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " = false;
                var field_dialog_title_";
                // line 441
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "   = false;

                function initialize_popup_";
                // line 443
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "() {
                    // initialize component
                    if (!field_dialog_";
                // line 445
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ") {
                        field_dialog_";
                // line 446
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "         = jQuery(\"#field_dialog_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "\");
                        field_dialog_content_";
                // line 447
                echo (isset($context["id"]) ? $context["id"] : null);
                echo " = jQuery(\".modal-body\", \"#field_dialog_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "\");
                        field_dialog_title_";
                // line 448
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "   = jQuery(\".modal-title\", \"#field_dialog_";
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "\");

                        // move the dialog as a child of the root element, nested form breaks html ...
                        jQuery(document.body).append(field_dialog_";
                // line 451
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");

                        Admin.log('[";
                // line 453
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "|field_dialog] move dialog container as a document child');
                    }
                }

                ";
                // line 460
                echo "                // this function initialize the popup
                // this can be only done this way has popup can be cascaded
                function start_field_dialog_form_add_";
                // line 462
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "(link) {

                    // remove the html event
                    link.onclick = null;

                    initialize_popup_";
                // line 467
                echo (isset($context["id"]) ? $context["id"] : null);
                echo "();

                    // add the jQuery event to the a element
                    jQuery(link)
                            .click(field_dialog_form_add_";
                // line 471
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ")
                            .trigger('click')
                    ;

                    return false;
                }

                if (field_dialog_";
                // line 478
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ") {
                    Admin.shared_setup(field_dialog_";
                // line 479
                echo (isset($context["id"]) ? $context["id"] : null);
                echo ");
                }

                ";
                // line 482
                if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "edit", array()) == "list")) {
                    // line 483
                    echo "                ";
                    // line 486
                    echo "                // this function initialize the popup
                // this can be only done this way has popup can be cascaded
                function start_field_dialog_form_list_";
                    // line 488
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "(link) {

                    link.onclick = null;

                    initialize_popup_";
                    // line 492
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "();

                    // add the jQuery event to the a element
                    jQuery(link)
                            .click(field_dialog_form_list_";
                    // line 496
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo ")
                            .trigger('click')
                    ;

                    return false;
                }

                function remove_selected_element_";
                    // line 503
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "(link) {

                    link.onclick = null;

                    jQuery(link)
                            .click(field_remove_element_";
                    // line 508
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo ")
                            .trigger('click')
                    ;

                    return false;
                }

                function field_remove_element_";
                    // line 515
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "(event) {
                    event.preventDefault();

                    if (jQuery('#";
                    // line 518
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo " option').get(0)) {
                        jQuery('#";
                    // line 519
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').attr('selectedIndex', '-1').children(\"option:selected\").attr(\"selected\", false);
                    }

                    jQuery('#";
                    // line 522
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').val('');
                    jQuery('#";
                    // line 523
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').trigger('change');

                    return false;
                }
                ";
                    // line 530
                    echo "
                // update the label
                jQuery('#";
                    // line 532
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').on('change', function(event) {

                    Admin.log('[";
                    // line 534
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "|on:change] update the label');

                    jQuery('#field_widget_";
                    // line 536
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').html(\"<span><img src=\\\"";
                    echo $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/ajax-loader.gif");
                    echo "\\\" style=\\\"vertical-align: middle; margin-right: 10px\\\"/>";
                    echo $this->env->getExtension('translator')->trans("loading_information", array(), "SonataAdminBundle");
                    echo "</span>\");
                    jQuery.ajax({
                        type: 'GET',
                        url: '";
                    // line 539
                    echo $this->env->getExtension('routing')->getPath("sonata_admin_short_object_information", array("objectId" => "OBJECT_ID", "uniqid" => $this->getAttribute(                    // line 541
(isset($context["associationadmin"]) ? $context["associationadmin"] : null), "uniqid", array()), "code" => $this->getAttribute(                    // line 542
(isset($context["associationadmin"]) ? $context["associationadmin"] : null), "code", array()), "linkParameters" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 543
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "link_parameters", array())));
                    // line 544
                    echo "'.replace('OBJECT_ID', jQuery(this).val()),
                        dataType: 'html',
                        success: function(html) {
                            jQuery('#field_widget_";
                    // line 547
                    echo (isset($context["id"]) ? $context["id"] : null);
                    echo "').html(html);
                        }
                    });
                });

                ";
                }
                // line 553
                echo "

                </script>
                <!-- / edit many association -->

                ";
                // line 559
                echo "
            ";
            }
            // line 561
            echo "        </div>
        </div>
    ";
        }
        // line 564
        echo "
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Custom:custom_one_one_to_many.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  1122 => 564,  1117 => 561,  1113 => 559,  1106 => 553,  1097 => 547,  1092 => 544,  1090 => 543,  1089 => 542,  1088 => 541,  1087 => 539,  1077 => 536,  1072 => 534,  1067 => 532,  1063 => 530,  1056 => 523,  1052 => 522,  1046 => 519,  1042 => 518,  1036 => 515,  1026 => 508,  1018 => 503,  1008 => 496,  1001 => 492,  994 => 488,  990 => 486,  988 => 483,  986 => 482,  980 => 479,  976 => 478,  966 => 471,  959 => 467,  951 => 462,  947 => 460,  940 => 453,  935 => 451,  927 => 448,  921 => 447,  915 => 446,  911 => 445,  906 => 443,  901 => 441,  897 => 440,  893 => 439,  881 => 432,  875 => 429,  870 => 427,  863 => 422,  855 => 417,  845 => 410,  841 => 409,  834 => 404,  832 => 403,  831 => 402,  830 => 401,  829 => 400,  828 => 399,  827 => 398,  823 => 397,  819 => 395,  813 => 392,  808 => 391,  806 => 387,  804 => 386,  799 => 384,  791 => 379,  780 => 371,  767 => 361,  750 => 347,  745 => 345,  735 => 338,  726 => 332,  717 => 326,  712 => 324,  704 => 321,  698 => 320,  691 => 316,  684 => 314,  680 => 313,  672 => 310,  661 => 302,  656 => 300,  646 => 293,  642 => 292,  633 => 286,  628 => 284,  622 => 281,  617 => 279,  610 => 277,  605 => 275,  599 => 272,  588 => 264,  581 => 260,  573 => 255,  568 => 253,  558 => 246,  553 => 244,  549 => 243,  544 => 241,  532 => 232,  524 => 227,  518 => 226,  511 => 222,  507 => 221,  500 => 217,  495 => 215,  491 => 214,  486 => 212,  476 => 205,  471 => 203,  467 => 202,  462 => 200,  452 => 193,  445 => 189,  440 => 187,  430 => 180,  421 => 174,  417 => 173,  414 => 172,  407 => 162,  405 => 161,  402 => 160,  399 => 158,  395 => 151,  391 => 139,  389 => 138,  385 => 136,  379 => 133,  373 => 130,  368 => 128,  364 => 127,  361 => 126,  359 => 125,  355 => 124,  349 => 121,  345 => 120,  340 => 119,  336 => 117,  333 => 116,  330 => 114,  323 => 110,  317 => 107,  312 => 105,  308 => 104,  302 => 102,  300 => 101,  297 => 100,  295 => 99,  290 => 96,  284 => 94,  281 => 93,  277 => 91,  271 => 90,  265 => 89,  259 => 87,  256 => 86,  254 => 85,  251 => 84,  248 => 81,  245 => 80,  240 => 79,  236 => 78,  233 => 77,  230 => 76,  226 => 74,  208 => 69,  201 => 67,  195 => 64,  192 => 63,  190 => 62,  187 => 61,  180 => 57,  176 => 56,  172 => 54,  168 => 52,  166 => 51,  159 => 47,  155 => 46,  150 => 43,  148 => 42,  145 => 41,  143 => 40,  139 => 39,  132 => 37,  126 => 36,  117 => 29,  111 => 27,  107 => 25,  105 => 24,  102 => 23,  100 => 22,  96 => 20,  94 => 19,  88 => 18,  82 => 17,  74 => 14,  71 => 13,  54 => 12,  51 => 11,  48 => 10,  45 => 9,  43 => 8,  38 => 6,  34 => 5,  31 => 4,  29 => 3,  26 => 2,  20 => 1,);
    }
}
