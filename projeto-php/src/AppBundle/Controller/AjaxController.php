<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HomologacaoOs;
use AppBundle\Entity\OrdemServico;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Model\UserModel;
use AppBundle\Entity\OrdemCompraProduto;
use AppBundle\Entity\ProdutoSaida;

/**
 * Ajax controller.
 *
 * @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * Ajax Cria uma homologação de os
     *
     * @Route("/create-homologacao-os", name="create_homologacao_os")
     * @Method("POST")
     */
    public function createHomologacaoOs(Request $request)
    {
        $response = new Response();

        $idOs = $request->get('id_os');
        $valor = $request->get('valor');
        $parcelas = $request->get('parcelas');
        $formaPagamento = $request->get('forma_pagamento');
        $obs = $request->get('obs');


        $valor = str_ireplace('.', '', $valor);
        $valor = str_ireplace(',', '.', $valor);

        $em = $this->get('doctrine.orm.default_entity_manager');
        $doctrine = $this->get('doctrine');

        $colaboradorModel = $this->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($doctrine, $this->container);


        // Localizo o equipamento pelo id passado
        $os = $em
            ->getRepository('AppBundle:OrdemServico')
            ->find($idOs);

        if (!$os) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $content = "Os inválida";

            $response->setStatusCode($statusCode);
            $response->setContent($content);

            return $response;
        }

        $os->setIsHomologada(true);
        $os->setIsEncerrada(true);
        $os->setStatus('HO');
        $em->persist($os);
        $em->flush();


        $homologacaoOs = new HomologacaoOs();
        $homologacaoOs->setValor($valor);
        $homologacaoOs->setIsPago(false);
        $homologacaoOs->setObservacoes($obs);
        $homologacaoOs->setOs($os);
        $homologacaoOs->setNomePerfil($colaboradorLogado->getNomePerfil());

        $em->persist($homologacaoOs);
        $em->flush();


        ###### Envia e-mail para o Fianceiro ######

        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        $body = '
                 <p>
                    Uma nova Ordem de serviço foi homologada<br/>
                    <a href="' . $urlBase . '/app/homologacaoos/' . $homologacaoOs->getId() . '/show">Clique aqui</a>
                    para acessar o registro no sistema.
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="' . $urlBase . '/bundles/app/img/logo_email.png"/></p>
                 ';

        ###### Envia e-mail ######


        $message = \Swift_Message::newInstance()
            ->setSubject("Nova Ordem de Serviço Homologada")
            ->setFrom('agendamento@flavis.com.br')
            ->setBcc(['viniciusam.senai@sistemafieg.org.br'])
            ->setBody($body, 'text/html');
        $this->get('mailer')->send($message);

        ###### Envia e-mail para o Fianceiro ######

        $responseText = '<span style="color: #0000ff !important;">Homologação efetivada com sucesso!</span>';
        $statusCode = Response::HTTP_OK;

        $response->setStatusCode($statusCode);
        $response->setContent($responseText);

        return $response;

    }


    /**
     * Ajax Reagenda todas as execucoes para o cliente na data passada para a data desejada
     *
     * @Route("/reagenda-execucoes-procedimentos-cliente", name="reagenda_execucoes_procedimentos_cliente")
     * @Method("POST")
     */
    public function reagendaExecucoesProcedimentosCliente(Request $request)
    {
        $response = new Response();
        $statusCode = Response::HTTP_OK;

        $id_cliente = $request->get('id_cliente');
        $id_equipamento = $request->get('id_equipamento');
        $dataAtual = new \DateTime($request->get('data_atual'));
        $nova_data = new \DateTime($request->get('nova_data'));
        $pmocModel = $this->get('pmoc_model');

        $em = $this->get('doctrine.orm.default_entity_manager');

        // Verificar se não é data passada
        //echo 'Cliente: ' . $request->get('id_cliente') . ' Nova data: ' . $request->get('nova_data');

        $cliente = $em->getRepository('AppBundle:Cliente')->find($id_cliente);
        $equipamento = $em->getRepository('AppBundle:EquipamentoCliente')->find($id_equipamento);

        if (!$cliente) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $content = "Cliente encontrado";

            $response->setStatusCode($statusCode);
            $response->setContent($content);

            return $response;
        }

        // Listar todos os procedimentos do cliente nesta data
        $procedimentosNaData = $pmocModel->getProcedimentosPorClienteNaData($cliente, $dataAtual, $this->container, $id_equipamento);

        $sql = "SELECT ce FROM AppBundle:ClienteEquipamento ce
                JOIN ce.cliente c
                JOIN ce.equipamento eq
                WHERE ce.equipamento=:equipamento
                AND ce.cliente = :cliente           
                ";

        $em2 = $this->get('doctrine')->getEntityManager();
        $query = $em2->createQuery($sql);
        $query->setParameters(array('cliente'=>$cliente, 'equipamento'=>$equipamento));

        $idClienteEquipamento = $query->getResult();


        foreach ($idClienteEquipamento as $clienteEquipamento) {

                foreach ($procedimentosNaData as $procedimento) {
//
//                if (!$procedimento->getOs()->getIsHomologada()) {
//
//                    // É preciso fazer o reagendamento de todas as execuções nessa mesma OS
//                    // Tenho todas as execuções vinculadas na os
//                    foreach ($procedimento->getOs()->getExecucoesProcedimentos() as $agendamentoOs) {
//                        $agendamentoOs->setDataAgendadaExecucao($nova_data);
//                        $em->persist($agendamentoOs);
//                    }
//                }


                    if ($procedimento->getObservacao() == 'FALSE' && $procedimento->getClienteEquipamento()->getId() == $clienteEquipamento->getId()) {
                        $procedimento->setDataAgendadaExecucao($nova_data);
                    }

                    $em->flush($procedimento);

                }
        }


        $content = "Reagendamento efetuado com sucesso!";
        $response->setStatusCode($statusCode);
        $response->setContent($content);

        return $response;

    }

    /**
     * Ajax Procedimentos de um equipamento
     *
     * @Route("/reagenda-execucoes-procedimentos", name="reagenda_execucoes_procedimentos")
     * @Method("POST")
     */
    public function reagendaExecucoesProcedimentos(Request $request)
    {
        $response = new Response();
        $statusCode = Response::HTTP_OK;

        $id_execucao_procedimento = $request->get('id_execucao_procedimento');
        $nova_data = new \DateTime($request->get('nova_data'));

        $em = $this->get('doctrine.orm.default_entity_manager');

        // Localizo o equipamento pelo id passado
        $agendamento = $em
            ->getRepository('AppBundle:ExecucaoDeProcedimentoEquipamento')
            ->find($id_execucao_procedimento);

        if (!$agendamento) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $content = "Nenhum agendamento encontrado";

            $response->setStatusCode($statusCode);
            $response->setContent($content);

            return $response;

        }

        if ($agendamento->getOs()) {

            if ($agendamento->getOs()->getIsHomologada()) {
                $statusCode = Response::HTTP_BAD_REQUEST;
                $content = "Agedamento já vinculada a uma OS Homologada!";

                $response->setStatusCode($statusCode);
                $response->setContent($content);

                return $response;
            }

            // É preciso fazer o reagendamento de todas as execuções nessa mesma OS
            // Tenho todas as execuções vinculadas na os
            foreach ($agendamento->getOs()->getExecucoesProcedimentos() as $agendamentoOs) {
                $agendamentoOs->setDataAgendadaExecucao($nova_data);
                $em->persist($agendamentoOs);
            }
        }

        $agendamento->setDataAgendadaExecucao($nova_data);

        $em->flush();

        $content = "Reagendamento efetuado com sucesso!";
        $response->setStatusCode($statusCode);
        $response->setContent($content);

        return $response;

    }

    /**
     * Ajax Procedimentos de um equipamento
     *
     * @Route("/get-procedimentos-equipamento", name="get_procedimentos_equipamento")
     * @Method("GET")
     */
    public function getProcedimentosEquipamento(Request $request)
    {
        $response = new Response();
        $statusCode = Response::HTTP_OK;

        $idEquipamento = $request->get('id_equipamento');
        $em = $this->get('doctrine.orm.default_entity_manager');
        $doctrine = $this->get('doctrine');

        $content = 'Nenhum procedimento cadastrado para este equipamento';

        if (!$idEquipamento) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }

        // Localizo o equipamento pelo id passado
        $equipamento = $em
            ->getRepository('AppBundle:EquipamentoCliente')
            ->find($idEquipamento);


        $dql = "SELECT l FROM AppBundle:Localizacao l";

        $localizacoes = $em->createQuery($dql)->getResult();

        $dql2 = "SELECT c FROM AppBundle:Ambiente c";
        $ambientes = $em->createQuery($dql2)->getResult();

        $dql3 = "SELECT c FROM AppBundle:AmbienteEquipamentoCliente c";
        $ambientesDeEquipamentos = $em->createQuery($dql3)->getResult();

        $ambienteAtual = '';
        foreach ($ambientesDeEquipamentos as $ambientesDeEquipamento){
            if($ambientesDeEquipamento->getEquipamento() == $equipamento){
                $ambienteAtual = $ambientesDeEquipamento->getAmbiente();
            }
        }

        $idLocalizacao = '';
        if ($ambienteAtual !== '') {
            foreach ($ambientes as $ambiente) {
                if ($ambiente == $ambienteAtual) {
                    $idLocalizacao = $ambiente->getLocalizacao();
                }
            }
        }

        if ($idLocalizacao !== '') {
            foreach ($localizacoes as $localizacao) {
                if ($idLocalizacao == $localizacao) {
                    $localizacaoAtual = $localizacao;
                }
            }
        }


        if (!$equipamento) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }

        // Pego todos os procedimentos
        $procedimentosHtml = '';

        if (count($equipamento->getProcedimentosPreventivos())) {

            foreach ($equipamento->getProcedimentosPreventivos() as $procedimento) {

                $procedimentosHtml .= '<p style="margin-bottom:0;padding-left:12px;">
                <input type="checkbox" name="procedimentos[]" value="' . $procedimento->getId() . '"/>
                <label style="margin-left:5px;" for="r1">' . $procedimento->getTitulo()->getTitulo() . '</label></p>';
//			$content = $procedimentosHtml;
             
            }
//Comentei o código que esta em produção
            if ($ambienteAtual !== '') {
                $procedimentosHtml .= '<p style="margin-bottom:0;padding-left:12px;">               
                <label style="margin-left:5px;" for="r1"><br>Localização <br>' . $ambienteAtual . ' -' . $localizacaoAtual . '</label></p>';

//            $content = $procedimentosHtml;
            }

            $content = $procedimentosHtml;
        }

        $response->setStatusCode($statusCode);
        $response->setContent($content);

        return $response;

    }

    /**
     * Ajax Pega endereços de Cliente
     *
     * @Route("/get-enderecos-cliente", name="get_enderecos_cliente")
     * @Method("POST")
     */
    public function getEnderecosDeCliente(Request $request)
    {
        $response = new Response();
        $idCliente = $request->get('id_cliente');
        $em = $this->get('doctrine.orm.default_entity_manager');

        $response->headers->set('Content-Type', 'application/json');
        $statusCode = Response::HTTP_OK;

        // Localizo a execução do procediemnto pelo id passado
        $cliente = $em
            ->getRepository('AppBundle:Cliente')
            ->find($idCliente);

        if (!$cliente) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent(json_encode(['Cliente não localizado']));
        }

        $clienteModel = $this->get('cliente_model');

        $enderecos = $clienteModel->getEnderecos($cliente);
        $enderecosJson = array();

        foreach ($enderecos as $endereco) {
            $enderecosJson[] = ['id' => $endereco->getId(), 'cep' => $endereco->getCep()];
        }

        $response->setStatusCode($statusCode);
        $response->setContent(json_encode($enderecosJson));

        return $response;

    }
