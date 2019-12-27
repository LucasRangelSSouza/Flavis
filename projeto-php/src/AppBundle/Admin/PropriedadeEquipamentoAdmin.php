<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PropriedadeEquipamentoAdmin extends Admin
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

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $propriedades = $em->getRepository('AppBundle:PropriedadeEquipamento')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $propriedadesToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }
//Warning: Ilegal offset type in C:\Apache2.4\htdocs\flavis\projeto-php\src\AppBundle\Admin\PropriedadeEquipamentoAdmin.php on line 64
//        foreach ($propriedades as $propriedade) {
//            if ($propriedade->getNomePerfil() == $perfilToFilter) {
//                $propriedadesToFilter[$propriedade->getTitulo()] = $propriedade->getTitulo();
//            }
//        }


        $datagridMapper
            ->add('id',null,['label'=>'Código'])
//            ->add('titulo',null,['label'=>'Nome'])
            ->add('titulo', 'doctrine_orm_string', array('label' => 'Nome'), 'choice',
                array('choices' => $propriedadesToFilter))
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

//        if (FALSE == $this->isGranted('ROLE_SUPER_ADMIN')) {

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

//        }

        return $query;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null,['label'=>'Código'])
//            ->add('titulo',null,['label'=>'Nome'])
            ->add('valores')
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
//            ->add('isEtiqueta','checkbox',['label'=>'Usar para gerar etiqueta','required'=>false])
            ->add('titulo','sonata_type_model',['label'=>'Nome','required'=>true,'property'=>'titulo'])
            ->add('valores','sonata_type_model',['required'=>false,'multiple'=>true])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados da Propriedade',array('class' => 'col-md-6'))
                ->add('id',null,['label'=>'Código'])
    //            ->add('titulo',null,['label'=>'Nome'])
                ->add('valores')
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}
