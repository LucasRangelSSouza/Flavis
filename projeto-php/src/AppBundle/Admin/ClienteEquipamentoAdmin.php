<?php

namespace AppBundle\Admin;

use AppBundle\Form\ProcedimentosClienteEquipamentoType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class ClienteEquipamentoAdmin extends Admin
{

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->remove('delete');
    }


//    public function prePersist($object)
//    {
//        if($object['acao']=='insert'){
//            $object['objeto']->getData()->setCliente($object['cliente']);
//            return $object['objeto'];
//        }
//    }
//
//    public function preUpdate($object)
//    {
//        $object['objeto']->getData()->setCliente($object['cliente']);
//        return $object['objeto'];
//    }

    public function postPersist($object)
    {
        $this->geraAgendaDeManutencoes($object);
    }

    public function postUpdate($object)
    {
        $this->geraAgendaDeManutencoes($object);
    }

    public function prePersist($object)//Insert
    {
        $this->updateEquipamento($object);
        $this->updateProcedimentos($object);
        if ($object->getFile()) {
            $this->manageFileUpload($object);
            $object->setPathFoto('/uploads/equipamentos-cliente/' . $object->getFile()->getClientOriginalName());
        }
    }

    public function preUpdate($object)//Update
    {
        $this->updateEquipamento($object);
        $this->updateProcedimentos($object);
        if ($object->getFile()) {
            $this->manageFileUpload($object);
            $object->setPathFoto('/uploads/equipamentos-cliente/' . $object->getFile()->getClientOriginalName());
        }
    }

    private function manageFileUpload($image) {
        if ($image->getFile()) {
            $image->lifecycleFileUpload();
        }
    }

    private function updateProcedimentos($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine')->getEntityManager();

        $procedimentos = $this->getRequest()->request->get('procedimentos');

        if (!empty($procedimentos)) {
            $object->clearProcedimentos();

            foreach($procedimentos as $procedimento){
                $procedimentoEntity = $em
                    ->getRepository('AppBundle:AgendamentoManutencaoEquipamento')//Procedimentos PMOC do equipamento
                    ->find($procedimento);

                $object->addProcedimentosPreventivo($procedimentoEntity);
            }
        }
    }

    private function updateEquipamento($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine')->getEntityManager();

        $idEquipamento = $this->getRequest()->request->get('equipamento_cliente');

        if (!empty($idEquipamento)) {
            $equipamento = $em
                ->getRepository('AppBundle:EquipamentoCliente')
                ->find($idEquipamento);

            $object->setEquipamento($equipamento);
        }
    }

    private function geraAgendaDeManutencoes($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $pmocModel = $container->get('pmoc_model');

        if($object->getIsPmoc()==true){
            $pmocModel->geraAgendamentoExecucoesPmoc($object,$container);
        }else{
            // Excluir todos os agendamentos daqui para frente
//            $pmocModel->cancelaPmocEquipamentoCliente($object,$container);
            $pmocModel->removeAllAgendamentosSemOS($object);
        }
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array(
                'AppBundle:Custom:custom_one_to_many.html.twig',
                'AppBundle:Custom:custom_one_one_to_many.html.twig'
            )
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $clientes = $em->getRepository('AppBundle:Cliente')->findAll(array(),array('nome' => 'ASC'));
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $clientesToFilter = array();

        foreach($clientes as $cliente) {
            if($cliente->getNomePerfil() == $perfilToFilter) {
                $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
            }
        }

        $marcas = $em->getRepository('AppBundle:MarcaEquipamento')->findAll(array(),array('titulo' => 'ASC'));
        $marcasToFilter = array();

        foreach($marcas as $marca) {
            $marcasToFilter[$marca->getTitulo()] = $marca->getTitulo();
        }

        $modelos = $em->getRepository('AppBundle:ModeloEquipamento')->findAll();
        $modelosToFilter = array();

        foreach($modelos as $modelo) {
            $modelosToFilter[$modelo->getTitulo()] = $modelo->getTitulo();
        }

        $datagridMapper
            ->add('cliente.nome','doctrine_orm_string', array('label'=>'Cliente'), 'choice',
                array('choices' => $clientesToFilter))
//            ->add('equipamento.marca.titulo','doctrine_orm_string',['label'=>'Marca'])
//            ->add('equipamento.modelo.titulo','doctrine_orm_string',['label'=>'Modelo'])
            ->add('equipamento.marca.titulo','doctrine_orm_string', array('label'=>'Marca'), 'choice',
                array('choices' => $marcasToFilter))
            ->add('equipamento.modelo.titulo','doctrine_orm_string', array('label'=>'Modelo'), 'choice',
                array('choices' => $modelosToFilter))
            ->add('prioridade','doctrine_orm_choice', array(
                'label' => 'Prioridade'),
                'choice',
                array(
                    'choices' => array(
                        'Alta' => 'Alta',
                        'Média' => 'Média',
                        'Baixa' => 'Baixa'
                    )
                ))
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
//        echo $perfilToFilter;

        // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
        $query->andWhere(
            $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
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
            ->add('cliente.nome',null,['label'=>'Cliente'])
            ->add('equipamento.marca.titulo',null,['label'=>'Marca'])
            ->add('equipamento.modelo.titulo',null,['label'=>'Modelo'])
            ->add('isPmoc', 'choice', [
                'label' => 'PMOC',
                'choices' => [true=>'Sim',false=>'Não'],
                'required' => false,
                'empty_value' => 'Selecione'
            ])
            ->add('prioridade',null,['label'=>'Prioridade'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $now = new \DateTime();
        $intervaloPmoc = new \DateInterval('P1Y'); // Intervalo do contrato mínimo de PMOC - um ano
        $endDate   = $now->add($intervaloPmoc);

        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => date('d') . '-' . date('m') . date('Y'),
            'format'=>'dd/MM/yyyy',
        );

        $colaborador = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Foto do Equipamento (PNG, JPG, JPEG)';
        $fileFieldOptions['attr'] = ['class' => 'foto'];

        if($colaborador->getPathFoto()!=''){
            $fileFieldOptions['help'] = '<img src="'.$this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath().$colaborador->getPathFoto().'" class="admin-preview img-thumbnail"/>';
        }


        $formMapper
            //->add('cliente', 'sonata_type_model', ['placeholder' => 'Selecione','label'=>'Cliente'])
            ->with('Dados Equipamento',array('class' => 'col-md-6'))
            ->add('cliente', 'entity', [
                    'label' => 'Cliente',
                    'class' => 'AppBundle:Cliente',
                    'empty_data'  => '0',
                    'placeholder' => 'Selecione',
                    'required' => true,
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                        $container = $this->getConfigurationPool()->getContainer();
                        $em = $container->get('doctrine.orm.default_entity_manager');
                        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                        $colaboradorModel  =  $container->get('colaborador_model');
                        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);
                        $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                        foreach($colaboradores as $colaborador) {
                            if($colaborador->getUser() == $colaboradorLogado2) {
                                $perfilToFilter = $colaborador->getNomePerfil();
                            }
                        }

                        $queryBuilder = $defaultRepository->createQueryBuilder('c');
                        $queryBuilder
//                            ->andWhere($queryBuilder->expr()->in('c.filial', ':filiais'))
                            ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                            ->setParameters([
//                                'filiais' => $colaboradorLogado->getFiliais()->toArray(),
                                'perfl' => $perfilToFilter
                            ]);

                        return $queryBuilder;
                    },
                ]
            )
//            ->add('foto', 'sonata_media_type', array(
//                'provider' => 'sonata.media.provider.image',
//                'context'  => 'default',
//                'label' =>'Foto',
//                'required' => false
//            ))
            ->add('procedimentosEquipamentos', new ProcedimentosClienteEquipamentoType(), array('label' => false, 'mapped' => false),array('type' => 'string'))
            ->add('propriedades',  'sonata_type_collection',
                [
                    'label' => 'Propriedades do equipamento',
                    'required' => false,
                    'cascade_validation' => true,
                    'type_options' => array(
                        'delete' => false,
                    ),
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'admin_code' => 'app.admin.propriedade_equipamento'
                ])
            ->add('prioridade','choice',
                array(
                    'label'=>'Prioridade',
                    'required' => false,
                    'choices' => array(
                        'Alta' => 'Alta',
                        'Média' => 'Média',
                        'Baixa' => 'Baixa'
                    )
                ))
            ->add('observacoes',null,['label'=>'Observações','required'=>true])
            ->add('file', 'file',$fileFieldOptions)
            ->end()
            ->with('PMOC',array('class' => 'col-md-4'))
            ->add('isPmoc','checkbox',['label'=>'Tem contrato de PMOC','required'=>false])
            ->add('dataInicioPmoc', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Data de início do PMOC','attr' => ['class' => 'mascara_data'],'required'=>false,'help'=>'Obrigatório, caso tenha PMOC.'])
            ->add('tempoOs',null,['label'=>'Tempo OS do PMOC','required'=>false,'help'=>'Obrigatório, caso tenha PMOC.'])
            ->add('unidadeTempo', 'choice', [ 'label'=>'Unidade de Tempo','required'=>false,
                'choices' => ['Hora'=>'Hora','Min'=>'Min','Seg'=>'Seg','Dia'=>'Dia','Mês'=>'Mês','Ano'=>'Ano'],
                'empty_value' => 'Selecione',
                'help'=>'Obrigatório, caso tenha PMOC.'
            ])
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Equipamento do Cliente',array('class' => 'col-md-6'))
                ->add('cliente.nome',null,['label'=>'Cliente'])
                ->add('equipamento.id',null,['label'=>'Código do Equipamento'])
                ->add('tagEquipamento')
                ->add('equipamento.marca.titulo',null,['label'=>'Marca'])
                ->add('equipamento.modelo.titulo',null,['label'=>'Modelo'])
                ->add('equipamento.grupoEquipamento.titulo',null,['label'=>'Tipo de Equipamento'])
                ->add('equipamento.serie',null,['label'=>'Número de Série'])
                ->add('equipamento.especificacoes',null,['label'=>'Especificações do Equipamento'])
                ->add('equipamento.dataAquisicao',null,['label'=>'Data de Aquisição'])
                //->add('equipamento.foto',null,['label'=>'Foto do Equipamento'])
//                ->add('equipamento.procedimentosPreventivos',null,['label'=>'Procedimentos Preventivos'])
                ->add('prioridade',null,['label'=>'Prioridade'])
                ->add('propriedades',  'sonata_type_collection',
                    [
                        'label' => 'Propriedades do equipamento',
                        'cascade_validation' => true,
                        'type_options' => array(
                            'delete' => false,
                        ),
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                        'admin_code' => 'app.admin.propriedade_equipamento'
                    ])
                ->add('observacoes')
            ->end()

            ->with('Dados PMOC',array('class' => 'col-md-4'))
                ->add('isPmoc', 'choice', [
                    'label' => 'PMOC',
                    'choices' => [true=>'Sim',false=>'Não'],
                    'required' => false,
                    'empty_value' => 'Selecione'
                ])
                ->add('dataInicioPmoc',null,['label'=>'Data de Inicio PMOC'])
            ->end()

            ->with('Localização Equipamento',array('class' => 'col-md-4'))
                ->add('equipamento.ambiente.colaborador.nome',null, array('label' => 'Responsável pelo Ambiente'))
                ->add('equipamento.ambiente.titulo',null, array('label' => 'Ambiente'))
                ->add('equipamento.ambiente.localizacao.titulo',null, array('label' => 'Localização'))
//                ->add('localizacaoEquipamento',null, array('label' => 'Localização', 'mapped' => false))
//                ->add('ambienteEquipamento',null, array('label' => 'Ambiente', 'mapped' => false))
//                ->add('responsavelAmbiente',null, array('label' => 'Responsável pelo Ambiente', 'mapped' => false))
            ->end()

            ->with('Dados do Cadastro',array('class' => 'col-md-4'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }

    /* Validações Fundamentais para criação de uma entrada de mercadoria */
    public function validate(ErrorElement $errorElement, $object)
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


        foreach ($object->getPropriedades() as $propriedade) {

            $object->removePropriedade($propriedade);
            $object->addPropriedade($propriedade->setNomePerfil($perfilToFilter));

        }

//        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine')->getEntityManager();

        $idEquipamento = $this->getRequest()->request->get('equipamento_cliente');

        if(empty($idEquipamento)){
            $errorElement->addViolation('O campo equipamento é obrigatório');
        }else {
            $equipamento = $em
                ->getRepository('AppBundle:EquipamentoCliente')
                ->find($idEquipamento);
            if(!$equipamento){
                $errorElement->addViolation('Equipamento não encontrado');
            }

            $procedimentos = $this->getRequest()->request->get('procedimentos');
            if($object->getIsPmoc()) {
                if (empty($procedimentos)) {
                    $errorElement->addViolation('A seleção do procedimento é obrigatório!');
                }
            }
        }

//        if(!count($object->getPropriedades())){
//            $errorElement->addViolation('É necessário incluir a propriedade do equipamento');
//        }

//        $now = new \DateTime();
        $now = date('d/m/Y');

        // Verificar se isPmoc está marcada para cobrar a data de assinatura do contrato
        if($object->getIsPmoc() && empty($object->getDataInicioPmoc())){
            $errorElement->addViolation('Caso tenha PMOC este equipamento, o campo "Data de início do PMOC" é obrigatório!');
        }
        if ($object->getDataInicioPmoc() !== '') {
            if ($object->getDataInicioPmoc() < $now ) {
                $errorElement->with('dataInicioPmoc')->addViolation('Atenção, data de início do PMOC menor que data atual')->end();
            }
        }
        // Verificar se isPmoc está marcada para cobrar a data de assinatura do contrato
        if($object->getIsPmoc() && empty($object->getTempoOs())){
            $errorElement->addViolation('Caso tenha PMOC este equipamento, o campo "Tempo OS do PMOC" é obrigatório!');
        }else{
            if(preg_match('/[^0-9]+/m', $object->getTempoOs())){
                $errorElement->with('tempoOs')->addViolation('Atenção, o campo tempo OS só pode conter números')->end();
            }
        }
        // Verificar se isPmoc está marcada para cobrar a data de assinatura do contrato
        if($object->getIsPmoc() && empty($object->getUnidadeTempo())){
            $errorElement->addViolation('Caso tenha PMOC este equipamento, o campo "Unidade de Tempo" é obrigatório!');
        }

        if($object->getObservacoes() == ''){
            $errorElement->with('observacoes')->addViolation('Atenção, preencha o campo Observaçôes')->end();
        }

    }
}