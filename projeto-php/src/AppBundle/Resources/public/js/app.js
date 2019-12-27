/**
 * Created by bruno on 20/02/16.
 */



var __osHomologaClicada = '';

$(document).ready(function(){




//    $(document).on('blur','.input_cep',function(){
//        //console.log('OK')
//    });


    /* Cancela OS */
    // $('.cancelaOs').click(function(){
    //
    //     if(confirm('Deseja confirmar o cancelamento desta OS?')){
    //         var urlCancelaUrl = getGlobal_path_cancela_os(object.id);
    //         document.location.href=urlCancelaUrl;
    //     }
    //
    // });

    /* Cancela OS */

    /* Homologação de os */

    $('#modalHomologacao').on('hidden.bs.modal', function () {
        clearModalHomologaOs();
    });

    $('.homologaOs').click(function(e){
        e.preventDefault();
        __osHomologaClicada = $(this).data('os');
        $('#modalHomologacao').modal('show');
    });

    $('#btnHomologaOs').click(function(e){

        e.preventDefault();
        homologaOS();

    });

    /* Homologação de os */

    $(document).on('click','.bt-deletar-row-form-custom-many-to-many',function(e){

        e.preventDefault();

        if(confirm('Deseja apagar este registro?')){

            $(this).parent().parent().parent().remove();
        }

    });

    $(".mask_cnpj").mask("99.999.999/9999-99");
    $(".mask_date").mask("99/99/9999");

    $(".dinheiro").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

    /* textiput_with_count_type */

    var number_max_textarea_pergunta = 500;
    var currentNumber = 0;

    $(".textarea_with_count_widget").keyup(function(){
        counterText_textarea_widget(currentNumber,number_max_textarea_pergunta,$(this));
    });

    /* textiput_with_count_type */

    /* textiput_maximize_with_count_type */

        $('.with_counter > a').click(function(e){

            e.preventDefault();

            var content_textiput_maximize_with_count = '.maximize_textarea';
            var objVisible = $(this).parent().find(content_textiput_maximize_with_count);

            if(objVisible.is(":visible")){
                $(this).find('.fa').removeClass('fa-minus');
                $(this).find('.fa').addClass('fa-plus');
                objVisible.fadeOut(200);
            }else{
                $(this).find('.fa').removeClass('fa-plus');
                $(this).find('.fa').addClass('fa-minus');
                objVisible.fadeIn(200);
            }
    })

    /* textiput_maximize_with_count_type */


});

/* textiput_with_count_type */
function counterText_textarea_widget(currentNumber,number_max_textarea_pergunta,obj)
{
    currentNumber = number_max_textarea_pergunta - obj.val().length;

    var counter_text = obj.parent().find(".counter_number .text_number");

    if(currentNumber < (number_max_textarea_pergunta/3)){
        counter_text.addClass('text_number_finish');
    }else{
        counter_text.removeClass('text_number_finish');
    }

    counter_text.text(currentNumber);
}
/* textiput_with_count_type */


/* Homologação de OS */

function clearModalHomologaOs()
{

    $('#validateHomologaOs').hide();
    $('#validateHomologaOs p').html("");

    $('#valorOs').val("");
    $('#numParcelasOs').select2('data', null);
    $('#meioPagamentoOs').select2('data', null);
    $('#obsHomologaOs').val("");

}

function homologaOS()
{
    var valor = $('#valorOs').val();
    var numeroParcelas = $('#numParcelasOs').val();
    var meioPagamento = $('#meioPagamentoOs').val();
    var obs = $('#obsHomologaOs').val();
    var objClicked = $(this);

    // validate and submit data
    if(valor=='' || numeroParcelas=='' || meioPagamento==''){

        if(__osHomologaClicada==''){
            $('#validateHomologaOs').show();
            $('#validateHomologaOs p').html("Os inválida");
        }

        $('#validateHomologaOs').show();
        $('#validateHomologaOs p').html("Os campos valor, Qdt. de parcelas e meio de pagamento são obrigatórios");

    }else{

        objClicked.attr('disabled',true);

        $.ajax({
            method: "POST",
            url: __global_path_save_homologacao_os,
            data: {
                id_os: __osHomologaClicada,
                valor: valor,
                parcelas: numeroParcelas,
                forma_pagamento: meioPagamento,
                obs: obs
            },
            success: function (data) {

                objClicked.attr('disabled',false);
                $('#validateHomologaOs').show();
                $('#validateHomologaOs p').html(data);

                setTimeout(function(){
                    document.location.reload();
                },1000);

            },
            error: function (request, status, error) {

                objClicked.attr('disabled',false);
                $('#validateHomologaOs').show();
                $('#validateHomologaOs p').html(error);

            }
        })

    }
}

/* Homologação de OS */
