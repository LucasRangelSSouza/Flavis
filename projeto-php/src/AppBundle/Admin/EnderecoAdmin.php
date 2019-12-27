<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Cliente;
use AppBundle\Entity\Colaborador;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Form\MapType;

class EnderecoAdmin extends Admin
{

    public function prePersist($object)
    {

        if($object['tipo']=='cliente'){

            $object['objeto']->getData()->setCliente($object['cliente']);

//            if($object['latitude']!='' &&
//                $object['longitude']!='' &&
//                $object['zoom']!=''
//            ){

                $object['objeto']->getData()->setLatitude($object['latitude']);
                $object['objeto']->getData()->setLongitude($object['longitude']);
                $object['objeto']->getData()->setZoomMapa($object['zoom']);

//            }

        }else if($object['tipo']=='colaborador'){

            $object['objeto']->getData()->setColaborador($object['colaborador']);

        }
        return $object['objeto'];
    }

    public function preUpdate($object)
    {

        if($object['tipo']=='cliente'){

            $object['objeto']->getData()->setCliente($object['cliente']);

//            if($object['latitude']!='' &&
//                $object['longitude']!='' &&
//                $object['zoom']!=''
//            ){

                $object['objeto']->getData()->setLatitude($object['latitude']);
                $object['objeto']->getData()->setLongitude($object['longitude']);
                $object['objeto']->getData()->setZoomMapa($object['zoom']);

//            }

        }else if($object['tipo']=='colaborador'){

            $object['objeto']->getData()->setColaborador($object['colaborador']);

        }

        return $object['objeto'];
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('logradouro')
            ->add('numero')
            ->add('cep')
            ->add('complemento')
            ->add('referencia')
            ->add('observacao')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null,['label'=>'Código'])
            ->add('logradouro')
            ->add('numero')
            ->add('cep')
            ->add('complemento')
            ->add('referencia')
            ->add('observacao')
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
            ->add('tipo', 'entity', [
                    'label' => 'Tipo de Endereço',
                    'class' => 'AppBundle:TipoEndereco',
                    'placeholder' => 'Selecione um tipo de endereço',
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
           // ->add('tipo', 'sonata_type_model', ['btn_add' => ' ')
            ->add('cep', null, ['label'=>'CEP','attr'=>['class'=>'input_cep']])
            ->add('bairro', 'sonata_type_model', ['btn_add' => false])
            ->add('logradouro', null, ['label'=>'Logradouro','attr'=>['class'=>'input_logradouro']])
            ->add('numero', null, ['label' => 'Nº'])
            ->add('complemento')
            ->add('referencia', null, ['label' => 'Referência'])
            ->add('observacao')
           // ->add('mapa',new MapType(), array('label'=>false, 'mapped'=>false),array('type' => 'string'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('logradouro')
            ->add('numero')
            ->add('cep')
            ->add('complemento')
            ->add('referencia')
            ->add('observacao')
        ;
    }
}
