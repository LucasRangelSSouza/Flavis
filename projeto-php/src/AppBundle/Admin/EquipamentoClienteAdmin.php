<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class EquipamentoClienteAdmin extends Admin
{


    /* Validações Fundamentais */
    public function validate(ErrorElement $errorElement, $object)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $equipamentos = $em->getRepository('AppBundle:EquipamentoCliente')->findAll();
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $object->setNomePerfil($perfilToFilter);

        foreach ($object->getProcedimentosPreventivos() as $preventivo) {
            $object->removeProcedimentosPreventivo($preventivo);
            $preventivo->setNomePerfil($perfilToFilter);
            $object->addProcedimentosPreventivo($preventivo);
        }


        foreach ($equipamentos as $equipamento) {

            //Validação na criação e na alteração (null ou <>)
            if (($this->getSubject()->getId() == null) || ($equipamento->getId() !== $object->getId())) {
                if ($equipamento->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                    if ($equipamento->getSerie() == $object->getSerie()) {
                        $errorElement->with('serie')->addViolation('Atenção, número de série informado já cadastrado')->end();
                    }

                }
            }

        }

        $now = new \DateTime();

        if ($object->getMarca() == '') {
            $errorElement->with('marca')->addViolation('Atenção, selecione uma Marca')->end();
        }
        if ($object->getModelo() == '') {
            $errorElement->with('modelo')->addViolation('Atenção, selecione um Modelo')->end();
        }
        if ($object->getDataAquisicao() == '') {
            $errorElement->with('dataAquisicao')->addViolation('Atenção, preencha o campo Data de Aquisição')->end();
        } else {
            if ($object->getDataAquisicao() > $now ) {
                $errorElement->with('dataAquisicao')->addViolation('Atenção, data de aquisição maior que data atual')->end();
            }
        }
        if ($object->getUnidadeMedida() == '') {
            $errorElement->with('unidadeMedida')->addViolation('Atenção, preencha o campo Unidade de Medida')->end();
        }
        if ($object->getSerie() == '') {
            $errorElement->with('serie')->addViolation('Atenção, preencha o campo Série')->end();
        }
        if ($object->getCapacidade() == '') {
            $errorElement->with('capacidade')->addViolation('Atenção, preencha o campo Capacidade')->end();
        }else{
            if(preg_match('/[^0-9]+/m', $object->getCapacidade())){
                $errorElement->with('capacidade')->addViolation('Atenção, o campo capacidade só pode conter números')->end();
            }
        }
        if ($object->getEspecificacoes() == '') {
            $errorElement->with('especificacoes')->addViolation('Atenção, preencha o campo Especificações técnicas')->end();
        }
        if ($object->getGrupoEquipamento() == '') {
            $errorElement->with('grupoEquipamento')->addViolation('Atenção, preencha o campo Tipo do Equipamento')->end();
        }
        if ($object->getAmbiente() == '') {
            $errorElement->with('ambiente')->addViolation('Atenção, preencha o campo Ambiente do Equipamento')->end();
        }

        // Verificar se isPmoc está marcada para cobrar a data de assinatura do contrato
        if($object->getInativado() && empty($object->getJustificativa())){
            $errorElement->addViolation('Caso tenha marcado a opção Inativado, o campo "Justificativa" é obrigatório!');
        }

        // Verificar se isPmoc está marcada para cobrar a data de assinatura do contrato
        if($object->getInativado() && empty($object->getJustificativa())){
            $errorElement->with('justificativa')->addViolation('Caso tenha marcado a opção Inativado, o campo "Justificativa" é obrigatório!');
        }

//        //Se exister ambiente relacionado com algum equipamento não pode inativar => Não precisa por que o amiente é obrogatório
//        if ($object->getInativado()) {//Valida se esta incluindo equipamento com ambiente Inativo
//
//            if(count($object->getAmbiente())){
//                $errorElement->with('ambiente')->addViolation('Atenção, para inativar não pode existir ambiente relacionado!');
//            }
//
//        }
    }

        // Removendo ações da lista
        public
        function getBatchActions()
        {
            $actions = parent::getBatchActions();
            unset($actions['delete']);

            return $actions;
        }


    public function prePersist($image) {
        if ($image->getFile()) {
            $this->manageFileUpload($image);
            $image->setPathFoto('/uploads/catalogo-equipamentos/' . $image->getFile()->getClientOriginalName());
        }
    }

    public function preUpdate($image) {
        if ($image->getFile()) {
            $this->manageFileUpload($image);
            $image->setPathFoto('/uploads/catalogo-equipamentos/' . $image->getFile()->getClientOriginalName());
        }
    }

    private function manageFileUpload($image) {
        if ($image->getFile()) {
            $image->lifecycleFileUpload();
        }
    }


