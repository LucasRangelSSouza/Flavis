<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;

class ProdutoAlmoxarifadoAdmin extends Admin
{


    /* Validações Fundamentais */
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

        if($object->getFornecedor() == ''){
            $errorElement->with('fornecedor')->addViolation('Atenção, selecione um fornecedor')->end();
        }
        if($object->getTitulo() == ''){
            $errorElement->with('titulo')->addViolation('Atenção, preencha o campo Título')->end();
        }
        if($object->getUnidadeMedida() == ''){
            $errorElement->with('unidadeMedida')->addViolation('Atenção, selecione uma unidade de medida')->end();
        }
        if($object->getCodigoFabricante() == ''){
            $errorElement->with('codigoFabricante')->addViolation('Atenção, preencha o campo Código do Fabricante')->end();
        }
        if($object->getDepartamento() == ''){
            $errorElement->with('departamento')->addViolation('Atenção, selecione um departamento')->end();
        }
        if($object->getSeccao() == ''){
            $errorElement->with('seccao')->addViolation('Atenção, preencha o campo Secção')->end();
        }
        if($object->getPrateleira() == ''){
            $errorElement->with('prateleira')->addViolation('Atenção, preencha o campo Prateleira')->end();
        }
        if($object->getDivisao() == ''){
            $errorElement->with('divisao')->addViolation('Atenção, preencha o campo Divisão')->end();
        }
        if($object->getCaixa() == ''){
            $errorElement->with('caixa')->addViolation('Atenção, preencha o campo Caixa')->end();
        }
        if($object->getQuantidadeMinima() == ''){
            $errorElement->with('quantidadeMinima')->addViolation('Atenção, selecione a quantidade mínima')->end();
        }else{
            if(preg_match('/[^0-9]+/m', $object->getQuantidadeMinima())){
                $errorElement->with('quantidadeMinima')->addViolation('Atenção, o campo quantidade mínima só pode conter números')->end();
            }
        }

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
//        $collection->clearExcept(array('list', 'show', 'edit',''));
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

    public function preUpdate($object)
    {
        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->preUpdate($documento);
        }
    }

    public function prePersist($object)
    {
        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->prePersist($documento);
        }
    }

    public function postUpdate($produto)
    {
        $this->uploadFile($produto);
    }

    public function postPersist($produto)
    {
        $this->uploadFile($produto);
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

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('status')
            ->add('titulo')
            ->add('pathFoto')
            ->add('codigoFabricante')
            ->add('seccao')
            ->add('prateleira')
            ->add('divisao')
            ->add('caixa')
//            ->add('createdAt',null,array(
//                'label'=>'Criado Em',
//                'field_type' => 'text'), null, array('attr' => array('class' => 'mask_date')))
//            ->add('updatedAt',null,array(
//                'label'=>'Alterado Em',
//                'field_type' => 'text'), null, array('attr' => array('class' => 'mask_date')))
//            ->add('deletedAt',null,array(
//                'label'=>'Deletado Em',
//                'field_type' => 'text'), null, array('attr' => array('class' => 'mask_date')))
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('deletedAt')
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
          //  ->add('id',null,['label'=>'Código'])
            ->add('titulo', null, ['label'=>'Título'])
            ->add('codigoFabricante', null, ['label'=>'Código do Fabricante'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
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
        $produto = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Foto do Produto';

        if($produto->getPathFoto()!=''){
            $fileFieldOptions['help'] = '<img src="/'.$produto->getPathFoto().'" class="admin-preview img-thumbnail"/>';
        }

        $formMapper
            ->tab('Produto')
                ->with('Dados do Produto', array('class' => 'col-md-6'))->end()
            ->end()

            ->tab('Documento')
                ->with('Documentos', array('class' => 'col-md-6'))->end()
            ->end()
        ;

        $formMapper
            ->tab('Produto')
                ->with('Dados do Produto',array('class' => 'col-md-6'))
        //            ->add('fornecedor','sonata_type_model',
        //                ['property' => 'razaoSocial','label'=>'Fornecedor*','required'=>false,'placeholder'=>'Selecione um fornecedor'])
                    ->add('fornecedor', 'entity', [
                            'label' => 'Fornecedor',
                            'class' => 'AppBundle:Fornecedor',
                            'placeholder' => 'Selecione',
                            'required' => true,
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                                $container = $this->getConfigurationPool()->getContainer();
                                $em = $container->get('doctrine.orm.default_entity_manager');

                                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));

                                $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

                                foreach($colaboradores as $colaborador) {
                                    if($colaborador->getUser() == $colaboradorLogado){
                                        $perfilToFilter = $colaborador->getNomePerfil();
                                    }
                                }

                                $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                $queryBuilder
                                    ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                    ->setParameters([
                                        'perfl' => $perfilToFilter
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('status','checkbox',['label'=>'Publicado','required'=>false])
                    ->add('titulo', null, ['label'=>'Título*','required'=>false])
                    ->add('unidadeMedida', 'choice', [ 'label'=>'Unidade de Medida','required'=>true,
                        'choices' => ['KG'=>'KG','UN'=>'UN','M'=>'M','M2'=>'M2','M3'=>'M3','L'=>'L'],
                        'empty_value' => 'Selecione'
                    ])
                    ->add('pathFoto', 'file',$fileFieldOptions)
                    ->add('codigoFabricante', null, ['label'=>'Código do Fabricante','required'=>true])
                ->end()
                ->with('Localização Física',array('class' => 'col-md-6'))
                    ->add('departamento', 'choice', [
                        'label' => 'Departamento',
                        'required' => true,
                        'choices' => ['industria'=>'Indústria','manutencao-e-servicos'=>'Manutenção e Serviços'],
                        'empty_value' => 'Selecione'
                    ])
                    ->add('seccao', null, ['label'=>'Secção','required'=>true])
                    ->add('prateleira', null, ['label'=>'Prateleira','required'=>true])
                    ->add('divisao', null, ['label'=>'Divisão','required'=>true])
                    ->add('caixa', null, ['label'=>'Caixa','required'=>true])
                    ->add('quantidadeMinima', null, ['label'=>'Quantidade Mínima','required'=>true])
                ->end()
            ->end()

            ->tab('Documento')
                ->with('Documentos',array('class' => 'col-md-12'))
                    ->add('documentos', 'sonata_type_collection',
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
                            'admin_code' => 'app.admin.documento'
                        ]
                    )
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
            ->with('Dados do Produto',array('class' => 'col-md-6'))
                ->add('status', null, ['label' => 'Publicado'])
                ->add('titulo', null, ['label'=>'Título'])
                ->add('pathFoto',null, ['label'=>'Foto do Produto','template'=>'AppBundle:Custom:image-list.html.twig'])
                ->add('codigoFabricante',null, ['label'=>'Código do Fabricante'])
            ->end()
            ->with('Localização Física',array('class' => 'col-md-6'))
                ->add('seccao', null, ['label'=>'Secção'])
                ->add('prateleira', null, ['label'=>'Prateleira'])
                ->add('divisao', null, ['label'=>'Divisão'])
                ->add('caixa', null, ['label'=>'Caixa'])
            ->end()
            ->with('Dados de cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
            ->with('Documentos',array('class' => 'col-md-12'))
                ->add('documentos','sonata_type_list', [
                    'label'=>false,
                    'template'=>'AppBundle:Colaborador:documentos-list.html.twig'
                ])
            ->end()
        ;
    }
}