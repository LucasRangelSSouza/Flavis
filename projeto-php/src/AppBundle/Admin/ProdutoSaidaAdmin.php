<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProdutoSaidaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('quantidade',null, ['label'=>'Quantidade'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('quantidade',null, ['label'=>'Quantidade'])
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
            ->add('produto', 'entity', [
                    'label' => 'Selecione um Produto',
                    'class' => 'AppBundle:ProdutoAlmoxarifado',
                    'empty_data'  => '0',
                    'placeholder' => 'Selecione',
                    'required' => true,
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                        $container = $this->getConfigurationPool()->getContainer();
                        $em = $container->get('doctrine.orm.default_entity_manager');
                        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                        $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                        foreach($colaboradores as $colaborador) {
                            if($colaborador->getUser() == $colaboradorLogado2) {
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
//            ->add('produto', 'sonata_type_model_autocomplete', [
//                'property' => 'tituloAmplo',
//                'label' => 'Selecione um Produto',
//                'callback' => function ($admin, $property, $value) {
//                        $value = strtolower($value);
//                        $datagrid = $admin->getDatagrid();
//                        $queryBuilder = $datagrid->getQuery();
//                        $queryBuilder
//                            ->leftJoin("{$queryBuilder->getRootAlias()}.fornecedor","f")
//                            ->orWhere("LOWER(CONCAT({$queryBuilder->getRootAlias()}.titulo,{$queryBuilder->getRootAlias()}.codigoFabricante)) LIKE :titulo")
//                            ->orWhere("LOWER(f.razaoSocial) LIKE :razaoSocial")
//                            ->setParameters(['titulo'=>"%$value%",'razaoSocial'=>"%$value%"])
//                        ;
//                        $datagrid->setValue($property, null, "%$value%");
//                    },
//                'to_string_callback' => function($entity, $property) {
//                        return sprintf('<b>%s</b> - Cód. Fabricante: %s', $entity->getTitulo(),$entity->getCodigoFabricante());
//                    }
//            ])
//            ->add('produto','sonata_type_model',[
//                'label'=>'Produto',
//                'property' => 'tituloAmplo',
//                'placeholder'=>'Selecione um produto',
//                'multiple'=>true,
//                'help' => '* Selecione um produto por nome ou codigo do fabricante'
//            ])
            ->add('quantidade',null, ['label'=>'Quantidade']);

                if($this->hasParentFieldDescription()) {

                    $adminClass = $this->getParentFieldDescription()->getAdmin()->getSubject();
                    if($adminClass){

                        $container = $this->getConfigurationPool()->getContainer();
                        $em = $container->get('doctrine')->getEntityManager();
                        $className = $em->getClassMetadata(get_class($adminClass))->getName();

                        if($className=='AppBundle\Entity\EntradaProduto'){
                            $formMapper->add('valor', null, ['label'=>'Valor unitário','required'=>true]);
                        }
                    }

                }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('quantidade',null, ['label'=>'Quantidade'])
        ;
    }
}
