<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\ExecucaoDeProcedimentoEquipamento;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Pmoc
{

    protected $em;
    protected $container = NULL;

    /**
     * @param EntityManagerInterface $entityManager
     * @param $container
     *///Modifiquei para os dois parâmetros não serem obrigatórios
//    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container)
    public function __construct(EntityManagerInterface $entityManager = null, ContainerInterface $container = null)
    {
        $this->em = ($entityManager) ? $entityManager : null;//$this->em = $entityManager;
        $this->container = ($container) ? $container : null;//$this->container = $container;
    }
//    /**
//     * @param EntityManagerInterface $entityManager
//     */
//    public function __construct(EntityManagerInterface $entityManager = null)
//    {
//        $this->em = ($entityManager) ? $entityManager : null;
//    }

//    function getClientesComPmoc()
//    {
//        // Equipamentos por cliente
//        $sql = "SELECT ce FROM AppBundle:ClienteEquipamento ce";
//
//        $query = $this->em->createQuery($sql);
//
//        if(!count($query->getResult())){
//            return 0;
//        }
//
//        $clienteEquipamento = $query->getResult()[0];
//
//        $this->geraAgendamentoExecucoesPmoc($clienteEquipamento);
//
//    }


    public function printPropriedadesRelatorioPmoc($jsonValores)
    {
        $jsonValores = json_decode($jsonValores);

        $result = array();

        if(count($jsonValores->valores)>0){

            foreach($jsonValores->valores as $valor){

                $valorPropriedadeEntity = $this->em->getRepository('AppBundle:ValorPropriedadeEquipamento')
                    ->find($valor->id);

                if($valorPropriedadeEntity){

                    $result[] = [
                        'label' => $valorPropriedadeEntity->getTitulo()->getTitulo(),
                        'valor' => $valor->valor
                    ];

                }
            }

        }

        return $result;

    }


    /*
     * Todos os equipamentos cadastrados no sistema
     */
    public function getEquipamentosCatalogoPMOC($idForm,$object)
    {

        $idEquipamento = ($object->getEquipamento()) ? $object->getEquipamento()->getId() : null;

        $colaboradores = $this->em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $this->container->get('security.context')->getToken()->getUser();
        $perfilToFilter = '';
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();

            }
        }

//        if ($nomePerfil == '') {
//            $sql = "SELECT e FROM AppBundle:EquipamentoCliente e";
//        }else {
            $sql = "SELECT e FROM AppBundle:EquipamentoCliente e WHERE e.nomePerfil = :nomePerfil";
