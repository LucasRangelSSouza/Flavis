<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AmbienteAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
    {
        if($object->getTitulo() == ''){
            $errorElement->with('titulo')->addViolation('Atenção, preencha o campo Título')->end();
        }

        if($object->getArea() == ''){
            $errorElement->with('area')->addViolation('Atenção, preencha o campo Área')->end();
        }else{
            if(preg_match('/[^0-9]+/m', $object->getArea())){
                $errorElement->with('area')->addViolation('Atenção, o campo Área só pode conter números')->end();
            }
        }
//
//        if($object->getOcupanteFixo() == ''){
//            $errorElement->with('ocupanteFixo')->addViolation('Atenção, preencha o campo Ocupantes Fixos')->end();
//        }
//
//        if($object->getOcupanteFlutuante() == ''){
//            $errorElement->with('ocupanteFlutuante')->addViolation('Atenção, preencha o campo Ocupantes Flutuantes')->end();
//        }

        if ($object->getLocalizacao() == '') {
            $errorElement->with('localizacao')->addViolation('Atenção, selecione uma Localização')->end();
        }

        if ($object->getColaborador() == '') {
            $errorElement->with('colaborador')->addViolation('Atenção, selecione um Responsável')->end();
        }

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $ambientes = $em->getRepository('AppBundle:Ambiente')->findAll();
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach ($ambientes as $ambiente) {

            //Validação na criação e na alteração (null ou <>)
            if (($this->getSubject()->getId() == null) || ($ambiente->getId() !== $object->getId())) {

                if ($ambiente->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                    if ($ambiente->getTitulo() == $object->getTitulo()) {
                        $errorElement->with('titulo')->addViolation('Atenção, já existe um ambiente cadastrado com este nome')->end();
                    }

                }
            }

        }

        //Se exister equipamento relacionado com este ambiente não pode inativar,
        //ou Inativado não pode incluir equipamento.
        if ($object->getHabilitado() == true) {//Valida se esta incluindo equipamento com ambiente Inativo

            if(count($object->getEquipamentos())){
                $errorElement->addViolation('Atenção, não pode existir equipamento relacionado!');
            }

        }

        $object->setNomePerfil($perfilToFilter);

    }

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    public function preUpdate($object)
    {

    }

    function prePersist($object)
    {
        // Setar qual usuário está requisitando
        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel = $container->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);
        $object->setColaborador($colaboradorLogado);
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
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $ambientes = $em->getRepository('AppBundle:Ambiente')->findAll(array(),array('nome' => 'ASC'));
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $ambientesToFilter = array();

        foreach($ambientes as $ambiente) {
            if($ambiente->getNomePerfil() == $perfilToFilter) {
                $ambientesToFilter[$ambiente->getTitulo()] = $ambiente->getTitulo();
            }
        }

        $datagridMapper
