<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig */
class __TwigTemplate_bc20141b5e1f90fd6f1d1cc63005cb8e2407616a61894ff106776ec6bd0ed635 extends Twig_Template
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
        // line 18
        echo "
";
        // line 20
        echo "
<script type=\"text/javascript\">

function isRegistredCnpj(){
   var cnpjCampo = $(\".mask_cnpj\").val();
      $.ajax({
                method: \"POST\",
                url: \"";

        echo $this->env->getExtension('routing')->getPath("isRegistred");
        echo "\",
                data: {cnpj:cnpjCampo}
            }).done(function(resposta) {
     
    $(\"#linkRegistro\").attr(\"href\",resposta);         
   $('#modalCnpj').modal('show');
   
   
});
}

function isRegistredCpf(){
   var cpfCampo = $(\".mask_cpf\").val();
      $.ajax({
                method: \"POST\",
                url: \"";

        echo $this->env->getExtension('routing')->getPath("isRegistred");
        echo "\",
                data: {
        cpf:
        cpfCampo}
            }).done(function (resposta) {
            
        $(\"#linkRegistro\").attr(\"href\",resposta);         
   $('#modalCnpj') . modal('show');
  
});
}

function isRegistredClienteCnpj(){
 
   var cnpjCampo = $(\".mask_cpfcnpj\").val();
   

      $.ajax({
                method: \"POST\",
                url: \"";

        echo $this->env->getExtension('routing')->getPath("isRegistred");
        echo "\",
                data: {
        cnpjCliente:
        cnpjCampo}
            }).done(function (resposta) {
  
        $(\"#linkRegistro\").attr(\"href\",resposta);         
   $('#modalCnpj') . modal('show');
   

});
}

function isRegistredClienteCpf(){
 
   var cpfCampo = $(\".mask_cpfcnpj\").val();
   
   
      $.ajax({
                method: \"POST\",
                url: \"";

        echo $this->env->getExtension('routing')->getPath("isRegistred");
        echo "\",
                data: {
        cpfCliente:
        cpfCampo}
            }).done(function (resposta) {
    
        $(\"#linkRegistro\").attr(\"href\",resposta);         
   $('#modalCnpj') . modal('show');
   

});
}

$(document).ready(function(){


  $(\".mask_telefone\").focusout(function(){
    var phone, element;
    element = $(this);
    element.unmask();
    phone = element.val().replace(/\D/g, '');
    if(phone.length > 10) {
        element.mask(\"(99) 9 9999-999?9\");
    } else {
        element.mask(\"(99) 9999-9999?9\");
    }
}).trigger('focusout');

       
     $(\".file\").change(function (){
     validate();
     });
   
   function validate() {
	var file_size = $('.file')[0].files[0].size;
	if(file_size>2097152) {
		alert(\"O Arquivo contém mais que 2MB\");
		$('.file').val('');
		return false;
	} 
	var ext = $('.file').val().split('.').pop().toLowerCase();
 if($.inArray(ext, ['docx','png','jpg','jpeg', 'pdf']) == -1) {
    alert('Tipo de arquivo inválido!');
    $('.file').val('');
}
	return true;
  }
    
     $(\".mask_cnpj\")
        .focusout(function() {
        var cnpjCampo = $(\".mask_cnpj\").val();
      if(cnpjCampo != '__.___.___/____-__'){
       isRegistredCnpj();
       }
        });
        
        $(\".mask_cpf\")
        .focusout(function() {
        var cpfCampo = $(\".mask_cpf\").val();    
      if(cpfCampo != '___.___.___-__'){
       isRegistredCpf();
       }
        });
        
         $(\".mask_cpfcnpj\")
        .focusout(function() {
        var cpfCnpjCampo = $(\".mask_cpfcnpj\").val();    
      if(cpfCnpjCampo != '___.___.___-__' && cpfCnpjCampo != '__.___.___/____-__' && cpfCnpjCampo != ''){
        if(cpfCnpjCampo.length == 18){
        isRegistredClienteCnpj();
        }
        if(cpfCnpjCampo.length == 14){
       isRegistredClienteCpf();
       }
       }
        });
        


 $(\".input_cep\").unmask().mask(\"99999-999\");


            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $(\"#rua\").val(\"\");
                $(\"#bairro\").val(\"\");
                $(\"#cidade\").val(\"\");
                $(\"#uf\").val(\"\");
                $(\"#ibge\").val(\"\");
            }
            
            //Quando o campo cep perde o foco.
            $(\".input_cep\").blur(function() {

                //Nova variável \"cep\" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != \"\") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com \"...\" enquanto consulta webservice.
                        $(\".input_logradouro\").val(\"...\");
                        $(\"#bairro\").val(\"...\");
                        $(\"#cidade\").val(\"...\");
                        $(\"#uf\").val(\"...\");
                        $(\"#ibge\").val(\"...\");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON(\"https://viacep.com.br/ws/\"+ cep +\"/json/?callback=?\", function(dados) {

                            if (!(\"erro\" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $(\".input_logradouro\").val(dados.logradouro);
                                $(\"#bairro\").val(dados.bairro);
                                $(\"#cidade\").val(dados.localidade);
                                $(\"#uf\").val(dados.uf);
                                $(\"#ibge\").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert(\"CEP não encontrado.\");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert(\"Formato de CEP inválido.\");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    // handle the add link
    var field_add_";
        // line 26
        echo (isset($context["id"]) ? $context["id"] : null);
        echo " = function(event) {

        event.preventDefault();
        event.stopPropagation();

        var form = jQuery(this).closest('form');

        // the ajax post
        jQuery(form).ajaxSubmit({
            url: '";
        // line 35
        echo $this->env->getExtension('routing')->getPath("sonata_admin_append_form_element", (array("code" => $this->getAttribute($this->getAttribute($this->getAttribute(        // line 36
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "code", array()), "elementId" =>         // line 37
(isset($context["id"]) ? $context["id"] : null), "objectId" => $this->getAttribute($this->getAttribute($this->getAttribute(        // line 38
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "id", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "subject", array())), "method"), "uniqid" => $this->getAttribute($this->getAttribute($this->getAttribute(        // line 39
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "root", array()), "uniqid", array()), "subclass" => $this->getAttribute($this->getAttribute($this->getAttribute(        // line 40
(isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "get", array(0 => "subclass"), "method")) + $this->getAttribute($this->getAttribute(        // line 41
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")));
        echo "',
            type: \"POST\",
            dataType: 'html',
            data: { _xml_http_request: true },
            success: function(html) {
                if (!html.length) {
                    return;
                }

                jQuery('#field_container_";
        // line 50
        echo (isset($context["id"]) ? $context["id"] : null);
        echo "').replaceWith(html); // replace the html

                Admin.shared_setup(jQuery('#field_container_";
        // line 52
        echo (isset($context["id"]) ? $context["id"] : null);
        echo "'));

                if(jQuery('input[type=\"file\"]', form).length > 0) {
                    jQuery(form).attr('enctype', 'multipart/form-data');
                    jQuery(form).attr('encoding', 'multipart/form-data');
                }
                jQuery('#sonata-ba-field-container-";
        // line 58
        echo (isset($context["id"]) ? $context["id"] : null);
        echo "').trigger('sonata.add_element');
                jQuery('#field_container_";
        // line 59
        echo (isset($context["id"]) ? $context["id"] : null);
        echo "').trigger('sonata.add_element');
            }
        });

        return false;
    };

    var field_widget_";
        // line 66
        echo (isset($context["id"]) ? $context["id"] : null);
        echo " = false;

    // this function initialize the popup
    // this can be only done this way has popup can be cascaded
    function start_field_retrieve_";
        // line 70
        echo (isset($context["id"]) ? $context["id"] : null);
        echo "(link) {

        link.onclick = null;

        // initialize component
        field_widget_";
        // line 75
        echo (isset($context["id"]) ? $context["id"] : null);
        echo " = jQuery(\"#field_widget_";
        echo (isset($context["id"]) ? $context["id"] : null);
        echo "\");

        // add the jQuery event to the a element
        jQuery(link)
            .click(field_add_";
        // line 79
        echo (isset($context["id"]) ? $context["id"] : null);
        echo ")
            .trigger('click')
        ;

        return false;
    }
</script>

<!-- / edit one association -->

";
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 79,  107 => 75,  99 => 70,  92 => 66,  82 => 59,  78 => 58,  69 => 52,  64 => 50,  52 => 41,  51 => 40,  50 => 39,  49 => 38,  48 => 37,  47 => 36,  46 => 35,  34 => 26,  26 => 20,  23 => 18,  19 => 11,);
    }
}
