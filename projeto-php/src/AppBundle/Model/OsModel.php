<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OsModel
{

    protected $em;
    protected $container = NULL;

    /**
     * @param EntityManagerInterface $entityManager
     * @param $container
     */
    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    public function getPosicaoTecnicos()
    {
        $colaboradores = $this->em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $this->container->get('security.context')->getToken()->getUser();
        $perfilToFilter = '';
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();

            }
        }

//        if($perfilToFilter == '') {
//            $sql = "SELECT distinct ON (p.tecnico_id) *
//                    FROM posicao_tecnico as p
//                    JOIN colaborador as co on p.tecnico_id = co.id
//                    ORDER BY p.tecnico_id, p.created_at DESC";
//        }else{
            $sql = "SELECT distinct ON (p.tecnico_id) *
                    FROM posicao_tecnico as p
                    JOIN colaborador as co on p.tecnico_id = co.id
                    WHERE p.nome_perfil = '$perfilToFilter'
                    ORDER BY p.tecnico_id, p.created_at DESC";
//        }

        $rsm = new ResultSetMappingBuilder($this->em);
        $query = $this->em->createNativeQuery($sql,$rsm);

        $rsm->addRootEntityFromClassMetadata('AppBundle:PosicaoTecnico', 'p');

        $posicoesResult = $query->getResult();
        return $posicoesResult;

    }

    public function totalOsAbertas()
    {
        //$os = $this->em->getRepository('AppBundle:OrdemServico')->findAll();

        $sql = "SELECT o FROM AppBundle:OrdemServico o
                WHERE o.cliente IN(:clientes) AND o.isHomologada = :isHomologada";

        $query = $this->em->createQuery($sql);

        $usuarioLogado = $this->getClienteLogado();

//        $query->andWhere(
//            $query->expr()->in($query->getRootAlias(). '.cliente', ':clientes')
//        );

        $query->setParameters([
            'isHomologada' => TRUE,
            'clientes' => $usuarioLogado->getClientes()->toArray()
        ]);

        $os = $query->getResult();

        return str_pad(count($os),6,0,STR_PAD_LEFT);

    }
    public function sendEmalInteressados($container,$object,$subject,$body,$tipo='os')
    {
        ###### Envia e-mail ######

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('agendamento@flavis.com.br')
            ->setBcc($this->interessadosEmail($object,$tipo))
            ->setBody($body,'text/html')
        ;
        $container->get('mailer')->send($message);

        ###### Envia e-mail ######
    }

    private function interessadosEmail($object,$tipo)
    {
        /* Interessados na os
         * - Todos os responsaveis da empresa
         * - O Técnico desinado(ColaboradorAvalista)
         */

        if($tipo=='agendamento' || $tipo=='os')
            $emails[] = $object->getColaboradorExecutor()->getEmail();

        if($tipo=='relatorio')
            $emails[] = $object->getAgendamento()->getOs()->getColaboradorAtendente()->getEmail();

        // Quando for relatório não enviar para o cliente
        if($tipo!='relatorio'){
            $resposanveisEmpresa = $object->getCliente()->getResponsaveis();
            if(count($resposanveisEmpresa)>0){
                foreach($resposanveisEmpresa as $responsavel){
                    $emails[] = $responsavel->getEmail();
                }
            }
        }

        return $emails;
    }

    public function sendEmailClienteAberturaOS($object,$container)
    {
        $resposanveisEmpresa = $object->getCliente()->getResponsaveis();

        $emails=[];

        if(count($resposanveisEmpresa)>0){
            foreach($resposanveisEmpresa as $responsavel){
                $emails[] = $responsavel->getEmail();
            }
        }

        if(count($emails)){

            $body = '
                 <p>
                    Olá '.$object->getCliente()->getNome().'<br/><br/>
                    Este ticket é referente abertura de uma Ordem de Serviço n. '.str_pad($object->getId(),6,'0',STR_PAD_LEFT).'.
                    Acompanhe o andamento dos trabalhos em sua loja acessando sua área de cliente.
                    <a href="http://www.orsin.com.br/app/ordemservico/'.$object->getId().'/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="http://www.orsin.com.br/bundles/app/img/logo_email.png"/></p>
                 ';

            ###### Envia e-mail ######

            $message = \Swift_Message::newInstance()
                ->setSubject('Flavis - Ordem de Serviço n. '.str_pad($object->getId(),6,'0',STR_PAD_LEFT))
                ->setFrom('agendamento@flavis.com.br')
                ->setBcc($emails)
                ->setBody($body,'text/html')
            ;

            $container->get('mailer')->send($message);

        }

    }

    public function sendEmailClienteReagendamentoOS($object,$container)
    {
        $resposanveisEmpresa = $object->getOs()->getCliente()->getResponsaveis();

        $emails=[];

        if(count($resposanveisEmpresa)>0){
            foreach($resposanveisEmpresa as $responsavel){
                $emails[] = $responsavel->getEmail();
            }
        }

        if(count($emails)){

            $bodyEmail = '
                 <p>
                    Olá '.$object->getOs()->getCliente()->getNome().'<br/><br/>
                    Este ticket é referente a um <span style="color:#ff0000;">reagendamento da Ordem de Serviço n. '.str_pad($object->getOs()->getId(),6,'0',STR_PAD_LEFT).'<span>.
                    Acesse o reagendamento dessa OS em sua área de cliente no sistema para mais informações.
                    <a href="http://www.orsin.com.br/app/agendamentoordemservico/'.$object->getId().'/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="http://www.orsin.com.br/bundles/app/img/logo_email.png"/></p>
                 ';

            ###### Envia e-mail ######

            $message = \Swift_Message::newInstance()
                ->setSubject('Flavis - Reagendamento de Ordem de Serviço n. '.str_pad($object->getOs()->getId(),6,'0',STR_PAD_LEFT))
                ->setFrom('agendamento@flavis.com.br')
                ->setBcc($emails)
                ->setBody($bodyEmail,'text/html')
            ;

            $container->get('mailer')->send($message);

        }

    }

    public function sendEmailClienteHomologacaoOS($object,$container)
    {
        $resposanveisEmpresa = $object->getOs()->getCliente()->getResponsaveis();

        $emails=[];

        if(count($resposanveisEmpresa)>0){
            foreach($resposanveisEmpresa as $responsavel){
                $emails[] = $responsavel->getEmail();
            }
        }

        if(count($emails)){

            $bodyEmail = '
                 <p>
                    Olá '.$object->getColaboradorExecutor()->getNome().'<br/><br/>
                    A OS n '. str_pad($object->getId(),6,'0',STR_PAD_LEFT) .' foi encerrada. Para maiores informações acesse sua OS
                    <a href="http://prod.flavis.com.br/app/ordemservico/'.$object->getId().'/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="http://prod.flavis.com.br/bundles/app/img/logo_email.png"/></p>
                 ';

            ###### Envia e-mail ######

            $message = \Swift_Message::newInstance()
                ->setSubject("Encerramento da OS n " . str_pad($object->getId(),6,'0',STR_PAD_LEFT))
                ->setFrom('agendamento@flavis.com.br')
                ->setBcc($emails)
                ->setBody($bodyEmail,'text/html')
            ;

            $container->get('mailer')->send($message);

        }

    }

    private function getClienteLogado()
    {
        $clienteModel  = $this->container->get('cliente_model');
        $usuarioLogado = $clienteModel->getUsuarioClienteByUsuario($this->container);

        return $usuarioLogado;
    }

} 