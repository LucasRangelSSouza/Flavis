<?php

/* AppBundle:CRUD:list__action_cancela_os_admin.html.twig */
class __TwigTemplate_473b04be25cb35bd93df53ced633bb73784219af11cc5ab86eb21486830a4144 extends Twig_Template
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
        // line 1
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isCancelada", array())) {
            // line 2
            echo "<button
        class=\"btn btn-sm btn-warning view_link disabled\" style=\"width: 120px;\">
   <i class=\"fa fa-times\" aria-hidden=\"true\"></i>
    Cancelada
</button>
";
        } else {
            // line 8
            echo "    <button
            onclick=\"if(confirm('Deseja confirmar o cancelamento desta OS?')){ var motivo = prompt('Informa o motivo do cancelamento'); if (motivo == null || motivo=='' ) { alert('Informe o motivo para cancelamento desta OS') } else { document.location.href='";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "cancela", 1 => (isset($context["object"]) ? $context["object"] : null)), "method"), "html", null, true);
            echo "?motivo='+motivo; }}\"
            class=\"btn btn-sm btn-warning cancelaOs\" style=\"width: 302px;\"
       data-os=\"";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "id", array()), "html", null, true);
            echo "\">
        <i class=\"fa fa-times\" aria-hidden=\"true\"></i>
        Cancelar
    </button>
";
        }
        // line 16
        echo "
<style>

.btn-group{
width: 305px;
}

    #validate {
        display: none;
        color: #ff0000;
        text-align: center;
        padding-top: 10px;
    }

</style>

<script>

    \$(document).ready(function(){

        \$('.cancelaOs').click(function(){



        });

    });

</script>";
    }

    public function getTemplateName()
    {
        return "AppBundle:CRUD:list__action_cancela_os_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 16,  37 => 11,  32 => 9,  29 => 8,  21 => 2,  19 => 1,);
    }
}
