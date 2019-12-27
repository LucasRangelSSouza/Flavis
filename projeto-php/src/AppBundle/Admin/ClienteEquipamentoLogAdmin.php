<?php

namespace AppBundle\Admin;

//use AppBundle\Form\ProcedimentosClienteEquipamentoType;
use Sonata\AdminBundle\Admin\Admin;
//use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
//use Sonata\AdminBundle\Form\FormMapper;
//use Sonata\AdminBundle\Show\ShowMapper;
//use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class ClienteEquipamentoLogAdmin extends Admin
{

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
    }


    public function postPersist($object)
    {
        $this->geraAgendaDeManutencoes($object);
    }

    public function postUpdate($object)
    {
        $this->geraAgendaDeManutencoes($object);
    }

    public function prePersist($object)
    {
        $this->updateEquipamento($object);
        $this->updateProcedimentos($object);
    }

    public function preUpdate($object)
    {
        $this->updateEquipamento($object);
        $this->updateProcedimentos($object);
    }

    private function updateProcedimentos($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine')->getEntityManager();

        $procedimentos = $this->getRequest()->request->get('procedimentos');

        $object->clearProcedimentos();

        foreach($procedimentos as $procedimento){

            $procedimentoEntity = $em
                ->getRepository('AppBundle:AgendamentoManutencaoEquipamento')
                ->find($procedimento);

            $object->addProcedimentosPreventivo($procedimentoEntity);

        }
    }

    private function updateEquipamento($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine')->getEntityManager();

        $idEquipamento = $this->getRequest()->request->get('equipamento_cliente');

        $equipamento = $em
            ->getRepository('AppBundle:EquipamentoCliente')
            ->find($idEquipamento);

        $object->setEquipamento($equipamento);
    }

    private function geraAgendaDeManutencoes($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $pmocModel = $container->get('pmoc_model');

        if($object->getIsPmoc()==true){
            $pmocModel->geraAgendamentoExecucoesPmoc($object,$container);
        }else{
            // Excluir todos os agendamentos daqui para frente
//            $pmocModel->cancelaPmocEquipamentoCliente($object,$container);
            $pmocModel->removeAllAgendamentosSemOS($object);
        }
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array(
                'AppBundle:Custom:custom_one_to_many.html.twig',
                'AppBundle:Custom:custom_one_one_to_many.html.twig'
            )
        );
    }

//    /**
//     * @param DatagridMapper $datagridMapper
//     */
//    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//    {
//
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
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('dataLog',null,['label'=>'Alteração'])
            ->add('id',null,['label'=>'Código'])
            ->add('cliente.nome',null,['label'=>'Cliente'])
            ->add('equipamento.marca.titulo',null,['label'=>'Marca'])
            ->add('equipamento.modelo.titulo',null,['label'=>'Modelo'])
            ->add('isPmoc', 'choice', [
                'label' => 'PMOC',
                'choices' => [true=>'Sim',false=>'Não'],
                'required' => false,
                'empty_value' => 'Selecione'
            ])
            ->add('prioridade',null,['label'=>'Prioridade'])
        ;
    }

//    /**
//     * @param FormMapper $formMapper
//     */
//    protected function configureFormFields(FormMapper $formMapper)
//    {
//
//    }

//    /**
//     * @param ShowMapper $showMapper
//     */
//    protected function configureShowFields(ShowMapper $showMapper)//, ListMapper $listMapper)
//    {
//
//    }
}