<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SolicitacaoProdutoAdmin extends Admin
{
    public function prePersist($object)
    {
        $object->setStatus('pendente');
        $this->setColaboradorUtil($object);
        return $object;
    }

    public function preUpdate($object)
    {
        $object->setStatus('pendente');
        $this->setColaboradorUtil($object);
        return $object;
    }

   private function setColaboradorUtil($object)
   {
       $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

       $colaboradorModel = $this->getConfigurationPool()->getContainer()->get('colaborador_model');

       if(!$colaboradorModel->getColaboradorLogado($em,$this->getConfigurationPool()->getContainer())){
           exit('Colaborador não encontrado');
       }
       $object->setColaborador($colaboradorModel->getColaboradorLogado($em,$this->getConfigurationPool()->getContainer()));

       return $object;
   }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('observacoes')
            ->add('status')
            ->add('dataPrevisaoEntrega')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('status')
            ->add('dataPrevisaoEntrega')
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
        // Data padrão
        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
        );

        $formMapper
            ->add('status','choice', ['choices'=>
                [
                    'solicitado'=>'Solicitado',
                    'recusado'=>'Recusado',
                    'orcando'=>'Orçando',
                    'orcamento_cancelado'=>'Orçamento Cancelado',
                    'orcamento_aprovado'=>'Orçamento Aprovado'
                ]])
            ->add('produtos', 'sonata_type_collection', ['cascade_validation' => true, 'label' => 'Produtos'], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
                'admin_code' => 'app.admin.produto_solicitacao'
            ])
            ->add('dataPrevisaoEntrega', 'sonata_type_date_picker', $dateFieldConfig + [
                    'label' => 'Data prevista para entrega',
                    'required' => true,
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
            ->with('Dados da Solicitação',array('class' => 'col-md-6'))
                ->add('id',null,['label'=>'Código'])
                ->add('observacoes')
                ->add('status')
                ->add('dataPrevisaoEntrega')
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}
