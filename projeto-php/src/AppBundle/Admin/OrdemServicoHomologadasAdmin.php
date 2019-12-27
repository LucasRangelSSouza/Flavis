<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;

class OrdemServicoHomologadasAdmin extends Admin
{

    protected $baseRoutePattern = 'ordens-de-servico-homologadas';

    protected $datagridValues = array(

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'updatedAt',
    );


    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
    {
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

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        unset($actions['delete']);
        unset($actions['create']);

        //$actions['relatorio'] = array ( 'label' => 'Imprimir Relatório', 'relatorio'  => true );

        return $actions;
    }

    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->remove('delete');
        //$collection->add('relatorio', $this->getRouterIdParameter().'/relatorio');
        $collection->add('relatoriopmoc', $this->getRouterIdParameter().'/relatoriopmoc');
        $collection->add('deshomologa', $this->getRouterIdParameter().'/deshomologa');

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


        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $clientes = $em->getRepository('AppBundle:Cliente')->findAll(array(),array('nome' => 'ASC'));
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        $perfilToFilter = '';


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        if($perfilToFilter == ''){
            foreach ($clientes as $cliente) {
                if ($cliente->getUser() == $colaboradorLogado) {
                    $perfilToFilter = $cliente->getNomePerfil();
                }
            }
        }

        if(false === $this->isGranted('ROLE_CLIENTE')) {
            foreach ($clientes as $cliente) {
                if ($cliente->getUser() == $colaboradorLogado) {
                    $perfilToFilter = $cliente->getNomePerfil();
                }
            }

            $clientesToFilter = array();

            foreach ($clientes as $cliente) {
                if ($cliente->getNomePerfil() == $perfilToFilter) {
                    $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
                }
            }
        }

        $colaboradorToFilter = array();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getNomePerfil() == $perfilToFilter && $colaborador->getFuncao()->getId() == 4) {
                $colaboradorToFilter[$colaborador->getNome()] = $colaborador->getNome();
            }
        }

        $datagridMapper
            ->add('id',null,[
                'label'=>'Código',
            ])
            ->add('criada_de', 'doctrine_orm_callback', array(
                'label'=>'Da data',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) { return; }

                    // De data até uma data maior ou igual
                    $queryBuilder->andWhere($alias . '.createdAt >= :gerada_antes_de');

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data.' 00:00:00');


                    $queryBuilder->setParameter('gerada_antes_de',$dataParam);

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'
            ))

            ->add('ate_data', 'doctrine_orm_callback', array(
                'label'=>'Até a data',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) { return; }

                    // Inferior a data passada ou igual
                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data.' 23:59:59');

                    $queryBuilder->andWhere($alias . '.createdAt <= :gerada_ate');
                    $queryBuilder->setParameter('gerada_ate',$dataParam);

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'
            ))

//            ->add('cliente.nome','doctrine_orm_callback',[
//                'label'=>'Cliente',
//                'callback'   => array($this, 'filterClienteOs'),
//                'field_type' => 'text',
//            ])
            ->add('colaboradorExecutor.nome','doctrine_orm_string', array('label'=>'Técnico'), 'choice',
                array('choices' => $colaboradorToFilter))
