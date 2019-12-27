<?php

/* AppBundle:CRUD:list_pmoc_agenda.html.twig */

class __TwigTemplate_dbe8c79b1abfcd60b12f1f0517b8982736789f6ab5a43d74e49992bdfe1c6ef6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:list.html.twig", "AppBundle:CRUD:list_pmoc_agenda.html.twig", 12);
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
        .hover-end {
    position: relative;
    display: inline;
}

        #ambiente, #grupo{
        font-weight: normal;
        margin-bottom: 0px;
        }

        .fc-content td:hover{background: #adf4fa;}
    </style>

    <div class=\"hover-end\"></div>

    <div class=\"col-xs-12 col-md-12\">
        <div class=\"box box-primary\">
            <div class=\"box-body\">
                <h4 style=\"text-align: center;\">Procedimentos Agendados por cliente</h4>
                <hr/>
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" id=\"modalDetalheProcedimento\" data-backdrop=\"static\" data-keyboard=\"false\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h4 class=\"modal-title\">Detalhe do Procedimento</h4>
                </div>
                <div class=\"modal-body\">
                    <p id=\"dealhe-procedimento\"></p>
                    <hr/>
                    <p>
                        <label>Técnico que vai executar o serviço</label>
                        <select id=\"colaboradores\">
                            <option value=\"\">Selecione o Técnico</option>

                            ";
        // line 58
        $context["colaboradores"] = $this->getAttribute((isset($context["colaborador_model"]) ? $context["colaborador_model"] : null), "getColaborares", array(), "method");
        $Pmoc = new \AppBundle\Model\Pmoc();
        $isConcluidos = $Pmoc->isProcedimentosFaltando($this->getAttribute($context["evento"], "os", array()));
        // line 59
        echo "
                            ";
        // line 60
        $context['_parent'] = (array)$context;
        $context['_seq'] = twig_ensure_traversable((isset($context["colaboradores"]) ? $context["colaboradores"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["colaborador"]) {
            // line 61
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
        // line 63 adicionarDiasData(0)
//        <input type="date" id="data_execucao" name="data_execucao" min="2019-12-23">
        echo "
                        </select>
                    </p>
                    <p>
                        <label>Endereço de execução do serviço</label>
                        <select id=\"enderecos\"><option value=\"\">Selecione um Endereço</option></select>
                    </p>              
                    <p>
                        <label for=\"data_execucao\">Data de Execução</label><br/>
                        <input type=\"date\" id=\"data_execucao\" name=\"data_execucao\" min=\"2019-12-23\">
                        <span class=\"validity\"></span>
                    </p>        
                    <p>
                        <label for=\"horario_atendimento\">Horário de atendimento</label><br/>
                        <input type=\"time\" id=\"horario_atendimento\" name=\"horario_atendimento\">
                    </p>
                    <input type=\"hidden\" id=\"idProcedimento\">
                    <input type=\"hidden\" id=\"nomePerfil\">
                    <input type=\"hidden\" id=\"idEquipamento\">
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" id=\"btnCloseModalOs\" data-dismiss=\"modal\">Fechar</button>
                    <button type=\"button\" class=\"btn btn-primary\" id=\"btnCreateOs\">Salvar</button>
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
        // line 105
        echo twig_escape_filter($this->env, (isset($context["data_calendario"]) ? $context["data_calendario"] : null), "html", null, true);
        echo "',
                navLinks: false, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow \"more\" link when too many events
                events: [
                    ";
        // line 110
        $context['_parent'] = (array)$context;
        $context['_seq'] = twig_ensure_traversable((isset($context["dataToCalendario"]) ? $context["dataToCalendario"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
            // line 111

            if ((null === $this->getAttribute($context["evento"], "os", array()) || ($isConcluidos))) {
                echo "                        {
                            'have_os':false, 
                            'is_homologada': false,
                            'os_id':null,
                            'id' : ";
                // line 112
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                            'id_evento': ";
                // line 113
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                            'id_cliente' : '";
                // line 114
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "id", array()), "html", null, true);
                echo "',                'nomePerfil' : '";
                // line 114
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nomePerfil", array()), "html", null, true);
                echo "',
                            'cliente' : '";
                // line 115
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                            'cnpj' : '";
                // line 116
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "cpfCnpj", array()), "html", null, true);
                echo "',
                            'equipamento' : '";
                // line 117
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "marca", array()), "titulo", array()), "html", null, true);
                    echo " - ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true);
                echo "',
                            'procedimento' : '";

//                foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
//                    if('10' == twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "id", array()), "html", null, true))
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);
//                }


                echo "',

                            'title': '";
                // line 120
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                            'id_equipamento': '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "id", array()), "html", null, true);
                echo "',
                            'start' : '";
                // line 121
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["evento"], "dataAgendadaExecucao", array()), "Y-m-d"), "html", null, true);
                echo "',
                            'allDay' : false,
                            'color' : 'rgb(255, 140, 52)'
                        },
                    ";
            } else {
                // line 139
                echo "
                            ";
                // line 140
                if ((!(null === $this->getAttribute($this->getAttribute($context["evento"], "os", array()), "isHomologada", array())) && ($this->getAttribute($this->getAttribute($context["evento"], "os", array()), "isHomologada", array()) == true))) {
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

                echo "                        {
                            'have_os':true,
                            'is_homologada': false,
                            'os_id':null,
                            'id' : ";
                // line 112
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                            'id_evento': ";
                // line 113
                echo twig_escape_filter($this->env, $this->getAttribute($context["evento"], "id", array()), "html", null, true);
                echo ",
                            'id_cliente' : '";
                // line 114
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "id", array()), "html", null, true);
                echo "',                'nomePerfil' : '";
                // line 114
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nomePerfil", array()), "html", null, true);
                echo "',
                            'cliente' : '";
                // line 115
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
                echo "',
                            'cnpj' : '";
                // line 116
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "cpfCnpj", array()), "html", null, true);
                echo "',";

