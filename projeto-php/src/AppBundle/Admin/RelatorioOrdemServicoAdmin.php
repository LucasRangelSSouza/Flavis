<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class RelatorioOrdemServicoAdmin extends Admin
{
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
        $collection->clearExcept(array('list', 'show', 'edit', 'create'));
    }

    public function validate( ErrorElement $errorElement, $object )
    {
        // Verifica se a OS está homologada, pois se estiver não pode
        if($object->getAgendamento()->getOs()->getIsHomologada()){
            $error = 'Não é possível cadastrar um relatório em OS que já foi homologada';
            $errorElement->with( 'enabled' )->addViolation($error)->end();
        }
    }

    public function postPersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $osModel =  $container->get('os_model');

        // Agora o agendamento tem um relatório vinculado
        $object->getAgendamento()->setTemRelatorio(TRUE);

        // pega o último registro desta entidade
        $em = $container->get('doctrine.orm.default_entity_manager');
        $agendamento = $em
            ->getRepository('AppBundle:AgendamentoOrdemServico')
            ->find($object->getAgendamento()->getId());

        if($agendamento){
            $agendamento->setTemRelatorio(TRUE);
            $em->flush();
        }

        // Enviar email para interessandos na criação de uma nova OS
        $osModel->sendEmalInteressados(
            $container,
            $object,
            "Novo relatório OS - COD: {$object->getId()}",
            "Uma novo relatório de OS foi cadastrada no sistema Flavis. Códido de acompanhamento: {$object->getId()}",
            "relatorio"
        );

        return $object;
    }

    public function preUpdate($object)
    {
        $this->uploadFile($object);

        foreach($this->getForm()->get('fotos') as $foto){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.fotoos')->preUpdate($foto);
        }
    }

    public function prePersist($object)
    {
        // Setar qual usuário está requisitando
        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel =  $container->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);
        $object->setColaborador($colaboradorLogado);

        $this->uploadFile($object);

        foreach($this->getForm()->get('fotos') as $foto){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.fotoos')->prePersist($foto);
        }
    }

    private function uploadFile($orcamento)
    {
        $foto = $this->getForm()->get('pathFile')->getData();

        if(isset($foto) && $foto!=''){

            try{

                $container = $this->getConfigurationPool()->getContainer();
                $uploadableManager = $container->get('stof_doctrine_extensions.uploadable.manager');
                $uploadableManager->markEntityToUpload($orcamento, $foto);

                $em = $container->get('doctrine.orm.default_entity_manager');
                $em->flush();

                @unlink($orcamento->getOldPathFile());

            } catch (InvalidFormException $exception) {
                return $exception->getForm();
            }

        }
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
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('agendamento.os.cliente.nome',null,['label'=>'Cliente'])
            ->add('createdAt',null,['label'=>'Data de Criação'])
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
            ->tab('Geral')
                ->with('Dados Gerais', array('class' => 'col-md-6'))->end()
                ->with('Impedimento', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Execução Técnica')
                ->with('Informações da Execução', array('class' => 'col-md-6'))->end()
                ->with('Fotos de Execução', array('class' => 'col-md-6'))->end()
            ->end()
        ;

        $produto = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Foto de Impedimento';

        if($produto->getPathFile()!=''){
            $fileFieldOptions['help'] = '<img src="/'.$produto->getPathFile().'" class="admin-preview img-thumbnail"/>';
        }

        $formMapper
            ->tab('Geral')
                ->with('Dados Gerais')
                ->add('agendamento', 'sonata_type_model_autocomplete', [
                    'property' => 'id',
                    'multiple' => false,
                    'label' => 'Selecione a um agendamento aberto',
                    'callback' => function ($admin, $property, $value) {

                            // Setar qual usuário está requisitando
                            $container = $admin->getConfigurationPool()->getContainer();
                            $colaboradorModel =  $container->get('colaborador_model');
                            $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);

                            $value = strtolower($value);
                            $datagrid = $admin->getDatagrid();
                            $queryBuilder = $datagrid->getQuery();
                            $queryBuilder
                                ->leftJoin("{$queryBuilder->getRootAlias()}.os","os")
                                ->leftJoin("os.cliente","c")
                                ->orWhere("LOWER(c.nome) LIKE :nome")
                                ->orWhere("LOWER(c.razaoSocial) LIKE :razaoSocial")
                                ->orWhere("LOWER(c.cpfCnpj) LIKE :cpfCnpj")
                                // Somente OS Aberta
                                ->andWhere("os.isEncerrada=:is_encerrada")
                                ->andWhere("os.isHomologada=:is_homologada")
                                ->andWhere("{$queryBuilder->getRootAlias()}.colaboradorExecutor=:colaborador_executor")
                                ->andWhere("{$queryBuilder->getRootAlias()}.temRelatorio=:tem_relatorio")
                                ->setParameters([
                                    "nome"=>"%$value%",
                                    "razaoSocial"=>"%$value%",
                                    "cpfCnpj"=>"%$value%",
                                    "is_encerrada"=>false,
                                    "is_homologada"=>false,
                                    "tem_relatorio"=>false,
                                    "colaborador_executor"=>$colaboradorLogado,
                                ])
                            ;
                        },
                    'to_string_callback' => function($entity, $property) {
                            return sprintf('OS:%s <b>%s</b> - CNPJ/CPF: %s', $entity->getOs()->getId(),
                                $entity->getOs()->getCliente()->getRazaoSocial()
                                ,$entity->getOs()->getCliente()->getCpfCnpj());
                        }
                ])
                    ->add('receptorNome',null,['label'=>'Nome de quem o recebeu'])
                    ->add('receptorRg',null,['label'=>'RG de quem o recebeu'])
                    ->add('isEncerrada','checkbox',['label'=>'Encerrar OS','required'=>false])
                    ->add('justificativaEncerramento',null,['label'=>'Justificativa de encerramento','attr'=>['style'=>'height:100px;']])
                ->end()
                ->with('Impedimento')
                    ->add('isImpedido','checkbox',['label'=>'Houve Impedimento','required'=>false])
                    ->add('justificativaEmpedimento',null,['label'=>'Justificativa do Impedimento','attr'=>['style'=>'height:173px;']])
                    ->add('pathFile', 'file',$fileFieldOptions)
                ->end()
            ->end()

            ->tab('Execução Técnica')
                ->with('Informações da Execução')
                    ->add('relatorio',null,['label'=>'Relatório','attr'=>['style'=>'height:140px;']])
                ->end()
                ->with('Fotos de Execução')
                    ->add('fotos', 'sonata_type_collection',
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
                            'admin_code' => 'app.admin.fotoos'
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
            ->add('id')
            ->add('receptorNome')
            ->add('receptorRg')
            ->add('relatorio')
            ->add('isEncerrada')
            ->add('justificativaEncerramento')
            ->add('isImpedido')
            ->add('justificativaEmpedimento')
            ->add('pathFile')
            ->add('createdAt')
            ->add('updatedAt')
//            ->add('deletedAt')
        ;
    }
}