//
//    /**
//     * Ajax Pega ambiente de Cliente
//     *
//     * @Route("/get-ambiente-cliente", name="get_ambiente_cliente")
//     * @Method("POST")
//     */
//    public function getAmbienteCliente(Request $request)
//    {
//        $response   = new Response();
//        $idCliente  = $request->get('id_cliente');
//        $em         = $this->get('doctrine.orm.default_entity_manager');
//
//        $response->headers->set('Content-Type', 'application/json');
//        $statusCode = Response::HTTP_OK;
//
//        // Localizo a execução do procediemnto pelo id passado
//        $ambientes = $em
//            ->getRepository('AppBundle:Ambiente')
//            ->findAll();
//
//
//        $ambientesJson = array();
//
//        foreach($ambientes as $ambiente){
//            $ambientesJson[] = ['id'=>$ambiente->getId(),'titulo'=>$ambiente->getTitulo()];
//        }
//
//
//        $response->setStatusCode($statusCode);
//        $response->setContent(json_encode($ambientesJson));
//
//        return $response;
//    }


    /**
     * Ajax Pega procedimentos de equipamento
     *
     * @Route("/get-procedimentos", name="get_procedimentos")
     * @Method("POST")
     */
    public function getProcedimentos(Request $request)
    {
        $response = new Response();
        $idProcedimento = $request->get('id_procedimento');
        $em = $this->get('doctrine.orm.default_entity_manager');

        $response->headers->set('Content-Type', 'application/json');
        $statusCode = Response::HTTP_OK;

        $procedimento = $em
            ->getRepository('AppBundle:ExecucaoDeProcedimentoEquipamento')
            ->find($idProcedimento);

//Comentei o código que esta em produção
//        $ambientes = $procedimento->getProcedimentoPmoc()->getTitulo()->getTitulo();
//
//        $ambientesJson = array();
//
//        foreach ($ambientes as $ambiente) {
//            $ambientesJson[] = ['id' => $ambiente->getId(), 'titulo' => $ambiente->getTitulo()];
//        }

        $from = new \DateTime($procedimento->getDataAgendadaExecucao()->format("Y-m-d") . " 00:00:00");
        $to = new \DateTime($procedimento->getDataAgendadaExecucao()->format("Y-m-d") . " 23:59:59");

        $sql = "SELECT ep FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
                JOIN ep.clienteEquipamento ce
                WHERE ep.dataAgendadaExecucao BETWEEN :dataInicial AND :dataFim AND
                ce.cliente=:cliente AND ep.clienteEquipamento=:clienteEquipamento AND ep.observacao=:observacao
                ";

        $query = $em->createQuery($sql);

        $query->setParameters([
            'dataInicial' => $from,
            'dataFim' => $to,
            'cliente' => $procedimento->getClienteEquipamento()->getCliente(),
            'clienteEquipamento' => $procedimento->getClienteEquipamento(),
            'observacao' => 'FALSE'
        ]);

        $procedimentosCoincidentes = $query->getResult();

        $procedimentosJson = array();


        foreach ($procedimentosCoincidentes as $procedimentoCoincidente) {

            if($procedimentoCoincidente->getOs() == null || $procedimentoCoincidente->getObservacao() == 'FALSE') {
                $procedimentosJson[] = ['procedimento' => $procedimentoCoincidente->getProcedimentoPmoc()->getTitulo()->getTitulo()];
            }
        }


        $response->setStatusCode($statusCode);
        $response->setContent(json_encode($procedimentosJson));

//        $fp = fopen("procedimentos.json", "a");
//
//// Escreve a mensagem passada através da variável $msg
//        $escreve = fwrite($fp, json_encode($procedimentosJson));
//
//// Fecha o arquivo
//        fclose($fp);


        return $response;
    }


    /**
     * Ajax Pega ambiente de Cliente
     *
     * @Route("/get-ambiente-cliente", name="get_ambiente_cliente")
     * @Method("POST")
     */
    public function getAmbienteCliente(Request $request)
    {

        $response = new Response();

        $idProcedimento = $request->get('id_procedimento');

        $em = $this->get('doctrine.orm.default_entity_manager');

        $response->headers->set('Content-Type', 'application/json');
        $statusCode = Response::HTTP_OK;

        $procedimento = $em
            ->getRepository('AppBundle:ExecucaoDeProcedimentoEquipamento')
            ->find($idProcedimento);

        $ambientes = $em->getRepository('AppBundle:Ambiente')->findAll();


        $equipamentos = $em->getRepository('AppBundle:EquipamentoCliente')->findAll();

        $grupos = $em->getRepository('AppBundle:GrupoEquipamento')->findAll();

        $from = new \DateTime($procedimento->getDataAgendadaExecucao()->format("Y-m-d") . " 00:00:00");
        $to = new \DateTime($procedimento->getDataAgendadaExecucao()->format("Y-m-d") . " 23:59:59");

        $sql = "SELECT ep FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
                JOIN ep.clienteEquipamento ce
                WHERE ep.dataAgendadaExecucao BETWEEN :dataInicial AND :dataFim AND
                ce.cliente=:cliente AND ce.equipamento=:equipamento
                ";

        $query = $em->createQuery($sql);

        $query->setParameters([
            'dataInicial' => $from,
            'dataFim' => $to,
            'cliente' => $procedimento->getClienteEquipamento()->getCliente(),
            'equipamento' => $procedimento->getClienteEquipamento()->getEquipamento()
        ]);

        $procedimentosCoincidentes = $query->getResult();

        $procedimentosJson = array();

        $nomeAmbiente = 'Equipamento não possui ambiente associado!';
        $nomeGrupo = 'Equipamento não possui ambiente associado!';
        $procedimentosDoEquipamento = '';


        foreach ($procedimentosCoincidentes as $procedimentoCoincidente) {

            foreach ($ambientes as $ambiente) {
                $equipamentosDoAmbiente = $ambiente->getEquipamentos();
                foreach ($equipamentosDoAmbiente as $equipamentoDoAmbiente) {
                    if (is_null($procedimentoCoincidente->getClienteEquipamento()->getEquipamento()->getId()) || is_null($equipamentoDoAmbiente->getId())) {
                        $nomeAmbiente = 'Equipamento não possui ambiente associado!';
                    }
                    if ($equipamentoDoAmbiente->getId() == $procedimentoCoincidente->getClienteEquipamento()->getEquipamento()->getId()) {
                        $nomeAmbiente = $ambiente->getTitulo();
                    }
                }
            }

            foreach ($grupos as $grupo) {
                if ($grupo->getId() == $procedimentoCoincidente->getClienteEquipamento()->getEquipamento()->getGrupoEquipamento()->getId()) {
                    $nomeGrupo = $grupo->getTitulo();
                }
            }

        }

        $procedimentosJson[] = ['equipamento' => $procedimento->getClienteEquipamento()->getEquipamento()->getMarca()->getTitulo(),
            'grupo' => $nomeGrupo,
            'ambiente' => $nomeAmbiente];


        $response->setStatusCode($statusCode);
        $response->setContent(json_encode($procedimentosJson));

        return $response;
    }


    /**
     * Ajax Cria uma os baseado em um procedimento agendado
     *
     * @Route("/create-os-by-procedimento-agendado", name="create_os_by_procedimento_agendado")
     * @Method("POST")
     */ //chamado os atributos do $request pelo arquivo dbe8c79b1abfcd60b12f1f0517b8982736789f6ab5a43d74e49992bdfe1c6ef6.php
    public function createOsByProcedimentoAgendado(Request $request)
    {

        $response = new Response();

        $idProcedimento = $request->get('id_procedimento');
        $idEquipamento = $request->get('id_equipamento');
        $idColaboradorTecnico = $request->get('id_colaboradorTecnico');
        $idEndereco = $request->get('id_endereco');
        $horaAgendada = $request->get('horario');
        $nomePerfil = $request->get('nome_Perfil');
        $dataExecucao = $request->get('data_execucao');

        $em = $this->get('doctrine.orm.default_entity_manager');
        $doctrine = $this->get('doctrine');

        $colaboradorModel = $this->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($doctrine, $this->container);

        $statusCode = Response::HTTP_OK;


        ### PROCEDIMENTO ###

        // Caso não tenha sido enviado um procedimento inválido
        if (!$idProcedimento) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível atualizar o agendamento. Código de procedimento inválido.';
        }

        // Localizo a execução do procediemnto principal pelo id passado
        $procediento = $em
            ->getRepository('AppBundle:ExecucaoDeProcedimentoEquipamento')
            ->find($idProcedimento);


        $sql = "SELECT ep FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
                JOIN ep.clienteEquipamento ce
                JOIN ce.equipamento eq
                WHERE ce.equipamento=:equipamento
                AND ce.cliente=:cliente
                AND ep.observacao = :observacao
                ";

        $query = $em->createQuery($sql);

        $query->setParameters([
            'cliente' => $procediento->getClienteEquipamento()->getCliente(),
            'equipamento' => $idEquipamento,
            'observacao'=>'FALSE'
        ]);//'observacao'=>'FALSE' por que estava atualizando todos

        $procedimentos = $query->getResult();

        ////////////////////////////////////////////////////////////////////

