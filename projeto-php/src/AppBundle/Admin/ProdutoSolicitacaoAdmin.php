<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProdutoSolicitacaoAdmin extends Admin
{

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('valor')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('produto.titulo',null, ['label'=>'Produto'])
            ->add('valor')
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
            ->add('produto', 'sonata_type_model_autocomplete', [
                'property' => 'tituloAmplo',
                'label' => 'Selecione um Produto',
                'callback' => function ($admin, $property, $value) {
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $queryBuilder = $datagrid->getQuery();
                        $queryBuilder
                            ->leftJoin("{$queryBuilder->getRootAlias()}.fornecedor","f")
                            ->orWhere("LOWER(CONCAT({$queryBuilder->getRootAlias()}.titulo,{$queryBuilder->getRootAlias()}.codigoFabricante)) LIKE :titulo")
                            ->orWhere("LOWER(f.razaoSocial) LIKE :razaoSocial")
                            ->setParameters(['titulo'=>"%$value%",'razaoSocial'=>"%$value%"])
                        ;
                        $datagrid->setValue($property, null, "%$value%");
                    },
                'to_string_callback' => function($entity, $property) {
                        return sprintf('<b>%s</b> - Cód. Fabricante: %s', $entity->getTitulo(),$entity->getCodigoFabricante());
                    }
            ])
            ->add('fornecedor','sonata_type_model',[
                'property' => 'razaoSocial',
                'label'=>'Fornecedor',
                'placeholder'=>'Selecione um fornecedor'
            ])
            ->add('valor', null, ['label'=>'Valor unitário'])
            ->add('quantidade')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('valor')
            ->add('observacoes')
        ;
    }
}
