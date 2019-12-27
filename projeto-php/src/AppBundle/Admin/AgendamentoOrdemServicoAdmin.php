<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class AgendamentoOrdemServicoAdmin extends Admin
{
    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->add('print', $this->getRouterIdParameter().'/print');
    }

    function prePersist($object)
    {
        // Setar qual usuário que agendou
        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel =  $container->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);
        $object->setColaborador($colaboradorLogado);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        if(!$this->hasParentFieldDescription()) {
            // Somente Somente o Colaborador Executor pode ver, além do admin
            if (FALSE === $this->isGranted('ROLE_SUPER_ADMIN')) {

                // Se o Executor está logado
                $query->orWhere(
                    $query->expr()->eq($query->getRootAlias().'.colaboradorExecutor', ':colaborador')
                );

                // Se quem criou está logado
                $query->orWhere(
                    $query->expr()->eq($query->getRootAlias().'.colaborador', ':colaborador')
                );

                $container = $this->getConfigurationPool()->getContainer();
                $colaboradorModel =  $container->get('colaborador_model');
                $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);


                $query->setParameters(['colaborador'=>$colaboradorLogado]);
            }
        }

        return $query;
    }

    public function validate( ErrorElement $errorElement, $object )
    {
        // Verifica se a OS está homologada, pois se estiver não pode
        if($object->getOs()->getIsHomologada()){
            $error = 'Não é possível cadastrar um agendamento em OS que já foi homologada';
            $errorElement->with( 'enabled' )->addViolation($error)->end();
        }

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $object->setNomePerfil($perfilToFilter);
    }

    public function postPersist($object)
    {
        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        $container = $this->getConfigurationPool()->getContainer();
        $osModel =  $container->get('os_model');

        $bodyEmail = '
                 <p>
                    Olá '.$object->getColaboradorExecutor()->getNome().'<br/><br/>
                    Este ticket é referente a um <span style="color:#ff0000;">reagendamento da Ordem de Serviço n. '.str_pad($object->getOs()->getId(),6,'0',STR_PAD_LEFT).'<span>.
                    Acesse o seu reagendamento dessa OS no sistema para mais informações.
                    <a href="' . $urlBase . '/app/agendamentoordemservico/'.$object->getId().'/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="' . $urlBase . '/bundles/app/img/logo_email.png"/></p>
                 ';

        // Enviar email para interessandos na criação de uma nova OS
        $osModel->sendEmalInteressados(
            $container,
            $object,
            'Flavis - Reagendamento de Ordem de Serviço n. '.str_pad($object->getOs()->getId(),6,'0',STR_PAD_LEFT),
            $bodyEmail,
            "agendamento"
        );

        // Envia e-mail para o cliente
        $osModel->sendEmailClienteReagendamentoOS($object,$container);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, ['label'=>'Código'])
            ->add('os.cliente.nome', null, ['label'=>'Cliente'])
            ->add('os.cliente.cpfCnpj', null, ['label'=>'CNPJ'])
            ->add('dataAgendada', null, ['label'=>'Data da Visita'])
            ->add('horaAgendada', null, ['label'=>'Hora da Visita'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'print' => array(
                        'template' => 'AppBundle:CRUD:list__action_pdf.html.twig'
                    ),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // Data padrão
        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
            'format' => 'dd/MM/yyyy',
        );

        $formMapper
            ->add('os', 'sonata_type_model_autocomplete', [
                'property' => 'id',
                'multiple' => false,
                'help' => '<small>(Informe pelo menos 3 caracteres para a consulta)</small>',
                'label' => 'Selecione a OS',
                'callback' => function ($admin, $property, $value) {
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $queryBuilder = $datagrid->getQuery();
                        $queryBuilder
                            // Somente OS Aberta
                            ->andWhere("{$queryBuilder->getRootAlias()}.id=:id")
                            ->andWhere("{$queryBuilder->getRootAlias()}.isEncerrada=:is_encerrada")
                            ->andWhere("{$queryBuilder->getRootAlias()}.isHomologada=:is_homologada")
                            ->setParameters([
                                "id"=>"$value",
                                "is_encerrada"=>false,
                                "is_homologada"=>false,
                            ])
                        ;
                    },
                'to_string_callback' => function($entity, $property) {
                        return sprintf('OS:%s <b>%s</b> - CNPJ/CPF: %s', $entity->getId(),
                            $entity->getCliente()->getRazaoSocial()
                            ,$entity->getCliente()->getCpfCnpj());
                    }
            ])
            ->add('solicitante', 'sonata_type_model_autocomplete', [
                'property' => 'id',
                'multiple' => false,
                'label' => 'Selecione o Solicitante',
                'callback' => function ($admin, $property, $value) {
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $queryBuilder = $datagrid->getQuery();
                        $queryBuilder
                            ->andWhere("LOWER({$queryBuilder->getRootAlias()}.nome) LIKE :nome")
                            ->setParameters(["nome"=>"$value%"])
                        ;
                    },
                'to_string_callback' => function($entity, $property) {
                        return $entity->getNome() . ' - ' . $entity->getEmail();
                    }
            ])
            ->add('colaboradorExecutor', 'sonata_type_model_autocomplete', [
                'property' => 'id',
                'multiple' => false,
                'label' => 'Selecione o Técnico de Designado',
                'callback' => function ($admin, $property, $value) {
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $queryBuilder = $datagrid->getQuery();
                        $queryBuilder
                            ->andWhere("LOWER({$queryBuilder->getRootAlias()}.nome) LIKE :nome")
                            ->setParameters(["nome"=>"%$value%"])
                        ;
                    },
            ])
            ->add('dataAgendada', 'sonata_type_date_picker', $dateFieldConfig + [
              'label' => 'Data da visita',
              'required' => false,
             ])
            ->add('horaAgendada', 'time', [
              'label'=>'Horário da visita','placeholder'=>'Selecione', 'required'=>false]
            )
            ->add('ocorrencia',null,['label'=>'Ocorrência','attr'=>['style'=>'height:150px;']])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Agendamento',array('class' => 'col-md-6'))
                ->add('id',null,['label'=>'Código'])
                ->add('dataAgendada')
                ->add('horaAgendada')
                ->add('ocorrencia')
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}
