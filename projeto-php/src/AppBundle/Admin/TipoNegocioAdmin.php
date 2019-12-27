<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TipoNegocioAdmin extends Admin
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

        $tiposNegocios = $em->getRepository('AppBundle:TipoNegocio')->findAll();

        if ($this->getSubject()->getId() == null) {

            foreach ($tiposNegocios as $tiposNegocio) {

                if ($tiposNegocio->getPerfilTipoNegocio() == $colaboradorLogado->getNomePerfil()) {
                    if ($tiposNegocio->getNome() == $object->getNome()) {
                        $errorElement->with('nome')->addViolation('Atenção, já existe um tipo de negócio cadastrado com este nome')->end();
                    }
                }

            }

        } else {

            foreach ($tiposNegocios as $tiposNegocio) {

                if ($tiposNegocio->getId() !== $object->getId()) {
                    if ($tiposNegocio->getPerfilTipoNegocio() == $colaboradorLogado->getNomePerfil()) {

                        if ($tiposNegocio->getNome() == $object->getNome()) {
                            $errorElement->with('nome')->addViolation('Atenção, já existe um tipo de negócio cadastrado com este nome')->end();
                        }

                    }

                }

            }
        }

        $object->setPerfilTipoNegocio($perfilToFilter);

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
        $negocios = $em->getRepository('AppBundle:TipoNegocio')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $negociosToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach($negocios as $negocio) {
            if($negocio->getPerfilTipoNegocio() == $perfilToFilter) {
                $negociosToFilter[$negocio->getNome()] = $negocio->getNome();
            }
        }

        $datagridMapper
//            ->add('id',null,['label'=>'Código'])
            ->add('nome','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $negociosToFilter))
            ->add('descricao')
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
            $query->expr()->in($query->getRootAlias(). '.perfilTipoNegocio', ':perfl')
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
            //->add('id',null,['label'=>'Código'])
            ->add('nome', null, ['label'=>'Nome'])
            ->add('descricao', null, ['label'=>'Descrição'])
//            ->add('perfilTipoNegocio', null, ['label'=>'Perfil'])
//            ->add('perfilTipoNegocio', 'doctrine_orm_string', array('label'=>'PerfilFiltrado'), 'choice',
//                array('choices' => $perfilToFilter))
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
            ->add('nome', null, ['label'=>'Nome'])
            ->add('descricao', null, ['label'=>'Descrição'])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Tipo de Negócio')
                ->add('nome', null, ['label'=>'Nome'])
                ->add('descricao', null, ['label'=>'Descrição'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}