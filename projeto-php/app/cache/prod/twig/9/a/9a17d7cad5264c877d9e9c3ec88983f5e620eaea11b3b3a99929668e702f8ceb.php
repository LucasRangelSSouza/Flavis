<?php

/* AppBundle:Form:depend_combo_fields.html.twig */
class __TwigTemplate_9a17d7cad5264c877d9e9c3ec88983f5e620eaea11b3b3a99929668e702f8ceb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'shtumi_select2_entity_widget' => array($this, 'block_shtumi_select2_entity_widget'),
            'shtumi_ajax_autocomplete_widget' => array($this, 'block_shtumi_ajax_autocomplete_widget'),
            'shtumi_dependent_filtered_entity_widget' => array($this, 'block_shtumi_dependent_filtered_entity_widget'),
            'shtumi_dependent_filtered_select2_widget' => array($this, 'block_shtumi_dependent_filtered_select2_widget'),
            'shtumi_daterange_widget' => array($this, 'block_shtumi_daterange_widget'),
            'shtumi_ajaxfile_widget' => array($this, 'block_shtumi_ajaxfile_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('shtumi_select2_entity_widget', $context, $blocks);
        // line 30
        echo "
";
        // line 31
        $this->displayBlock('shtumi_ajax_autocomplete_widget', $context, $blocks);
        // line 97
        echo "

";
        // line 99
        $this->displayBlock('shtumi_dependent_filtered_entity_widget', $context, $blocks);
        // line 149
        echo "
";
        // line 150
        $this->displayBlock('shtumi_dependent_filtered_select2_widget', $context, $blocks);
        // line 184
        echo "

";
        // line 186
        $this->displayBlock('shtumi_daterange_widget', $context, $blocks);
        // line 205
        echo "

";
        // line 207
        $this->displayBlock('shtumi_ajaxfile_widget', $context, $blocks);
    }

    // line 1
    public function block_shtumi_select2_entity_widget($context, array $blocks = array())
    {
        // line 2
        echo "
    <script>
        jQuery(function() {
            jQuery(\"#";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").select2({
                minimumInputLength: 0,
                ajax: {
                    url: '";
        // line 8
        echo $this->env->getExtension('routing')->getPath("shtumi_select2_entity");
        echo "',
                    dataType: 'json',
                    data: function (term, page) {
                        return {
                            entity_alias: \"";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["entity_alias"]) ? $context["entity_alias"] : null), "html", null, true);
        echo "\",
                            term: term,
                            maxRows: 20,
                            page: page
                        };
                    },
                    results: function (data, page) {
                        return {results: data};
                    }
                }
            });
            jQuery(\"#";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").select2('data', ";
        echo (isset($context["value"]) ? $context["value"] : null);
        echo ");
        });
    </script>

    ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "

";
    }

    // line 31
    public function block_shtumi_ajax_autocomplete_widget($context, array $blocks = array())
    {
        // line 32
        echo "
    <script type=\"text/javascript\">
        if (typeof jQuery.ui == 'undefined'){
            jQuery.getScript('";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/shtumiuseful/js/jqueryui/jquery-ui-1.10.1.custom.min.js"), "html", null, true);
        echo "');
        }

    </script>

    <script>
        jQuery(function() {
            jQuery(\"body\").bind(\"DOMSubtreeModified\", function() {
                jQuery( \"#";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\"  ).autocomplete({
                    source: function( request, response ) {
                        jQuery.ajax({
                            url: \"";
        // line 46
        echo $this->env->getExtension('routing')->getPath("shtumi_ajaxautocomplete");
        echo "\",
                            dataType: \"json\",
                            data: {
                                maxRows: 12,
                                letters: request.term,
                                entity_alias: \"";
        // line 51
        echo twig_escape_filter($this->env, (isset($context["entity_alias"]) ? $context["entity_alias"] : null), "html", null, true);
        echo "\"
                            },
                            success: function( data ) {
                                response( jQuery.map( data, function( item ) {
                                    return {
                                        label: item,
                                        value: item
                                    }
                                }));
                            }
                        });
                    },
                    minLength: 2,
                    open: function() {
                        jQuery( this ).removeClass( \"ui-corner-all\" ).addClass( \"ui-corner-top\" );
                    },
                    close: function() {
                        jQuery( this ).removeClass( \"ui-corner-top\" ).addClass( \"ui-corner-all\" );
                    }
                });
            });

        });
    </script>

    <style>
        .ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
        }
        /* IE 6 doesn't support max-height
         * we use height instead, but this forces the menu to always be this tall
         */
        * html .ui-autocomplete {
            height: 100px;
        }
    </style>


    ";
        // line 94
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "

";
    }

    // line 99
    public function block_shtumi_dependent_filtered_entity_widget($context, array $blocks = array())
    {
        // line 100
        echo "
    <select ";
        // line 101
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo "></select>

    <img src='";
        // line 103
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/images/ajax-loader.gif"), "html", null, true);
        echo "' id='loader' style='display: none;'>
    <script type=\"text/javascript\">
        jQuery(function(){

            jQuery(\"select#";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "offsetGet", array(0 => (isset($context["parent_field"]) ? $context["parent_field"] : null)), "method"), "vars", array()), "id", array()), "html", null, true);
        echo "\").change( function() {

                if(jQuery(this).val()!=''){

                     var selected_index = ";
        // line 111
        echo twig_escape_filter($this->env, (((isset($context["value"]) ? $context["value"] : null)) ? ((isset($context["value"]) ? $context["value"] : null)) : (0)), "html", null, true);
        echo ";
                     jQuery(\"#loader\").show();
                     jQuery.ajax({
                     type: \"POST\",
                     data: {
                         parent_id: jQuery(this).val(),
                         entity_alias: \"";
        // line 117
        echo twig_escape_filter($this->env, (isset($context["entity_alias"]) ? $context["entity_alias"] : null), "html", null, true);
        echo "\",
                         empty_value: \"";
        // line 118
        echo twig_escape_filter($this->env, (isset($context["empty_value"]) ? $context["empty_value"] : null), "html", null, true);
        echo "\"
                     },
                     url:\"";
        // line 120
        echo $this->env->getExtension('routing')->getPath("shtumi_dependent_filtered_entity");
        echo "\",
                     success: function(msg){
                         if (msg != ''){
                         jQuery(\"select#";
        // line 123
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").html(msg).show();
                         jQuery.each(jQuery(\"select#";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo " option\"), function (index, option){
                         if (jQuery(option).val() == selected_index)
                         jQuery(option).prop('selected', true);
                     })
                     jQuery(\"select#";
        // line 128
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").trigger('change');
                     jQuery(\"#loader\").hide();
                     } else {
                     jQuery(\"select#";
        // line 131
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").html('<em>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["no_result_msg"]) ? $context["no_result_msg"] : null)), "html", null, true);
        echo "</em>');
                     jQuery(\"#loader\").hide();
                     }
                     },
                     error: function(xhr, ajaxOptions, thrownError){
                     jQuery('html').html(xhr.responseText);
                     }
                     });

                }
            });

            jQuery(\"select#";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "offsetGet", array(0 => (isset($context["parent_field"]) ? $context["parent_field"] : null)), "method"), "vars", array()), "id", array()), "html", null, true);
        echo "\").trigger('change');

        });
    </script>

";
    }

    // line 150
    public function block_shtumi_dependent_filtered_select2_widget($context, array $blocks = array())
    {
        // line 151
        echo "
    <input ";
        // line 152
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " />

    <script type=\"text/javascript\">
        jQuery(function(){

            jQuery(\"#";
        // line 157
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").select2({
                placeholder: \"";
        // line 158
        echo twig_escape_filter($this->env, (isset($context["empty_value"]) ? $context["empty_value"] : null), "html", null, true);
        echo "\",
                minimumInputLength: 0,
                ajax: {
                    url: '";
        // line 161
        echo $this->env->getExtension('routing')->getPath("shtumi_dependent_filtered_select2");
        echo "',
                    dataType: 'json',
                    data: function (term, page) {
                        return {
                            term: term,
                            parent_id: jQuery(\"#";
        // line 166
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "offsetGet", array(0 => (isset($context["parent_field"]) ? $context["parent_field"] : null)), "method"), "vars", array()), "id", array()), "html", null, true);
        echo "\").val(),
                            entity_alias: \"";
        // line 167
        echo twig_escape_filter($this->env, (isset($context["entity_alias"]) ? $context["entity_alias"] : null), "html", null, true);
        echo "\"
                        };
                    },
                    results: function (data, page) {
                        return {results: data};
                    }
                }
            });
            jQuery(\"#";
        // line 175
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").select2('data', ";
        echo (isset($context["value"]) ? $context["value"] : null);
        echo ");

            jQuery(\"#";
        // line 177
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "offsetGet", array(0 => (isset($context["parent_field"]) ? $context["parent_field"] : null)), "method"), "vars", array()), "id", array()), "html", null, true);
        echo "\").change(function(){
                jQuery(\"#";
        // line 178
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "\").select2('data', null);
            });
        });
    </script>