//        $fp = fopen("procedimentos.txt", "a");
//
//// Escreve a mensagem passada através da variável $msg
//        $escreve = fwrite($fp, $idEquipamento);
//
//// Fecha o arquivo
//        fclose($fp);

        $pmocModel = $this->get('pmoc_model');
        $procedimentosSemOS = $pmocModel->isTotosProcedimentosSemOS($procediento->getClienteEquipamento()->getCliente(), $idEquipamento, $procediento->getDataAgendadaExecucao());

        if ($procedimentosSemOS) {
            $responseText = 'Ordem de serviço criada com sucesso';
        }else{
            $responseText = 'Ordem de serviço atualizada com sucesso';
        }

        if (!$procediento) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Procedimento não localizado.';
        }

        ### COLABORADOR EXECUTOR ###

        // Caso não tenha sido enviado um colaborador inválido
        if (!$idColaboradorTecnico) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Código de colaborador inválido.';
        }

        // Localizo a execução do procediemnto pelo id passado
        $colaboradorExecutor = $em
            ->getRepository('AppBundle:Colaborador')
            ->find($idColaboradorTecnico);

        // Caso não tenha sido enviado um colaborador válido
        if (!$colaboradorExecutor) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Colaborador não localizado.';
        }

        ### ENDERECO DE EXECUÇÃO ###

        // Caso não tenha sido enviado um colaborador inválido
        if (!$idEndereco) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Código de endeço inválido.';
        }

        // Localizo o endereco pelo id passado
        $enderecoExecucao = $em
            ->getRepository('AppBundle:Endereco')
            ->find($idEndereco);

        // Caso não tenha sido enviado um endereco válido
        if (!$enderecoExecucao) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Endereço não localizado.';
        }

        // Caso não tenha sido enviado um horário válido
        if (!$horaAgendada) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Horário inválido.';
        }

        // Caso não tenha sido enviado uma data válida
        if (!$dataExecucao) {
            $statusCode = Response::HTTP_BAD_REQUEST;
            $responseText = 'Não foi possível criar a OS. Data em branco.';
        }

        ////////////////////////////////////////////////////////////////////
        // Criar uma nova OS
        $os = new OrdemServico();
        $os->setCliente($procediento->getClienteEquipamento()->getCliente());
        $os->setColaboradorAtendente($colaboradorLogado);
        $os->setColaboradorExecutor($colaboradorExecutor);
        $os->setOcorrencia('Realizar os procedimentos listados nesta Ordem de Serviço no equipamento - '
            .$procediento->getClienteEquipamento()->getEquipamento()->getMarca()->getTitulo());
