<?php

/* AppBundle:Form:fields.html.twig */
class __TwigTemplate_96ccc92f24f4f0f6f2aea9455ca288e9b5be63c8ad4380cd3057a0c4ed306ce3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'app_procedimentos_cliente_equipamento_widget' => array($this, 'block_app_procedimentos_cliente_equipamento_widget'),
            'app_cnpj_widget' => array($this, 'block_app_cnpj_widget'),
            'app_textarea_with_count_widget' => array($this, 'block_app_textarea_with_count_widget'),
            'app_textarea_maximize_with_count_widget' => array($this, 'block_app_textarea_maximize_with_count_widget'),
            'app_file_with_icon_widget' => array($this, 'block_app_file_with_icon_widget'),
            'app_button_gerar_orcamento_widget' => array($this, 'block_app_button_gerar_orcamento_widget'),
            'app_file_xml_nota_widget' => array($this, 'block_app_file_xml_nota_widget'),
            'app_map_widget' => array($this, 'block_app_map_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $this->displayBlock('app_procedimentos_cliente_equipamento_widget', $context, $blocks);
        // line 75
        echo "

";
        // line 77
        $this->displayBlock('app_cnpj_widget', $context, $blocks);
        // line 82
        echo "

";
        // line 85
        $this->displayBlock('app_textarea_with_count_widget', $context, $blocks);
        // line 93
        echo "
";
        // line 95
        $this->displayBlock('app_textarea_maximize_with_count_widget', $context, $blocks);
        // line 106
        echo "
";
        // line 108
        $this->displayBlock('app_file_with_icon_widget', $context, $blocks);
        // line 113
        echo "
";
        // line 115
        $this->displayBlock('app_button_gerar_orcamento_widget', $context, $blocks);
        // line 122
        echo "
";
        // line 124
        $this->displayBlock('app_file_xml_nota_widget', $context, $blocks);
        // line 255
        echo "
";
        // line 256
        $this->displayBlock('app_map_widget', $context, $blocks);
    }

    // line 2
    public function block_app_procedimentos_cliente_equipamento_widget($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        ob_start();
// line 4 Combo de Equipamentos
        echo "
        <label class=\"control-label required\">
            Selecione o equipamento<br/>
            <small>Selecione um equipamento para aparecer as opções ou editar</small>
        </label>
        ";
        // line 10
        echo $this->getAttribute((isset($context["pmoc_model"]) ? $context["pmoc_model"] : null), "getEquipamentosCatalogoPMOC", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "id", array()), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "value", array())), "method");

