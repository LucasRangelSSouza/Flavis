<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Fornecedor;
use AppBundle\Entity\ProdutoAlmoxarifado;
use AppBundle\Entity\ProdutoSaida;
use AppBundle\Form\FileXmlNotaType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class EntradaProdutoAdmin extends Admin
{
    protected $baseRouteName = 'entradaproduto';

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel =  $container->get('colaborador_model');

        $produtosNota = $this->getRequest()->request->get('produtoNota');
        $contentNota = $this->getRequest()->request->get('contentNota');
        $idNota = $this->getRequest()->request->get('idNota');

        $fornecedor_razao_social = $this->getRequest()->request->get('fornecedor_razao_social');
        $fornecedor_cnpj = $this->getRequest()->request->get('fornecedor_cnpj');

        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }


        // Verifica se este fornecedor existe. Caso não exista ele deve ser criado no sistema
        $fornecedor = $this->getOrCreateFornecedor($fornecedor_cnpj,$fornecedor_razao_social, $perfilToFilter);

        if(!$fornecedor){
            exit('Erro em criar o fornecedor');
        }

        $object->setFornecedor($fornecedor);


        if(count($produtosNota)){

            $em = $this->modelManager->getEntityManager('AppBundle:ProdutoSaida');

            $almoxatidadoModel =  $this->getConfigurationPool()->getContainer()->get('almoxarifado_model');

            foreach($produtosNota as $produto){

                // Verifica se existe este produto no catálogo
                $produtoEntity = $this->getOrCreateProduto($produto['codigo']);

                if($produtoEntity){

                    $quantidade = explode('.',$produto['qtd']);

                    // Adiciona ele no relacionamento desta entrada
                    $produtoSaida = new ProdutoSaida();
                    $produtoSaida->setProduto($produtoEntity);

                    $produtoSaida->setQuantidade($quantidade[0]);

                    $produtoSaida->setValor($produto['valor']);

                    $em->persist($produtoSaida);
                    $em->flush();

                    $object->addProduto($produtoSaida);

                    // Adiciona este produto no estoque
                    $almoxatidadoModel->criaOuIncrementaProdutoNoEstoque($produtoSaida->getProduto(),$quantidade[0], $perfilToFilter);
                }
            }
        }

        // Setar qual usuário está dando entrada nos produtos
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);
        $object->setColaborador($colaboradorLogado);

        $object->setNotaXmlContent($contentNota);
        $object->setIdNota($idNota);
        return $object;

    }

    private function getOrCreateFornecedor($cnpj,$razao_social, $nomePerfil)
    {
        $em = $this->modelManager->getEntityManager('AppBundle:Fornecedor');

        $query = $em->createQuery("
            SELECT f FROM AppBundle:Fornecedor f
            WHERE f.cnpj='$cnpj'");

        $fornecedor = $query->getResult();

        if(count($fornecedor)){

            return $fornecedor[0];

        }else{

            $fornecedor = new Fornecedor();
            $fornecedor->setCnpj($cnpj);
            $fornecedor->setRazaoSocial($razao_social);
            $fornecedor->setNomePerfil($nomePerfil);
            $em->persist($fornecedor);
            $em->flush();

            return $fornecedor;

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


        $produtosNota = $this->getRequest()->request->get('produtoNota');

        $idNota = $this->getRequest()->request->get('idNota');

        if($this->thisNotaExist($idNota)){
            $errorElement->addViolation('Esta nota já foi cadastrada.');
        }

        if(!count($produtosNota)){
            $errorElement->addViolation('Não é possível criar um entrada sem itens na nota.');
        }

        $produtosNota = $this->getRequest()->request->get('produtoNota');
        if(count($produtosNota)){
            foreach($produtosNota as $produto){

                // Verifica se tem algum produto que não tem no catálogo
                if(!$this->getOrCreateProduto($produto['codigo'])){
                    $errorElement->addViolation('O produto código '.$produto['codigo'].' não consta no catálogo de produtos no sistema.');
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
            ->add('filexmlnota',new FileXmlNotaType(), array('label'=>false, 'mapped'=>false),array('type' => 'string'))
            ->add('observacoes', null, ['label'=>'Observações'])
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
//            ->with('Dados do Cadastro')
//                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
//                ->add('updatedAt',null, ['label'=>'Última alteração'])
//            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
//            ->end()
        ;
    }
}