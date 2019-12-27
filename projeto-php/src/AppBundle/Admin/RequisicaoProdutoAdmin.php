<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ProdutoAlmoxarifado;
use AppBundle\Form\ButtonGerarOrcamentoType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class RequisicaoProdutoAdmin extends Admin
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
        $collection->clearExcept(array('list', 'show', 'create'));
    }

    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();

        $colaboradorModel =  $container->get('colaborador_model');

        // Sempre na criação o estado é aberto
        $object->setEstado('aberto');

        // Setar qual usuário está requisitando
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);

        $object->setColaborador($colaboradorLogado);

        return $object;
    }

    public function postPersist($object)
    {
        $almoxatidadoModel =  $this->getConfigurationPool()->getContainer()->get('almoxarifado_model');

        // Remover produtos do estoque
        foreach($object->getProdutos() as $produto){
            $almoxatidadoModel->removeQuantidadeProdutoEstoque($produto->getProduto(),$produto->getQuantidade());
        }
    }

    /* Validações Fundamentais para criação de uma requisição */
    public function validate(ErrorElement $errorElement, $object)
    {
        // Se algum dos produtos da lista está indisponível
        $produtosIndisponiveis = $this->listaDeProdutosIndisponiveis($object->getProdutos());

        if(count($produtosIndisponiveis)){

            $errorElement->addViolation("Favor solicitar a abertura de um orçamento para uma ordem de compra destes produtos.");

            foreach($produtosIndisponiveis as $produtoIndisponivel){

                if(isset($produtoIndisponivel['produto'])){

                    $errorElement->addViolation("Quantidade do produto -
                    {$produtoIndisponivel['produto']->getProduto()->getTitulo()} - indisponível.
                    Faltam: {$produtoIndisponivel['faltam']} produto no estoque para concluir a requisição.");

                }

            }

        }
    }

    private function listaDeProdutosIndisponiveis($listaDeProdutos)
    {
        // Model
        $almoxatidadoModel =  $this->getConfigurationPool()->getContainer()->get('almoxarifado_model');

        $produtosIndisponiveis = array();

        foreach($listaDeProdutos as $produto){

            if($produto->getProduto() instanceof ProdutoAlmoxarifado){

                // Se está disponível a quantidade solicitada deste produto ID no estoque

                $quantidadeEstoque = $almoxatidadoModel->getQuantidadeItemDisponivelNoEstoqueByProdutoID($produto->getProduto()->getId());

                // Neste caso não está disponível no estoque
                if($produto->getQuantidade() > $quantidadeEstoque){

                    $faltam = $produto->getQuantidade() - $quantidadeEstoque;
                    $produtosIndisponiveis[] = ['produto'=>$produto,'faltam'=>$faltam];
                }
            }
        }

        return $produtosIndisponiveis;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('estado',null, ['label'=>'Estado da Requisição'])
            ->add('createdAt',null,['label'=>'Data da Requisição'])
        ;
    }


    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        // Somente Somente o Colaborador que criou a requisiçåo
        if (FALSE === $this->isGranted('ROLE_SUPER_ADMIN')) {

            $query->andWhere(
                $query->expr()->eq($query->getRootAlias().'.colaborador', ':colaborador')
            );

            $container = $this->getConfigurationPool()->getContainer();
            $colaboradorModel =  $container->get('colaborador_model');
            $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);

            $query->setParameter('colaborador', $colaboradorLogado);
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


            // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
            $query->andWhere(
                $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
            );

            $query->setParameters([
                'perfl' => $perfilToFilter
            ]);


        }

        return $query;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            //  ->add('id',null,['label'=>'Código'])
            ->add('colaborador.nome',null, ['label'=>'Colaborador'])
            ->add('estado',null, ['label'=>'Estado da Requisição'])
            ->add('createdAt',null,['label'=>'Data da Requisição'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
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
            ->tab('Requisição')
				->with('Requisição de Produto');

//        if(1){
//            $formMapper->add('button_solicitar_orcamento', new ButtonGerarOrcamentoType(),
//                ['label'=>'Solicitar orçamento', 'mapped' => false, 'required'=>false],['type'=>'string']);
//        }

        $formMapper
					->add('os', 'sonata_type_model_autocomplete', [
						'property' => 'id',
						'multiple' => false,
						'label' => 'Selecione a OS',
						'callback' => function ($admin, $property, $value) {
							$value = strtolower($value);
							$datagrid = $admin->getDatagrid();
							$queryBuilder = $datagrid->getQuery();
							$queryBuilder
								->leftJoin("{$queryBuilder->getRootAlias()}.cliente","c")
								->orWhere("LOWER(c.nome) LIKE :nome")
								->orWhere("LOWER(c.razaoSocial) LIKE :razaoSocial")
								->orWhere("LOWER(c.cpfCnpj) LIKE :cpfCnpj")
								->orWhere("")
								// Somente OS Aberta
								->andWhere("{$queryBuilder->getRootAlias()}.isEncerrada=:is_encerrada")
								->setParameters([
									//"id"=>$value,
									"nome"=>"%$value%",
									"razaoSocial"=>"%$value%",
									"cpfCnpj"=>"%$value%",
									"is_encerrada"=>false
								])
							;
						},
						'to_string_callback' => function($entity, $property) {
							return sprintf('OS:%s <b>%s</b> - CNPJ/CPF: %s', $entity->getId(),
								$entity->getCliente()->getRazaoSocial()
								,$entity->getCliente()->getCpfCnpj());
						}
					] ,['admin_code' => 'app.admin.ordem_servico'])
					->add('estado','choice', ['read_only'=>true,'attr'=>['disabled'=>true],'choices'=>
						[
							'aberto'=>'Aberto',
							'cancelada'=>'Cancelada',
							'orcando'=>'Orçando',
						]])
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
            ->with('Dados da Requisição')
                ->add('id',null, ['label'=>'Código'])
                ->add('colaborador.nome', null, ['label'=>'Colaborador'])
                ->add('estado','choice',
                    array(
                        'label'=>'Estado',
                        'choices' => array(
                            'aberto'=>'Aberto',
                            'cancelada'=>'Cancelada',
                            'orcando'=>'Orçando',
                    )
                ))
                ->add('createdAt', null, ['label'=>'Requisitada em'])
            ->end()
            ->with('Produtos Requisitados')
                ->add('produtos','sonata_type_list', [
                    'label'=>false,
                    'template'=>'AppBundle:Almoxarifado:produtos-list.html.twig'
                ])
            ->end()
        ;
    }
}