// line 18 Lista de Procedimentos
        echo "
        <div style=\"padding-top: 10px;\">
            <label class=\"control-label\">
                Procedimentos vinculados
            </label>
            <div id=\"procedimentos_herdados\">

                ";
        // line 18
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "value", array()), "procedimentosPreventivos", array())) <= 0)) {
            // line 19
            echo "                    <p><small>Selecione um equipamento acima</small></p>
                ";
        } else {
            // line 21
            echo "                    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "value", array()), "procedimentosPreventivos", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["procedimento"]) {
                // line 22
                echo "                    <p style=\"margin-bottom:0;padding-left:12px;\">
                        <input type=\"checkbox\" name=\"procedimentos[]\" value=\"";
                // line 23
                echo twig_escape_filter($this->env, $this->getAttribute($context["procedimento"], "id", array()), "html", null, true);
                echo "\" checked/>
                        <label style=\"margin-left:5px;\" for=\"r1\">";
                // line 24
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["procedimento"], "titulo", array()), "titulo", array()), "html", null, true);
                echo "</label></p>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['procedimento'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "                ";
        }

        // line 27
        echo "
            </div>
        </div>
        <hr/>

        <script>
            \$(document).ready(function(){
                \$('#equipamento_cliente').change(function(e){
                    // Pegar todos os procedimentos do equipamento selecionado acima
                    var idEquipamento = \$(this).val();
                    if(idEquipamento==''){
                        return;
                    }
                    \$.ajax({
                        type: 'get',
                        url: '";
        // line 42
        echo $this->env->getExtension('routing')->getPath("get_procedimentos_equipamento");
        echo "',
                        data: 'id_equipamento='+idEquipamento,
                        beforeSend:function(xhr){
                            \$('#procedimentos_herdados').html('<p><small>Carregando procedimentos do equipamento selecionado</small></p>');
                        },
                        success:function(data){
                            \$('#procedimentos_herdados').html(data);
//                            \$('input').iCheck();
                        },
                        statusCode: {
                            404: function(){
                                alert(\"Rota não encontrada!\");
                            },
                            401: function(){
                                alert(\"Existe algum parâmetro obrigatório não atendido neste processo\");
                            },
                            403: function() {
                                alert(\"Permissão negada!\");
                            },
                            204: function(){
                                alert(\"Requisito não encontrado!\");
                            },
                            500: function() {
                                alert(\"Houve um erro crítico, contate o suporte.\" );
                            }
                        }
                    });

                })
            });
        </script>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 77
    public function block_app_cnpj_widget($context, array $blocks = array())
    {
        // line 78
        echo "    ";
        ob_start();
        // line 79
        echo "        <input type=\"text\" class=\"form-control mask_cnpj\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "value", array()), "cnpj", array()), "html", null, true);
        echo "\">
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 85
    public function block_app_textarea_with_count_widget($context, array $blocks = array())
    {
        // line 86
        echo "    ";
        ob_start();
        // line 87
        echo "        <div class=\"with_counter\">
            <textarea name=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "full_name", array()), "html", null, true);
        echo "\" class=\"form-control textarea_with_count_widget\">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "</textarea>
            <div class=\"counter_number\">*Você só tem <span class=\"text_number\">";
        // line 89
        echo twig_escape_filter($this->env, (500 - twig_length_filter($this->env, (isset($context["value"]) ? $context["value"] : null))), "html", null, true);
        echo "</span> caracteres restantes</div>
        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 95
    public function block_app_textarea_maximize_with_count_widget($context, array $blocks = array())
    {
        // line 96
        echo "    ";
        ob_start();
        // line 97
        echo "        <div class=\"with_counter\">
            <a href=\"#\"><i class=\"fa fa-plus\"></i></a>
            <div class=\"maximize_textarea\">
                <textarea name=\"";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "full_name", array()), "html", null, true);
        echo "\" class=\"form-control textarea_with_count_widget\">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "</textarea>
                <div class=\"counter_number\">*Você só tem <span class=\"text_number\">";
        // line 101
        echo twig_escape_filter($this->env, (500 - twig_length_filter($this->env, (isset($context["value"]) ? $context["value"] : null))), "html", null, true);
        echo "</span> caracteres restantes</div>
            </div>
        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 108
    public function block_app_file_with_icon_widget($context, array $blocks = array())
    {
        // line 109
        echo "    ";
        ob_start();
        // line 110
        echo "        ";
        echo (isset($context["value"]) ? $context["value"] : null);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 115
    public function block_app_button_gerar_orcamento_widget($context, array $blocks = array())
    {
        // line 116
        echo "    ";
        ob_start();
        // line 117
        echo "        <p>Como existem produtos que não constam no estoque você pode solicitar a criação de um orçamento.</p>
        <button type=\"button\" class=\"btn btn-warning\"><i class=\"fa fa-share\" aria-hidden=\"true\"></i> Criar orçamento para produtos faltantes</button>
        <hr/>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 124
    public function block_app_file_xml_nota_widget($context, array $blocks = array())
    {
        // line 125
        echo "    ";
        ob_start();
        // line 126
        echo "        <label class=\"btn btn-warning btn-file\" id=\"buttonUploadNota\">
            <i class=\"fa fa-cloud-upload\" aria-hidden=\"true\"></i>
            Buscar arquivo da nota fiscal<input type=\"file\" style=\"display: none;\" id=\"inputnota\">
        </label>

        <div id=\"infoNota\" style=\"display: none;\">

            <input type=\"hidden\" name=\"contentNota\" id=\"contentNota\">
            <input type=\"hidden\" name=\"idNota\" id=\"idNota\">
            <input type=\"hidden\" name=\"fornecedor_razao_social\" id=\"fornecedor_razao_social\">
            <input type=\"hidden\" name=\"fornecedor_cnpj\" id=\"fornecedor_cnpj\">

            <div id=\"listprodutosnota\" class=\"panel panel-default\" style=\"margin-top: 10px;\">
                <div class=\"panel-heading\"><h3 class=\"panel-title\" id=\"titleDetalheNota\">Detalhes da Nota</h3></div>
                <div class=\"panel-body\">
                    <h4>Informações do fornecedor</h4>
                    <ul id=\"infoEmpresaList\">
                    </ul>
                    <h3 class=\"panel-title\" style=\"padding-top: 20px;\">Lista dos Itens</h3>
                </div>

                <table class=\"table table-hover\">
                    <thead>
                    <th>Codigo</th>
                    <th>Qtd</th>
                    <th>Título Produto</th>
                    <th>Valor</th>
                    </thead>
                    <tbody id=\"bodyListaItensNota\">
                    <tr>
                        <td>0001
                        <td>Teste de Produto
                    </tbody>
                </table>
                <div id=\"inputsItensNota\"></div>
            </div>

        </div>

    <script>
        \$(document).ready(function(){
            \$('#inputnota').change(function(){
                \$('#infoNota').fadeOut(200);
                uploadNota();
            });
        });

        function uploadNota(){

            \$('#buttonUploadNota').addClass('disabled');
            var inputFile = \$('#inputnota');

            if(inputFile.val()==''){
                alert('Informe um arquivo para upload');
                return;
            }

            var file = document.getElementById('inputnota').files[0]; //Files[0] = 1st file
            var reader = new FileReader();
            reader.readAsText(file, 'UTF-8');
            reader.onprogress = function(data) {
                if (data.lengthComputable) {
                    var progress = parseInt( ((data.loaded / data.total) * 100), 10 );
                }
            }
            reader.onload = function(event){

                var result = event.target.result;

                \$('#buttonUploadNota').removeClass('disabled');

//                var fileName = document.getElementById('inputnota').files[0].name;

                \$('#contentNota').val(result);

                var xmlDoc = \$.parseXML( result );

                var \$xml = \$(xmlDoc);

                \$('#idNota').val(\$xml.find('infNFe').attr('Id'));

                var numeroNota = \$xml.find(\"nNF\");
                \$('#titleDetalheNota').html('Detalhes da Nota: <strong>nº.'+numeroNota.text()+'</strong>');

                var razaoSocial = \$xml.find('emit').find(\"xNome\");
                var cnpj = \$xml.find(\"emit\");
                cnpj = cnpj.find('CNPJ');

                \$('#fornecedor_razao_social').val(razaoSocial.text());
                \$('#fornecedor_cnpj').val(cnpj.text());

                var strInfoEmpresa = '<li><strong>Razão Social: </strong>'+razaoSocial.text()+'</li>'+
                                     '<li><strong>CNPJ: </strong>'+cnpj.text()+'</li>';

                \$('#infoEmpresaList').empty();
                \$('#infoEmpresaList').html(strInfoEmpresa);


                var itens = \$xml.find('prod');
                \$(\"#bodyListaItensNota\").empty();
                \$('#inputsItensNota').empty();
                var contItens = 0;
                itens.each(function(){
                    contItens++;
                    var codigo = \$(this).find('cProd').text(),
                        qtd    = \$(this).find('qCom').text(),
                        titulo = \$(this).find('xProd').text(),
                        valor  = \$(this).find('vProd').text();

                    var input = '<input type=\"hidden\" name=\\'produtoNota['+contItens+'][codigo]\\' value=\"'+codigo+'\"/>' +
                                '<input type=\"hidden\" name=\\'produtoNota['+contItens+'][qtd]\\' value=\"'+qtd+'\"/>' +
                                '<input type=\"hidden\" name=\\'produtoNota['+contItens+'][titulo]\\' value=\"'+titulo+'\"/>' +
                                '<input type=\"hidden\" name=\\'produtoNota['+contItens+'][valor]\\' value=\"'+valor+'\"/>';

                    \$('#inputsItensNota').append(input);

                    \$(\"#bodyListaItensNota\" ).append('<tr><td>' +codigo+ '<td>' +qtd+ '<td>' +titulo+ '<td>' +accounting.formatMoney(valor, \"R\$\", 2, \".\", \",\"));

                });

                \$('#infoNota').fadeIn(200);

            }

        }
    </script>

    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 256
    public function block_app_map_widget($context, array $blocks = array())
    {
        // line 257
        echo "    ";
        ob_start();
        // line 258
        echo "        <p>Arraste o marcador para o estabelecimento para gravar a localização</p>
        <div id=\"map\" style=\"width: 100%;height: 450px;\"></div>
        <div class=\"row\" style=\"padding-bottom: 5px;\">
            <div class=\"col-md-12\">
                <span id=\"latitude-txt\">&nbsp;</span>&nbsp;&nbsp;<span id=\"longitude-txt\">&nbsp;</span>
                <input type=\"hidden\" id=\"latitude\" name=\"latitude_mapa\" value=\"";
        // line 263
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "latitude", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" id=\"longitude\" name=\"longitude_mapa\" value=\"";
        // line 264
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "longitude", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" id=\"zoom_map\" name=\"zoom_map\" value=\"";
        // line 265
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "zoomMapa", array()), "html", null, true);
        echo "\">
            </div>

        </div>
        <script>
            var marker;
            function initMap() {

                ";
        // line 273
        if (twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "latitude", array()))) {
            // line 274
            echo "                var myLatlng = new google.maps.LatLng(-16.251969, -50.364335);
                ";
        } else {
            // line 276
            echo "                var myLatlng = new google.maps.LatLng(";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "latitude", array()), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "longitude", array()), "html", null, true);
            echo ");
                ";
        }
        // line 278
        echo "
                ";
        // line 279
        if (twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "zoomMapa", array()))) {
            // line 280
            echo "                var zoomMapa = 5;
                ";
        } else {
            // line 282
            echo "                var zoomMapa = ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array()), "vars", array()), "data", array(), "array"), "zoomMapa", array()), "html", null, true);
            echo "
                ";
        }
        // line 284
        echo "
                // Create a map object and specify the DOM element for display.
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatlng,
                    scrollwheel: false,
                    zoom: zoomMapa
                });

                map.addListener('zoom_changed', function() {
                    google.maps.event.trigger(map, \"resize\");
                    \$('#zoom_map').val(map.getZoom());
                });

                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    position: myLatlng
                });
                marker.addListener('dragend', handleEvent);
            }

            function handleEvent(event) {
                \$('#latitude-txt').html(event.latLng.lat());
                \$('#longitude-txt').html(event.latLng.lng());
                \$('#latitude').val(event.latLng.lat());
                \$('#longitude').val(event.latLng.lng());
            }

        </script>
        <script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyBakjXapuMHSBkLOrbAowlksYZ_ydPfTi4&callback=initMap\"
                async defer></script>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "AppBundle:Form:fields.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  466 => 284,  460 => 282,  456 => 280,  454 => 279,  451 => 278,  443 => 276,  439 => 274,  437 => 273,  426 => 265,  422 => 264,  418 => 263,  411 => 258,  408 => 257,  405 => 256,  273 => 126,  270 => 125,  267 => 124,  259 => 117,  256 => 116,  253 => 115,  245 => 110,  242 => 109,  239 => 108,  230 => 101,  224 => 100,  219 => 97,  216 => 96,  213 => 95,  205 => 89,  199 => 88,  196 => 87,  193 => 86,  190 => 85,  182 => 79,  179 => 78,  176 => 77,  139 => 42,  122 => 27,  119 => 26,  111 => 24,  107 => 23,  104 => 22,  99 => 21,  95 => 19,  93 => 18,  82 => 10,  74 => 4,  71 => 3,  68 => 2,  64 => 256,  61 => 255,  59 => 124,  56 => 122,  54 => 115,  51 => 113,  49 => 108,  46 => 106,  44 => 95,  41 => 93,  39 => 85,  35 => 82,  33 => 77,  29 => 75,  27 => 2,);
    }
}