//    private function uploadFile($produto)
//    {
//        $foto = $this->getForm()->get('pathFoto')->getData();
//
//        if(isset($foto) && $foto!=''){
//
//            try{
//
//                $container = $this->getConfigurationPool()->getContainer();
//                $uploadableManager = $container->get('stof_doctrine_extensions.uploadable.manager');
//                $uploadableManager->markEntityToUpload($produto, $foto);
//
//                $em = $container->get('doctrine.orm.default_entity_manager');
//                $em->flush();
//
//                @unlink($produto->getOldPathFoto());
//
//            } catch (InvalidFormException $exception) {
//                return $exception->getForm();
//            }
//
//        }
//    }

        public
        function getFormTheme()
        {
            return array_merge(
                parent::getFormTheme(),
                array('AppBundle:Custom:custom_one_to_many.html.twig')
            );
        }

        /**
         * @param DatagridMapper $datagridMapper
         */
        protected
        function configureDatagridFilters(DatagridMapper $datagridMapper)
        {
            $container = $this->getConfigurationPool()->getContainer();
            $em = $container->get('doctrine.orm.default_entity_manager');

            $marcas = $em->getRepository('AppBundle:MarcaEquipamento')->findAll(array(), array('titulo' => 'ASC'));
            $marcasToFilter = array();

            foreach ($marcas as $marca) {
                $marcasToFilter[$marca->getTitulo()] = $marca->getTitulo();
            }

            $modelos = $em->getRepository('AppBundle:ModeloEquipamento')->findAll();
            $modelosToFilter = array();

            foreach ($modelos as $modelo) {
                $modelosToFilter[$modelo->getTitulo()] = $modelo->getTitulo();
            }

            $datagridMapper
                ->add('id', null, ['label' => 'Código'])
                ->add('marca.titulo', 'doctrine_orm_string', array('label' => 'Marca'), 'choice',
                    array('choices' => $marcasToFilter))
                ->add('modelo.titulo', 'doctrine_orm_string', array('label' => 'Modelo'), 'choice',
                    array('choices' => $modelosToFilter));
        }

        public
        function createQuery($context = 'list')
        {
            $query = parent::createQuery($context);

            $container = $this->getConfigurationPool()->getContainer();
            $em = $container->get('doctrine.orm.default_entity_manager');

            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));

            $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

            $perfilToFilter = array();

            foreach ($colaboradores as $colaborador) {
                if ($colaborador->getUser() == $colaboradorLogado) {
                    $perfilToFilter = $colaborador->getNomePerfil();
                }
            }
