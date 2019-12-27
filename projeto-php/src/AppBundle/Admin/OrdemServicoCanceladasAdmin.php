<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;

class OrdemServicoCanceladasAdmin extends Admin
{

    protected $baseRoutePattern = 'ordens-de-servico-canceladas';

    protected $datagridValues = array(

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'updatedAt',
    );

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        unset($actions['delete']);
        unset($actions['create']);

        return $actions;
    }

    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->remove('delete');

    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

//        $container = $this->getConfigurationPool()->getContainer();
//        $em = $container->get('doctrine.orm.default_entity_manager');
//        $tecnicos = $em->getRepository('AppBundle:Colaborador')->findBy([
//            '' => ''
//        ]);
//        $tecnocosToFilter = array();
//
//        foreach($tecnicos as $tecnico){
//            $empresasToFilter[$tecnico->getNome()] = $tecnico->getNome();
//        }

        $datagridMapper
            ->add('cliente.nome','doctrine_orm_callback',[
                'label'=>'Cliente',
                'callback'   => array($this, 'filterClienteOs'),
                'field_type' => 'text',
            ])
            ->add('colaboradorExecutor.nome','doctrine_orm_callback',[
                'label'=>'Técnico',
                'callback'   => array($this, 'filterTecnicoOs'),
                'field_type' => 'text',
            ])
            ->add('isEncerrada','doctrine_orm_callback', array(
                'label'=>'Fechada?',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                        if ($value['value']=='0' || $value['value']=='1') {

                            $queryBuilder->andWhere($alias . '.isEncerrada = :isEncerrada');
                            $queryBuilder->setParameter('isEncerrada',$value['value']);
                            return true;

                        }else{

                            return;

                        }

                    },
            ), 'choice',
                array(
                    'choices' => array(
                        true  => 'Sim',
                        false => 'Não'
                    )
            ))
            ->add('isCancelada','doctrine_orm_callback', array(
                'label'=>'Cancelada?',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if ($value['value']=='0' || $value['value']=='1') {

                        $queryBuilder->andWhere($alias . '.isCancelada = :isCancelada');
                        $queryBuilder->setParameter('isCancelada',$value['value']);
                        return true;

                    }else{

                        return;

                    }

                },
            ), 'choice',
                array(
                    'choices' => array(
                        true  => 'Sim',
                        false => 'Não'
                    )
                ))
        ;
    }

    // Filtro de condomínio por logradouro
    public function filterTecnicoOs($queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $value = mb_strtolower($value['value']);

        $queryBuilder
            ->join("$alias.colaboradorExecutor","tec")
            ->andWhere("UNACCENT(LOWER(tec.nome)) LIKE UNACCENT(:nome)" )
            ->setParameter('nome', "%$value%");

        return true;
    }

    // Filtro de condomínio por logradouro
    public function filterClienteOs($queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $value = mb_strtolower($value['value']);

        $queryBuilder
            ->join("$alias.cliente","cli")
            ->andWhere("UNACCENT(LOWER(cli.nome)) LIKE UNACCENT(:nome)" )
            ->setParameter('nome', "%$value%");

        return true;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

//        $container = $this->getConfigurationPool()->getContainer();
//
//        $parent = $admin = $this->getParentFieldDescription()->getAdmin();
//        $em = $container->get('doctrine')->getEntityManager();
//        $className = $em->getClassMetadata(get_class($parent))->getName();
//        extit($className);

        // Caso a chamada não seja feita por um outro admin, seja de select ou nxn
        if(!$this->hasParentFieldDescription()) {

            $parameters = [];

            // Somente Somente o Colaborador Executor pode ver, além do admin
            if (FALSE === $this->isGranted('ROLE_SUPER_ADMIN')) {

                // É Cliente
                if(TRUE === $this->isGranted('ROLE_CLIENTE')){

                    $container = $this->getConfigurationPool()->getContainer();
                    $clienteModel =  $container->get('cliente_model');
                    $usuarioClienteLogado = $clienteModel->getUsuarioClienteByUsuario($container);


                    // Filtrar OS por clientes
                    $query->andWhere(
                        $query->expr()->eq($query->getRootAlias().'.isCancelada', ':isCancelada')
                    );

                    // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
                    $query->andWhere(
                        $query->expr()->in($query->getRootAlias(). '.cliente', ':clientes')
                    );

                    $query->setParameters([
                        'isCancelada' => TRUE,
                        'clientes' => $usuarioClienteLogado->getClientes()->toArray()
                    ]);

                }else{

                    // Se o Executor está logado
                    $query->orWhere(
                        $query->expr()->eq($query->getRootAlias().'.colaboradorExecutor', ':colaborador')
                    );

                    // Se quem criou está logado
                    $query->orWhere(
                        $query->expr()->eq($query->getRootAlias().'.colaboradorAtendente', ':colaborador')
                    );

                    $container = $this->getConfigurationPool()->getContainer();
                    $colaboradorModel =  $container->get('colaborador_model');
                    $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);

                    $query->andWhere(
                        $query->expr()->eq($query->getRootAlias().'.isHomologada', ':isHomologada')
                    );

                    $query->setParameters([
                        'colaborador'  => $colaboradorLogado,
                        'isHomologada' => TRUE
                    ]);

                }

            }else{

                $query->andWhere(
                    $query->expr()->eq($query->getRootAlias().'.isCancelada', ':isCancelada')
                );

                $query->setParameters([
                    'isCancelada' => TRUE
                ]);
            }

        }

        return $query;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        // Somente Somente o Colaborador Executor pode ver, além do admin
        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
        
            $buttons = ['actions' => array(
                'show' => array(),
                'edit' => array(),
            )];

        }else{

            $buttons = ['actions' => array(
                'show' => array(),                
//                'relatorio' => array(
//                    'template' => 'AppBundle:CRUD:list__action_relatorio.html.twig'
//                )
            )];

        }


        $listMapper
            ->add('id',null,['label'=>'Código'])
            ->add('cliente.nome',null,array('label'=>'Cliente'));

        // Caso seja o gerente que esteja vendo a lista
        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN') ||
            TRUE === $this->isGranted('ROLE_GERENTE_OS_HOMOLOGA')) {

            $listMapper->add('colaboradorExecutor.nome',null,array('label'=>'Técnico'));

        }

        $listMapper
            ->add('dataAgendada',null,['label'=>'Data agendada',
                'template'=>'AppBundle:Os:list_agenda_os.html.twig'])
            ->add('isEncerrada',null,['label'=>'Fechada pelo técnico',
                'template'=>'AppBundle:Os:list_status_os.html.twig'])
            ->add('isHomologada',null,['label'=>'Homologada',
                'template'=>'AppBundle:Os:list_status_os_homologada.html.twig'])
            ->add('_action', 'actions',$buttons)
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
           $formMapper->add('isHomologada','checkbox',['label'=>'Homologada','required'=>false]);
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $pmoc = $this->getSubject()->getIsPmoc();

        if($pmoc){
            $titleAvaliacao = 'Avaliação Técnica - PMOC';
        }else{
            $titleAvaliacao = 'Avaliação Técnica';
        }

        $showMapper
            ->with('Dados Básicos da OS',['box_class'   => 'box box-solid box-success'])
            ->add('isEncerrada','boolean',[
                'label'=>'Status',
                'template'=>'AppBundle:Os:boolean.html.twig'
            ])
            ->add('justificativaEncerramento',null,['label'=>'Justificativa de Encerramento'])
            ->add('cliente.nome',null,['label'=>'Cliente'])
            ->add('cliente.cpfCnpj',null,['label'=>'CNPJ/CPF'])
            ->add('solicitante',null,['label'=>'Solicitante'])
            ->add('id',null,['label'=>'Código'])
            ->add('createdAt',null,['label'=>'Data de Abertura'])
            ->add('dataAgendada',null,['label'=>'Data Agendada','template'=>'AppBundle:Os:date.html.twig'])
            ->add('horaAgendada',null,['label'=>'Hora Agendada'])
            ->add('ocorrencia',null,['label'=>'Ocorrência'])
            ->end()
            ->with($titleAvaliacao,['box_class' => 'box box-solid box-primary'])
            ->add('isHomologada','boolean',[
                'label'=>'Está Homologada',
            ])
            ->add('colaboradorAvalista.nome',null,['label'=>'Técnico Avalista'])
            ->add('colaboradorExecutor.nome',null,['label'=>'Técnico Executor'])
            ->add('observacao',null,['label'=>'Observação']);


        if(!$pmoc){
            $showMapper->add('fotos','sonata_type_list',['label'=>'Fotos','template'=>'AppBundle:Os:fotos-list.html.twig']);
        }else{
            $showMapper->add('execucoesProcedimentos',null,['label'=>'Procedimentos:','template'=>'AppBundle:Os:execucoes_pmoc.html.twig']);
            $showMapper->add('relatoriosExecucoesProcedimentos',null,['label'=>'RELATÓRIO DE PMOC:','template'=>'AppBundle:Os:relatorio_pmoc.html.twig']);
        }

        // Footer do relatório
        $showMapper->add('receptorNome',null,['label'=>'Nome de Quem Recebeu o Técnico'])
            ->add('receptorRg',null,['label'=>'RG de Quem Recebeu o Técnico'])
            ->add('receptorAssinatura',null,['label'=>'Assinatura','template'=>'AppBundle:Os:assinatura.html.twig'])
            ->end();
    }
}