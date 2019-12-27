<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class LocalizacaoAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $localizacoes = $em->getRepository('AppBundle:Localizacao')->findAll();

        foreach ($localizacoes as $localizacao) {

            //Validação na criação e na alteração (null ou <>)
            if (($this->getSubject()->getId() == null) || ($localizacao->getId() !== $object->getId())) {
                if ($localizacao->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                    if (($localizacao->getSigla() == $object->getSigla()) and ($localizacao->getTitulo() == $object->getTitulo())) {
                        $errorElement->with('numero')->addViolation('Atenção, já existe uma localização cadastrada com esta sigla')->end();
                    }

                }

            }

        }

        //Se esta localização estiver sendo usado pelo ambiente.
        if ($object->getHabilitado() == true) {//Valida se esta ao gravar como Inativo esta sendo usado

            $ambientes = $em->getRepository('AppBundle:Ambiente')->findAll();

            foreach ($ambientes as $ambiente) {
                if ($ambiente->getLocalizacao()->getId() == $object->getId()) {
                    $errorElement->addViolation('Atenção, não pode ser inativado enquanto existir ambiente relacionado!')->end();
                    break;
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
        $localizacoes = $em->getRepository('AppBundle:localizacao')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $localizacoesToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach ($localizacoes as $localizacao) {
            if ($localizacao->getNomePerfil() == $perfilToFilter) {
                $localizacoesToFilter[$localizacao->getTitulo()] = $localizacao->getTitulo();
            }
        }

        $datagridMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('sigla')
            ->add('titulo');
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

//        if (FALSE == $this->isGranted('ROLE_SUPER_ADMIN')) {

            $container = $this->getConfigurationPool()->getContainer();
            $em = $container->get('doctrine.orm.default_entity_manager');

            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));

            $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

            $perfilToFilter = array();

            foreach ($colaboradores as $colaborador) {
                if ($colaborador->getUser() == $colaboradorLogado) {
                    $perfilToFilter = $colaborador->getNomePerfil();
                }
            }

            // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
            $query->andWhere(
                $query->expr()->in($query->getRootAlias() . '.nomePerfil', ':perfl')
            );

            $query->setParameters([
                'perfl' => $perfilToFilter
            ]);

//        }

        return $query;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id', null, ['label' => 'Código'])
            ->add('titulo')
            ->add('sigla')
            ->add('habilitado', 'choice', [
                'label' => 'Inativado',
                'choices' => [true=>'Sim',false=>'Não'],
                'required' => false,
                'empty_value' => 'Selecione'
            ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
//                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titulo')
            ->add('sigla')
            ->add('habilitado','checkbox',['label'=>'Inativado','required'=>false])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados da Localização', array('class' => 'col-md-6'))
//                ->add('id', null, ['label' => 'Código'])
                ->add('titulo')
                ->add('sigla')
            ->end()
            ->with('Dados do Cadastro', array('class' => 'col-md-6'))
                ->add('createdAt', null, ['label' => 'Data de Cadastro'])
                ->add('updatedAt', null, ['label' => 'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end();
    }
}