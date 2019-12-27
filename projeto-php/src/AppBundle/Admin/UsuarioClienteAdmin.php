<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class UsuarioClienteAdmin extends Admin
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


        if($object->getUser() == ''){
            $errorElement->with('user')->addViolation('Atenção, selecione um usuário')->end();
        }
        if($object->getClientes() == ''){
            $errorElement->with('clientes')->addViolation('Atenção, selecione um Cliente')->end();
        }

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

        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        $perfilToFilter = array();
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $usuarios = $em->getRepository('ApplicationSonataUserBundle:User')->findAll();
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        $usuariosToFilter = array();
        foreach($usuarios as $usuario) {
            if($usuario->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {
                $usuariosToFilter[$usuario->getUsername()] = $usuario->getUsername();
            }
        }

        $clientes = $em->getRepository('AppBundle:Cliente')->findAll(array(),array('nome' => 'ASC'));
        $clientesToFilter = array();
        foreach($clientes as $cliente) {
            if($cliente->getNomePerfil() == $perfilToFilter) {
                $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
            }
        }

        $datagridMapper
//            ->add('id',null,['label'=>'Código'])
            ->add('user','doctrine_orm_string', array('label'=>'Usuário'), 'choice',
                array('choices' => $usuariosToFilter))
            ->add('clientes.nome','doctrine_orm_string', array('label'=>'Cliente'), 'choice',
                array('choices' => $clientesToFilter))
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
         //   ->add('id',null,['label'=>'Código'])
            ->add('user','text',['label'=>'Usuário'])
            ->add('clientes','sonata_type_model',[
                    'label'=>'Clientes',
                    'placeholder'=>'Selecione um Cliente ou mais clientes',
                    'multiple'=>true]
            )
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
        $formMapper
//            ->add('user','sonata_type_model',['label'=>'Usuário','placeholder'=>'Selecione um Usuário'])
            ->add('user', 'entity', [
                    'label' => 'Usuarios*',
                    'class' => 'ApplicationSonataUserBundle:User',
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
            ->add('clientes', 'entity', [
                    'label' => 'Clientes*',
                    'class' => 'AppBundle:Cliente',
                    'multiple'  => true,
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
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Usuário do Cliente')
                ->add('user','text',['label'=>'Usuário'])
                ->add('clientes',null,['label'=>'Clientes'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}