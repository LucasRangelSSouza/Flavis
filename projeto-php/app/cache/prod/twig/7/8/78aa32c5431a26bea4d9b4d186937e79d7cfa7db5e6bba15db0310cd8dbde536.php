<?php

/* AppBundle:Os:relatorio_os_single.html.twig */
class __TwigTemplate_78aa32c5431a26bea4d9b4d186937e79d7cfa7db5e6bba15db0310cd8dbde536 extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Relatório de OS</title>
    <style>
        body {
            margin: 0.5cm;
            padding: 0.5cm;
            background-color: #fff;
            font: 12pt \"Tahoma\";
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        h1,h2,h3,h4{
            padding: 0;
            margin: 0;
        }
        .page {
            width: 21cm;
            min-height: 29.7cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .subpage {
            height: 295mm;
            outline: 2cm #fff solid;
            position:relative;
        }

        @page {
            size: A4;
            margin: 0.5cm;
        }
        @media print {
            .page {
                margin: 0.5cm;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            .box_vinho_procedimento{
                background: #7F223D;
            }
            .subtitle-detalhe{
                background: #eee;
            }
            .subtitle-detalhe{padding: 0 !important;}
        }

        .cf:before,
        .cf:after {
            content: \" \"; /* 1 */
            display: table; /* 2 */
        }

        .cf:after {
            clear: both;
        }

        /**
         * For IE 6/7 only
         * Include this rule to trigger hasLayout and contain floats.
         */
        .cf {
            *zoom: 1;
        }

        #content {
            display: table;
            position: absolute;
            right: 0;
            bottom: 0;
        }

        #pageFooter {
            display: table-footer-group;

        }

        #pageFooter:after {
            counter-increment: page;
            content:\"Page \" counter(page);
            left: 0;
            top: 100%;
            white-space: nowrap;
            z-index: 20px;
            -moz-border-radius: 5px;
            -moz-box-shadow: 0px 0px 4px #222;
            background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
            background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
        }

        .box_vinho_procedimento{
            border: 1px solid #111;
            width: 1000px;
            background: #7F223D;
            padding: 10px;
            margin-bottom: 40px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .box_vinho_procedimento h4{
            color: #fff;
            margin-bottom: 10px;
        }

        .box-detalhe-procedimento{
            border: 1px dashed #111;
            padding: 20px;
            background: #fff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .property-item{
            float: left;
            margin-right: 8px;
        }
        .foto-item{margin-left: 0px;display: inline-block;}
        .foto-item .foto-bg{
            width: 100%;
            height: 100%;
            background-position: center center;
            background-size: 100% 100%;
            padding: 3px;
            color: #000 !important;
            text-align: center;
            font-weight: bold;
            border:1px solid #7F223D;
            line-height: 12px;
        }
        .foto-item .foto-bg:hover{
            border:1px solid #0000ff;
        }
        .foto-item p{
            margin-top: 5px;
        }
        a{color: #111 !important; text-decoration: none;}

        .subtitle-detalhe{
            background: #eee;
            padding:10px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .assinatura{
            width: 400px;
            border-top: 1px solid #111;
            margin: auto;
            text-align: center;
        }

        .assinatura_img{
            width: 400px;
            margin: auto;
            text-align: center;
        }

        .texto-ocorrencia{
            color: #fff;
        }

    </style>
</head>
<body>
        <table style=\"width:800px;margin:auto;\">
            <tr>
                <td>

                    ";
        // line 186
        echo "                    <table style=\"width: 100%;\">
                        <tr style=\"text-align: center;\">
                            <td>
                                <div style=\"padding-bottom:20px;text-align: center;\">
                                    <div style=\"width:300px;margin: auto;\">
                                        <img style=\"width:100%;\" src=\"";
        // line 191
        echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
        echo "/bundles/app/img/logo_app.png\" alt=\"\">
                                    </div>
                                    <div style=\"font-size: .7em;padding-top: 6px;\">

                                        FLAVIS CONDICIONAMENTO CONTROLE AMBIENTAL<br style=\"line-height: 16px;\"/>
                                        Rua 1046, nº 155, Lt 31 - Setor Pedro Ludovico, 75825-130 - Goiânia-GO

                                    </div>
                                </div>
                                <hr/>
                            </td>
                        </tr>
                    </table>

                    <table style=\"width: 100%;\">
                        <tr>
                            <td style=\"width: 33%\"><h3>PEDIDO DE MANUTENÇÃO</h3></td>
                            <td style=\"width: 33%;text-align: center;\"><strong>Data:</strong> ";
        // line 208
        echo twig_escape_filter($this->env, (isset($context["data"]) ? $context["data"] : null), "html", null, true);
        echo "</td>
                            <td style=\"width: 33%;text-align: right;\"><strong>Ordem de serviço nº:</strong> ";
        // line 209
        echo twig_escape_filter($this->env, (isset($context["num_os"]) ? $context["num_os"] : null), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"width: 50%\"><strong>Nome:</strong> ";
        // line 212
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "cliente", array()), "nome", array()), "html", null, true);
        echo "</td>
                            <td style=\"width: 50%;text-align: right;\"><strong>CNPJ:</strong> ";
        // line 213
        echo twig_escape_filter($this->env, (isset($context["cpnj_cliente"]) ? $context["cpnj_cliente"] : null), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"text-align: left;\"><strong>Unidade:</strong> ";
        // line 216
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "cliente", array()), "razaoSocial", array()), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td colspan=\"2\" style=\"width: 50%\">
                                <strong>Avalista:</strong> ";
        // line 220
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "receptorNome", array()), "html", null, true);
        echo "
                            </td>
                            <td style=\"width: 50%;text-align: right;\"><strong>RG: </strong>";
        // line 222
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "receptorRg", array()), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"padding-top: 20px;\">
                                <strong>Endereço de execução:</strong>
                                <p>";
        // line 227
        echo twig_escape_filter($this->env, (isset($context["endereco"]) ? $context["endereco"] : null), "html", null, true);
        echo "</p>
                            </td>
                        </tr>
                    </table>

                    <hr/>