//                foreach ($context['_seq'] as $context["_key"] => $context["clienteEquipamento"]) {
                    echo "'equipamento' : '";
                    // line 117
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "marca", array()), "titulo", array()), "html", null, true);
                    echo " - ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true);
                    echo "',";
//                    foreach ($context['_seq'] as $context["_key"] => $context["procedimentoPmoc"]) {
                        echo "'procedimento' : '";

                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);

//                    }
//                }
                echo "',
                            'title': '";
                // line 120
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "cliente", array()), "nome", array()), "html", null, true);
               echo "',
                            'id_equipamento': '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["evento"], "clienteEquipamento", array()), "equipamento", array()), "id", array()), "html", null, true);
                echo "',
                            'start' : '";
                // line 121
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["evento"], "dataAgendadaExecucao", array()), "Y-m-d"), "html", null, true);
                echo "',
                            'allDay' : false,
                            'color' : 'rgb(255, 140, 52)'
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
        // line 126
        echo "                ],

                eventDrop:function(event, delta, revertFunc){

                    reagendaProcedimentosDoCliente(event);

                },

                eventMouseover: function(event, jsEvent, view) {

                    var html =  '<h4>Detalhe do Cliente</h4>' +
                                '<b>Cliente:</b> ' + event.title + ' CNPJ: ' + event.cnpj +
                                '</br>Equipamento: ' + event.equipamento 
                    \$('.hover-end').html(html);
                    
                },
                eventClick: function(calEvent, jsEvent, view){
                
                 __eventCliked = calEvent;
                
                if(calEvent.have_os){
                         alert('Já existe uma OS criada para esta manutenção!');
                        return;
                }else{
                   var htmlDetalhe  = '<strong>Cliente: </strong>'+calEvent.cliente+'<br/>'+
                                '<strong>CNPJ: </strong>'+calEvent.cnpj+'<br/>'+                     
                                '<strong>Ambiente: </strong><label id=\"ambiente\"></label><br/>'+                     
                                '<strong>Grupo: </strong>'+'<label id=\"grupo\"></label><br/>'+                     
                                '<strong>Equipamento: </strong>'+calEvent.equipamento+'<br/>'+
                                '<strong>Procedimentos </strong><div id=\"procedimentos_cliente\"></div>'+
                                '<p style=\"font-style: italic;\"><small>* Na criação da OS serão vinculadas todos os procedimentos.</small></p>';

                $('#dealhe-procedimento').html(htmlDetalhe);
                $('#idProcedimento').val(calEvent.id);
                $('#nomePerfil').val(calEvent.nomePerfil);
                $('#idEquipamento').val(calEvent.id_equipamento);
                
                        getEnderecosCliente(calEvent.id_cliente);                   
                        getInformacoes(calEvent.id);        
                        getProcedimentos(calEvent.id);           
                                           
                                       
                                      
                $('#modalDetalheProcedimento').modal('show');
                }
                },
                eventMouseout: function(event, jsEvent, view) {
                    \$('.hover-end').hide();
                    \$('.hover-end').html('');
                }";
        // line 151
        //echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getBaseURL", array(), "method") . "/app/execucaodeprocedimentoequipamento/listprocedimentos?date="), "html", null, true);
        echo "
                
            });
                    
    // Detect paginate
            \$('.fc-next-button, .fc-prev-button, .fc-today-button').click(function(){

                \$('.fc-view-container').hide();
                \$('.fc-header-toolbar').html('Carregando...');

                var moment = \$('#calendar').fullCalendar('getDate');
                var urlRedirect = \"";
        // line 164/app/execucaodeprocedimentoequipamento/list
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getBaseURL", array(), "method") . "/app/lista/execucaodeprocedimentoequipamento/list?date="), "html", null, true);
        echo "\" + moment.format();
             document.location.href = urlRedirect;
            });      
        
        \$('#btnCreateOs').click(function()
        {
            var idProcedimento = \$('#idProcedimento').val();
            var nomePerfil = \$('#nomePerfil').val();
            var idEquipamento = \$('#idEquipamento').val();
            var btnCreate = \$(this);
            var idColaboradorTecnico = \$('#colaboradores').val();
            var idEndereco = \$('#enderecos').val();
            var horario_atendimento = \$('#horario_atendimento').val();
            var procedimentos_cliente = \$('#procedimentos_cliente').text();
            var dataExecucao = \$('#data_execucao').val();
            
            if(idColaboradorTecnico==''){
                    alert('Selecione um Técnico que vai executar esta Ordem de Serviço');
                    return;
                }else if(idEndereco==''){
                    alert('Selecione um endereço de execução para esta Ordem de Serviço');
                    return;
                }else if(horario_atendimento=='') {
                    alert('Selecione um horário de atendimento para esta Ordem de Serviço');
                    return;
                }else if(procedimentos_cliente=='') {
                    alert('Todos os procedimentos já possuem uma Ordem de Serviço!');
                    return;
                }else if(dataExecucao=='') {
                    alert('Selecione a data de execução para esta Ordem de Serviço');
                    return;
                }
               
                
                 btnCreate.html('Salvando...').attr('disabled',true);
                \$('#btnCloseModalOs').hide();
                
                
                  \$.ajax({
                    method: \"POST\",
                    url: \"";

//                }else if(dataExecucao < date('Y-m-d')) {
//                    alert('Selecione uma data maior que a data atual para esta Ordem de Serviço');
//                    return;
        echo $this->env->getExtension('routing')->getPath("create_os_by_procedimento_agendado");
        echo "\",
                data: {
                        id_procedimento: idProcedimento,
                        nome_Perfil: nomePerfil,
                        id_equipamento: idEquipamento,
                        id_colaboradorTecnico: idColaboradorTecnico,
                        id_endereco: idEndereco,
                        horario: horario_atendimento,
                        data_execucao: dataExecucao
                    },
                     success: function (data) {
                      btnCreate.html('Salvar').attr('disabled',false);
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
        
        
        
          function getProcedimentos(idProcedimento)
        {
              var html = ''; 
           
               \$.ajax({
                method: \"POST\",
                dataType: \"json\",
                url: \"";
        echo $this->env->getExtension('routing')->getPath("get_procedimentos");
        echo "\",
                 data: {id_procedimento: idProcedimento},
                success: function (data) {

        $.each(data, function (index, value ){
            html += '<input type=\"checkbox\" class=\"icheckbox_flat-blue\" checked disabled> ' + value.procedimento + '<br>';
        });

       $('#procedimentos_cliente').html(html);

    },
                error: function (request, status, error) {
        return '<option value=\"\">Este cliente não tem endereço cadastrado</option>';
    }
            });
}
            
          
          function getInformacoes(idProcedimento)
        {
              var html = ''; 
              var html2 = ''; 
              var html3 = '';
               \$.ajax({
                method: \"POST\",
                dataType: \"json\",
                url: \"";
        echo $this->env->getExtension('routing')->getPath("get_ambiente_cliente");
        echo "\",
                 data: {id_procedimento: idProcedimento},
                success: function (data) {
                 
                   
                    $.each( data, function( index, value ){                      
                        html2 += ''+value.grupo+'';
                    });
                    
                    $.each( data, function( index, value ){
                        html3 += ''+value.ambiente+'';
                    });

                    
                    $('#grupo').html(html2);
                    $('#ambiente').html(html3);

                },
                error: function (request, status, error) {
                    return  '<option value=\"\">Este cliente não tem endereço cadastrado</option>';
                }
            });
        }
        
     

        function reagendaProcedimentosDoCliente(event){

            var moment = \$('#calendar').fullCalendar('getDate');
            var id_cliente = event.id_cliente;
            var data_atual = moment.format();
            var id_equipamento = event.id_equipamento;

            \$.ajax({
                method: \"POST\",
                url: \"";
        // line 181
        echo $this->env->getExtension('routing')->getPath("reagenda_execucoes_procedimentos_cliente");
        echo "\",
                data: { id_cliente: id_cliente,nova_data:event.start.format(), 'data_atual':data_atual, id_equipamento: id_equipamento},
                success: function (data) {
                    alert(data);
                },
                error: function (request, status, error) {
                    alert('Houve um erro inesperado! Favor entrar em contato com o suporte');
                    console.log(error);
                }
            });
        }
        
        function adicionarDiasData(dias){
            var hoje        = new Date();
            var dataVenc    = new Date(hoje.getTime() + (dias * 24 * 60 * 60 * 1000));
            return dataVenc.getFullYear() + \"/\" + (dataVenc.getMonth() + 1) + \"/\" + dataVenc.getDate();
        }        
  

    </script>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list_pmoc_agenda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array(264 => 181, 244 => 164, 228 => 151, 201 => 126, 190 => 121, 186 => 120, 178 => 117, 174 => 116, 170 => 115, 166 => 114, 162 => 113, 158 => 112, 155 => 111, 151 => 110, 143 => 105, 99 => 63, 88 => 61, 84 => 60, 81 => 59, 79 => 58, 36 => 17, 34 => 16, 31 => 14, 28 => 13, 11 => 12,);
    }
}
