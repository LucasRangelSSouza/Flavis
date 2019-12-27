<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class ResponsavelClienteAdmin extends Admin
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


        if($object->getCliente() == ''){
            $errorElement->with('cliente')->addViolation('Atenção, selecione um Cliente')->end();
        }
        if($object->getNome() == ''){
            $errorElement->with('nome')->addViolation('Atenção, preencha o campo nome')->end();
        }
        if($object->getEmail() == ''){
            $errorElement->with('email')->addViolation('Atenção, preencha o campo e-mail')->end();
        }
        if($object->getFuncao() == ''){
            $errorElement->with('funcao')->addViolation('Atenção, preencha o campo função')->end();
        }
        if($object->getTelefone() == ''){
            $errorElement->with('telefone')->addViolation('Atenção, selecione um telefone')->end();
        }

    }


    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }


//    public function prePersist($object)
//    {
//        $object['responsavel']->getData()->setCliente($object['cliente']);
//        return $object['responsavel'];
//    }
//
//    public function preUpdate($object)
//    {
//       $object['responsavel']->getData()->setCliente($object['cliente']);
//       return $object['responsavel'];
//    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');

        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $perfilToFilter = array();
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $clientes = $em->getRepository('AppBundle:Cliente')->findAll(array(),array('nome' => 'ASC'));
        $clientesToFilter = array();
        foreach($clientes as $cliente) {
            if($cliente->getNomePerfil() == $perfilToFilter) {
                $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
            }
        }

        $responsaveis = $em->getRepository('AppBundle:ResponsavelCliente')->findAll();
        $responsaveisToFilter = array();
        foreach($responsaveis as $responsavel) {
            if($responsavel->getNomePerfil() == $perfilToFilter) {
                $responsaveisToFilter[$responsavel->getNome()] = $responsavel->getNome();
            }
        }

        $datagridMapper
//            ->add('id')
//            ->add('cliente.nome', null, ['label'=>'Cliente'])
            ->add('cliente.nome','doctrine_orm_string', array('label'=>'Cliente'), 'choice',
                array('choices' => $clientesToFilter))
            ->add('nome','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $responsaveisToFilter))
//            ->add('nome','doctrine_orm_callback',[
//                'label'=>'Nome',
//                'callback'   => array($this, 'filterComString'),
//                'field_type' => 'text',
//            ])
            ->add('email',null, ['label'=>'E-mail'])
            ->add('funcao', null, ['label'=>'Função'])
            ->add('telefone', null, ['label'=>'Telefone'])
        ;
    }

    // Filtro de condomínio por logradouro
    public function filterComString($queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $value = mb_strtolower($value['value']);

        $queryBuilder
            ->andWhere("UNACCENT(LOWER($alias.nome)) LIKE UNACCENT(:nome)" )
            ->setParameter('nome', "%$value%");

        return true;
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
//            ->add('id',null,['label'=>'Código'])
            ->add('cliente.nome', null, ['label'=>'Cliente'])
            ->add('nome', null, ['label'=>'Nome'])
            ->add('email',null, ['label'=>'E-mail'])
            ->add('_action', 'actions',
                array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                )
            )
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->add('id',null,['label'=>'Código'])
//            ->add('cliente', 'sonata_type_model', ['label'=>'Cliente','placeholder'=>'Selecione um Usuário'])
            ->add('cliente', 'entity', [
                    'label' => 'Cliente*',
                    'class' => 'AppBundle:Cliente',
                    'empty_data'  => '0',
                    'placeholder' => 'Selecione um cliente',
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
            ->add('nome', null, ['label'=>'Nome*', 'required' => false])
            ->add('email',null, ['label'=>'E-mail*', 'required' => false])
            ->add('funcao', null, ['label'=>'Função*', 'required' => false])
            ->add('telefone', null, ['label'=>'Telefone*', 'required' => false, 'attr' => ['class' => 'mask_responsavel']])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Responsável do Cliente')
                ->add('cliente.nome', null, ['label'=>'Cliente'])
                ->add('nome', null, ['label'=>'Nome'])
                ->add('email',null, ['label'=>'E-mail'])
                ->add('funcao', null, ['label'=>'Função'])
                ->add('telefone', null, ['label'=>'Telefone'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}