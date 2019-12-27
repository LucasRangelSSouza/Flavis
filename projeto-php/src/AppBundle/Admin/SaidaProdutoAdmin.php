<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SaidaProdutoAdmin extends Admin
{
    public function prePersist($object)
    {
        $object->setTipoSolicitante('colaborador');
        return $object;
    }

    public function preUpdate($object)
    {
        $object->setTipoSolicitante('colaborador');
        return $object;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->with('Dados da Filial',array('class' => 'col-md-6'))
                ->add('quantidade')
                ->add('observacoes', null, ['label'=>'Observações'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('colaborador.nome',null, ['label'=>'Colaborador'])
            ->add('quantidade')
            ->add('observacoes', null, ['label'=>'Observações'])
            ->add('createdAt', null, ['label'=>'Data de Entrada'])
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
            ->add('os', null, ['label'=>'Ordem de Serviço', 'help'=>'(* Este campo deverá ser um registro do módulo de OS, quando este estiver pronto)'])
            ->add('colaborador', 'sonata_type_model_autocomplete', [
                'property' => 'id',
                'multiple' => false,
                'label' => 'Selecione um colaborador',
                'callback' => function ($admin, $property, $value) {
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $queryBuilder = $datagrid->getQuery();
                        $queryBuilder
                            ->andWhere("LOWER({$queryBuilder->getRootAlias()}.nome) LIKE :nome OR {$queryBuilder->getRootAlias()}.cpf = :cpf")
                            ->setParameters(["nome"=>"%{$value}%",'cpf'=>$value])
                        ;
                    },
            ])
            ->add('produtos', 'sonata_type_collection', [
                'cascade_validation' => true, 'label' => 'Produtos'], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
                'admin_code' => 'app.admin.produto_saida'
            ])
            ->add('observacoes', null, ['label'=>'Observações'])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('quantidade')
            ->add('observacoes', null, ['label'=>'Observações'])
            ->add('createdAt', null, ['label'=>'Data de Entrada'])
        ;
    }
}