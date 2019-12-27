<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ClienteRepository;
use AppBundle\Model\MapeamentoStringModel;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;

class OrdemCompraProdutoAdmin extends Admin
{
    protected $baseRouteName = 'ordens-de-compra';

    protected $datagridValues = array(

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_order_by_' => 'dataEntrega'

    );

    public function postPersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $osModel = $container->get('os_model');

        $bodyEmail = '
                 <p>
                    Olá ' . $object->getColaboradorQueAutorizou()->getNome() . '<br/><br/>
                    Este ticket é referente abertura de uma Ordem de Compra n. ' . str_pad($object->getId(), 6, '0', STR_PAD_LEFT) . '.
                    Acesse sua OS no sistema para mais informações.
                    <a href="http://www.orsin.com.br/app/' . $object->getNomePerfil() . '/ordemcompraproduto/' . $object->getId() . '/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:manutencao.go@flavis.com.br">manutencao.go@flavis.com.br</a>
                 </p>

                 <p><img style="width:200px;" src="http://www.orsin.com.br/bundles/app/img/logo_email.png"/></p>
                 ';


        // Enviar email para interessandos na criação de uma nova OC
        $osModel->sendEmalInteressados(
            $container,
            $object,
            'Flavis - Ordem de Compra n. '.str_pad($object->getId(),6,'0',STR_PAD_LEFT),
            $bodyEmail
        );
    }

    public function validate( ErrorElement $errorElement, $object )
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
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

    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->clearExcept(array('list', 'show'));
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null, ['label'=>'Código'])
            ->add('estado')
            ->add('observacoes')
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
            ->add('id', null, ['label'=>'Código'])
            ->add('orcamento', 'string', ['label'=>'Orçamento'])
            ->add('estado', null, ['label'=>'Estado'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array()
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
//        $dateFieldConfig = array(
//            'years' => range(1900, $now->format('Y')),
//            'dp_min_date' => '1-1-1900',
//        );
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => date('d') . '-' . date('m') . date('Y'),
            'format'=>'dd/MM/yyyy',
        );

        $formMapper
            ->tab('Ordem de Compra')
                ->with('Ordem de Compra')
                    ->add('orcamento','sonata_type_model',
                        ['property' => 'id',
                            'label'=>'Número do orçamento','placeholder'=>'Selecione um orçamento'])
                    ->add('estado','choice', ['choices'=>
                        [
                            'aberto'=>'Aberto',
                            'aprovado'=>'Aprovado',
                            'cancelado'=>'Cancelado'
                        ]])
                    ->add('observacoes',null,['label'=>'Observações'])
                ->end()
            ->end()

            ->tab('Produto')
                ->with('Produtos')
                    ->add('produtos', 'sonata_type_collection',
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
                        'admin_code' => 'app.admin.produto_saida'
                    ])
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
            ->with('Dados da Compra')
                ->add('id',null, ['label'=>'Código'])
                ->add('estado','choice',
                    array(
                        'label'=>'Estado',
                        'choices' => array(
                            'aberto' => 'Aberto',
                            'aprovado' => 'Aprovado',
                            'cancelado' => 'Cancelado'
                        ),
                        'template'=>'AppBundle:Orcamento:estado-orcamento.html.twig'
                    ))
                ->add('colaborador.nome', null, ['label'=>'Colaborador'])
                ->add('createdAt', null, ['label'=>'Criada em'])
            ->end()
            ->with('Produtos Requisitados')
                ->add('produtos','sonata_type_list', [
                    'label'=>false,
                    'template'=>'AppBundle:Almoxarifado:produtos-compra-list.html.twig'
                ])
                ->add('',null,[
                'label'=>false,
                'template'=>'AppBundle:Almoxarifado:produtos-compra-actions.html.twig'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
//                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}