//            ->add('id',null,['label'=>'Código'])
            ->add('titulo','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $ambientesToFilter))
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

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

        // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
        $query->andWhere(
            $query->expr()->in($query->getRootAlias() . '.nomePerfil', ':perfl')
        );

        $query->setParameters([
            'perfl' => $perfilToFilter
        ]);

        return $query;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null,['label'=>'Código'])
            ->add('titulo',null,['label'=>'Nome'])
            ->add('sigla')
            ->add('area',null,['label'=>'Área','required' => false])
            ->add('ocupanteFixo',null,['label'=>'Ocupantes Fixo'])
            ->add('localizacao.titulo',null,['label'=>'Localização'])
            ->add('habilitado', 'choice', [
                'label' => 'Inativado',
                'choices' => [true=>'Sim',false=>'Não'],
                'required' => false,
                'empty_value' => 'Selecione'
            ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
//                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Ambiente')
                ->with('Ambiente', array('class' => 'col-md-12'))->end()
            ->end()

            ->tab('Equipamento')
                ->with('Equipamentos', array('class' => 'col-md-12'))->end()
            ->end()
        ;

        $formMapper
            ->tab('Ambiente')
                ->with('Ambiente')
//                    ->add('id',null,['label'=>'Código'])
                    ->add('titulo',null,['label'=>'Nome'])
                    ->add('sigla')
                    ->add('area',null,['label'=>'Área m2','required' => true])
                    ->add('ocupanteFixo',null,['label'=>'Ocupantes Fixo','required' => false])
                    ->add('ocupanteFlutuante',null,['label'=>'Ocupantes Flutuante','required' => false])
//                    ->add('localizacao', null, ['label' => 'Localizaçâo', 'placeholder' => 'Selecione'])
                    ->add('localizacao', 'entity', [
                            'label' => 'Selecione uma localização',
                            'class' => 'AppBundle:Localizacao',
                            'placeholder' => 'Selecione',
                            'required' => true,
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
                                $container = $this->getConfigurationPool()->getContainer();
                                $em = $container->get('doctrine.orm.default_entity_manager');
                                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                                $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                                foreach($colaboradores as $colaborador) {
                                    if($colaborador->getUser() == $colaboradorLogado2) {
                                        $perfilToFilter = $colaborador->getNomePerfil();
                                    }
                                }

                                $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                $queryBuilder
                                    ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                    ->andWhere($queryBuilder->expr()->not('c.habilitado = :status'))
                                    ->setParameters([
                                        'perfl' => $perfilToFilter,
                                        'status' => true
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('colaborador', 'entity', [
                            'label' => 'Selecione um colaborador reponsável',
                            'class' => 'AppBundle:Colaborador',
                            'empty_data'  => '0',
                            'placeholder' => 'Selecione',
                            'required' => true,
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                                $container = $this->getConfigurationPool()->getContainer();
                                $em = $container->get('doctrine.orm.default_entity_manager');
                                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                                $ambientes = $em->getRepository('AppBundle:Ambiente')->findAll();
                                $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                                foreach($colaboradores as $colaborador) {
                                    if($colaborador->getUser() == $colaboradorLogado2) {
                                        $perfilToFilter = $colaborador->getNomePerfil();
                                    }
                                }

                                //Selecionar as localizações que não estão vinculada a um ambiente
//                                foreach($ambientes as $ambiente) {
//                                    if($ambiente->getNome() == 'Técnico') {
//                                        $ambienteToFilter = $ambiente->getId();
//                                    }
//                                }

                                $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                $queryBuilder
//                                    ->andWhere($queryBuilder->expr()->in('c.funcao', ':funcaoId'))
                                    ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                    ->setParameters([
//                                        'funcaoId' => $funcaoToFilter,
                                        'perfl' => $perfilToFilter
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('observacao',null,['label'=>'Observação','attr'=>['style'=>'height:140px;']])
                    ->add('habilitado','checkbox',['label'=>'Inativado','required'=>false])
                ->end()
            ->end()
        ;

//        if($this->getSubject()->getId() == null) {  //Criação

//        }else{
            $formMapper
                ->tab('Equipamento')
                    ->with('Equipamentos')
                        ->add('equipamentos', 'entity', [
                                'label' => 'Equipamentos',
                                'class' => 'AppBundle:EquipamentoCliente',
                                'multiple'  => true,
                                'placeholder' => 'Selecione',
                                'required' => false,
                                'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
                                    $container = $this->getConfigurationPool()->getContainer();
                                    $em = $container->get('doctrine.orm.default_entity_manager');
                                    $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
                                    $ambienteEquipamentoClientes = $em->getRepository('AppBundle:AmbienteEquipamentoCliente')->findAll();

                                    $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

                                    foreach($colaboradores as $colaborador) {
                                        if($colaborador->getUser() == $colaboradorLogado){
                                            $perfilToFilter = $colaborador->getNomePerfil();
                                        }
                                    }

                                    //Selecionar os equipamentos que não estão na tabela relacionada com ambiente
                                    //Selecionar os equipamento que não tem relação com outros ambientes
                                    $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                    $queryBuilder
                                        ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                        ->andWhere($queryBuilder->expr()->isNull('c.ambiente'))
                                        ->orWhere($queryBuilder->expr()->in('c.ambiente', ':ambienteId'))
//                                    ->andWhere($queryBuilder->expr()->not('c.inativado = :status'))
//                                    ->orWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                        ->setParameters([
                                            'perfl' => $perfilToFilter,
                                            'ambienteId' => $this->getSubject()->getId()
//                                        'status' => true
                                        ]);

                                    return $queryBuilder;
                                },
                            ]
                        )
                        ->end()
                    ->end()
            ;
//        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Ambiente',array('class' => 'col-md-6'))
    //            ->add('id',null,['label'=>'Código'])
                ->add('titulo',null,['label'=>'Nome'])
                ->add('sigla')
                ->add('area',null,['label'=>'Área'])
                ->add('ocupanteFixo',null,['label'=>'Ocupantes Fixo'])
                ->add('ocupanteFlutuante',null,['label'=>'Ocupantes Flutuante'])
                ->add('equipamentos', 'sonata_type_list', ['label'=>false])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}