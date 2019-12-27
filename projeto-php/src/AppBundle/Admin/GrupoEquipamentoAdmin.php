<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GrupoEquipamentoAdmin extends Admin
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

        //Se este grupo estiver sendo usado pelo equipamento.
        if ($object->getHabilitado() == true) {//Valida se esta ao gravar como Inativo esta sendo usado

            $equipamentos = $em->getRepository('AppBundle:EquipamentoCliente')->findAll();

            foreach ($equipamentos as $equipamento) {
                if ($equipamento->getGrupoEquipamento()->getId() == $object->getId()) {
                    $errorElement->addViolation('Atenção, não pode ser inativado enquanto existir equipamento relacionado!')->end();
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
        $grupos = $em->getRepository('AppBundle:GrupoEquipamento')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $gruposToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach($grupos as $grupo) {
            if($grupo->getNomePerfil() == $perfilToFilter) {
                $gruposToFilter[$grupo->getTitulo()] = $grupo->getTitulo();
            }
        }

        $datagridMapper
//            ->add('id',null,['label'=>'Código'])
            ->add('titulo','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $gruposToFilter))
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
            $query->expr()->in($query->getRootAlias() . '.nomePerfil', ':perfl')
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
//            ->add('id',null,['label'=>'Código'])
            ->add('titulo',null,['label'=>'Nome'])
            ->add('habilitado', 'choice', [
                'label' => 'Inativo',
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
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titulo',null,['label'=>'Nome'])
            ->add('habilitado','checkbox',['label'=>'Inativado','required'=>false])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Tipo',array('class' => 'col-md-6'))
    //            ->add('id',null,['label'=>'Código'])
                ->add('titulo',null,['label'=>'Nome'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
    //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}
