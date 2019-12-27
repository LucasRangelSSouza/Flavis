<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ProdutoEstoqueAdmin extends Admin
{

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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('produto.titulo')
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
            ->add('produto.titulo',null,['label'=>'Título do Produto'])
            ->add('produto.codigoFabricante',null,['label'=>'Código do Fabricante'])
            ->add('quantidade')
//            ->add('_action', 'actions', array(
//                'actions' => array(
//                    'show' => array(),
//                    'edit' => array(),
//                    'delete' => array(),
//                )
//            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id',null,['label'=>'Código'])
            ->add('quantidade')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('deletedAt')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Estoque',array('class' => 'col-md-6'))
                ->add('id',null,['label'=>'Código'])
                ->add('quantidade')
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}