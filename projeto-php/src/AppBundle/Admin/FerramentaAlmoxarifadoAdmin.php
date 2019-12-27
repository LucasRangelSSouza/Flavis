<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class FerramentaAlmoxarifadoAdmin extends Admin
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


        if($object->getTitulo() == ''){
            $errorElement->with('titulo')->addViolation('Atenção, preencha o campo')->end();
        }
        if($object->getQuantidade() == ''){
            $errorElement->with('quantidade')->addViolation('Atenção, preencha o campo')->end();
        }
    }


    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    public function preUpdate($object)
    {
        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->preUpdate($documento);
        }
    }

    public function prePersist($object)
    {
        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->prePersist($documento);
        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('status',null,['label'=>'Publicado'])
            ->add('titulo', null, ['label'=>'Título'])
            ->add('quantidade', null, ['label'=>'Quantidade'])
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
           // ->add('id',null,['label'=>'Código'])
            ->add('titulo', null, ['label'=>'Título'])
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
            ->tab('Ferramenta')
                ->with('Ferramenta', array('class' => 'col-md-6'))->end()
            ->end()

            ->tab('Documento')
                ->with('Documentos', array('class' => 'col-md-6'))->end()
            ->end()
        ;

        $formMapper
            ->tab('Ferramenta')
                ->with('Ferramenta',array('class' => 'col-md-12'))
                    ->add('status','checkbox',['label'=>'Publicado','required'=>false])
                    ->add('titulo', null, ['label'=>'Título*','required'=>false])
                    ->add('quantidade', null, ['label'=>'Quantidade*','required'=>false])
                ->end()
            ->end()

            ->tab('Documento')
                ->with('Documentos',array('class' => 'col-md-12'))
                    ->add('documentos', 'sonata_type_collection',
                        [
                            'label' => false,
                            'cascade_validation' => true,
                            'type_options' => array(
                                'delete' => false,
                            )
                        ],
                        [
                            'edit' => 'inline',
                            'inline' => 'table',
                            'sortable' => 'position',
                            'admin_code' => 'app.admin.documento'
                        ]
                    )
                ->end()
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados da Ferramenta')
//                ->add('id',null,['label'=>'Código'])
                ->add('status',null,['label'=>'Publicado'])
                ->add('titulo', null, ['label'=>'Título'])
                ->add('quantidade', null, ['label'=>'Quantidade'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}