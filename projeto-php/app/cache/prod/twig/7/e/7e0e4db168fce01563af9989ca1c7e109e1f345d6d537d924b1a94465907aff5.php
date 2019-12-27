<?php

/* AppBundle:Orcamento:orcamento-actions.html.twig */
class __TwigTemplate_7e0e4db168fce01563af9989ca1c7e109e1f345d6d537d924b1a94465907aff5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Orcamento:orcamento-actions.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        // line 4
        echo "
    ";
        // line 5
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) != "aberto")) {
            // line 6
            echo "    <button class=\"btn btn-success\" disabled>
        <i class=\"fa fa-share\" aria-hidden=\"true\"></i> Enviar para Fornecedores</button>
    ";
        } else {
            // line 9
            echo "        <button class=\"btn btn-success bt_action_status\" data-action=\"send_fornecedor\">
            <i class=\"fa fa-share\" aria-hidden=\"true\"></i> Enviar para Fornecedores</button>
    ";
        }
        // line 12
        echo "
    ";
        // line 13
        if ((($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "cancelada") || ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "autorizado"))) {
            // line 14
            echo "    <button class=\"btn btn-success\" disabled>
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i> Autorizar</button>
    ";
        } else {
            // line 17
            echo "        <button class=\"btn btn-success bt_action_status\" data-action=\"autorizar\">
            <i class=\"fa fa-check\" aria-hidden=\"true\"></i> Autorizar</button>
    ";
        }
        // line 20
        echo "
    ";
        // line 21
        if ((($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "cancelada") || ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "autorizado"))) {
            // line 22
            echo "    <button class=\"btn btn-danger\" disabled>
        <i class=\"fa fa-close\" aria-hidden=\"true\"></i> Cancelar</button>
    ";
        } else {
            // line 25
            echo "        <button class=\"btn btn-danger bt_action_status\" data-action=\"cancelar\">
            <i class=\"fa fa-close\" aria-hidden=\"true\"></i> Cancelar</button>
    ";
        }
        // line 28
        echo "

    <script>

        \$(document).ready(function(){

            \$('.bt_action_status').click(function(){

                var action = \$(this).data('action');

                \$(this).addClass('disabled').html('Enviando...');

                \$.ajax({
                    type: 'get',
                    url: '";
        // line 42
        echo $this->env->getExtension('routing')->getPath("change_status_orcamento");
        echo "',
                    data: 'id_orcamento=";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "id", array()), "html", null, true);
        echo "&action=' + action,
                    beforeSend:function(xhr){
//                    \$('.overlay-wait').show();
                    },
                    success:function(data,textStatus,jqXHR){

                     alert(data);
                     document.location.reload();

                    },
                    statusCode: {
                        200: function(data){
                            alert(data.responseText);
                            document.location.reload();
                        },
                        400: function(data){
                            alert(data.responseText);
                            document.location.reload();
                        },
                        404: function(data){
                            alert(data.responseText);
                            \$('.overlay-wait').hide();
                        },
                        401: function(){
                            alert(data.responseText);
                            \$('.overlay-wait').hide();
                        },
                        403: function() {
                            alert(data.responseText);
                            \$('.overlay-wait').hide();
                        },
                        204: function(){
                            alert(data.responseText);
                            \$('.overlay-wait').hide();
                        },
                        500: function() {
                            \$('.overlay-wait').hide();
                            alert('Houve um erro inesperado no servidor. Entre em contato com o suporte');
                        }
                    }
                });
            });
        });

    </script>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Orcamento:orcamento-actions.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 43,  92 => 42,  76 => 28,  71 => 25,  66 => 22,  64 => 21,  61 => 20,  56 => 17,  51 => 14,  49 => 13,  46 => 12,  41 => 9,  36 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
