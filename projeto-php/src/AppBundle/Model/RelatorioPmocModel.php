<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RelatorioPmocModel
{

    protected $em;
    protected $container = NULL;
    protected $pathImage;
    protected $object = NULL;
    public $totalPage = 0;

    const NEW_PAGE = '<div class="page_break"></div>';
    const PAGE_COUNT = '<span class="pagenum">Página: </span>';


    /**
     * @param EntityManagerInterface $entityManager
     * @param $container
     */
    public function __construct(EntityManagerInterface $entityManager, $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
        $this->pathImage = __DIR__ . '/../Resources/public/img/';
        $this->pathImageUpload = __DIR__ . '/../../../web/';
    }

    #### RENDER

    public function getRelatorio($os)
    {

        $this->object = $os;

        if (!$this->object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        if($os->getIsPmoc()) {

            $paginas = array(
                $this->makeStyle(),
                $this->getPagina1($os),
                $this->getPagina2($os),
                $this->getPagina3($os),
                $this->getPagina4($os),
                $this->getPagina5($os),
                $this->getPaginaFotos($os),
                $this->getPaginaRelatorioTecnico($os),
            );

        } else {

            $paginas = array(
                $this->makeStyle(),
                $this->getPagina1($os),
                $this->getPagina2($os),
                $this->getPagina4($os),
                $this->getPagina5($os),
                $this->getPaginaFotos($os),
                $this->getPaginaRelatorioTecnico($os),
            );

        }


        return implode('', $paginas);

    }


    #### MAKES PAGES

    private function getPagina1($os)
    {

        $content = '<div><table width="100%" cellpadding="0" cellspacing="0">';

#### DADOS DA EMPRESA


        $enderecoCompleto = "";
        $enderecoComplemento = "";
        $enderecoNumero = "";
        $enderecoBairro = "";
        $enderecoCidade = "";
        $enderecoEstado = "";
        $enderecoCep = "";

        if ($this->object->getEndereco()) {

            $enderecoCompleto = $this->object->getEndereco()->getLogradouro();
            $enderecoComplemento = $this->object->getEndereco()->getComplemento();
            $enderecoNumero = $this->object->getEndereco()->getNumero();
            $enderecoBairro = $this->object->getEndereco()->getBairro()->getNome();
            $enderecoCidade = $this->object->getEndereco()->getBairro()->getCidade()->getNome();
            $enderecoEstado = $this->object->getEndereco()->getBairro()->getCidade()->getUf();
            $enderecoCep = $this->object->getEndereco()->getCep();

        }

        $telefoneCliente = $this->getFoneContato($this->object->getCliente());

        $content .= '<tr>
                            <td>
                                <table style="border: 1px solid #111111;border-bottom:0 none;" width="100%" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td colspan="" class="bgLine">Identificação do solicitante</td>
                                    </tr>
                                </table>
                            </td>
                         </tr>';


        $content .= '<tr>
                            <td>
                                <table style="border: 1px solid #111111;" width="100%" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td width="75%" style="border: 1px solid #111111;"><b>Nome/Razão Social:</b><br/>' . $this->object->getCliente()->getNome() . '</td>
                                        <td width="25%" style="border: 1px solid #111111;"><b>CPF/CNPJ:</b><br/>' . $this->object->getCliente()->getCpfCnpj() . '</td>
                                    </tr>
                                </table>
                            </td>
                         </tr>';

        $content .= '<tr>
                            <td>
                                <table style="border: 1px solid #111111; border-top: 0 none;" width="100%" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td width="85%" style="border: 1px solid #111111;"><b>Endereço Completo: </b><br/>' . $enderecoCompleto . '</td>
                                        <td width="15%" style="border: 1px solid #111111;"><b>Nº</b><br/>' . $enderecoNumero . '</td>
                                    </tr>
                                </table>
                            </td>
                         </tr>';

        $content .= '<tr>
                            <td>
                                <table style="border: 1px solid #111111; border-top: 0 none;" width="100%" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td width="25%" style="border: 1px solid #111111;border-top: 0 none;"><b>Complemento: </b><br/>' . $enderecoComplemento . '</td>
                                        <td width="10%" style="border: 1px solid #111111;border-top: 0 none;"><b>Bairro: </b><br/>' . $enderecoBairro . '</td>
                                        <td width="10%" style="border: 1px solid #111111;border-top: 0 none;"><b>Cidade: </b><br/>' . $enderecoCidade . '</td>
                                        <td width="5%" style="border: 1px solid #111111;border-top: 0 none;"><b>UF: </b><br/>' . $enderecoEstado . '</td>
                                    </tr>
                                </table>
                            </td>
                         </tr>';


        $content .= '<tr>
                            <td>
                                <table style="border: 1px solid #111111; border-top: 0 none;" width="100%" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td width="13%" style="border: 1px solid #111111;border-top: 0 none;"><b>CEP: </b>' . $enderecoCep . '<br/></td>
                                        <td width="23%" style="border: 1px solid #111111;border-top: 0 none;"><b>Telefone: </b><br/>' . $telefoneCliente . '</td>
                                        <td width="12%" style="border: 1px solid #111111;border-top: 0 none;"><b>Endereço Eletrônico: </b><br/>-----</td>
                                    </tr>
                                </table>
                            </td>
                         </tr>';


        $content .= '</table></div>';


        #### DADOS DOS TÉCNICOS
        $content .= '<div style="margin-top: 20px;"><table width="100%" cellpadding="0" cellspacing="0">';

        $tecnicos = $this->getTecnicosOs($this->object);

        if(count($tecnicos)>0) {

            $content .= '<tr>
                        <td>
                            <table style="border: 1px solid #111111;" width="100%" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td colspan="" class="bgLine">Identificação da equipe técnica</td>
                                </tr>
                            </table>
                        </td>
                     </tr>';

        }

        foreach ($tecnicos as $tecnico) {

            $content .= '<tr>
                            <td>
                                <table style="border: 1px solid #111111; border-top: 0 none;" width="100%" cellpadding="10" cellspacing="0">
                                    <tr>
                                        <td width="23%" style="border: 1px solid #111111;border-top: 0 none;"><b>Nome: </b><br/>' . $tecnico['nome'] . '</td>
                                        <td width="12%" style="border: 1px solid #111111;border-top: 0 none;"><b>CPF: </b><br/>' . $tecnico['cpf'] . '</td>
                                    </tr>
                                </table>
                            </td>
                         </tr>';
        }


        $content .= '</table></div>';

        ### RESPONSAVEL TÉCNICO
        $tecnicoResponsavel = $this->getResponsavelTecnico();

        $content .= '<div style="margin-top: 20px;"><table width="100%" cellpadding="0" cellspacing="0">';

        $content .= '<tr>
                        <td>
                            <table style="border: 1px solid #111111;border-bottom: 0 none !important;" width="100%" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td colspan="" class="bgLine">Identificação do Responsável Técnico</td>
                                </tr>
                            </table>
                        </td>
                     </tr>';

        $content .= '<tr>
                        <td>
                            <table style="border: 1px solid #111111;" width="100%" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td width="75%" style="border: 1px solid #111111;border-top: 0 none !important;"><b>Nome:</b><br/>' . $tecnicoResponsavel['nome'] . '</td>
                                    <td width="30%" style="border: 1px solid #111111;border-top: 0 none !important;"><b>CPF:</b><br/>' . $tecnicoResponsavel['cpf'] . '</td>
                                </tr>
                            </table>
                        </td>
                     </tr>';

        $content .= '<tr>
                        <td>
                            <table style="border: 1px solid #111111; border-top: 0 none;" width="100%" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td width="25%" style="border: 1px solid #111111;border-top: 0 none;"><b>Endereço completo: </b><br/>' . $tecnicoResponsavel['endereco'] . '</td>
                                    <td width="15%" style="border: 1px solid #111111;border-top: 0 none;"><b>Telefone: </b><br/>' . $tecnicoResponsavel['telefone'] . '</td>
                                    <td width="15%" style="border: 1px solid #111111;border-top: 0 none;"><b>E-mail: </b><br/>' . $tecnicoResponsavel['email'] . '</td>
                                </tr>
                            </table>
                        </td>
                     </tr>';

        $content .= '<tr>
                        <td>
                            <table style="border: 1px solid #111111;" width="100%" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td width="75%" style="border: 1px solid #111111;border-top: 0 none !important;"><b>Registro no Conselho de Classe:</b><br/>' . $tecnicoResponsavel['numero_registro'] . '</td>
                                    <td width="25%" style="border: 1px solid #111111;border-top: 0 none !important;"><b>ART*:</b><br/>' . $tecnicoResponsavel['art'] . '</td>
                                </tr>
                            </table>
                        </td>
                     </tr>';


        $content .= '</table><b>*Anotação de Responsabilidade Técnica</b></div>';

        ### TEXTO RESUMO RELATÓRIO

        $content .= '<div style="padding-top: 40px;">
            
            <p style="text-align: justify;">
                <b>RESUMO.</b>'.$this->object->getResumoRelatorio().'
            </p>
    
        </div>';


        return $this->makePage($content);
    }

    private function getPagina2($os)
    {
        $sumario = str_ireplace("\n", "<br/>", $os->getIndiceRelatorio());

        $content = '<h3 style="text-align: center;">SUMÁRIO</h3>';

        if ($sumario!=''){
            $content .= '<div class="sumario"><p>' . $sumario . '</p></div>';
        } else {
            $content .= '<div class="sumario"><p>' . $this->loadImageUpload($os->getPathFoto(), 'img_sumario') . '</p></div>';
        }

        return $this->makePage($content);
    }

    // Lista de equipamentos
    private function getPagina3($os)
    {
        $content = '';

        //$content = '<h3>2. Descrição do sistema de exaustão da loja</h3>';
//
//        $content .= '<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
//                        Commodi corporis dolores ducimus earum expedita, harum ipsa minus officiis optio voluptatibus.
//                        Ab accusantium autem eos, natus placeat saepe ut. Asperiores, quo. Lorem ipsum dolor sit amet,
//                        consectetur adipisicing elit. Commodi corporis dolores ducimus earum expedita,
//                        harum ipsa minus officiis optio voluptatibus. Ab accusantium autem eos, natus placeat saepe ut.
//                        Asperiores, quo.</p>';

        $content .= $this->getEquipamentosOs($os);

        return $this->makePage($content);
    }

    public function loadLogo($logo, $style)
    {
        $urlBase = '';
        return '<img style="' . $style . '" src="' . $urlBase . '/bundles/app/img/' . $logo . '.png" alt="">';
    }

    // Introdução e foto da norma
    private function getPagina4($os)
    {

        if (!$os->getNormaTecnica()) {

            $content = '<h3>Norma Técnica: NÃO INFORMADA!</h3>';
            $content .= '<p style="text-align: justify;"> ~ </p>';

        } else {

            $content = '<h3>Norma Técnica: ' . $os->getNormaTecnica()->getNumero() . '</h3>';
            $content .= '<p style="text-align: justify;">' . $os->getNormaTecnica()->getObservacao() . '</p>';

        }

        return $this->makePage($content);
    }

    // Produtos utilizados
    private function getPagina5($os)
    {

        $content = '<h3>Materiais e ferramentas utilizados</h3>';

        $content .= '<div><ul>';

        $produtos = $os->getFichasTecnicasProduto();

        if (count($produtos) > 0) {

            foreach ($produtos as $produto) {
                $content .= '<li>' . $produto->getTitulo() . '<br/><br/>' . $this->loadImageUpload($produto->getPathFoto(), 'img_rotulo') . '</li>';
            }

        } else {
            $content .= '<li>Nenhum produto cadastrado</li>';
        }

        $content .= '</ul></div>';

        return $this->makePage($content);
    }

    function generateImagePorPage($registros)
    {

        $content = '';
        $cont = 0;

        foreach ($registros as $imagem) {

            $cont += 1;

            if ($cont == 1) {
                $content .= "<tr>";
            }

            $content .= "<td width='33.33%' style='text-align: center;'>
                <div class='thumb-image'>
                    <div class='img_rotulo'>".$this->loadImageUpload($imagem['foto']->getPathFile())."</div>
                    <div class='img_legend'>{$imagem['obs']}</div>
                </div>
            </td>";

            if ($cont == 3) { // ou não isset. Não tem mais informação count/3==0 ou total
                $content .= "</tr>";
                $cont = 0;
            }
        }

        return $content;

    }

    // Produtos utilizados // 2560 os de teste
    private function getPaginaFotos($os)
    {

        $content = '<h3>Fotos dos componentes antes e depois do serviço</h3>';
        $fotosPages = '';
        
        $matrizTeste = array();

        if($os->getIsPmoc()) {

            $relatoriosExecucoesProcedimentos = $os->getRelatoriosExecucoesProcedimentos();

            if(!count($relatoriosExecucoesProcedimentos)){
                $fotosPages .= $this->makePage($content);
            }

            foreach ($relatoriosExecucoesProcedimentos as $relatorio){

                $execucao = $relatorio->getExecucaoDeProcedimentoEquipamento();
                $procedimento = $execucao->getProcedimentoPmoc()->getTitulo()->getTitulo();
                $fotos = $execucao->getFotos();

                $tituloEquipamento = $execucao->getClienteEquipamento()->getEquipamento();

                $tituloEquipamento = $tituloEquipamento->getMarca() . ' - ' . $tituloEquipamento->getModelo();

                foreach ($fotos as $foto){

                    $matrizTeste[] = [
                        'procedimento' => $procedimento,
                        'equipamento' => $tituloEquipamento,
                        'foto' => $foto,
                        'obs' => $execucao->getObservacao()
                    ];

                }
            }

        } else {

            $fotos = $os->getFotos();

            if(!count($fotos)){
                $fotosPages .= $this->makePage($content);
            }

            foreach ($fotos as $foto) {

                $matrizTeste[] = [
                    'procedimento' => '',
                    'equipamento' => '',
                    'foto' => $foto,
                    'obs' => $foto->getTitulo()
                ];

            }

        }

//
//
//        /* Teste */
//        $matrizTeste = array(
//            'bla1',
//            'bla2',
//            'bla3',
//            'bla4',
//            'bla5',
//            'bla6',
//            'bla7',
//            'bla8',
//            'bla9',
//            'bla10',
//            'bla11',
//            'bla12',
//            'bla13',
//            'bla14',
//            'bla15',
//            'bla16',
//            'bla17',
//            'bla18',
//            'bla19',
//        );

        $totalPorPagina = 9;
        $totalRegistros = count($matrizTeste);
        $arrayQuebrado = ceil($totalRegistros / $totalPorPagina);
        // se foi valor quebrado
        $whole = floor($arrayQuebrado);
        $fraction = $arrayQuebrado - $whole;

        // Loop de páginas
        for ($i = 0; $i < $arrayQuebrado; $i++) {

            $content .= '<div style="margin-top: 40px;width: 100%;">
                <p>' . $matrizTeste[0]['equipamento'] . ' - '. $matrizTeste[0]['equipamento'] .'</p>
	                <table width="100%" cellpadding="0" cellspacing="0">';

            $imagens = array_slice($matrizTeste, ($i * $totalPorPagina), $totalPorPagina);

            //print_r($imagens);

            $content .= $this->generateImagePorPage($imagens);

            $content .= '</table></div><div style="clear: both;"></div>';
            $fotosPages .= $this->makePage($content);

            $content = '';
        }

        return $fotosPages;

    }

    function getPaginaRelatorioTecnico($os) {

        $imgAssinaturaCliente = '';
        $nomeEngenheiro = 'Não informado';
        if($os->getEngenheiroResponsavel()){
            $nomeEngenheiro = $os->getEngenheiroResponsavel()->getNome();
            $imgAssinaturaCliente = (empty($os->getEngenheiroResponsavel()->getPathFoto())) ? '' : $this->loadImageUpload($os->getEngenheiroResponsavel()->getPathFoto(),'assinatura_engenheiro');
        }

        $receptorNome = (empty($os->getReceptorNome())) ? 'Não informado' : $os->getReceptorNome();
        $receptorAssinatura = (empty($os->getReceptorAssinatura())) ? '' : $this->loadImageUpload($os->getReceptorAssinatura(),'assinatura_atendente');

        // $content = $receptorAssinatura;

        // $content .= $imgAssinaturaCliente;

        $content = '<div style="margin-top: 40px;width: 100%;">';

        $content .= '<h3>Relatório Técnico</h3>';

        $content .= '<p style="text-align: justify">' . $os->getRelatorioAvaliacao() . '</p>';

        $content .= '<div style="text-align: center;position: absolute;bottom:0px;left: 10px;">'.$receptorAssinatura.'________________________________________<br/>'.$receptorNome.'<br/>Responsável do cliente</div>';

        $content .= '<div style="text-align: center;position: absolute;bottom:0px; right: 10px;">'.$imgAssinaturaCliente.'________________________________________<br/>'.$nomeEngenheiro.'<br/>Responsável Técnico</div>';

        $content .= '</div>';

        return $this->makePage($content,'',true);
    }


    #### TOOLS

    public function loadImage($name, $class = '')
    {
        return '<img class="' . $class . '" src="' . $this->pathImage . $name . '"/>';
    }

    public function loadImageUpload($name, $class = '')
    {
        return '<img class="' . $class . '" src="' . $this->pathImageUpload . $name . '"/>';
    }

    private function makeStyle()
    {

        return "
        
        <style>
            
            body{ font-family: Verdana;font-size: 18px;letter-spacing: 1px;}
            .titleMedium{font-size: 20px;font-weight: bold;}
            .center{text-align: center;}
            .smallText{font-size: 15px;}
            .bgLine{background-color: #111111;color: #ffffff;}
            
            .page_break{ page-break-before: always !important; }
            .pagenum:after { content: counter(page); }
        
            .header {
                /*position: fixed; top: 0px;*/
                height: 150px;
                margin-bottom: 80px;
            }
            
            .footer {
                position: fixed; bottom: 0px;
            }
            
            .size_page {
                height: 1300px;
                width: 100%;
                border-bottom: 1px solid #eaeaea;
            }
        
            .thumb-image{
                width: 360px;
                height: 340px;
                margin-bottom: 5px;
                padding-bottom: 2px;
            }
            
            .img_rotulo{
                height: 300px;
                width: 360px;
            }
            
            .img_rotulo img{
                height: 300px;
                width: 360px;
            }
            
            .img_sumario {
                width: 1090px !important;
                height: 1200px !important;
            }
            
            .img_sumario img {
                width: 1090px !important;
                height: 1200px !important;
            }
            
            .img_legend{
                padding: 10px;
                height: 40px;
                width: 360px;
                color: #111;
                line-break: auto !important;
            }
            
            .assinatura_engenheiro{
                position: absolute;
                bottom: 0px;
                left: 0px;
                height: 120px;
            }
            
            .assinatura_atendente{
                position: absolute;
                bottom: 0px;
                left: 0px;
                height: 120px;
            }
        
        </style>
        
        ";

    }

    private function makeHeader()
    {

        $this->totalPage++;

        $dadosEmpresa = '
            <b>FLAVIS CONDICIONAMENTO CONTROLE AMBIENTAL</b><br/>
            Rua 1046, nº 155, Lt 31, 
            Setor Pedro Ludovico<br/>CEP: 75825-130 | 
            Goiânia-GO
        ';


        $output = '<div class="header"><table border="1" width="100%" cellpadding="10" cellspacing="0">';

        $output .= '<tr>
                            <td width="5%" class="center">' . $this->loadImage('logo_email.png') . '</td>
                            <td width="30%">' . $dadosEmpresa . '</td>
                            <td width="12%" class="center smallText"><b>CNPJ</b><br/>16.891.438/0001-47</td>
                        </tr>';

        $output .= '<tr>
                            <td width="5%" class="titleMedium center">OS Nº. ' . $numeOs = str_pad($this->object->getId(), 4, '0', STR_PAD_LEFT) . '</td>
                            <td width="30%" class="titleMedium center">PROGRAMA DE GESTÃO DE QUALIDADE</td>
                            <td width="12%" class="center smallText"><b>DATA</b><br/>'. $this->object->getDataAgendada()->format('d/m/Y') .'</td>
                        </tr>';

        $output .= '<tr>
                            <td width="35%" colspan="2" class="">RELATÓRIO DE EXECUÇÃO E HIGIENIZAÇÃO E MANUTENÇÃO</td>
                            <td width="12%" class="center smallText"><b>PÁGINA</b><br/><span class="pagenum"></span></td>
                        </tr>';

        $output .= '</table></div>';

        return $output;
    }

    private function makeFooter($end = false)
    {

        $output = '<div class="footer"><table>';

        $output .= '<tr><td>www.orsin.com.br</td></tr>';

        $output .= '</table></div>';

        $output .= $end ? '' : $this::NEW_PAGE;

        return $output;
    }

    private function makePage($content, $class = '', $last=false)
    {
        $output = $this->makeHeader();
        $output .= '<div class="size_page ' . $class . '">';
        $output .= $content;
        $output .= '</div>';
        if(!$last)
         $output .= $this->makeFooter();

        return $output;
    }


    // GET DIMAMIC DATA

    public function getTecnicosOs($os)
    {

        $tecnicos = array();

        foreach ($os->getTecnicosOs() as $tecnico){
            $tecnicos[] = [
                'nome' => $tecnico->getNome(),
                'cpf' => $tecnico->getCpf()
            ];
        }

        return $tecnicos;

    }

    public function getResponsavelTecnico()
    {

        $engenheiroResponsavel = $this->object->getEngenheiroResponsavel();

        if(!$engenheiroResponsavel){
            return [
                'nome' => 'não informado',
                'cpf' => 'não informado',
                'endereco' => 'não informado',
                'telefone' => 'não informado',
                'email' => 'não informado',
                'numero_registro' => 'não informado',
                'art' => 'não informado'
            ];
        }

        $endereco = $engenheiroResponsavel->getEnderecos();
        if(isset($endereco[0])){
            $endereco = $endereco[0]->getLogradouro() . ', ' .
                        $endereco[0]->getBairro() . ', ' .
                        $endereco[0]->getBairro()->getCidade() . '-'. $endereco[0]->getBairro()->getCidade()->getUf() . ', '.
                        $endereco[0]->getCep();
        } else {
            $endereco = "não informado";
        }

        return [
            'nome' => $engenheiroResponsavel->getNome(),
            'cpf' => $engenheiroResponsavel->getCpf(),
            'endereco' => $endereco,
            'telefone' => $engenheiroResponsavel->getEmail(),
            'email' => $engenheiroResponsavel->getEmail(),
            'numero_registro' => $engenheiroResponsavel->getCrea(),
            'art' => $engenheiroResponsavel->getArtigoCrea()
        ];
    }

    public function getEquipamentosOs($os)
    {

        $content = '<div style="margin-top: 20px;"><table width="100%" cellpadding="0" cellspacing="0">';

        ### PMOC
//        $execucoes = $os->getExecucoesProcedimentos();
//
//        foreach ($execucoes as $execucao) {
//            $content .= $execucao
//                    ->getClienteEquipamento()
//                    ->getEquipamento()
//                    ->getModelo()
//                    ->getTitulo() . '<br/>';
//        }

        ### NO PMOC
        $equipamentos = $os->getCliente()->getEquipamentos();

        foreach ($equipamentos as $equipamento) {

            $nomeEquipamento = $equipamento
                ->getEquipamento()
                ->getModelo()
                ->getTitulo();

            $colspan = count($equipamento->getPropriedades());

            $content .= '<tr>
                        <td>
                            <table style="margin-top:10px;border: 1px solid #111111;border-bottom: 0 none !important;" width="100%" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td colspan="' . $colspan . '" class="bgLine" style="border-bottom:1px solid #111;">' . $nomeEquipamento . '</td>
                                </tr>
                                ' . $this->getPropriedadesEquipamento($equipamento) . '
                            </table>
                        </td>
                     </tr>';

        }

        $content .= '</table></div>';

        return $content;

    }

    public function getPropriedadesEquipamento($equipamento)
    {

        $content = '<tr>';

        if (count($equipamento->getPropriedades()) > 0) {

            $percent = 100 / (count($equipamento->getPropriedades()));

            foreach ($equipamento->getPropriedades() as $propriedade) {

                if (count($propriedade->getValores()) > 0) {
                    $valores = '';
                    foreach ($propriedade->getValores() as $valor) {
                        $valores .= $valor->getTitulo()->getTitulo() . '=' . $valor->getValor() . '&nbsp;&nbsp;&nbsp;';
                    }
                } else {
                    $valores = 'Nenhum Valor';
                }

                $content .= '<td style="border: 1px solid #111111;border-top: 0 none !important;font-size:13px;text-align:center;" width="' . $percent . '%"><span style="font-weight:bold;">' . mb_strtoupper($propriedade->getTitulo()->getTitulo()) . '</span><br><br>' . $valores . '</td>';

            }

        } else {
            $content .= '<td style="border: 1px solid #111111;border-top: 0 none !important;"><p style="text-align: center;">Nenhuma propriedade</p></td>';
        }

        $content .= '</tr>';

        return $content;

    }

    private function getFoneContato($cliente)
    {
        // Pegando contato
        $contato = 'Não cadastrado';
        $telefone = $cliente->getTelefones();
        if (count($telefone)) {
            $contato = $telefone[0]->getNumero();
        }

        return $contato;
    }

} 