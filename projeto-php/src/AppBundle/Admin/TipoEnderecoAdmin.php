<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TipoEnderecoAdmin extends Admin
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

        $tiposEnderecos = $em->getRepository('AppBundle:TipoEndereco')->findAll();

        if ($this->getSubject()->getId() == null) {

            foreach ($tiposEnderecos as $tipoEndereco) {

                if ($tipoEndereco->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                    if ($tipoEndereco->getNome() == $object->getNome()) {
                        $errorElement->with('nome')->addViolation('Atenção, já existe um tipo de endereço cadastrado com este nome')->end();
                    }
                }

            }

        } else {

            foreach ($tiposEnderecos as $tipoEndereco) {

                if ($tipoEndereco->getId() !== $object->getId()) {
                    if ($tipoEndereco->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                        if ($tipoEndereco->getNome() == $object->getNome()) {
                            $errorElement->with('nome')->addViolation('Atenção, já existe um tipo de endereço cadastrado com este nome')->end();
                        }

                    }

                }

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

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $enderecos = $em->getRepository('AppBundle:TipoEndereco')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $enderecosToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach($enderecos as $endereco) {
            if($endereco->getNomePerfil() == $perfilToFilter) {
                $enderecosToFilter[$endereco->getNome()] = $endereco->getNome();
            }
        }

        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('nome','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $enderecosToFilter))
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
           // ->add('id',null,['label'=>'Código'])
            ->add('nome')
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
            ->add('nome')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
//            ->add('id',null,['label'=>'Código'])
            ->add('nome')
        ;
    }
}
