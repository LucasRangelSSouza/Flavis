<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class HomologacaoOsAdmin extends Admin
{

    /* Confgurações Básicas */

    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $datagridValues = array(

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'createdAt',
    );

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
        unset($actions['create']);

        return $actions;
    }

    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->remove('delete');
        $collection->remove('create');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $clientes = $em->getRepository('AppBundle:Cliente')->findAll();

        $clientesToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach($clientes as $cliente) {
            if($cliente->getNomePerfil() == $perfilToFilter) {
                $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
            }
        }

        $datagridMapper
            ->add('criada_de', 'doctrine_orm_callback', array(
                'label'=>'Da data',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) { return; }

                    // De data até uma data maior ou igual
                    $queryBuilder->andWhere($alias . '.createdAt >= :gerada_antes_de');

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data.' 00:00:00');


                    $queryBuilder->setParameter('gerada_antes_de',$dataParam);

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'
            ))

            ->add('ate_data', 'doctrine_orm_callback', array(
                'label'=>'Até a data',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) { return; }

                    // Inferior a data passada ou igual
                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data.' 23:59:59');

                    $queryBuilder->andWhere($alias . '.createdAt <= :gerada_ate');
                    $queryBuilder->setParameter('gerada_ate',$dataParam);

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'
            ))
//            ->add('os.cliente','doctrine_orm_callback',[
//                'label'=>'Cliente',
//                'callback'   => array($this, 'filterClienteOs'),
//                'field_type' => 'text',
//            ])
            ->add('os.cliente.nome','doctrine_orm_string', array('label'=>'Cliente'), 'choice',
                array('choices' => $clientesToFilter))
            ->add('codigoErp', null, ['label'=>'Código Financeiro'])
            ->add('os.id', null, ['label'=>'Código OS'])
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
            ->add('os.id', null, ['label'=>'Código OS'])
            ->add('os.cliente.nome', null, ['label'=>'Cliente'])
            ->add('createdAt', null, ['label'=>'Data'])
            ->add('valor', null, ['label'=>'Valor'])
            ->add('parcelas', null, ['label'=>'Qtd. Parcelas'])
           // ->add('codigoErp',null, ['label'=>'Código Financeiro'])
            ->add('isPago', 'boolean', ['label'=>'Pago'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    public function filterClienteOs($queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $value = mb_strtolower($value['value']);

        $queryBuilder
            ->join("$alias.os","os")
            ->join("os.cliente","cli")
            ->andWhere("UNACCENT(LOWER(cli.razaoSocial)) LIKE UNACCENT(:nome)" )
            ->setParameter('nome', "%$value%");

        return true;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('codigoErp',null, ['label'=>'Código Financeiro', 'help'=>'Um identificador do sistema financeiro'])
            ->add('isPago','checkbox',['label'=>'Marque se estiver paga','required'=>false])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('os.id', null, ['label'=>'Código OS'])
            ->add('os.cliente.nome', null, ['label'=>'Cliente'])
            ->add('os.cliente.razaoSocial', null, ['label'=>'Cliente'])
            ->add('os.cliente.cpfCnpj', null, ['label'=>'CNPJ'])
            ->add('valor', null, ['label'=>'Valor'])
            ->add('parcelas', null, ['label'=>'Parcelas'])
            ->add('observacoes',null,['label'=>'Observações'])
            ->add('codigoErp',null, ['label'=>'Código Financeiro'])
            ->add('isPago', 'boolean', ['label'=>'Pago'])
            ->add('createdAt',null, ['label'=>'Data da primeira Homologação'])
            ->add('updatedAt',null, ['label'=>'Data da última alteração'])
        ;
    }
}
