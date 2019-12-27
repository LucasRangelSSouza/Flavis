<?php

/* AppBundle:Almoxarifado:produtos-compra-actions.html.twig */
class __TwigTemplate_ac9f5682adf26aa278d408738b2d8fff9f08ed7dd9efc2fe27b8c3e8a4a40af7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Almoxarifado:produtos-compra-actions.html.twig", 1);
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
        if ((($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "cancelado") || ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "aprovado"))) {
            // line 6
            echo "        <button class=\"btn btn-success\" disabled>
            <i class=\"fa fa-check\" aria-hidden=\"true\"></i> Aprovar</button>
    ";
        } else {
            // line 9
            echo "        <button class=\"btn btn-success bt_action_status\" data-action=\"aprovar\">
            <i class=\"fa fa-check\" aria-hidden=\"true\"></i> Aprovar</button>
    ";
        }
        // line 12
        echo "
    ";
        // line 13
        if ((($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "cancelado") || ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "estado", array()) == "aprovado"))) {
            // line 14
            echo "        <button class=\"btn btn-danger\" disabled>
            <i class=\"fa fa-close\" aria-hidden=\"true\"></i> Cancelar</button>
    ";
        } else {
            // line 17
            echo "        <button class=\"btn btn-danger bt_action_status\" data-action=\"cancelar\">
            <i class=\"fa fa-close\" aria-hidden=\"true\"></i> Cancelar</button>
    ";
        }
        // line 20
        echo "

    <script>

        \$(document).ready(function(){

            \$('.bt_action_status').click(function(){

                var action = \$(this).data('action');

                \$(this).addClass('disabled').html('Enviando...');

                \$.ajax({
                    type: 'get',
                    url: '";
        // line 34
        echo $this->env->getExtension('routing')->getPath("change_status_compra");
        echo "',
                    data: 'id_ordemcompra=";
        // line 35
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
        return "AppBundle:Almoxarifado:produtos-compra-actions.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 35,  77 => 34,  61 => 20,  56 => 17,  51 => 14,  49 => 13,  46 => 12,  41 => 9,  36 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