//        }

        $query = $this->em->createQuery($sql);

        if (!$perfilToFilter == '') {
            $query->setParameter('nomePerfil', $perfilToFilter);
        }

        $equipamentos = $query->getResult();

        $optionEquipamento = '<option  value="">Selecione</option>';

        foreach($equipamentos as $equipamento){

            if($idEquipamento!==null){

                if($equipamento->getID()==$idEquipamento){
                    $optionEquipamento .='<option value="'.$equipamento->getId().'" selected>'.$equipamento->getGrupoEquipamento()->getTitulo().' - '.$equipamento->getMarca()->getTitulo().' - '.$equipamento->getModelo().' - '.$equipamento->getSerie().'</option>';
                }else{
                    $optionEquipamento .='<option value="'.$equipamento->getId().'">'.$equipamento->getGrupoEquipamento()->getTitulo().' - '.$equipamento->getMarca()->getTitulo().' - '.$equipamento->getModelo().' - '.$equipamento->getSerie().'</option>';
                }

            }else{
                $optionEquipamento .='<option value="'.$equipamento->getId().'">'.$equipamento->getGrupoEquipamento()->getTitulo().' - '.$equipamento->getMarca()->getTitulo().' - '.$equipamento->getModelo().' - '.$equipamento->getSerie().'</option>';
            }

        }

        return '<select id="equipamento_cliente" name="equipamento_cliente">' . $optionEquipamento . '</select>';

    }

    /*
     * Retorna a quantidade de dias vigentes de um contrato de PMOC
     */
    public function getTempoContratoDefault()
    {
        return 365;
    }


    public function removeAllAgendamentosSemOS($clienteEquipamento)
    {
        $sql = "SELECT ex FROM AppBundle:ExecucaoDeProcedimentoEquipamento ex WHERE
                ex.dataAgendadaExecucao >= :dataInicial AND
                ex.clienteEquipamento = :clienteEquipamento AND
                ex.os IS NULL AND
                ex.nomePerfil = :nomePerfil
        ";

        $query = $this->em->createQuery($sql);
        $query->setParameter('dataInicial',$clienteEquipamento->getDataInicioPmoc());
        $query->setParameter('clienteEquipamento',$clienteEquipamento);
        $query->setParameter('nomePerfil',$clienteEquipamento->getNomePerfil());

        $execucoesProcedimentos = $query->getResult();

        if(count($execucoesProcedimentos)){

            foreach($execucoesProcedimentos as $execucao){
                $this->em->remove($execucao);
            }
            $this->em->flush();

        }

    }

    /*
     * Ao Marcar um PMOC em um cadastro de equipamento de um cliente
     *
     */
    public function geraAgendamentoExecucoesPmoc($clienteEquipamento,$container)
    {
        // Ferifica se tem procedimentos para este equipamento
        if(count($clienteEquipamento->getEquipamento()->getProcedimentosPreventivos())){

            // A primeira coisa a ser feita é excluir todos os agendamntos, sem vínculo com OS

            $this->removeAllAgendamentosSemOS($clienteEquipamento);

            // Definido intervalos, sendo de um ano,
            // contado da data de alteração do registro, onde "isPmoc" = true

            //$startDate = new \DateTime('now',new \DateTimeZone("America/Sao_Paulo")); // Data a partir do agendamento
            $startDate = $clienteEquipamento->getDataInicioPmoc();
            $endDate   = new \DateTime('now',new \DateTimeZone("America/Sao_Paulo")); // Data final do agendamento
            $intervaloPmoc = new \DateInterval('P1Y'); // Intervalo do contrato mínimo de PMOC - um ano
            $endDate   = $endDate->add($intervaloPmoc);

            $colaboradores = $this->em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
            $colaboradorLogado = $this->container->get('security.context')->getToken()->getUser();
            $perfilToFilter = '';
            foreach($colaboradores as $colaborador) {
                if($colaborador->getUser() == $colaboradorLogado) {
                    $perfilToFilter = $colaborador->getNomePerfil();

                }
            }

            // Pegando todos os procedimentos
            // Alterar essa linha para que pegue direto do $clienteEquipamento
            foreach($clienteEquipamento->getProcedimentosPreventivos() as $procedimento){

                // Para cada procedimento crio um agendamento a cada periodicidade durante um ano

                $intervaloString = "P" . $procedimento->getPeriodicidade() . "D";
                $periodInterval = new \DateInterval( $intervaloString ); // 1-day, though can be more sophisticated rule
                $period = new \DatePeriod( $startDate, $periodInterval, $endDate );

                foreach($period as $date){

                    // Verificar se já não existe este procedimento no sistema

                    if(!$this->procedimentoIsAgendado($clienteEquipamento,$date,$procedimento)){

                        // Criar os eventos
                        $execucaoProcedimentoAgendadoPara = new ExecucaoDeProcedimentoEquipamento();
                        $execucaoProcedimentoAgendadoPara->setDataAgendadaExecucao($date);
                        $execucaoProcedimentoAgendadoPara->setProcedimentoPmoc($procedimento);
                        $execucaoProcedimentoAgendadoPara->setClienteEquipamento($clienteEquipamento);
                        $execucaoProcedimentoAgendadoPara->setObservacao('FALSE');
                        $execucaoProcedimentoAgendadoPara->setStatus('PEN');
                        $execucaoProcedimentoAgendadoPara->setNomePerfil($perfilToFilter);

                        $this->em->persist($execucaoProcedimentoAgendadoPara);
                    }

                }
                $this->em->flush();
            }
        }

    }

    private function procedimentoIsAgendado($clienteEquipamento,$dataParaAgendar,$procedimentoPmoc)
    {
        $sql = "SELECT ex FROM AppBundle:ExecucaoDeProcedimentoEquipamento ex WHERE
                ex.dataAgendadaExecucao = :dataAgendada AND
                ex.clienteEquipamento = :clienteEquipamento AND
                ex.procedimentoPmoc = :procedimentoPmoc
        ";

        $query = $this->em->createQuery($sql);
        $query->setParameter('dataAgendada',$dataParaAgendar);
        $query->setParameter('clienteEquipamento',$clienteEquipamento);
        $query->setParameter('procedimentoPmoc',$procedimentoPmoc);

        $result = $query->getResult();

        if(count($result)>0){
            return true;
        }else{
            return false;
        }
    }

    //1º. Se não existir nenhuma OS para os agendamentos (agendamento_manutencao_equipamento)
    //dos procedimentos criados (execucao_de_procedimento_equipamento)

    //Verifica se existe algum procedimento que foi executado naquela data
    //Se não tiver, pego o número da OS como OS pai.
    public function isProcedimentosOSPAi($cliente, $equipamento, $dataAgendada)
    {
        $sql = "SELECT ex FROM AppBundle:ExecucaoDeProcedimentoEquipamento ex
                JOIN ex.clienteEquipamento ce
                JOIN ce.equipamento eq
                WHERE ce.equipamento=:equipamento
                AND ce.cliente=:cliente
                AND ex.dataAgendadaExecucao = :dataAgendada
                AND ex.observacao = :observacao
                AND ex.os <> NULL
                ORDER BY ex.updatedAt
                ";

        $query = $this->em->createQuery($sql);

        $query->setParameters([
            'cliente' => $cliente,
            'equipamento' => $equipamento,
            'dataAgendada' => $dataAgendada,
            'observacao'=>'FALSE'
        ]);

        $result = $query->getResult();

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Verifica se existe algum procedimento que foi executado naquela data
    //Se tiver, pego o número da OS como OS pai.
    //Se naquela data agendada, não tem nenhum procedimento com OS.
    public function isTotosProcedimentosSemOS($cliente, $equipamento, $dataAgendada)
    {
        $sql = "SELECT ex FROM AppBundle:ExecucaoDeProcedimentoEquipamento ex
                JOIN ex.clienteEquipamento ce
                JOIN ce.equipamento eq
                WHERE ce.equipamento=:equipamento
                AND ce.cliente=:cliente
                AND ex.dataAgendadaExecucao = :dataAgendada
                AND ex.observacao = :observacao
                ";

        $query = $this->em->createQuery($sql);

        $query->setParameters([
            'cliente' => $cliente,
            'equipamento' => $equipamento,
            'dataAgendada' => $dataAgendada,
            'observacao'=>'TRUE'
        ]);                         //Se existir algum procedimento usado, então já tem OS criada para o agendamento

        $result = $query->getResult();

        if (count($result) == 0) {
            return true;
        } else {
            return false;
        }
    }


    //Verifica se existe procedimento que não foi executado
    public function isProcedimentosFaltando($os)
    {

        if($os == null){

            return true;

        }else {


            $sql = "SELECT ex FROM AppBundle:ExecucaoDeProcedimentoEquipamento ex WHERE
                ex.os = :os AND
                ex.observacao = :observacao
            ";

            $query = $this->em->createQuery($sql);
            $query->setParameter('os', $os);
            $query->setParameter('observacao', 'FALSE');

            $result = $query->getResult();

            if (count($result) > 0) {
                return true;
            } else {
                return false;
            }

        }
    }


    /**
     * Toda vez que a opção "isPmoc" no cadastro de um equipamento for desmarcada deve-se excluir
     * todos os agendamentos vinculados a este mesmo equipamento, com data igual ou maior
     * à data em que o cadastro foi atualizado, "isPmoc" = false
     * Recebe $clienteEquipamento AppBundle\Entity\ClienteEquipamento
     */
    public function cancelaPmocEquipamentoCliente($clienteEquipamento,$container)
    {
        // Excluir agendamentos deste equipamento
        $em = $container->get('doctrine')->getEntityManager();

        $hoje = new \DateTime();
        $hoje = new \DateTime($hoje->format("Y-m-d")." 00:00:00");

        $sql = "SELECT ep FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
                WHERE ep.dataAgendadaExecucao >= :hoje
                ";

        $query = $em->createQuery($sql);
        $query->setParameter('hoje',$hoje);

        $agendamentos = $query->getResult();

        foreach($agendamentos as $agendamento){
            $em->remove($agendamento);
        }

        $em->flush();
    }

    public function getProcedimentosNoMes($date,$container)
    {

        $em = $container->get('doctrine')->getEntityManager();

        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $colaboradorLogado = $this->container->get('security.context')->getToken()->getUser();
        $perfilToFilter = '';
        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $mesInicial = $date->format('Y') . "-" . $date->format('m') . "-01";

        $mesFinalDateTime = new \DateTime($mesInicial);
        $mesFinalDateTime->modify('last day of this month');

        $mesFinal = $date->format('Y') . "-" . $date->format('m') . "-" . $mesFinalDateTime->format('d');

        $sql = "SELECT ep,ce FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
                JOIN ep.clienteEquipamento ce
                JOIN ce.cliente c
                JOIN ce.equipamento eq
                WHERE ep.dataAgendadaExecucao BETWEEN :mesInicial AND :mesFinal
                AND eq.id = ce.equipamento
                AND ep.nomePerfil = :nomePerfil
                ";

        $query = $em->createQuery($sql);
        $query->setParameters(array('mesInicial'=>$mesInicial, 'mesFinal'=>$mesFinal, 'nomePerfil'=>$perfilToFilter));

        return $query->getResult();

    }

    //Consulta os procedimentos que lista na tela de agendamento no calendário
    //no html da função block_app_procedimentos_cliente_equipamento_widget na "// line 42" em 96ccc92f24f4f0f6f2aea9455ca288e9b5be63c8ad4380cd3057a0c4ed306ce3.php
    //junto com o html da rota get_procedimentos_equipamento na função getProcedimentosEquipamento em AjaxController.php
    public function getProcedimentosPorClienteNaData($cliente, $date,$container, $id_equipamento) {

        $em = $container->get('doctrine')->getEntityManager();

        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $this->container->get('security.context')->getToken()->getUser();
        $perfilToFilter = '';
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $mesInicial = $date->format('Y') . "-" . $date->format('m') . "-01";

        $mesFinalDateTime = new \DateTime($mesInicial);
        $mesFinalDateTime->modify('last day of this month');

        $mesFinal = $date->format('Y') . "-" . $date->format('m') . "-" . $mesFinalDateTime->format('d') ;

        $sql = "SELECT ep,ce FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep
                JOIN ep.clienteEquipamento ce
                JOIN ce.cliente c
                JOIN ce.equipamento eq
                WHERE ce.equipamento=:equipamento
                AND ce.cliente = :cliente
                AND ep.dataAgendadaExecucao BETWEEN :mesInicial AND :mesFinal
                AND ep.nomePerfil = :nomePerfil
        ";

        $query = $em->createQuery($sql);
        $query->setParameters(array('cliente'=>$cliente, 'mesInicial'=>$mesInicial,'mesFinal'=>$mesFinal, 'equipamento'=>$id_equipamento, 'nomePerfil'=>$perfilToFilter));

        return $query->getResult();
    }

}