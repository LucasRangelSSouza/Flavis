<?php

/* AppBundle:CRUD:list_pmoc_agenda_procedimentos.html.twig */
class __TwigTemplate_87c5323fdad738b79ec2c01ab0a6bca63471ab7d917128972ddd8a7f7b7e1e5b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:list.html.twig", "AppBundle:CRUD:list_pmoc_agenda_procedimentos.html.twig", 12);
        $this->blocks = array(
            'list_table' => array($this, 'block_list_table'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_list_table($context, array $blocks = array())
    {
        // line 14
        echo "
    ";
        // line 16
        echo "    ";
        // line 17
        echo "
    <style>
        .hover-end{
            display: none;
            position: fixed;
            z-index: 999999;
            padding: 10px;
            background: rgb(129, 32, 59);
            top: 0;
            left:0;
            color: #fff;
        }
        .fc-content td:hover{background: #adf4fa;}
    </style>

    <div class=\"hover-end\"></div>

    <div class=\"col-xs-12 col-md-12\">
        <div class=\"box box-primary\">
            <div class=\"box-body\">
            <!--    <a class=\"btn btn-primary pull-left\" href=\"";
        // line 37
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getBaseURL", array(), "method") . "/app/execucaodeprocedimentoequipamento/list")), "html", null, true);
        echo "\">Voltar</a> -->
                <h4 style=\"text-align: center;\">Procedimentos Agendados - <u>";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["nome_cliente"]) ? $context["nome_cliente"] : null), "html", null, true);
        echo "</u></h4>
                <hr/>
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" id=\"modalDetalheProcedimento\" data-backdrop=\"static\" data-keyboard=\"false\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h4 class=\"modal-title\">Detalhe de Procedimento</h4>
                </div>
                <div class=\"modal-body\">
                    <p id=\"dealhe-procedimento\"></p>
                    <hr/>
                    <p>
                        <label>Técnico que vai executar o serviço</label>
                        <select id=\"colaboradores\">
                            <option value=\"\">Selecione o Técnico</option>

                            ";
        // line 59
        $context["colaboradores"] = $this->getAttribute((isset($context["colaborador_model"]) ? $context["colaborador_model"] : null), "getColaborares", array(), "method");
        // line 60
        echo "
                            ";
        // line 61
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["colaboradores"]) ? $context["colaboradores"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["colaborador"]) {
            // line 62
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["colaborador"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["colaborador"], "nome", array()), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['colaborador'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "
                        </select>
                    </p>
                    <p>
                        <label>Endereço de execução do serviço</label>
                        <select id=\"enderecos\"><option value=\"\">Selecione um Endereço</option></select>
                    </p>
                    <p>
                        <label for=\"horario_atendimento\">Horário de atendimento</label><br/>
                        <input type=\"time\" id=\"horario_atendimento\" name=\"horario_atendimento\">
                    </p>
                    <input type=\"hidden\" id=\"idProcedimento\">
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" id=\"btnCloseModalOs\" data-dismiss=\"modal\">Fechar</button>
                    <button type=\"button\" class=\"btn btn-primary\" id=\"btnCreateOs\">Criar OS</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>

        var __eventCliked = '';

        jQuery(document).ready(function() {

            jQuery('#calendar').fullCalendar({
//                customButtons: {
//                    myCustomButton: {
//                        text: 'Botão Customizado',
//                        click: function() {
//                            alert('Executar alguma ação customizada!');
//                        }
//                    }
//                },
                header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    //right: 'month,basicWeek,basicDay,listDay'
                },
                views: {
                    listDay: { buttonText: 'Listar dia' },
                    listWeek: { buttonText: 'Lista de Hoje' }
                },
                locale: 'pt-br',
                defaultDate: '";
        // line 111
        echo twig_escape_filter($this->env, (isset($context["data_calendario"]) ? $context["data_calendario"] : null), "html", null, true);
        echo "',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow \"more\" link when too many events
                events: [
                    ";
        // line 116
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["dataToCalendario"]) ? $context["dataToCalendario"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
            // line 117
            echo "
                        ";
            // line 118
            if ((null === $this->getAttribute($context["evento"], "os", array()))) {
                // line 119
                echo "
                            {
                                'have_os': false,
                                'is_homologada': false,
                                'os_id': null,
                                'id' : ";
                // line 124
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                                'id_evento': ";
                // line 125
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                                'id_cliente' : '";
                // line 126
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "id", array()), "html", null, true);
                echo "',
                                'cliente' : '";
                // line 127
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                                'cnpj' : '";
                // line 128
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "cpfCnpj", array()), "html", null, true);
                echo "',
                                'equipamento' : '";
                // line 129
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "marca", array()), "titulo", array()), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true);
                echo "',
                                'procedimento' : '";
                // line 130
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);
                echo "',

                                'title': '";
                // line 132
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                                'start' : '";
                // line 133
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["evento"], "dataAgendadaExecucao", array()), "Y-m-d"), "html", null, true);
                echo "',
                                'allDay' : false,
                                'color' : '";
                // line 135
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "colorBackgroundCalendar", array()), "html", null, true);
                echo "'
                            },

                        ";
            } else {
                // line 139
                echo "
                            ";
                // line 140
                if (( !(null === $this->getAttribute($this->getAttribute($context["evento"], "os", array()), "isHomologada", array())) && ($this->getAttribute($this->getAttribute($context["evento"], "os", array()), "isHomologada", array()) == true))) {
                    // line 141
                    echo "
                                ";
                    // line 142
                    $context["homologada"] = 1;
                    // line 143
                    echo "
                            ";
                } else {
                    // line 145
                    echo "
                                ";
                    // line 146
                    $context["homologada"] = 0;
                    // line 147
                    echo "
                            ";
                }
                // line 149
                echo "
                            {
                                'have_os': true,
                                'is_homologada': ";
                // line 152
                echo twig_escape_filter($this->env, (isset($context["homologada"]) ? $context["homologada"] : null), "html", null, true);
                echo ",
                                'os_id': ";
                // line 153
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["evento"], "os", array()), "id", array()), "html", null, true);
                echo ",
                                'id' : ";
                // line 154
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["evento"], "os", array()), "id", array()), "html", null, true);
                echo ",
                                'id_evento': ";
                // line 155
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                                'id_cliente' : '";
                // line 156
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "id", array()), "html", null, true);
                echo "',
                                'cliente' : '";
                // line 157
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                                'cnpj' : '";
                // line 158
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "cpfCnpj", array()), "html", null, true);
                echo "',
                                'equipamento' : '";
                // line 159
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "marca", array()), "titulo", array()), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true);
                echo "',
                                'procedimento' : '";
                // line 160
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);
                echo "',

                                'title': '";
                // line 162
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                                'start' : '";
                // line 163
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["evento"], "dataAgendadaExecucao", array()), "Y-m-d"), "html", null, true);
                echo "',
                                'allDay' : false,
                                'color' : '";
                // line 165
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "colorBackgroundCalendar", array()), "html", null, true);
                echo "'
                            },

                        ";
            }
            // line 169
            echo "
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['evento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 171
        echo "                ],
                eventDrop:function(event, delta, revertFunc){

                    if(event.is_homologada){
                        alert('Estes procedimentos já estão vinculados a uma OS HOMOLOGADA e não podem ser reagendados');
                        revertFunc();
                    }else{
                        reagendaProcedimentos(event);
                    }

                },
                eventMouseover: function(event, jsEvent, view) {

                    var html =  '<h4>Detalhes com foco</h4>' +
                                '<b>Cliente:</b> ' + event.title + ' <b>CNPJ:</b> ' + event.cnpj +
                                '<br/><b>Equipamento:</b> ' + event.equipamento +
                                '<br/><b>Procedimento:</b> ' + event.procedimento

                    \$('.hover-end').html(html);
                    \$('.hover-end').show();
                },
                eventMouseout: function(event, jsEvent, view) {
                    \$('.hover-end').hide();
                    \$('.hover-end').html('');
                },
                eventClick: function(calEvent, jsEvent, view){

                    __eventCliked = calEvent;

                    //var evento = \$(\"#calendar\").fullCalendar('clientEvents', response.idEvent);

                    if(calEvent.have_os){

                        alert('Já existe uma OS criada para esta manutenção!');
                        return;

                    }else{

                        var htmlDetalhe  = '<strong>Cliente: </strong>'+calEvent.cliente+'<br/>'+
                                '<strong>CNPJ: </strong>'+calEvent.cnpj+'<br/>'+
                                '<strong>Equipamento: </strong>'+calEvent.equipamento+'<br/>'+
                                '<strong>Procedimento: </strong>'+calEvent.procedimento+'<br/>'+
                                '<p style=\"font-style: italic;\"><small>* Na criação da OS serão vincuadas todos os procedimentos conscidentes nesta data.</small></p>';

                        \$('#dealhe-procedimento').empty();
                        \$('#dealhe-procedimento').html(htmlDetalhe);

                        \$('#idProcedimento').val(calEvent.id);

                        getEnderecosCliente(calEvent.id_cliente);

                        \$('#modalDetalheProcedimento').modal('show');

                    }

                }
            });

            // Detect paginate
            \$('.fc-next-button, .fc-prev-button, .fc-today-button').click(function(){

                \$('.fc-view-container').hide();
                \$('.fc-header-toolbar').html('Carregando...');

                var moment = \$('#calendar').fullCalendar('getDate');

                var urlRedirect = \"";
        // line 237
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getBaseURL", array(), "method") . "/app/execucaodeprocedimentoequipamento/listprocedimentos?date="), "html", null, true);
        echo "\" +
                    moment.format() + \"&cliente=";
        // line 238
        echo twig_escape_filter($this->env, (isset($context["id_cliente"]) ? $context["id_cliente"] : null), "html", null, true);
        echo "\";

                document.location.href = urlRedirect;

            });

            // Click Generate OS
            \$('#btnCreateOs').click(function(){

                var idProcedimento = \$('#idProcedimento').val();
                var btnCreate = \$(this);
                var idColaboradorTecnico = \$('#colaboradores').val();
                var id_endereco = \$('#enderecos').val();
                var horario_atendimento = \$('#horario_atendimento').val();

                if(idColaboradorTecnico==''){
                    alert('Selecione um Técnico que vai executar esta OS');
                    return;
                }else if(id_endereco==''){
                    alert('Selecione um endereço de execução para esta OS');
                    return;
                }else if(horario_atendimento=='') {
                    alert('Selecione um horário de atendimento para esta OS');
                    return;
                }

                btnCreate.html('carregando...').attr('disabled',true);
                \$('#btnCloseModalOs').hide();

                \$.ajax({
                    method: \"POST\",
                    url: \"";
        // line 269
        echo $this->env->getExtension('routing')->getPath("create_os_by_procedimento_agendado");
        echo "\",
                    data: {
                        id_procedimento: idProcedimento,
                        id_colaboradorTecnico: idColaboradorTecnico,
                        id_endereco: id_endereco,
                        horario: horario_atendimento
                    },
                    success: function (data) {
                        btnCreate.html('Criar OS').attr('disabled',false);
                        \$('#btnCloseModalOs').show();
                        alert(data);
                        \$('#modalDetalheProcedimento').modal('hide');
                        __eventCliked.backgroundColor = 'rgb(255, 196, 0)';
                        __eventCliked.borderColor = 'rgb(255, 196, 0)';
                        \$('#calendar').fullCalendar( 'rerenderEvents' );

                        document.location.reload();

                    },
                    error: function (request, status, error) {
                        alert(error);
                    }
                })

            });

        });

        function getEnderecosCliente(id_cliente)
        {
            var html = '';

            \$.ajax({
                method: \"POST\",
                dataType: \"json\",
                url: \"";
        // line 304
        echo $this->env->getExtension('routing')->getPath("get_enderecos_cliente");
        echo "\",
                data: { id_cliente: id_cliente},
                success: function (data) {

                    \$.each( data, function( index, value ){
                        html += '<option value=\"'+value.id+'\">'+value.cep+'</option>';
                    });

                    \$('#enderecos').html(html);

                },
                error: function (request, status, error) {
                    return  '<option value=\"\">Este cliente não tem endereço cadastrado</option>';
                }
            });
        }

        function reagendaProcedimentos(event){

            if(event.have_os){
                var id_execucao = event.id_evento;
            }else{
                var id_execucao = event.id;
            }

            \$.ajax({
                method: \"POST\",
                url: \"";
        // line 331
        echo $this->env->getExtension('routing')->getPath("reagenda_execucoes_procedimentos");
        echo "\",
                data: { id_execucao_procedimento: id_execucao,nova_data:event.start.format()},
                success: function (data) {
                    alert(data);
                },
                error: function (request, status, error) {
                    alert('Houve um erro inesperado! Favor entrar em contato com o suporte');
                    console.log(error);
                }
            });
        }

    </script>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list_pmoc_agenda_procedimentos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  490 => 331,  460 => 304,  422 => 269,  388 => 238,  384 => 237,  316 => 171,  309 => 169,  302 => 165,  297 => 163,  293 => 162,  288 => 160,  282 => 159,  278 => 158,  274 => 157,  270 => 156,  266 => 155,  262 => 154,  258 => 153,  254 => 152,  249 => 149,  245 => 147,  243 => 146,  240 => 145,  236 => 143,  234 => 142,  231 => 141,  229 => 140,  226 => 139,  219 => 135,  214 => 133,  210 => 132,  205 => 130,  199 => 129,  195 => 128,  191 => 127,  187 => 126,  183 => 125,  179 => 124,  172 => 119,  170 => 118,  167 => 117,  163 => 116,  155 => 111,  106 => 64,  95 => 62,  91 => 61,  88 => 60,  86 => 59,  62 => 38,  58 => 37,  36 => 17,  34 => 16,  31 => 14,  28 => 13,  11 => 12,);
    }
}