//            ->add('colaboradorExecutor.nome','doctrine_orm_callback',[
//                'label'=>'Técnico',
//                'callback'   => array($this, 'filterTecnicoOs'),
//                'field_type' => 'text',
//            ])
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
        if(false === $this->isGranted('ROLE_CLIENTE')) {
            $datagridMapper
                ->add('cliente.nome', 'doctrine_orm_string', array('label' => 'Cliente'), 'choice',
                    array('choices' => $clientesToFilter));
        }
        

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


                    if($usuarioClienteLogado == false){

                        $usuarioClienteLogado = $container->get('security.context')->getToken()->getUser();

                        $em = $container->get('doctrine.orm.default_entity_manager');
                        $clientes = $em->getRepository('AppBundle:Cliente')->findAll();
                        $perfilToFilter = array();
                        $id=0;

                       foreach($clientes as $cliente) {
                            if($cliente->getUser() == $usuarioClienteLogado){
                                $id = $cliente->getId();
                            }
                           if($cliente->getUser() == $usuarioClienteLogado){
                               $perfilToFilter = $cliente->getNomePerfil();
                           }
                       }

                        // Filtrar OS por clientes
                        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias().'.isHomologada', ':isHomologada')
                        );

                        // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
                        $query->andWhere(
                            $query->expr()->in($query->getRootAlias(). '.cliente', ':clientes')
                        );
                        $query->andWhere(
                            $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
                        );

                        $query->setParameters([
                            'isHomologada' => TRUE,
                            'clientes' => $id,
                            'perfl' => $perfilToFilter
                        ]);


                    }else{

                        // Filtrar OS por clientes
                        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias().'.isHomologada', ':isHomologada')
                        );

                        // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
                        $query->andWhere(
                            $query->expr()->in($query->getRootAlias(). '.cliente', ':clientes')
                        );


                        $query->setParameters([
                            'isHomologada' => TRUE,
                            'clientes' => $usuarioClienteLogado->getClientes()->toArray()
                        ]);
                    }

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

                $container = $this->getConfigurationPool()->getContainer();
                $em = $container->get('doctrine.orm.default_entity_manager');

                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));

                $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

                $perfilToFilter = array();

                foreach($colaboradores as $colaborador) {
                    if($colaborador->getUser() == $colaboradorLogado){
                        $perfilToFilter = $colaborador->getNomePerfil();
                    }
                }

                $query->andWhere(
                    $query->expr()->eq($query->getRootAlias().'.isHomologada', ':isHomologada')
                );
                $query->andWhere(
                    $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
                );

                $query->setParameters([
                    'isHomologada' => TRUE,
                    'perfl' => $perfilToFilter
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
//        $container = $this->getConfigurationPool()->getContainer();
//        $em = $container->get('doctrine.orm.default_entity_manager');
//
//        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
//        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
//        foreach($colaboradores as $colaborador) {
//            if($colaborador->getUser() == $colaboradorLogado) {
//                $perfilToFilter = $colaborador->getNomePerfil();
//            }
//        }
//
//        $ordensServicos = $em->getRepository('AppBundle:OrdemServico')->findAll(array(),array('nome' => 'ASC'));
//        //Pegar o colaborador executor da os homologada
//        foreach($ordensServicos as $ordemServico) {
//            if($ordemServico->getId() == os.id) {
//                $colaboradorExecutor = $ordemServico->getColaboradorExecutor();
//            }
//        }
//
//        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        // Somente o Colaborador Executor pode ver, além do admin
        if (TRUE == $this->isGranted('ROLE_SUPER_ADMIN')) {//|| ($colaboradorLogado == $colaboradorExecutor)) {
        
            $buttons = ['actions' => array(
                'show' => array(),
                'edit' => array(),
                'relatoriopmoc' => array(
                    'template' => 'AppBundle:CRUD:list__action_relatoriopmoc.html.twig'
                ),
//                'relatorio' => array(
//                    'template' => 'AppBundle:CRUD:list__action_relatorio.html.twig'
//                ),
                'deshomologa' => array(
                    'template' => 'AppBundle:CRUD:list__action_deshomologa_os_admin.html.twig'
                )
            )];

        }else{

            $buttons = ['actions' => array(
                'show' => array(),
                'relatorio' => array(
                    'template' => 'AppBundle:CRUD:list__action_relatoriopmoc.html.twig'
                )
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

            $os = $this->getSubject();
            $fileFieldOptions['data_class'] = null;
            $fileFieldOptions['required'] = false;
            $fileFieldOptions['label'] = 'Imagem para Sumário';

            if($os->getPathFoto()!=''){
                $fileFieldOptions['help'] = '<img src="/'.$os->getPathFoto().'" class="admin-preview img-thumbnail"/>';
            }

           $formMapper
               ->add('isHomologada','checkbox',['label'=>'Homologada','required'=>false])
               ->add('resumoRelatorio',null,['label'=>'Resumo para o Relatório','attr'=>['style'=>'height:250px;']])
               ->add('indiceRelatorio',null,['label'=>'Sumário para o Relatório','help'=>'Se colocar um texto aqui a imagem não irá aparecer','attr'=>['style'=>'height:250px;']])
               ->add('pathFoto', 'file',$fileFieldOptions)
//               ->add('tecnicosOs','sonata_type_model',['label'=>'Técnicos envolvidos no atendimento','required'=>false,'multiple'=>true]);
               ->add('tecnicosOs', 'entity', [
                       'label' => 'Selecione um Técnico Designado*',
                       'class' => 'AppBundle:Colaborador',
                       'empty_data'  => '0',
                       'placeholder' => 'Selecione',
                       'multiple'=>true,
                       'required' => false,
                       'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                           $container = $this->getConfigurationPool()->getContainer();
                           $em = $container->get('doctrine.orm.default_entity_manager');
                           $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                           $funcoes = $em->getRepository('AppBundle:Funcao')->findAll();
                           $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                           foreach($colaboradores as $colaborador) {
                               if($colaborador->getUser() == $colaboradorLogado2) {
                                   $perfilToFilter = $colaborador->getNomePerfil();
                               }
                           }

                           foreach($funcoes as $funcao) {
                               if($funcao->getNome() == 'Técnico') {
                                   $funcaoToFilter = $funcao->getId();
                               }
                           }

                           $queryBuilder = $defaultRepository->createQueryBuilder('c');
                           $queryBuilder
                               ->andWhere($queryBuilder->expr()->in('c.funcao', ':funcaoId'))
                               ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                               ->setParameters([
                                   'funcaoId' => $funcaoToFilter,
                                   'perfl' => $perfilToFilter
                               ]);

                           return $queryBuilder;
                       },
                   ]
               );

        }
    }

    private function uploadFile($produto)
    {
        $foto = $this->getForm()->get('pathFoto')->getData();

        if(isset($foto) && $foto!=''){

            try{

                $container = $this->getConfigurationPool()->getContainer();
                $uploadableManager = $container->get('stof_doctrine_extensions.uploadable.manager');
                $uploadableManager->markEntityToUpload($produto, $foto);

                $em = $container->get('doctrine.orm.default_entity_manager');
                $em->flush();

                @unlink($produto->getOldPathFoto());

            } catch (InvalidFormException $exception) {
                return $exception->getForm();
            }

        }
    }

    public function postUpdate($object)
    {
        $this->uploadFile($object);
    }

    public function postPersist($object)
    {
        $this->uploadFile($object);
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
                ->add('status',null,[
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
                ->add('colaboradorAvalista.nome',null,['label'=>'Técnico Avalista'])
                ->add('colaboradorExecutor.nome',null,['label'=>'Técnico Executor'])
                ->add('observacao',null,['label'=>'Observação']);


        if(!$pmoc){
            $showMapper
                ->add('fotos','sonata_type_list',['label'=>'Fotos','template'=>'AppBundle:Os:fotos-list.html.twig']);
        }else{
            $showMapper
                ->add('execucoesProcedimentos',null,['label'=>'Procedimentos:','template'=>'AppBundle:Os:execucoes_pmoc.html.twig']);
            $showMapper
                ->add('relatoriosExecucoesProcedimentos',null,['label'=>'RELATÓRIO DE PMOC:','template'=>'AppBundle:Os:relatorio_pmoc.html.twig']);
        }

        // Footer do relatório
        $showMapper
                ->add('receptorNome',null,['label'=>'Nome de Quem Recebeu o Técnico'])
                ->add('receptorRg',null,['label'=>'RG de Quem Recebeu o Técnico'])
                ->add('receptorAssinatura',null,['label'=>'Assinatura','template'=>'AppBundle:Os:assinatura.html.twig'])
            ->end()
        ;
    }
}