//        $os->setDataAgendada($procediento->getDataAgendadaExecucao());
        $yyyy = substr($dataExecucao,0,4);
        $mm = substr($dataExecucao,5,2);
        $dd = substr($dataExecucao,8,2);
        $dt_formatted = $yyyy.'-'.$mm.'-'.$dd.' 00:00:00';
        $data2 = \DateTime::createFromFormat('Y-m-d H:i:s', $dt_formatted);
        $os->setDataAgendada($data2);

        $os->setIsPmoc(TRUE);
        $os->setEndereco($enderecoExecucao);
        $os->setObservacao('Os Aberta baseado em PMOC');
        $os->setHoraAgendada(\DateTime::createFromFormat('Y-m-d H:i:s',
            $procediento->getDataAgendadaExecucao()->format('Y-m-d') . ' ' . $horaAgendada . ':00'));
        $os->setNomePerfil($nomePerfil);
        $os->setStatus('PEN');

//        $idProcedimentosExistentes = array();

        foreach ($procedimentos as $procedimento) {
//            if (!in_array($procedimento->getProcedimentoPmoc()->getId(), $idProcedimentosExistentes)) {

//             if($procediento->getDataAgendadaExecucao() == $procedimento->getDataAgendadaExecucao()) {
                $os->addExecucaoProcedimento($procedimento);
                $procedimento->setOs($os);//Inseri o número da OS
                $procedimento->setUpdatedAt(new \DateTime());
                $procedimento->setDataExecucao($data2);


            //Gravo a OS pai nos procedimento a serem executados
                 if ($procedimentosSemOS) {
                     $procedimento->setOsPai($os);//Inseri o número da OS
                 }

//                $idProcedimentosExistentes[] = $procedimento->getProcedimentoPmoc()->getId();
//             }
//            }
        }

        // Verifico se tem mais procedimentos na mesma data
        // Procedimento agendado para o mesmo cliente na mesma data

