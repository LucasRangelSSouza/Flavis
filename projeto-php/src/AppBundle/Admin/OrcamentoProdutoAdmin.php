<?php

namespace AppBundle\Admin;

use AppBundle\Entity\OrdemCompraProduto;
use AppBundle\Entity\ProdutoSaida;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;

class OrcamentoProdutoAdmin extends Admin
{
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

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
        $collection->add('print', $this->getRouterIdParameter().'/print');
    }

    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();

        // Setar qual usuário está requisitando
        $colaboradorModel =  $container->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);

        $object->setColaborador($colaboradorLogado);
        $object->setEstado('aberto');

        return $object;
    }

    public function postUpdate($orcamento)
    {
        $this->uploadFile($orcamento);
    }

    public function postPersist($orcamento)
    {
        //$this->uploadFile($orcamento);
    }

    private function uploadFile($orcamento)
    {
        $foto = $this->getForm()->get('pathFoto')->getData();

        if(isset($foto) && $foto!=''){

            try{

                $container = $this->getConfigurationPool()->getContainer();
                $uploadableManager = $container->get('stof_doctrine_extensions.uploadable.manager');
                $uploadableManager->markEntityToUpload($orcamento, $foto);

                $em = $container->get('doctrine.orm.default_entity_manager');
                $em->flush();

                @unlink($orcamento->getOldPathFoto());

            } catch (InvalidFormException $exception) {
                return $exception->getForm();
            }

        }
    }

    public function preUpdate($object)
    {

    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('enviadoParaOrcarEm')
            ->add('dataCancelamento')
            ->add('observacoes')
            ->add('createdAt')
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
         //   ->add('id',null,['label'=>'Código'])
            ->add('colaborador.nome',null,['label'=>'Colaborador'])
            ->add('createdAt',null,['label'=>'Data de Cadastro'])
            ->add('estado',null,['label'=>'Estado'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'print' => array(
                        'template' => 'AppBundle:CRUD:list__action_pdf.html.twig'
                    )
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
        // Definição da disposição dos blocos
        $formMapper
            ->tab('Orçamentos')
                ->with('Orçamento', array('class' => 'col-md-8'))->end()
            ->end()
        ;

        // Data padrão
        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
            'format' => 'dd/MM/yyyy',
        );

        if($this->getSubject()->getId()){
            $orcamento = $this->getSubject();
            $fileFieldOptions['data_class'] = null;
            $fileFieldOptions['required'] = false;
            $fileFieldOptions['label'] = 'Cópia do Orçamento';

            if($orcamento->getPathFoto()!=''){
                $fileFieldOptions['help'] = '<a class="btn btn-success" href="/'.$orcamento->getPathFoto().'" target="_blank"><i class="fa fa-file" aria-hidden="true" style="margin-right:5px;"></i> Visualizar Arquivo</a>';
            }
        }

        $formMapper
            ->tab('Orçamentos')
                ->with('Orçamento');

                    if($this->getSubject()->getId()){
                        $formMapper->add('pathFoto', 'file',$fileFieldOptions);
                    }

                $formMapper
                    ->add('dataPrevistaEntrega', 'sonata_type_date_picker', $dateFieldConfig + [
                            'label' => 'Data Prevista de entrega',
                            'required' => true,
                        ])
                    ->add('dataEntrega', 'sonata_type_date_picker', $dateFieldConfig + [
                            'label' => 'Data de entrega',
                            'required' => false,
                        ])
                    ->add('observacoes',null,['label'=>'Observações'])
                ->end()
            ->end()

            ->tab('Itens para Orçamento')
                ->with('Itens para Orçamento')
                    ->add('produtos', 'sonata_type_collection',
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
                        'admin_code' => 'app.admin.produto_solicitacao'
                    ])
                ->end()
            ->end()


        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {

        $showMapper
            ->with('Dados do Orçamento')
                ->add('id',null, ['label'=>'Código'])
                ->add('estado','choice',
                    array(
                        'label'=>'Estado',
                        'choices' => array(
                            'aberto' => 'Aberto',
                            'orcando' => 'Orçando',
                            'autorizado' => 'Autorizado',
                            'cancelada' => 'Cancelada'
                        ),
                        'template'=>'AppBundle:Orcamento:estado-orcamento.html.twig'
                    ))
                ->add('colaborador.nome', null, ['label'=>'Colaborador'])
                ->add('createdAt', null, ['label'=>'Criado em'])
            ->end()

            ->with('Produtos Orçados')
                ->add('produtos','sonata_type_list', [
                    'label'=>false,
                    'template'=>'AppBundle:Almoxarifado:produtos-list.html.twig'
                ])
            ->end()
            ->with('Ações')
                ->add('',null,[
                    'label'=>false,
                    'template'=>'AppBundle:Orcamento:orcamento-actions.html.twig'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
//                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function validate( ErrorElement $errorElement, $object ) {

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



        if ( $object->getEstado() == 'cancelada' || $object->getEstado() == 'autorizado') {
            $error = 'Este orçamento não pode ser editado. Porque já foi autorizado ou cancelado';
            $errorElement->with( 'enabled' )->addViolation($error)->end();
//            $this->getRequest()->getSession()->getFlashBag()->add( "menu_type_check", $error );
        }

    }
}