";
        // line 234
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "isPmoc", array())) {
            // line 235
            echo "
    <table style=\"width: 100%;\">
        <tr>
            <strong style=\"padding-bottom: 10px;display: block;text-align: center;\">OS DE PMOC</strong>
            <p style=\"text-align: center;\">Confira abaixo a lista de procedimentos executados</p>
        </tr>
    </table>

    ";
            // line 244
            echo "    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "relatoriosExecucoesProcedimentos", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["relatorio"]) {
                // line 245
                echo "
        <div class=\"box_vinho_procedimento cf\">
            <h4>#";
                // line 247
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["relatorio"], "execucaoDeProcedimentoEquipamento", array()), "id", array()), "html", null, true);
                echo " Procedimento executado: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["relatorio"], "execucaoDeProcedimentoEquipamento", array()), "procedimentoPmoc", array()), "titulo", array()), "titulo", array()), "html", null, true);
                echo "</h4>

            <div class=\"box-detalhe-procedimento cf\">
                <p class=\"subtitle-detalhe\"><strong>Relatório da execução</strong></p>

                ";
                // line 252
                if ( !twig_test_empty($this->getAttribute($context["relatorio"], "relatorioDeExecucao", array()))) {
                    // line 253
                    echo "
                    ";
                    // line 254
                    echo twig_escape_filter($this->env, $this->getAttribute($context["relatorio"], "relatorioDeExecucao", array()), "html", null, true);
                    echo "

                ";
                } else {
                    // line 257
                    echo "                    <div class=\"property-box row cf\">
                        ";
                    // line 258
                    $context["valores"] = $this->getAttribute((isset($context["pmoc_model"]) ? $context["pmoc_model"] : null), "printPropriedadesRelatorioPmoc", array(0 => $this->getAttribute($context["relatorio"], "propriedadeEquipamentoComValoresColetado", array())), "method");
                    // line 259
                    echo "                        ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["valores"]) ? $context["valores"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["valor"]) {
                        // line 260
                        echo "                            <div class=\"property-item col-md-2 cf\">
                                <strong>";
                        // line 261
                        echo twig_escape_filter($this->env, $this->getAttribute($context["valor"], "label", array()), "html", null, true);
                        echo "</strong>: ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["valor"], "valor", array()), "html", null, true);
                        echo "
                            </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['valor'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 264
                    echo "                    </div>
                ";
                }
                // line 266
                echo "
                <div class=\"fotos\"><p class=\"subtitle-detalhe\"><strong>Fotos da execução</strong></p></div>
                <div class=\"foto-box row cf\">
                    ";
                // line 269
                $context["fotos"] = $this->getAttribute($this->getAttribute($context["relatorio"], "execucaoDeProcedimentoEquipamento", array()), "fotos", array());
                // line 270
                echo "                    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["fotos"]) ? $context["fotos"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["foto"]) {
                    // line 271
                    echo "                        <a href=\"/";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "pathFile", array()), "html", null, true);
                    echo "\" target=\"_blank\" class=\"foto-item cf\" style=\"display: inline-block;margin-right: 10px;\">
                            <img src=\"/";
                    // line 272
                    echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "pathFile", array()), "html", null, true);
                    echo "\" style=\"display: inline-block;height: 150px;\">
                            <p>";
                    // line 273
                    echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "titulo", array()), "html", null, true);
                    echo "</p>
                        </a>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['foto'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 276
                echo "                </div>

            </div>

        </div>

    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['relatorio'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 283
            echo "
";
        } else {
            // line 285
            echo "

    <table style=\"width: 100%;\">
        <tr>
            <strong style=\"padding-bottom: 10px;display: block;\">OS DE ROTINA</strong>
            <p>Confira abaixo o relatório de resolução da ocorrência</p>
        </tr>
    </table>

    <div class=\"box_vinho_procedimento cf\">

        <div class=\"texto-ocorrencia\">
            <h4 style=\"text-align: center;\">OCORRÊNCIA</h4>
            <p>";
            // line 298
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "ocorrencia", array()), "html", null, true);
            echo "</p>
        </div>

        <div class=\"box-detalhe-procedimento cf\">
            <p class=\"subtitle-detalhe\" style=\"text-align: center;\"><strong>Relatório da execução</strong></p>
                <p>
                    ";
            // line 304
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "relatorioAvaliacao", array()), "html", null, true);
            echo "
                </p>
            <div class=\"fotos\"><p class=\"subtitle-detalhe\"><strong>Fotos da execução</strong></p></div>
            <div class=\"foto-box row cf\">
                ";
            // line 308
            $context["fotos"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "fotos", array());
            // line 309
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["fotos"]) ? $context["fotos"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["foto"]) {
                // line 310
                echo "                    <a href=\"/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "pathFile", array()), "html", null, true);
                echo "\" target=\"_blank\" class=\"foto-item cf\" style=\"display: inline-block;margin-right: 10px;\">
                        <img src=\"/";
                // line 311
                echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "pathFile", array()), "html", null, true);
                echo "\" style=\"display: inline-block;height: 150px;\">
                        <p>";
                // line 312
                echo twig_escape_filter($this->env, $this->getAttribute($context["foto"], "titulo", array()), "html", null, true);
                echo "</p>
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['foto'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 315
            echo "            </div>

            <div class=\"justificativa\">
                <strong>Justificativa de encerramento:</strong><br/>
                ";
            // line 319
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "justificativaEncerramento", array()), "html", null, true);
            echo "
            </div>

        </div>

    </div>


