<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TipoDocumentoAdmin extends Admin
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

        $tiposDocumentos = $em->getRepository('AppBundle:TipoDocumento')->findAll();

        if ($this->getSubject()->getId() == null) {

            foreach ($tiposDocumentos as $tipoDocumento) {

                if ($tipoDocumento->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                    if ($tipoDocumento->getTitulo() == $object->getTitulo()) {
                        $errorElement->with('titulo')->addViolation('Atenção, já existe um tipo de telefone cadastrado com este nome')->end();
                    }
                }

            }

        } else {

            foreach ($tiposDocumentos as $tipoDocumento) {

                if ($tipoDocumento->getId() !== $object->getId()) {
                    if ($tipoDocumento->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                        if ($tipoDocumento->getTitulo() == $object->getTitulo()) {
                            $errorElement->with('titulo')->addViolation('Atenção, já existe um tipo de telefone cadastrado com este nome')->end();
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
        $documentos = $em->getRepository('AppBundle:TipoDocumento')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $documentosToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach($documentos as $documento) {
            if($documento->getNomePerfil() == $perfilToFilter) {
                $documentosToFilter[$documento->getTitulo()] = $documento->getTitulo();
            }
        }

        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('titulo','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $documentosToFilter))
            ->add('observacoes', null, ['label'=>'Obsercações'])
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado){
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }
//        $perfilLogado = $this->perfilLogado();//Não precisa
//        echo 'Rastreabilidade! Perfil em tipo de documento: '.$perfilLogado.'                             ';

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
            ->add('titulo', null, ['label'=>'Nome'])
            ->add('observacoes', null, ['label'=>'Obsercações'])
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
            ->add('titulo', null, ['label'=>'Nome'])
            ->add('observacoes', null, ['label'=>'Obsercações'])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Tipo de Documento')
                ->add('titulo', null, ['label'=>'Nome'])
                ->add('observacoes', null, ['label'=>'Obsercações'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
            ->add('createdAt',null, ['label'=>'Data de Cadastro'])
            ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}