//        $from = new \DateTime($procediento->getDataAgendadaExecucao()->format("Y-m-d") . " 00:00:00");
//        $to = new \DateTime($procediento->getDataAgendadaExecucao()->format("Y-m-d") . " 23:59:59");

//        $sql = "SELECT ep FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
//                JOIN ep.clienteEquipamento ce
//                WHERE ep.dataAgendadaExecucao BETWEEN :dataInicial AND :dataFim AND
//                ce.cliente=:cliente
//                ";
//
//        $query = $em->createQuery($sql);
//
//        $query->setParameters([
//            'dataInicial' => $from,
//            'dataFim' => $to,
//            'cliente' => $procediento->getClienteEquipamento()->getCliente()
//        ]);

//        $procedimentosCoincidentes = $query->getResult();

//        foreach ($procedimentosCoincidentes as $procedimentoCoincidente) {
//            $os->addExecucaoProcedimento($procedimentoCoincidente);
//            // Update neste evento vincualando a os criada a ela mesma
//            $procedimentoCoincidente->setOs($os);
//        }

        // Adiciona os procedimentos a serem realizados
        $em->persist($os);
        $em->flush();

        ////////////////////////////////////////////////////////////////////
        //Gravo a OS pai na OS
        $os = $em
            ->getRepository('AppBundle:OrdemServico')
            ->find($os->getId());
        if ($procedimentosSemOS) {

            $pmocModel = $this->get('pmoc_model');
            $procedimentosSemOS = $pmocModel->isTotosProcedimentosSemOS($procediento->getClienteEquipamento()->getCliente(), $idEquipamento, $procediento->getDataAgendadaExecucao());
            if ($os->getId() !== '') {
//                $os->setOsOriginal($os->getId()); //error: Argument 1 passed to AppBundle\Entity\OrdemServico::setOsOriginal() must be an instance of AppBundle\Entity\OrdemServico or null
                $os->setOsOriginalPai($os->getId());
            }

        }else{

            $procedimentos = $query->getResult();

            foreach ($procedimentos as $procedimento) {

                if($procediento->getDataAgendadaExecucao() == $procedimento->getDataAgendadaExecucao()) {

                    //Gravo a OS pai dos procedimento a serem executados
                    $os->setOsOriginalPai($procedimento->getOsPai());//Inseri o número da OS Pai
                }
            }
        }
        $em->persist($os);
        $em->flush();


        $response->setStatusCode($statusCode);
        $response->setContent($responseText);

        return $response;
    }

    /**
     * Ajax Muda status compra
     *
     * @Route("/change-status-compra", name="change_status_compra")
     * @Method("GET")
     */
    public function changeStatusCompraAction(Request $request)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $em = $this->get('doctrine.orm.default_entity_manager');
        $doctrine = $this->get('doctrine');

        $colaboradorModel = $this->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($doctrine, $this->container);

        $action = $request->get('action');

        // Localizar a ordem de compra
        $ordemDeCompra = $em->getRepository('AppBundle:OrdemCompraProduto')->find($request->get('id_ordemcompra'));

        if (!$ordemDeCompra) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent('OrdemCompraProduto não encontrado');

            return $response;
        }

        // Verifica se está cancelado
        if ($ordemDeCompra->getEstado() == 'cancelada') {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent('Orçamento Cancelado');
        }