";
        }
        // line 328
        echo "
    <div class=\"assinatura_img\">
        ";
        // line 330
        if ( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "receptorAssinatura", array()))) {
            // line 331
            echo "        <img src=\"/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "receptorAssinatura", array()), "html", null, true);
            echo "\" style=\"max-height: 80px;\">
        ";
        }
        // line 332
        echo "        
    </div>
    <div class=\"assinatura\">Assinatura de conferência<br/>";
        // line 334
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "receptorNome", array()), "html", null, true);
        echo " - RG: ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "receptorRg", array()), "html", null, true);
        echo "</div>



                    ";
        // line 339
        echo "

                    ";
        // line 342
        echo "                        ";
        // line 343
        echo "                            ";
        // line 344
        echo "                                ";
        // line 345
        echo "                            ";
        // line 346
        echo "                        ";
        // line 347
        echo "                    ";
        // line 348
        echo "
                    ";
        // line 350
        echo "                    ";
        // line 351
        echo "                        ";
        // line 352
        echo "                            ";
        // line 353
        echo "                                ";
        // line 354
        echo "                                    ";
        // line 355
        echo "                                        ";
        // line 356
        echo "                                        ";
        // line 357
        echo "                                    ";
        // line 358
        echo "                                ";
        // line 359
        echo "                            ";
        // line 360
        echo "                        ";
        // line 361
        echo "                    ";
        // line 362
        echo "
                </td>
            </tr>
        </table>

        ";
        // line 368
        echo "            ";
        // line 369
        echo "        ";
        // line 370
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "AppBundle:Os:relatorio_os_single.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  551 => 370,  549 => 369,  547 => 368,  540 => 362,  538 => 361,  536 => 360,  534 => 359,  532 => 358,  530 => 357,  528 => 356,  526 => 355,  524 => 354,  522 => 353,  520 => 352,  518 => 351,  516 => 350,  513 => 348,  511 => 347,  509 => 346,  507 => 345,  505 => 344,  503 => 343,  501 => 342,  497 => 339,  488 => 334,  484 => 332,  478 => 331,  476 => 330,  472 => 328,  460 => 319,  454 => 315,  445 => 312,  441 => 311,  436 => 310,  431 => 309,  429 => 308,  422 => 304,  413 => 298,  398 => 285,  394 => 283,  382 => 276,  373 => 273,  369 => 272,  364 => 271,  359 => 270,  357 => 269,  352 => 266,  348 => 264,  337 => 261,  334 => 260,  329 => 259,  327 => 258,  324 => 257,  318 => 254,  315 => 253,  313 => 252,  303 => 247,  299 => 245,  294 => 244,  284 => 235,  282 => 234,  272 => 227,  264 => 222,  259 => 220,  252 => 216,  246 => 213,  242 => 212,  236 => 209,  232 => 208,  212 => 191,  205 => 186,  19 => 1,);
    }
}
