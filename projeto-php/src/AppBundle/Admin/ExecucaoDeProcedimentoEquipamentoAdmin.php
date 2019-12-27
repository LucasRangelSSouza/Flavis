<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ExecucaoDeProcedimentoEquipamentoAdmin extends Admin
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

        $collection->add('listprocedimentos', 'listprocedimentos');
    }


//    public function createQuery($context = 'list')
//    {
//        $query = parent::createQuery($context);
//
//        $query->setMaxResults(1);
//
//        return $query;
//    }

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
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $clientes = $em->getRepository('AppBundle:Cliente')->findAll();
        $clientesToFilter = array();

        foreach($clientes as $cliente){
            $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
        }

        $datagridMapper
            ->add('clienteEquipamento.cliente.nome','doctrine_orm_string',
                array('label'=>'Lista de Clientes'), 'choice',
                array('choices' => $clientesToFilter))

            // Previsão de execução
            ->add('with_execucao_em', 'doctrine_orm_callback', array(
                'label'=>'Execução a partir de ',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                        if (!$value['value']) { return; }

                        $queryBuilder->andWhere($alias . '.dataAgendadaExecucao >= :executar_em');
                        $queryBuilder->setParameter('executar_em',$value['value']);

                        return true;
                    },
                'field_type' => 'sonata_type_date_picker'
            ))
            ->add('with_execucao_antes_de', 'doctrine_orm_callback', array(
                'label'=>'Execução antes de',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                        if (!$value['value']) { return; }

                        $queryBuilder->andWhere($alias . '.dataAgendadaExecucao <= :executar_antes');
                        $queryBuilder->setParameter('executar_antes',$value['value']);

                        return true;
                    },
                'field_type' => 'sonata_type_date_picker'
            ))// Previsão de execução
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('observacao')
            ->add('createdAt')
            ->add('updatedAt')
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
        $formMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('observacao')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('observacao')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