//        echo $perfilToFilter;

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
        protected
        function configureListFields(ListMapper $listMapper)
        {
            $listMapper
                ->add('id',null,['label'=>'Código'])
                ->add('marca.titulo', null, ['label' => 'Marca'])
                ->add('modelo.titulo', null, ['label' => 'Modelo'])
                ->add('serie', null, ['label' => 'Série'])
                ->add('grupoEquipamento.titulo', null, ['label' => 'Tipo'])
                ->add('inativado', 'choice', [
                    'label' => 'Inativado',
                    'choices' => [true=>'Sim',false=>'Não'],
                    'required' => false,
                    'empty_value' => 'Selecione'
                ])
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                    )
                ));
        }

        /**
         * @param FormMapper $formMapper
         */
        protected
        function configureFormFields(FormMapper $formMapper)
        {
            $now = new \DateTime();
            $dateFieldConfig = array(
                'years' => range(1900, $now->format('Y')),
                'dp_min_date' => '1-1-1900',
                'dp_max_date' => date('d') . '-' . date('m') . date('Y'),
                'format' => 'dd/MM/yyyy',
            );

            // Definição da disposição dos blocos
            $formMapper
                ->tab('Catálogo de Equipamentos')
                    ->with('Equipamento', array('class' => 'col-md-6'))->end()
                    ->with('Mais Informações', array('class' => 'col-md-6'))->end()
                ->end()
                ->tab('PMOC')
                    ->with('Procedimentos Preventivos', array('class' => 'col-md-12'))->end()
                ->end();

            $colaborador = $this->getSubject();
            $fileFieldOptions['data_class'] = null;
            $fileFieldOptions['required'] = false;
            $fileFieldOptions['label'] = 'Foto do Equipamento (PNG, JPG, JPEG)';
            $fileFieldOptions['attr'] = ['class' => 'foto'];

            if($colaborador->getPathFoto()!=''){
                $fileFieldOptions['help'] = '<img src="'.$this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath().$colaborador->getPathFoto().'" class="admin-preview img-thumbnail"/>';
            }

            $formMapper
                ->tab('Catálogo de Equipamentos')
                    ->with('Equipamento')
                        ->add('marca', 'sonata_type_model', ['placeholder' => 'Selecione', 'required' => true, 'label' => 'Marca', 'property' => 'titulo', 'btn_add' => false])
                        ->add('modelo', 'sonata_type_model', ['placeholder' => 'Selecione', 'required' => true, 'label' => 'Modelo', 'property' => 'titulo', 'btn_add' => false])
                        ->add('capacidade', null, ['label' => 'Capacidade', 'required' => true])
                        ->add('unidadeMedida', 'choice', ['label' => 'Unidade de Medida', 'required' => true,
                            'choices' => ['KG' => 'KG', 'UN' => 'UN', 'M' => 'M', 'M2' => 'M2', 'M3' => 'M3', 'L' => 'L'],
                            'empty_value' => 'Selecione'
                        ])
                        ->add('serie', null, ['label' => 'Série', 'required' => true])
                        ->add('dataAquisicao', 'sonata_type_date_picker', $dateFieldConfig + [
                                'label' => 'Data de Aquisicao',
                                'required' => true,'attr' => ['class' => 'mascara_data']
                            ])
                        ->add('grupoEquipamento', 'entity', [
                                'label' => 'Tipo do Equipamento',
                                'class' => 'AppBundle:GrupoEquipamento',
                                'placeholder' => 'Selecione',
                                'required' => true,
                                'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
                                    $container = $this->getConfigurationPool()->getContainer();
                                    $em = $container->get('doctrine.orm.default_entity_manager');
                                    $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
                                    $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

                                    foreach ($colaboradores as $colaborador) {
                                        if ($colaborador->getUser() == $colaboradorLogado) {
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
                        ->add('ambiente', 'entity', [
                                'label' => 'Ambiente do Equipamento',
                                'class' => 'AppBundle:Ambiente',
                                'placeholder' => 'Selecione',
                                'required' => true,
                                'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
                                    $container = $this->getConfigurationPool()->getContainer();
                                    $em = $container->get('doctrine.orm.default_entity_manager');
                                    $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
                                    $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
                                    $ambienteEquipamentoClientes = $em->getRepository('AppBundle:AmbienteEquipamentoCliente')->findAll(array(), array('titulo' => 'ASC'));

                                    foreach ($colaboradores as $colaborador) {
                                        if ($colaborador->getUser() == $colaboradorLogado) {
                                            $perfilToFilter = $colaborador->getNomePerfil();
                                        }
                                    }

//                                    //Já traz o ambiente deste equipamento
//                                    //ou seja um ambiente para um equipamento
//                                    //Traz o ambiente que esteja na tabela relacionada com o equipamento selecionado
//                                    foreach ($ambienteEquipamentoClientes as $ambienteEquipamentoCliente) {
//                                        if ($ambienteEquipamentoCliente->getEquipamento() == $this->getId()) {
//                                            $ambienteEquipamentoClienteToFilter = $ambienteEquipamentoCliente->getAmbiente();
//                                        }
//                                    }
//
//                                    //Tráz os ambientes que não estejam ligados a nenhum equipamento
//                                    //ou seja um ambiente para um equipamento
//                                    //Traz os ambientes que não estejam na tabela relacionada
//                                    foreach ($ambienteEquipamentoClientes as $ambienteEquipamentoCliente) {
//                                        if ($ambienteEquipamentoCliente->getAmbiente() !== $this->getAmbiente()) {
//                                            $ambienteEquipamentoClienteToFilter = $ambienteEquipamentoCliente->getAmbiente();
//                                        }
//                                    }

                                    $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                    $queryBuilder
                                        ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
//                                        ->andWhere($queryBuilder->expr()->not('c.habilitado = :status'))
//                                        ->andWhere($queryBuilder->expr()->in('c.id = :ambiente'))
                                        ->setParameters([
                                            'perfl' => $perfilToFilter
//                                            'status' => true
//                                            'ambiente' => $ambienteEquipamentoClienteToFilter
                                        ]);

                                    return $queryBuilder;
                                },
                            ]
                        )
                        ->add('inativado','checkbox',['label'=>'Inativado','required'=>false])
                        ->add('justificativa',null,['label'=>'Justificativa','attr'=>['style'=>'height:140px;']])
                    ->end()
                    ->with('Mais Informações')
                        ->add('file', 'file',$fileFieldOptions)
//                        ->add('foto', 'sonata_media_type', array(
//                            'provider' => 'sonata.media.provider.image',
//                            'context' => 'apply',
//                            'label' => 'Foto',
//                            'required' => false
//                        ))
                        ->add('especificacoes', null, ['label' => 'Especificações técnicas do equipamento', 'required' => true, 'attr' => ['style' => 'height:200px']])
                    ->end()
                ->end()
                ->tab('PMOC')
                    ->with('Procedimentos Preventivos')
                        ->add('procedimentosPreventivos', 'sonata_type_collection',
                            [
                                'label' => false,
                                'cascade_validation' => true,
                                'type_options' => array(
                                    'delete' => false,
                                )
                            ],
                            [
                                'edit' => 'inline',
                                'inline' => 'table',
                                'sortable' => 'position',
                                'admin_code' => 'app.admin.agendamento_manutencao_equipamento'
                            ])
                    ->end()
                ->end();
        }

        /**
         * @param ShowMapper $showMapper
         */
        protected
        function configureShowFields(ShowMapper $showMapper)
        {
            $showMapper
                ->with('Dados do Equipamento', array('class' => 'col-md-6'))
                    //            ->add('id',['label'=>'Código'])
                    ->add('marca.titulo', null, ['label' => 'Marca'])
                    ->add('modelo.titulo', null, ['label' => 'Modelo'])
                    ->add('capacidade', null, ['label' => 'Capacidade'])
                    //            ->add('unidadeMedida',null,['label'=>'Unidade de Medida'])
                    ->add('serie', null, ['label' => 'Série'])
                    ->add('dataAquisicao', null, ['label' => 'Data de Aquisicao'])
                    ->add('grupoEquipamento.titulo', null, ['label' => 'Tipo'])
                    ->add('foto', 'sonata_media_type', array(
                        'provider' => 'sonata.media.provider.image',
                        'context' => 'default',
                        'label' => 'Foto',
                        'required' => false,
                        'label' => 'Arquivo'
                    ))
                ->end()
                ->with('Dados do Cadastro', array('class' => 'col-md-6'))
                    ->add('createdAt', null, ['label' => 'Data de Cadastro'])
                    ->add('updatedAt', null, ['label' => 'Última alteração'])
    //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
                ->end();
        }
    }