";
    }

    // line 186
    public function block_shtumi_daterange_widget($context, array $blocks = array())
    {
        // line 187
        echo "
    <style type=\"text/css\">@import \"";
        // line 188
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/datepicker/jquery.datepick.css"), "html", null, true);
        echo "\";</style>
    <style type=\"text/css\">@import \"";
        // line 189
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/css/daterange.css"), "html", null, true);
        echo "\";</style>
    <script type=\"text/javascript\" src=\"";
        // line 190
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/datepicker/jquery.datepick.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 191
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((("bundles/shtumiuseful/js/datepicker/jquery.datepick-" . twig_slice($this->env, (isset($context["locale"]) ? $context["locale"] : null), 0, 2)) . ".js")), "html", null, true);
        echo "\"></script>

    <input ";
        // line 193
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " value=\"";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "\" class=\"shtumi-daterange\">

    <script>
        jQuery('input#";
        // line 196
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "id", array()), "html", null, true);
        echo "').datepick({
            rangeSelect: true, monthsToShow: 2, showTrigger: '#calImg', dateFormat: '";
        // line 197
        echo twig_escape_filter($this->env, (isset($context["datepicker_date_format"]) ? $context["datepicker_date_format"] : null), "html", null, true);
        echo "' });
    </script>

    <div style=\"display: none;\">
        <img id=\"calImg\" src=\"";
        // line 201
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/datepicker/calendar-green.gif"), "html", null, true);
        echo "\" alt=\"Popup\" class=\"trigger\" height='22' align='absmiddle' style='margin-left: 10px;'>
    </div>