#### E-mails de envolvidos neste processo #####
        $emails = array();

        // Fornecedor
        $emails[] = $ordemDeCompra->getFornecedor()->getEmail();

        // Colaborador Que abriu a Requisição
        $emails[] = $ordemDeCompra->getOrcamento()
            ->getRequisicao()
            ->getColaborador()
            ->getEmail();
#### E-mails de envolvidos neste processo #####

        // Verifica qual ação
        if ($action == 'aprovar') {

            $ordemDeCompra->setEstado('aprovado');
            $ordemDeCompra->setAutorizadoEm(new \DateTime());
            $ordemDeCompra->setColaboradorQueAutorizou($colaboradorLogado);
            $msg_response = 'Ordem de Compra Autorizada';

            ###### Envia e-mail ######

            $message = \Swift_Message::newInstance()
                ->setSubject("Ordem de compra Aprovada")
                ->setFrom('agendamento@flavis.com.br')
                ->setBcc($emails)
                ->setBody('
            Uma nova ordem de compra foi aprovada no sistema<br/>
            Ordem de compra COD: ' . $ordemDeCompra->getId(), 'text/html'
                );
            $this->get('mailer')->send($message);

            ###### Envia e-mail ######

        } else if ($action == 'cancelar') {

            // Precisa estar aberto ou orcando
            if ($ordemDeCompra->getEstado() != 'aprovado') {

                $ordemDeCompra->setEstado('cancelado');
                $ordemDeCompra->setDataCancelamento(new \DateTime());

                $msg_response = 'Ordem de Compra Cancelada';

                ###### Envia e-mail ######

                $message = \Swift_Message::newInstance()
                    ->setSubject("Ordem de compra cancelada")
                    ->setFrom('agendamento@flavis.com.br')
                    ->setBcc($emails)
                    ->setBody('Ordem de compra cancelada - COD: ' . $ordemDeCompra->getId(), 'text/html'
                    );
                $this->get('mailer')->send($message);

                ###### Envia e-mail ######

            }
        } else {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent('Ação não encontrada');

            return $response;
        }

        $em->flush();

        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent($msg_response);

        return $response;

    }


    /**
     * Ajax Muda status orcamento
     *
     * @Route("/change-status-orcamento", name="change_status_orcamento")
     * @Method("GET")
     */
    public function changeStatusOrcamentoAction(Request $request)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $em = $this->get('doctrine.orm.default_entity_manager');
        $doctrine = $this->get('doctrine');

        $colaboradorModel = $this->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($doctrine, $this->container);

        $action = $request->get('action');

        // Localizar o orçamento no servidor
        $orcamento = $em->getRepository('AppBundle:OrcamentoProduto')->find($request->get('id_orcamento'));

        if (!$orcamento) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent('Orçamento não encontrado');

            return $response;
        }

        // Verifica se está cancelado
        if ($orcamento->getEstado() == 'cancelada') {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent('Orçamento Cancelado');
        }

