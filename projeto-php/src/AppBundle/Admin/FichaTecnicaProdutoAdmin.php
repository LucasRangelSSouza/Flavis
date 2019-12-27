<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FichaTecnicaProdutoAdmin extends Admin
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

    public function postUpdate($produto)
    {
        $this->uploadFile($produto);
    }

    public function postPersist($produto)
    {
        $this->uploadFile($produto);
    }

    private function uploadFile($produto)
    {
        $foto = $this->getForm()->get('pathFoto')->getData();

        if(isset($foto) && $foto!=''){

            try{

                $container = $this->getConfigurationPool()->getContainer();
                $uploadableManager = $container->get('stof_doctrine_extensions.uploadable.manager');
                $uploadableManager->markEntityToUpload($produto, $foto);

                $em = $container->get('doctrine.orm.default_entity_manager');
                $em->flush();

                @unlink($produto->getOldPathFoto());

            } catch (InvalidFormException $exception) {
                return $exception->getForm();
            }

        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('titulo',null, ['label'=>'Título'])
            ->add('observacao',null, ['label'=>'Observação'])
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
          //  ->add('id',null,['label'=>'Código'])
            ->add('titulo',null, ['label'=>'Título'])
            ->add('observacao',null, ['label'=>'Observação'])
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

        $colaborador = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Foto do Rótulo com a Ficha Técnica';

        if($colaborador->getPathFoto()!=''){
            $fileFieldOptions['help'] = '<img src="/'.$colaborador->getPathFoto().'" class="admin-preview img-thumbnail"/>';
        }

        $formMapper
            ->add('titulo',null, ['label'=>'Título'])
            ->add('fabricante', 'entity', [
                    'label' => 'Selecione um Fornecedor*',
                    'class' => 'AppBundle:Fornecedor',
                    'empty_data'  => '0',
                    'placeholder' => 'Selecione',
                    'multiple'=>false,
                    'required' => false,
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
//            ->add('fabricante','sonata_type_model',[
//                'property' => 'razaoSocial',
//                'label'=>'Fabricante',
//                'placeholder'=>'Selecione um Fabricante'
//            ])
            ->add('observacao',null, ['label'=>'Observação'])
            ->add('pathFoto', 'file',$fileFieldOptions)
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados da Ficha Técnica')
                ->add('titulo',null, ['label'=>'Título'])
                ->add('observacao',null, ['label'=>'Observação'])
                ->add('fabricante',null, ['label'=>'Fabricante'])
                ->add('pathFoto',null, ['label'=>'Foto do Rótulo com a Ficha Técnica','template'=>'AppBundle:Custom:image-list.html.twig'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}