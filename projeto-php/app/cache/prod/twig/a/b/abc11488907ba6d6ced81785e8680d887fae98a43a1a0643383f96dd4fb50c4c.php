<?php

/* AppBundle:Cliente:etiquetas-equipamentos.html.twig */

class __TwigTemplate_abc11488907ba6d6ced81785e8680d887fae98a43a1a0643383f96dd4fb50c4c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array();
    }

    protected function doDisplay(array $context, array $blocks = array())
    {

        $clienteModel = new \AppBundle\Model\Cliente();

//        $equipamento = $clienteModel->informacoesQRcode(twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true));

        $clienteEquipamentos = $this->getAttribute((isset($context["cliente_model"]) ? $context["cliente_model"] : null), "informacoesQRcode", array(), "method");

        $ambienteEquipamentos = $this->getAttribute((isset($context["cliente_model"]) ? $context["cliente_model"] : null), "ambienteEquipamento", array(), "method");


        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\" integrity=\"sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M\" crossorigin=\"anonymous\">

    <style>

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fff;
            font: 10pt \"Tahoma\";
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 310mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #fff solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            padding: 1cm;
            border: 1px #eee solid;
            outline: 2cm #fff solid;
        }

        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

     
        
        * {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 350px;
  height: 10%;
  padding: 30px;
  margin: 15px;
}

/* Clearfix (clear floats) */
.row::after {
  content: \"\";
  clear: both;
  display: table;
}
        
        img{
       width:40%;
       float: right;
        }
        
        .logo{
        width: 40%;
        float:left;
        }
   

    </style>

    <script src=\"https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js\"></script>
    <script src=\"../../../../../../js/qrcode.min.js\"></script>
    <script src=\"../../../../../../js/qrcode.js\"></script>
   
 

</head>
<body>

<div class=\"book\">

    <div class=\"page\">

        <div class=\"subpage\">

            <p style=\"text-align: center;\"><strong>";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cliente"]) ? $context["cliente"] : null), "nome", array()), "html", null, true);
        echo "</strong><br/><small>Etiquetas de equipamentos</small></p>

            
            <div class=\"row\">  ";

         // line 88
        $context['_parent'] = (array)$context;
        $context['_seq'] = twig_ensure_traversable((isset($context["equipamentos"]) ? $context["equipamentos"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["equipamento"]) {

            foreach ($clienteEquipamentos as $clienteEquipamento) {

                if ($clienteEquipamento->getId() == twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true)) {

                    echo "
                        <div class=\"column border border-primary rounded\">            
                      <div id=\"";

                    echo twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true);

                    echo "\"><div style=\"writing-mode: tb-rl; transform: rotate(0deg); float: right; font-size: 14px;\">www.orsin.com.br</div></div>";

//                    echo 'ID: '.twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true). '<br>';
//
//                    echo 'Modelo: '.twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["equipamento"], "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true).'<br>';
//
//                    echo 'Marca: '.twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["equipamento"], "equipamento", array()), "marca", array()), "titulo", array()), "html", null, true).'<br>';
//
//                    echo 'Serie: ' . $clienteEquipamento->getEquipamento()->getSerie().'<br>';

                    foreach ($ambienteEquipamentos as $ambienteEquipamento) {
                        foreach ($ambienteEquipamento->getEquipamentos() as $equipamento) {
                            if($equipamento->getId() == $clienteEquipamento->getEquipamento()->getId())
                               $ambiente = $ambienteEquipamento->getSigla();
                               $localizacao = $ambienteEquipamento->getLocalizacao();
                        }
                    }

                    $perfis = $this->getAttribute((isset($context["cliente_model"]) ? $context["cliente_model"] : null), "getPerfis", array(), "method");
                    $empresas = $this->getAttribute((isset($context["cliente_model"]) ? $context["cliente_model"] : null), "getEmpresas", array(), "method");

                    foreach ($perfis as $perfil) {
                            if($perfil->getNomePerfil() == twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "nomePerfil", array()), "html", null, true))
                            $idEmpresa = $perfil->getEmpresa();
                    }

                    foreach ($empresas as $empresa){
                        if($idEmpresa == $empresa){
                            $empresaMantenedora = $empresa;
                        }
                    }


                    echo '<img class="logo" src="../../../../../../'.$empresaMantenedora->getPathFoto().'" alt="logo"><br>';

                    echo '<br><br><br><div style="margin-top: 15%;">'.$localizacao.'-'.$ambiente.'-'.substr(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["equipamento"], "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true),0,3).'-'.twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true);

                    echo '</div><br><br>Modelo: '.twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["equipamento"], "equipamento", array()), "modelo", array()), "titulo", array()), "html", null, true);


               echo  "<script type=\"text/javascript\">
                    new QRCode(document.getElementById(\"";

                    echo twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true);

                    echo "\"), \"http://orsin.com.br/app.php/app/";


                    echo twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "nomePerfil", array()), "html", null, true);

                    echo "/clienteequipamento/";


                    echo twig_escape_filter($this->env, $this->getAttribute($context["equipamento"], "id", array()), "html", null, true);


                    echo "/show&linkservico\"); ";

                    echo "</script><br/>
              
                   <small> ";

                    echo "</small></div>";
                }
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['equipamento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        echo "
            </div>

        </div>
    </div>

</div>

</body>
</html>


";
    }

    public function getTemplateName()
    {
        return "AppBundle:Cliente:etiquetas-equipamentos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array(153 => 104, 138 => 97, 127 => 93, 123 => 92, 119 => 91, 115 => 89, 111 => 88, 104 => 84, 19 => 1,);
    }
}