";
    }

    // line 207
    public function block_shtumi_ajaxfile_widget($context, array $blocks = array())
    {
        // line 208
        echo "
    <style type=\"text/css\">@import \"";
        // line 209
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/css/jquery-file-upload/jquery.fileupload.css"), "html", null, true);
        echo "\";</style>

    <script type=\"text/javascript\" src=\"http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js\"></script>
    <script type=\"text/javascript\" src=\"http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 213
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/jquery-file-upload/jquery.iframe-transport.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 214
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/jquery-file-upload/jquery.fileupload.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 215
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/jquery-file-upload/jquery.fileupload-process.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 216
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/jquery-file-upload/jquery.fileupload-audio.js"), "html", null, true);
        echo "\"></script>

    <script type=\"text/javascript\" src=\"";
        // line 218
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/jquery-file-upload/jquery.fileupload-video.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 219
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/shtumiuseful/js/jquery-file-upload/jquery.fileupload-validate.js"), "html", null, true);
        echo "\"></script>


    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class=\"btn btn-success fileinput-button\">
        <i class=\"glyphicon glyphicon-plus\"></i>
        <span>Add files...</span>
        <!-- The file input field used as target for the file upload widget -->
        ";
        // line 227
        $context["uploader_id"] = ((isset($context["id"]) ? $context["id"] : null) . "_uploader");
        // line 228
        echo "        <input id=\"";
        echo twig_escape_filter($this->env, (isset($context["uploader_id"]) ? $context["uploader_id"] : null), "html", null, true);
        echo "\" name=\"";
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "\" type=\"file\" multiple>

        <input ";
        // line 230
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " type=\"hidden\">

    </span>


    <div class=\"progress-bar progress-bar-success\"></div>
    <!-- The container for the uploaded files -->
    <div id=\"files\" class=\"files\"></div>

    <script>

        (function(){

            var files_list = [];

            jQuery('#";
        // line 245
        echo twig_escape_filter($this->env, (isset($context["uploader_id"]) ? $context["uploader_id"] : null), "html", null, true);
        echo "')
                    .fileupload({
                        url: '";
        // line 247
        echo $this->env->getExtension('routing')->getPath("shtumi_ajaxfileupload");
        echo "',
                        dataType: 'json',
                        autoUpload: true,
                        maxFileSize: 50000000000, // 5 MB
                        // Enable image resizing, except for Android and Opera,
                        // which actually support image resizing, but fail to
                        // send Blob objects via XHR requests:
                        disableImageResize: false,// /Android(?!.*Chrome)|Opera/
                        //.test(window.navigator.userAgent),
                        previewMaxWidth: 100,
                        previewMaxHeight: 100,
                        previewCrop: true
                    })
                    .on('fileuploadadd', function (e, data) {
                        data.context = jQuery('<div/>').appendTo('#files');
                        jQuery.each(data.files, function (index, file) {
                            var node = jQuery('<p/>')
                                    .append(jQuery('<span/>').text(file.name));

                            node.appendTo(data.context);
                        });
                    })
                    .on('fileuploadprocessalways', function (e, data) {
                        var index = data.index,
                                file = data.files[index],
                                node = jQuery(data.context.children()[index]);
                        if (file.preview) {
                            node
                                    .prepend('<br>')
                                    .prepend(file.preview);
                        }
                        if (file.error) {
                            node
                                    .append('<br>')
                                    .append(jQuery('<span class=\"text-danger\"/>').text(file.error));
                        }
                    })
                    .on('fileuploadprogressall', function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        jQuery('#progress .progress-bar').css(
                                'width',
                                progress + '%'
                        );
                    })
                    .on('fileuploaddone', function (e, data) {
                        jQuery.each(data.result.files, function (index, file) {
                            alert(123);
                            if (file.url) {
                                var link = jQuery('<a>')
                                        .attr('target', '_blank')
                                        .prop('href', file.url);
                                jQuery(data.context.children()[index])
                                        .wrap(link);

                                files_list.push(file.path);
                                jQuery('#";
        // line 302
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "').val(JSON.stringify(files_list));
                            } else if (file.error) {
                                var error = jQuery('<span class=\"text-danger\"/>').text(file.error);
                                jQuery(data.context.children()[index])
                                        .append('<br>')
                                        .append(error);
                            }
                        });
                    })
                    .on('fileuploadfail', function (e, data) {
                        jQuery.each(data.files, function (index, file) {
                            var error = jQuery('<span class=\"text-danger\"/>').text('File upload failed.');
                            jQuery(data.context.children()[index])
                                    .append('<br>')
                                    .append(error);
                        });
                    })
                    .prop('disabled', !jQuery.support.fileInput)
                    .parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');
        }());
    </script>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:Form:depend_combo_fields.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  541 => 302,  483 => 247,  478 => 245,  460 => 230,  452 => 228,  450 => 227,  439 => 219,  435 => 218,  430 => 216,  426 => 215,  422 => 214,  418 => 213,  411 => 209,  408 => 208,  405 => 207,  397 => 201,  390 => 197,  386 => 196,  378 => 193,  373 => 191,  369 => 190,  365 => 189,  361 => 188,  358 => 187,  355 => 186,  345 => 178,  341 => 177,  334 => 175,  323 => 167,  319 => 166,  311 => 161,  305 => 158,  301 => 157,  293 => 152,  290 => 151,  287 => 150,  277 => 143,  260 => 131,  254 => 128,  247 => 124,  243 => 123,  237 => 120,  232 => 118,  228 => 117,  219 => 111,  212 => 107,  205 => 103,  200 => 101,  197 => 100,  194 => 99,  187 => 94,  141 => 51,  133 => 46,  127 => 43,  116 => 35,  111 => 32,  108 => 31,  101 => 27,  92 => 23,  78 => 12,  71 => 8,  65 => 5,  60 => 2,  57 => 1,  53 => 207,  49 => 205,  47 => 186,  43 => 184,  41 => 150,  38 => 149,  36 => 99,  32 => 97,  30 => 31,  27 => 30,  25 => 1,);
    }
}