#### E-mails de envolvidos neste processo #####

        $emails = array();

        // Quem Cadastrou o Orçamento
        $emails[] = $orcamento->getColaborador()->getEmail();

        // Quem abriu a requisição
        $emails[] = $orcamento
            ->getRequisicao()
            ->getColaborador()
            ->getEmail();

#### E-mails de envolvidos neste processo #####

        // Verifica qual ação
        if ($action == 'autorizar') {

            ## Validar de tem algum produto sem valor
            $flagTemProdutoSemValor = false;
            // Varrer todos os produtos no orçamento
            if (count($orcamento->getProdutos())) {

                // Verifico se tem algum produto sem valor
                foreach ($orcamento->getProdutos() as $produto) {

                    if ($produto->getValor() == '' || $produto->getValor() <= 0) {
                        $flagTemProdutoSemValor = true;
                    }
                }
                if ($flagTemProdutoSemValor) {
                    $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                    $response->setContent('Orçamento não pode ser aprovado porque tem produtos sem valor.');

                    return $response;
                }
            }
            ## Validar de tem algum produto sem valor

            // Setar qual usuário está requisitando
            $colaboradorModel = $this->get('colaborador_model');
            $colaboradorLogado = $colaboradorModel->getColaboradorLogado($this->get('doctrine'), $this->container);

            $produtosPorForncedor = array();

            // Verificar se foi setado os produtos
            if ($orcamento->getProdutos()) {

                // Varro todos os produtos enviados para agrupar por fornecedor
                foreach ($orcamento->getProdutos() as $produto) {

                    // Agrupo todos os produtos da lista por fornecedor
                    $produtosPorForncedor[$produto->getFornecedor()->getId()][] = [
                        'fornecedor' => $produto->getFornecedor(),
                        'produto' => $produto->getProduto(),
                        'quantidade' => $produto->getQuantidade(),
                        'valor' => $produto->getValor(),
                    ];

                }

                // Crio {N} ordens de compra, cada uma baseado em um fornecedor
                foreach ($produtosPorForncedor as $ordemCompraPorFornecedor) {

                    $ordemCompra = new OrdemCompraProduto();
                    $ordemCompra->setOrcamento($orcamento);
                    $ordemCompra->setColaborador($colaboradorLogado);
                    $ordemCompra->setFornecedor($ordemCompraPorFornecedor[0]['fornecedor']);
                    $ordemCompra->setObservacoes('Gerada automaticamente baseada em Orçamento');
                    $ordemCompra->setEstado('aberto');


                    // Loop dos produtos dentro do fornecedor
                    foreach ($ordemCompraPorFornecedor as $produto) {

                        $produtoSaida = new ProdutoSaida();

                        $produtoSaida->setProduto($produto['produto']);
                        $produtoSaida->setQuantidade($produto['quantidade']);
                        $produtoSaida->setValor($produto['valor']);

                        $ordemCompra->addProduto($produtoSaida);
                    }

                    $em->persist($ordemCompra);
                    $em->flush();
                }

            }

            $orcamento->setEstado('autorizado');
            $orcamento->setAutorizadoEm(new \DateTime());
            $orcamento->setColaboradorQueAutorizou($colaboradorLogado);
            $msg_response = 'Orçamento Autorizado';

            ###### Envia e-mail ######

            $message = \Swift_Message::newInstance()
                ->setSubject("Orçamento autorizado")
                ->setFrom('agendamento@flavis.com.br')
                ->setBcc($emails)
                ->setBody('Orçamento autorizado - COD: ' . $orcamento->getId(), 'text/html'
                );
            $this->get('mailer')->send($message);

            ###### Envia e-mail ######

        } else if ($action == 'send_fornecedor') {

            $orcamento->setEstado('orcando');
            $orcamento->setEnviadoParaOrcarEm(new \DateTime());
            $orcamento->setColaboradorQueEnviouOrcamento($colaboradorLogado);

            $msg_response = 'Orçamento enviado';

            ###### Envia e-mail ######

            $message = \Swift_Message::newInstance()
                ->setSubject("Orçamento enviado para fornecedores")
                ->setFrom('agendamento@flavis.com.br')
                ->setBcc($emails)
                ->setBody('Orçamento enviado para fornecedores - COD: ' . $orcamento->getId(), 'text/html'
                );
            $this->get('mailer')->send($message);

            ###### Envia e-mail ######

        } else if ($action == 'cancelar') {

            // Precisa estar aberto ou orcando
            if ($orcamento->getEstado() != 'autorizado') {

                $orcamento->setEstado('cancelada');
                $orcamento->setDataCancelamento(new \DateTime());

                $msg_response = 'Orçamento Cancelado';

                ###### Envia e-mail ######

                $message = \Swift_Message::newInstance()
                    ->setSubject("Orçamento cancelado")
                    ->setFrom('agendamento@flavis.com.br')
                    ->setBcc($emails)
                    ->setBody('Orçamento cancelado - COD: ' . $orcamento->getId(), 'text/html'
                    );
                $this->get('mailer')->send($message);

                ###### Envia e-mail ######
            }

        } else {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent('Ação não encontrada');

            return $response;
        }

        $em->flush();

        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent($msg_response);

        return $response;

    }


    /**
     *
     *
     * @Route("/isRegistred", name="isRegistred")
     * @Method("POST")
     */
    public function isRegistred(Request $request)
    {
        $doctrine = $this->get('doctrine');

        $url = '';

        $colaboradorModel = $this->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($doctrine, $this->container);

        $em = $this->get('doctrine.orm.default_entity_manager');


        $response = new Response();
//        $statusCode = Response::HTTP_OK;


        $fornecedores = $em->getRepository('AppBundle:Fornecedor')
            ->findAll();

        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        if ($request->get('cnpj') != null) {
            $cnpj = $request->get('cnpj');


            foreach ($fornecedores as $fornecedor) {
                if ($fornecedor->getCnpj() == $cnpj && $fornecedor->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                    $idFornecedor = $fornecedor->getId();
                }
            }

            if ($idFornecedor != null) {
                $url = $urlBase . '/app.php/app/' . $colaboradorLogado->getNomePerfil() . '/fornecedor/' . $idFornecedor . '/edit';
                $response->setContent($url);
                return $response;
            }

        }

        if ($request->get('cnpjCliente') != null) {
            $cnpjCliente = $request->get('cnpjCliente');
            $clientes = $em->getRepository('AppBundle:Cliente')
                ->findAll();

            foreach ($clientes as $cliente) {
                if ($cliente->getCpfCnpj() == $cnpjCliente && $cliente->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                    $idCliente = $cliente->getId();
                }
            }

            if ($idCliente != null) {
                $url = $urlBase . '/app.php/app/' . $colaboradorLogado->getNomePerfil() . '/cliente/' . $idCliente . '/edit';
                $response->setContent($url);
                return $response;
            }
        }


        if ($request->get('cpf') != null) {
            $cpf = $request->get('cpf');

            $colaboradores = $em->getRepository('AppBundle:Colaborador')
                ->findAll();

            foreach ($colaboradores as $colaborador) {
                if ($colaborador->getCpf() == $cpf && $colaborador->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                    $idColaborador = $colaborador->getId();
                }
            }

            if ($idColaborador != null) {
                $url = $urlBase . '/app.php/app/' . $colaboradorLogado->getNomePerfil() . '/colaborador/' . $idColaborador . '/edit';
                $response->setContent($url);
                return $response;
            }
        }

        if ($request->get('cpfCliente') != null) {
            $cpfCliente = $request->get('cpfCliente');
            $clientes = $em->getRepository('AppBundle:Cliente')
                ->findAll();

            foreach ($clientes as $cliente) {
                if ($cliente->getCpfCnpj() == $cpfCliente && $cliente->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                    $idCliente = $cliente->getId();
                }
            }

            if ($idCliente != null) {
                $url = $urlBase . '/app.php/app/' . $colaboradorLogado->getNomePerfil() . '/cliente/' . $idCliente . '/edit';
                $response->setContent($url);
                return $response;
            }
        }

//        $response->setStatusCode($statusCode);
//        $response->setContent("Não existe");

//        return $response;
    }


}
