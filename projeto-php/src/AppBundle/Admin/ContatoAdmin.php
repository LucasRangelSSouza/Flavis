<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ContatoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('sobrenome')
            ->add('empresa')
            ->add('email')
            ->add('nome','doctrine_orm_callback',array(
                'label'=>'Nome',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                        if (!$value['value']) {
                            return;
                        }

                        $value = strtolower($value['value']);
                        $queryBuilder
                            ->andWhere("LOWER($alias.nome) LIKE :nome")
                            ->setParameter('nome', "%$value%");
                        return true;
                    },
                'field_type' => 'text'
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null,['label'=>'Código'])
            ->add('nome')
            ->add('sobrenome')
            ->add('empresa')
            ->add('email')
            ->add('telefones')
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
            ->add('nome')
            ->add('sobrenome')
            ->add('empresa')
            ->add('email')
            ->add('telefones', 'sonata_type_collection', ['cascade_validation' => true], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nome')
            ->add('sobrenome')
            ->add('empresa')
            ->add('email')
            ->add('telefones')
        ;
    }

    public function getName()
    {
        return 'app.admin.contato';
    }
}
