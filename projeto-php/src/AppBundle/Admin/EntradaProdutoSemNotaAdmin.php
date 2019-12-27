<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class EntradaProdutoSemNotaAdmin extends Admin
{
    protected $baseRoutePattern = 'entradaprodutosemnota';



    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

    public function preRemove($object)
    {
        $almoxatidadoModel =  $this->getConfigurationPool()->getContainer()->get('almoxarifado_model');

        // Removento itens do estoque baseado em cancelamento de nota
        if(count($object->getProdutos())){
            foreach($object->getProdutos() as $produto){
                // Incrementa produto no estoque
                $almoxatidadoModel->removeQuantidadeProdutoEstoque($produto->getProduto(),$produto->getQuantidade());
            }
        }
    }

    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel =  $container->get('colaborador_model');
        $almoxatidadoModel =  $this->getConfigurationPool()->getContainer()->get('almoxarifado_model');

        $object->setColaborador($colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container));
        if(count($object->getProdutos())){
            foreach($object->getProdutos() as $produto){
                // Incrementa produto no estoque
                $almoxatidadoModel->criaOuIncrementaProdutoNoEstoque($produto->getProduto(),$produto->getQuantidade(), $perfilToFilter);
            }
        }

    }

    private function thisNotaExist($idNota)
    {
        $em = $this->modelManager->getEntityManager('AppBundle:EntradaProduto');

        $query = $em->createQuery("SELECT e FROM AppBundle:EntradaProduto e
            WHERE e.idNota='$idNota'");

        $entradaProduto = $query->getResult();

        if(count($entradaProduto)){
            return true;
        }

        return false;
    }

    private function getOrCreateProduto($codigoFabricante)
    {

        $em = $this->modelManager->getEntityManager('AppBundle:ProdutoAlmoxarifado');

        $query = $em->createQuery("SELECT p FROM AppBundle:ProdutoAlmoxarifado p
            WHERE p.codigoFabricante='$codigoFabricante'");

        $produto = $query->getResult();

        if(!count($produto)){
            return false;
        }

        return $produto[0];

//        if(!count($produto)){
//
//            $produtoNovo = new ProdutoAlmoxarifado();
//            $produtoNovo->setCaixa('a');
//
//        }else{
//            return $produto[0];
//        }
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


        if($object->getFornecedor() == ''){
            $errorElement->with('fornecedor')->addViolation('Atenção, selecione um fornecedor')->end();
        }

        $idNota = $this->getRequest()->request->get('idNota');

        if($this->thisNotaExist($idNota)){
            $errorElement->addViolation('Esta nota já foi cadastrada.');
        }

        if(!count($object->getProdutos())){
            $errorElement->addViolation('Não é possível criar um entrada sem itens na nota.');
        }

        if(count($object->getProdutos())){
            foreach($object->getProdutos() as $produto){

                // Verifica se tem algum produto que não tem no catálogo
                if(!$this->getOrCreateProduto($produto->getProduto()->getCodigoFabricante())){
                    $errorElement->addViolation('O produto código '.$produto->getProduto()->getCodigoFabricante().' não consta no catálogo de produtos no sistema.');
                }

            }
        }

    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('observacoes', null, ['label'=>'Observações'])
            ->add('createdAt', null, ['label'=>'Data de Entrada'])
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
            ->add('colaborador', null, ['label'=>'Colaborador que executou a entrada'])
            ->add('createdAt', null, ['label'=>'Data de Entrada'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
//                    'edit' => array(),
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
        $formMapper
            ->tab('Entrada de Produtos')
                ->with('Entrada de Produto')
//                    ->add('fornecedor','sonata_type_model',[
//                        'property' => 'razaoSocial',
//                        'label'=>'Fornecedor*',
//                        'required'=>false,
//                        'placeholder'=>'Selecione um Fornecedor'
//                    ])
					->add('fornecedor', 'entity', [
							'label' => 'Forenecedor*',
							'class' => 'AppBundle:Fornecedor',
							'placeholder' => 'Selecione',
							'required' => false,
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
                    ->add('idNota', null, ['label'=>'Identificação'])
                    ->add('observacoes', null, ['label'=>'Observações'])
                ->end()
            ->end()
            ->tab('Produtos')
                ->with('Produtos')
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
                            'admin_code' => 'app.admin.produto_saida'
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
            ->with('Dados da Entrada')
                ->add('idNota',null, ['label'=>'Número da Nota'])
                ->add('id',null, ['label'=>'Código'])
                ->add('colaborador.nome', null, ['label'=>'Colaborador'])
                ->add('createdAt', null, ['label'=>'Data'])
            ->end()
            ->with('Fornecedor')
                ->add('fornecedor.razaoSocial',null, ['label'=>'Razão Social'])
                ->add('fornecedor.cnpj', null, ['label'=>'CNPJ'])
            ->end()
            ->with('Itens da nota')
                ->add('produtos','sonata_type_list', [
                    'label'=>false,
                    'template'=>'AppBundle:Almoxarifado:produtos-entrada-list.html.twig'
                ])
            ->end()
//            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
//                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
//                ->add('updatedAt',null, ['label'=>'Última alteração'])
//            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
//            ->end()
        ;
    }
}