<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ClienteRepository;
use AppBundle\Form\ProcedimentosClienteEquipamentoType;
use AppBundle\Model\MapeamentoStringModel;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Acl\Domain\Entry;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class OrdemServicoAdmin extends Admin
{
    protected $baseRouteName = 'ordens-de-servico';

    protected $datagridValues = array(

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_order_by_' => 'dataAgendada'

    );

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'AppBundle:Os:list.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function postPersist($object)
    {

        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        $container = $this->getConfigurationPool()->getContainer();
        $osModel = $container->get('os_model');

        $bodyEmail = '
                 <p>
                    Olá '.$object->getColaboradorExecutor()->getNome().'<br/><br/>
                    Este ticket é referente abertura de uma Ordem de Serviço n. '.str_pad($object->getId(),6,'0',STR_PAD_LEFT).'.
                    Acesse sua OS no sistema para mais informações.
                    <a href="' . $urlBase . '/' . $object->getNomePerfil().'/ordemservico/'.$object->getId().'/show">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:manutencao.go@flavis.com.br">manutencao.go@flavis.com.br</a>
                 </p>

                 <p><img style="width:200px;" src="' . $urlBase . '/bundles/app/img/logo_email.png"/></p>
                 ';


        // Enviar email para interessandos na criação de uma nova OS
        $osModel->sendEmalInteressados(
            $container,
            $object,
            'Flavis - Ordem de Serviço n. '.str_pad($object->getId(),6,'0',STR_PAD_LEFT),
            $bodyEmail
        );

        // Envia e-mail para o cliente
        $osModel->sendEmailClienteAberturaOS($object, $container);

//        if($object->getStatus()=='PR') {
//
//            $bodyEmail = '
//                 <p>
//                    Olá ' . $object->getColaboradorExecutor()->getNome() . '<br/><br/>
//                    Este ticket é referente abertura de uma Ordem de Serviço n. ' . str_pad($object->getId(), 6, '0', STR_PAD_LEFT) .
//                '.
//                    Acesse sua OS no sistema para mais informações.
//                    <a href="http://prod.flavis.com.br/app/' . $object->getNomePerfil() . '/ordemservico/' . $object->getId() . '/show">Clique aqui</a>
//                 </p>
//
//                 <p style="padding-top:20px;">
//                    Contato da manutenção<br/>
//                    Fone: 062-39546527<br/>
//                    Email: <a href="mailto:manutencao.go@flavis.com.br">manutencao.go@flavis.com.br</a>
//                 </p>
//
//                 <p><img style="width:200px;" src="http://prod.flavis.com.br/bundles/app/img/logo_email.png"/></p>
//                 ';
//
//
//            $message = \Swift_Message::newInstance()
//                ->setSubject('Flavis - Ordem de Serviço n. ' . str_pad($object->getId(), 6, '0', STR_PAD_LEFT))
//                ->setFrom('agendamento@flavis.com.br')
//                ->setBcc($object->getColaboradorExecutor()->getEmail())
//                ->setBody($bodyEmail, 'text/html');
//
//            $container->get('mailer')->send($message);
//        }

    }

    public function postUpdate($object)
    {

    }

    public function validate( ErrorElement $errorElement, $object ) {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $object->setNomePerfil($perfilToFilter);

//        if ($object->getIsPmoc()) {// && $object->getOsOriginalPai() !== '') {
//            //PMOC
//        }else{
//            $object->setOsOriginalPai($object->getId());
//        }

//        $now = new \DateTime();
        $now = date('d/m/Y');

        if ($object->getIsPmoc() && $object->getEngenheiroResponsavel() == '') {
            $errorElement->with('engenheiroResponsavel')->addViolation('Atenção, para PMOC selecione um engenheiro responsável')->end();
        }
        if ($object->getIsPmoc() && $object->getNormaTecnica() == '') {
            $errorElement->with('normaTecnica')->addViolation('Atenção, para PMOC selecione uma norma')->end();
        }
        if ($object->getCliente() == '') {
            $errorElement->with('cliente')->addViolation('Atenção, selecione um cliente')->end();
        }
        if ($object->getEndereco() == '') {
            $errorElement->with('endereco')->addViolation('Atenção, selecione um endereço')->end();
        }
        if ($object->getColaboradorExecutor() == '') {
            $errorElement->with('colaboradorExecutor')->addViolation('Atenção, selecione um técnico')->end();
        }
        if ($object->getDataAgendada() == '') {
            $errorElement->with('dataAgendada')->addViolation('Atenção, informe uma data de agendamento')->end();
        } else {
            if ($object->getDataAgendada() < $now ) {
                $errorElement->with('dataAgendada')->addViolation('Atenção, data de agendamento menor que data atual')->end();
            }
        }
        if ($object->getHoraAgendada() == '') {
            $errorElement->with('horaAgendada')->addViolation('Atenção, informe um horario')->end();
        }
        if ($object->getOcorrencia() == '') {
            $errorElement->with('ocorrencia')->addViolation('Atenção, preencha o campo')->end();
        }
        if ($object->getStatus() == '') {
            $errorElement->with('status')->addViolation('Atenção, selecione um status')->end();
        }
//        if ($object->getStatus() == 'REP' && $object->getOsOriginal() == '') {
//            $errorElement->with('osOriginal')->addViolation('Atenção, selecione uma os para o replanejamento')->end();
//        }


        // Verifica se está sendo encerrado
        if ($object->getIsEncerrada() && $object->getJustificativaEncerramento() == '') {
            $error = 'É preciso justificar o encerramento desta Ordem de Serviço';
            $errorElement->with('enabled')->addViolation($error)->end();
        }

        // Uma OS não pode ser editada se estiver homologada
        if ($object->getIsHomologada()) {
            $error = 'Esta OS não pode ser editada porque foi Homologada!';
            $errorElement->with('enabled')->addViolation($error)->end();
        }


        if ($object->getExecucoesProcedimentos() != null) {//Estava gerando o erro "Child "teste" does not exist."
            if ($this->getSubject()->getIsPmoc()) {
                foreach ($this->getForm()->get('teste')->getData() as $procedimentoForm) {
                    foreach ($object->getExecucoesProcedimentos() as $procedimento) {
                        if ($procedimento->getId() == $procedimentoForm->getId())
                   $procedimento->setObservacao('TRUE');
                    }
                }
            }
        }
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
        $collection->remove('delete');

        $collection->add('homologa', $this->getRouterIdParameter() . '/homologa');
        $collection->add('print', $this->getRouterIdParameter() . '/print');
        $collection->add('cancela', $this->getRouterIdParameter() . '/cancela');
        //$collection->add('relatoriopmoc', $this->getRouterIdParameter().'/relatoriopmoc');
        $collection->add('historico', $this->getRouterIdParameter().'/historico');

    }

    public function preUpdate($object)
    {
        foreach ($this->getForm()->get('fotos') as $foto) {
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.fotoos')->preUpdate($foto);
        }
    }

    function prePersist($object)
    {
        // Setar qual usuário está requisitando
        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel = $container->get('colaborador_model');
        $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'), $container);
        $object->setColaboradorAtendente($colaboradorLogado);


        foreach ($this->getForm()->get('fotos') as $foto) {
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.fotoos')->preUpdate($foto);
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

//        $container = $this->getConfigurationPool()->getContainer();
//        $em = $container->get('doctrine.orm.default_entity_manager');
//        $tecnicos = $em->getRepository('AppBundle:Colaborador')->findBy([
//            '' => ''
//        ]);
//        $tecnocosToFilter = array();
//
//        foreach($tecnicos as $tecnico){
//            $empresasToFilter[$tecnico->getNome()] = $tecnico->getNome();
//        }


        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');

        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        $perfilToFilter = array();
        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $clientes = $em->getRepository('AppBundle:Cliente')->findAll(array(), array('nome' => 'ASC'));
        $clientesToFilter = array();
        foreach ($clientes as $cliente) {
            if ($cliente->getNomePerfil() == $perfilToFilter) {
                $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
            }
        }

//        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
//        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
//
//        foreach ($colaboradores as $colaborador) {
//            if ($colaborador->getUser() == $colaboradorLogado) {
//                $perfilToFilter = $colaborador->getNomePerfil();
//            }
//        }

        $colaboradorToFilter = array();
        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getNomePerfil() == $perfilToFilter) {
                $colaboradorToFilter[$colaborador->getNome()] = $colaborador->getNome();
            }
        }


        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
            'format' => 'dd/MM/yyyy',
            'required' => false
        );

        $datagridMapper
            ->add('osOriginalPai', null, ['label' => 'Código'])
            ->add('cliente.nome', 'doctrine_orm_string', array('label' => 'Cliente'), 'choice',
                array('choices' => $clientesToFilter))
//            ->add('colaboradorExecutor.nome','doctrine_orm_callback',[
//                'label'=>'Técnico',
//                'callback'   => array($this, 'filterTecnicoOs'),
//                'field_type' => 'text',
//            ])
            ->add('colaboradorExecutor.nome', 'doctrine_orm_string', array('label' => 'Técnico'), 'choice',
                array('choices' => $colaboradorToFilter))
            ->add('status', 'doctrine_orm_choice', array(
                'label' => 'Status'),
                'choice',
                array(
                    'choices' => array(
                        'PEN' => 'Pendente',
                        'ABE' => 'Aberta',
                        'PAR' => 'Paralisada',
                        'REP' => 'Replanejada',
                        'HOM' => 'Homologada',
                        'ENC' => 'Encerrada',
                        'CAN' => 'Cancelada',
                        'CON' => 'Concluída'
                    )))
            ->add('prioridade', 'doctrine_orm_choice', array(
                'label' => 'Prioridade'),
                'choice',
                array(
                    'choices' => array(
                        'Alta' => 'Alta',
                        'Média' => 'Média',
                        'Baixa' => 'Baixa'
                    )
                ))
            ->add('isPmoc', 'doctrine_orm_choice', array(
                'label' => 'PMOC'),
                'choice',
                array(
                    'choices' => array(
                        true => 'Sim',
                        false => 'Não'
                    )
                ))
//            ->add('deletedAt','doctrine_orm_choice', array(
//                'label' => 'Situação'),
//                'choice',
//                array(
//                    'choices' => array(
//                        null => 'Ativo',
//                        isnull => 'Inativo'
//                    )
//                ))
            ->add('agendada_em', 'doctrine_orm_callback', array(
                'label' => 'Agendada a partir de ',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) {
                        return;
                    }
                    //  $date = \DateTime::createFromFormat('d-m-Y', $value['value']);
                    //if(!$date) { return; }
                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data . ' 00:00:00');

                    $queryBuilder->andWhere($alias . '.dataAgendada >= :agendada_em');
                    $queryBuilder->setParameter('agendada_em', $dataParam->format('Y-m-d'));

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'))
            ->add('agendada_antes_de', 'doctrine_orm_callback', array(
                'label' => 'Agendada até ',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) {
                        return;
                    }
                    //   $date = \DateTime::createFromFormat('d/m/Y', $value['value']);
                    //  if(!$date) { return; }

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data . ' 00:00:00');

                    $queryBuilder->andWhere($alias . '.dataAgendada <= :agendada_antes_de');
                    $queryBuilder->setParameter('agendada_antes_de', $dataParam->format('Y-m-d'));

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'))
            ->add('isEncerrada', 'doctrine_orm_callback', array(
                'label' => 'Fechada?',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if ($value['value'] == '0' || $value['value'] == '1') {

                        $queryBuilder->andWhere($alias . '.isEncerrada = :isEncerrada');
                        $queryBuilder->setParameter('isEncerrada', $value['value']);
                        return true;

                    } else {

                        return;

                    }

                },
            ), 'choice',
                array(
                    'choices' => array(
                        true => 'Sim',
                        false => 'Não'
                    )
                ))
            ->add('isCancelada', 'doctrine_orm_callback', array(
                'label' => 'Cancelada?',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if ($value['value'] == '0' || $value['value'] == '1') {

                        $queryBuilder->andWhere($alias . '.isCancelada = :isCancelada');
                        $queryBuilder->setParameter('isCancelada', $value['value']);
                        return true;

                    } else {

                        return;

                    }

                },
            ), 'choice',
                array(
                    'choices' => array(
                        true => 'Sim',
                        false => 'Não'
                    )
                ))
            ->add('isParalisada', 'doctrine_orm_callback', array(
                'label' => 'Paralisada?',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if ($value['value'] == '0' || $value['value'] == '1') {

                        $queryBuilder->andWhere($alias . '.isParalisada = :isParalisada');
                        $queryBuilder->setParameter('isParalisada', $value['value']);
                        return true;

                    } else {

                        return;

                    }

                },
            ), 'choice',
                array(
                    'choices' => array(
                        true => 'Sim',
                        false => 'Não'
                    )
                ))
        ;
    }

    // Filtro de condomínio por logradouro
    public function filterTecnicoOs($queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $value = mb_strtolower($value['value']);

        $queryBuilder
            ->join("$alias.colaboradorExecutor", "tec")
            ->andWhere("UNACCENT(LOWER(tec.nome)) LIKE UNACCENT(:nome)")
            ->setParameter('nome', "%$value%");

        return true;
    }

    // Filtro de condomínio por logradouro
    public function filterClienteOs($queryBuilder, $alias, $field, $value)
    {
        if (!$value['value']) {
            return;
        }

        $value = mb_strtolower($value['value']);

        $queryBuilder
            ->join("$alias.cliente", "cli")
            ->andWhere("UNACCENT(LOWER(cli.nome)) LIKE UNACCENT(:nome)")
            ->setParameter('nome', "%$value%");

        return true;
    }


    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);


//        $container = $this->getConfigurationPool()->getContainer();
//
//        $parent = $admin = $this->getParentFieldDescription()->getAdmin();
//        $em = $container->get('doctrine')->getEntityManager();
//        $className = $em->getClassMetadata(get_class($parent))->getName();
//        extit($className);

        // Caso a chamada não seja feita por um outro admin, seja de select ou nxn
        if (!$this->hasParentFieldDescription()) {

            $parameters = [];

            // Somente o Colaborador Executor pode ver, além do admin
            if ($this->isGranted(MapeamentoStringModel::ROLE_ACESSO_OS_ADMIN)) {

                $container = $this->getConfigurationPool()->getContainer();
                $em = $container->get('doctrine.orm.default_entity_manager');

                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));

                $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

                $perfilToFilter = array();

                foreach ($colaboradores as $colaborador) {
                    if ($colaborador->getUser() == $colaboradorLogado) {
                        $perfilToFilter = $colaborador->getNomePerfil();
                    }
                }

                $query->andWhere(
                    $query->expr()->eq($query->getRootAlias() . '.isHomologada', ':isHomologada')
                );

                $query->andWhere(
                    $query->expr()->in($query->getRootAlias() . '.nomePerfil', ':perfl')
                );
//
                $query->andWhere(
                    $query->expr()->eq($query->getRootAlias() . '.isCancelada', ':cancelada')
                );
//                $query->andWhere(
//                    $query->expr()->eq($query->getRootAlias().'.status', ':statusOs')
//                );

                $query->setParameters([
                    'isHomologada' => FALSE,
                    'perfl' => $perfilToFilter,
//                    'statusOs' => 'PR',
                    'cancelada' => FALSE
                ]);


            } else {


                $query->leftJoin($query->getRootAlias() . '.cliente', 'c');

                // Se o Executor está logado
                $query->orWhere(
                    $query->expr()->eq($query->getRootAlias() . '.colaboradorExecutor', ':colaborador')
                );

                // Se quem criou está logado
                $query->orWhere(
                    $query->expr()->eq($query->getRootAlias() . '.colaboradorAtendente', ':colaborador')
                );

                $container = $this->getConfigurationPool()->getContainer();
                $colaboradorModel = $container->get('colaborador_model');
                $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'), $container);

                $query->andWhere(
                    $query->expr()->eq($query->getRootAlias() . '.isHomologada', ':isHomologada')
                );

                $query->andWhere(
                    $query->expr()->in('c.filial', ':filiais')
                );

//                $query->andWhere(
//                    $query->expr()->eq($query->getRootAlias().'.isCancelada', ':cancelada')
//                );

                // Filtrar também por Filial do Colaborador

                // No cliente temos a Filial

                // No Colaborar logado temos uma ou mais filiais


                $query->setParameters([
                    'colaborador' => $colaboradorLogado,
                    'isHomologada' => FALSE,
                    'filiais' => $colaboradorLogado->getFiliais()->toArray(),
//                    'cancelada' => true,
                ]);

            }

        }

        return $query;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {

//        $pmoc = $this->getSubject()->getIsPmoc();

        $buttons = ['actions' => array(
            'show' => array(),
            'edit' => array(),
//            'delete' => array(),
            'print' => array(
                'template' => 'AppBundle:CRUD:list__action_pdf.html.twig'
            ),
//            'relatoriopmoc' => array(
//                'template' => 'AppBundle:CRUD:list__action_relatoriopmoc.html.twig'
//            ),
            'homologa' => array(
                'template' => 'AppBundle:CRUD:list__action_homologa_os_admin.html.twig'
            ),
            'cancela' => array(
                'template' => 'AppBundle:CRUD:list__action_cancela_os_admin.html.twig'
            ),
        )];

        $listMapper
            ->add('osOriginalPai', null, ['label' => 'Código'])
            ->add('id', null, ['label' => 'Filho'])
            ->add('cliente.nome', null, array('label' => 'Cliente'));
//        if ($pmoc) {
//            $showMapper
//                ->add('osOriginalPai', null, ['label' => 'Código']);
//            //        if ($this->getSubject()->getOsOriginal()) {
//            //            $showMapper->add('os_original', null, ['label' => 'Procedimentos:', 'template' => 'AppBundle:Os:os_original.html.twig']);
//        } else {
//            $showMapper
//                ->add('id', null, ['label' => 'Código']);
//        }

        // Caso seja o gerente que esteja vendo a lista
        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN') ||
            TRUE === $this->isGranted('ROLE_GERENTE_OS_HOMOLOGA')) {

            $listMapper->add('colaboradorExecutor.nome', null, array('label' => 'Técnico'));

        }

        $listMapper
            ->add('dataAgendada', null, ['label' => 'Data agendada',
                'template' => 'AppBundle:Os:list_agenda_os.html.twig'])
            ->add('isPmoc',null,['label'=>'PMOC'])
            ->add('status', 'choice',
                array(
                    'label' => 'Status',
                    'choices' => array(
                        'PEN' => 'Pendente',
                        'ABE' => 'Aberto',
                        'PAR' => 'Paralisado',
                        'REP' => 'Replanejado',
                        'ENC' => 'Encerrado',
                        'HOM' => 'Homologado',
                        'CAN' => 'Cancelado',
                        'CON' => 'Concluído'
                    )
                ))
            ->add('isEncerrada', null, ['label' => 'Fechada pelo técnico',
                'template' => 'AppBundle:Os:list_status_os.html.twig'])
            ->add('isParalisada', null, ['label' => 'Paralisada pelo técnico',
                'template' => 'AppBundle:Os:list_status_os.html.twig'])
            ->add('isSync', null, ['label' => 'Sincronizada',
                'template' => 'AppBundle:Os:list_sinc_os.html.twig'])
            ->add('prioridade', null, ['label' => 'Prioridade'])
            ->add('_action', 'actions', $buttons)
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $container = $this->getConfigurationPool()->getContainer();

        $em = $container->get('doctrine.orm.default_entity_manager');


        $sql = "SELECT ep FROM AppBundle:ExecucaoDeProcedimentoEquipamento ep             
                WHERE ep.os=:os AND ep.observacao=:observacao";

        $query = $em->createQuery($sql);

        $query->setParameters([
            'os' => $this->getSubject()->getId(),
            'observacao' => 'TRUE'
        ]);

        $procedimentosBd = $query->getResult();

        $procedimentos = array();

        foreach ($procedimentosBd as $procedimento) {
            $procedimentos[] = $procedimento->getProcedimentoPmoc()->getTitulo()->getTitulo();
        }


        if ($this->getSubject()->getStatus() == 'REP') {

            $now = new \DateTime();
//        $dateFieldConfig = array(
//            'years' => range(1900, $now->format('Y')),
//            'dp_min_date' => '1-1-1900',
//            'format'=>'dd/MM/yyyy',
//        );

            $dateFieldConfig = array(
                'years' => range(1900, $now->format('Y')),
                'dp_min_date' => date('d') . '-' . date('m') . date('Y'),
                'format' => 'dd/MM/yyyy',
            );

//        if(!$this->getSubject()->getId()){
            $formMapper
                ->tab('Ordem de Serviço')
                ->with('Dados Gerais', array('class' => 'col-md-6'))->end()
                ->with('Ocorrência', array('class' => 'col-md-6'))->end()
                ->end();
//        }

            $formMapper
                ->tab('Avaliação Técnica')
                ->with('Informações de Avaliação', array('class' => 'col-md-6'))->end()
                ->with('Fotos de Avaliação', array('class' => 'col-md-6'))->end()
                ->end()
            ;


            $formMapper
                ->tab('Ordem de Serviço')
                ->with('Dados Gerais')
//                ->add('osOriginal', 'entity', [
//                    'label' => 'Ordem de Serviço Original',
//                    'class' => 'AppBundle:OrdemServico',
//                    'placeholder' => 'Selecione',
//                    'required' => true,
//                    'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
//
//                        $container = $this->getConfigurationPool()->getContainer();
//                        $em = $container->get('doctrine.orm.default_entity_manager');
//                        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
//                        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
//
//                        foreach ($colaboradores as $colaborador) {
//                            if ($colaborador->getUser() == $colaboradorLogado) {
//                                $perfilToFilter = $colaborador->getNomePerfil();
//                            }
//                        }
//
//                        $queryBuilder = $defaultRepository->createQueryBuilder('c');
//                        $queryBuilder
//                            ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
//                            ->andWhere($queryBuilder->expr()->in('c.isEncerrada', ':is_encerrada'))
//                            ->andWhere($queryBuilder->expr()->in('c.isHomologada', ':is_homologada'))
//                            ->setParameters([
//                                'perfl' => $perfilToFilter,
//                                "is_encerrada" => true,
//                                "is_homologada" => true
//                            ]);
//                        return $queryBuilder;
//                    },
//                ], ['admin_code' => 'app.admin.ordem_servico'])
                ->add('cliente', 'entity', [
                        'label' => 'Cliente',
                        'read_only' => true,
                        'disabled' => true,
                        'class' => 'AppBundle:Cliente',
                        'empty_data' => '0',
                        'placeholder' => 'Selecione um cliente',
                        'required' => true,
                        'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                            $container = $this->getConfigurationPool()->getContainer();
                            $em = $container->get('doctrine.orm.default_entity_manager');
                            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                            $colaboradorModel = $container->get('colaborador_model');
                            $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'), $container);
                            $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                            foreach ($colaboradores as $colaborador) {
                                if ($colaborador->getUser() == $colaboradorLogado2) {
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
                ->add('solicitante', null, ['label' => 'Nome do solicitante', 'read_only' => true,
                    'disabled' => true])
                ->add('endereco', 'shtumi_dependent_filtered_entity',
                    array(
                        'entity_alias' => 'endereco_por_cliente',
                        'read_only' => true,
                        'disabled' => true,
                        'parent_field' => 'cliente',
                        'empty_value' => '== Selecione um Endereço ==',
                        'required' => true,
                        'label' => 'Endereço',
                    )
                )
                ->add('colaboradorExecutor', 'entity', [
                        'label' => 'Selecione um Técnico Designado',
                        'class' => 'AppBundle:Colaborador',
                        'empty_data' => '0',
                        'placeholder' => 'Selecione',
                        'required' => true,
                        'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                            $container = $this->getConfigurationPool()->getContainer();
                            $em = $container->get('doctrine.orm.default_entity_manager');
                            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                            $funcoes = $em->getRepository('AppBundle:Funcao')->findAll();
                            $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                            foreach ($colaboradores as $colaborador) {
                                if ($colaborador->getUser() == $colaboradorLogado2) {
                                    $perfilToFilter = $colaborador->getNomePerfil();
                                }
                            }

                            $queryBuilder = $defaultRepository->createQueryBuilder('c');
                            $queryBuilder
                                ->andWhere($queryBuilder->expr()->in('c.funcao', ':funcaoId'))
                                ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                ->setParameters([
                                    'funcaoId' => 4, //'Técnico'
                                    'perfl' => $perfilToFilter
                                ]);

                            return $queryBuilder;
                        },
                    ]
                )
                ->add('dataAgendada', 'sonata_type_date_picker', $dateFieldConfig + [
                        'label' => 'Data de Agendamento',
                        'required' => true,
                    ])
//                ->add('dataInicioPmoc', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Data de início do PMOC','attr' => ['class' => 'mascara_data'],'required'=>false,'help'=>'Obrigatório, caso tenha PMOC.'])
                ->add('status', 'choice',
                    array(
                        'label' => 'Status',
                        'read_only' => true,
                        'disabled' => true,
                        'required' => true,
                        'choices' => array(
                            'PEN' => 'Pendente',
                            'PAR' => 'Paralisada',
                            'REP' => 'Replanejada'
                        )
                    ))
                ->add('prioridade', 'choice',
                    array(
                        'label' => 'Prioridade',
                        'read_only' => true,
                        'disabled' => true,
                        'required' => true,
                        'choices' => array(
                            'Alta' => 'Alta',
                            'Média' => 'Média',
                            'Baixa' => 'Baixa'
                        )
                    ))
                ->add('horaAgendada', 'time', [
                        'label' => 'Horário Agendado', 'placeholder' => 'Selecione', 'required' => true]
                )
                ->end()
                ->with('Ocorrência')
                ->add('ocorrencia', null, ['label' => 'Ocorrência', 'read_only' => true,
                    'disabled' => true, 'required' => true, 'attr' => ['style' => 'height:150px;']])
                ->add('observacao', null, ['label' => 'Observação', 'read_only' => true,
                    'disabled' => true, 'attr' => ['style' => 'height:140px;']])
                ->end()
                ->end();


            $formMapper
                ->tab('Avaliação Técnica')
                ->with('Informações de Avaliação')
                ->add('receptorNome', null, ['label' => 'Nome de quem o recebeu', 'read_only' => true,
                    'disabled' => true])
                ->add('receptorRg', null, ['label' => 'RG de quem o recebeu', 'read_only' => true,
                    'disabled' => true])
                ->add('relatorioAvaliacao', null, ['label' => 'Relatório de Avaliação', 'read_only' => true,
                    'disabled' => true, 'attr' => ['style' => 'height:150px;']])
                ->add('isEncerrada', 'checkbox', ['label' => 'Encerrar OS', 'required' => false])
                ->add('isSync', 'checkbox', ['label' => 'Sincronizada', 'required' => false])
                ->add('justificativaEncerramento', null, ['label' => 'Justificativa de encerramento', 'attr' => ['style' => 'height:140px;']])
                // Técnico que cadastrou esta avaliação
                ->add('engenheiroResponsavel', 'entity', [
                        'label' => 'Selecione o Engenheiro Reponsável',
                        'read_only' => true,
                        'disabled' => true,
                        'class' => 'AppBundle:Colaborador',
                        'empty_data' => '0',
                        'placeholder' => 'Selecione',
                        'required' => false,
                        'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                            $container = $this->getConfigurationPool()->getContainer();
                            $em = $container->get('doctrine.orm.default_entity_manager');
                            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                            $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();
                            $funcoes = $em->getRepository('AppBundle:Funcao')->findAll();

                            foreach ($colaboradores as $colaborador) {
                                if ($colaborador->getUser() == $colaboradorLogado2) {
                                    $perfilToFilter = $colaborador->getNomePerfil();

                                }
                            }

//                            foreach ($funcoes as $funcao) {
//                                if ($funcao->getNome() == 'Engenheiro') {
//                                    $funcaoToFilter = $funcao->getId();
//
//                                }
//                            }

                            $queryBuilder = $defaultRepository->createQueryBuilder('c');
                            $queryBuilder
                                ->andWhere($queryBuilder->expr()->in('c.funcao', ':funcaoId'))
                                ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                ->setParameters([
                                    'funcaoId' => 5, //'Engenheiro'
                                    'perfl' => $perfilToFilter
                                ]);

                            return $queryBuilder;
                        },
                    ]
                )
                ->add('normaTecnica', 'entity', [
                        'label' => 'Selecione uma Norma',
                        'class' => 'AppBundle:Norma',
                        'read_only' => true,
                        'disabled' => true,
                        'empty_data' => '0',
                        'placeholder' => 'Selecione',
                        'required' => false,
                        'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {


                            $container = $this->getConfigurationPool()->getContainer();
                            $em = $container->get('doctrine.orm.default_entity_manager');
                            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                            $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                            foreach ($colaboradores as $colaborador) {
                                if ($colaborador->getUser() == $colaboradorLogado2) {
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
                ->add('fichasTecnicasProduto', 'sonata_type_model', ['label' => 'Produtos utilizados na execução', 'required' => false, 'multiple' => true])
                ->end()
                ->with('Fotos de Avaliação')
                ->add('fotos', 'sonata_type_collection',
                    [
                        'label' => false,
                        'cascade_validation' => true,
                        'type_options' => array(
                            'delete' => false,
                        ),
                        'btn_add' => 'Adicionar Foto',
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                        'admin_code' => 'app.admin.fotoos',

                    ])
                ->end()
                ->end();

            if($this->getSubject()->getIsPmoc()) {

                $formMapper
                    ->tab('Procedimentos')
                    ->with('Procedimentos do Equipamento')
                    ->add('teste', 'entity', [
                            'label' => 'Procedimentos Restantes',
                            'expanded' => true,
                            'multiple' => true,
                            'mapped' => false,
                            'class' => 'AppBundle:ExecucaoDeProcedimentoEquipamento',
                            'required' => true,
                            'property' => 'procedimentoPmoc.titulo.titulo',
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                                $queryBuilder = $defaultRepository->createQueryBuilder('c');

                                $queryBuilder
                                    ->andWhere($queryBuilder->expr()->in('c.os', ':os'))
                                    ->andWhere($queryBuilder->expr()->in('c.observacao', ':observacao'))
                                    ->setParameters([
                                        'os' => $this->getSubject()->getId(),
                                        'observacao' => 'FALSE'
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('feitos', 'choice', array(
                        'choices' => $procedimentos,
                        'label' => 'Procedimentos Realizados',
                        'expanded' => true,
                        'mapped' => false,
                        'multiple' => true,
                        'required' => false,
                        'data' => array_keys($procedimentos),
                    ))
                    ->end()
                    ->end();
            }


        } else {

            $now = new \DateTime();


            $dateFieldConfig = array(
                'years' => range(1900, $now->format('Y')),
                'dp_min_date' => date('d') . '-' . date('m') . date('Y'),
                'format' => 'dd/MM/yyyy',
            );


            $formMapper
                ->tab('Ordem de Serviço')
                ->with('Dados Gerais', array('class' => 'col-md-6'))->end()
                ->with('Ocorrência', array('class' => 'col-md-6'))->end()
                ->end();

            $formMapper
                ->tab('Avaliação Técnica')
                ->with('Informações de Avaliação', array('class' => 'col-md-6'))->end()
                ->with('Fotos de Avaliação', array('class' => 'col-md-6'))->end()
                ->end();


            $formMapper
                ->tab('Ordem de Serviço')
                ->with('Dados Gerais')
//                ->add('osOriginal', 'entity', [
//                    'label' => 'Ordem de Serviço Original',
//                    'class' => 'AppBundle:OrdemServico',
//                    'placeholder' => 'Selecione',
//                    'required' => false,
//                    'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
//
//                        $container = $this->getConfigurationPool()->getContainer();
//                        $em = $container->get('doctrine.orm.default_entity_manager');
//                        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
//                        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
//
//                        foreach ($colaboradores as $colaborador) {
//                            if ($colaborador->getUser() == $colaboradorLogado) {
//                                $perfilToFilter = $colaborador->getNomePerfil();
//                            }
//                        }
//
//
//                        $queryBuilder = $defaultRepository->createQueryBuilder('c');
//                        $queryBuilder
//                            ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
//                            ->andWhere($queryBuilder->expr()->in('c.isEncerrada', ':is_encerrada'))
//                            ->andWhere($queryBuilder->expr()->in('c.isHomologada', ':is_homologada'))
//                            ->setParameters([
//                                'perfl' => $perfilToFilter,
//                                "is_encerrada" => true,
//                                "is_homologada" => true
//                            ]);
//
//                        return $queryBuilder;
//                    },
//                ], ['admin_code' => 'app.admin.ordem_servico'])
                ->add('cliente', 'entity', [
                        'label' => 'Cliente',
                        'class' => 'AppBundle:Cliente',
                        'empty_data' => '0',
                        'placeholder' => 'Selecione um cliente',
                        'required' => true,
                        'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                            $container = $this->getConfigurationPool()->getContainer();
                            $em = $container->get('doctrine.orm.default_entity_manager');
                            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                            $colaboradorModel = $container->get('colaborador_model');
                            $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'), $container);
                            $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                            foreach ($colaboradores as $colaborador) {
                                if ($colaborador->getUser() == $colaboradorLogado2) {
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
                ->add('solicitante', null, ['label' => 'Nome do solicitante'])
                ->add('endereco', 'shtumi_dependent_filtered_entity',
                    array(

                        'entity_alias' => 'endereco_por_cliente',
                        'parent_field' => 'cliente',
                        'empty_value' => '== Selecione um Endereço ==',
                        'required' => true,
                        'label' => 'Endereço',
                    )
                )
                ->add('colaboradorExecutor', 'entity', [
                        'label' => 'Selecione um Técnico Designado',
                        'class' => 'AppBundle:Colaborador',
                        'empty_data' => '0',
                        'placeholder' => 'Selecione',
                        'required' => true,
                        'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                            $container = $this->getConfigurationPool()->getContainer();
                            $em = $container->get('doctrine.orm.default_entity_manager');
                            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                            $funcoes = $em->getRepository('AppBundle:Funcao')->findAll();
                            $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                            foreach ($colaboradores as $colaborador) {
                                if ($colaborador->getUser() == $colaboradorLogado2) {
                                    $perfilToFilter = $colaborador->getNomePerfil();
                                }
                            }

                            $queryBuilder = $defaultRepository->createQueryBuilder('c');
                            $queryBuilder
                                ->andWhere($queryBuilder->expr()->in('c.funcao', ':funcaoId'))
                                ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                ->setParameters([
                                    'funcaoId' => 4, //'Técnico'
                                    'perfl' => $perfilToFilter
                                ]);

                            return $queryBuilder;
                        },
                    ]
                )
                ->add('dataAgendada', 'sonata_type_date_picker', $dateFieldConfig + [
                        'label' => 'Data de Agendamento',
                        'required' => true,
                    ])
                ->add('status', 'choice',
                    array(
                        'label' => 'Status',
                        'required' => true,
                        'choices' => array(
                            'PEN' => 'Pendente',
                            'PAR' => 'Paralisado',
                            'REP' => 'Replanejado'
                        )
                    ))
                ->add('prioridade', 'choice',
                    array(
                        'label' => 'Prioridade',
                        'required' => true,
                        'choices' => array(
                            'Alta' => 'Alta',
                            'Média' => 'Média',
                            'Baixa' => 'Baixa'
                        )
                    ))
                ->add('horaAgendada', 'time', [
                        'label' => 'Horário Agendado', 'placeholder' => 'Selecione', 'required' => true]
                )
                ->end()
                ->with('Ocorrência')
                ->add('ocorrencia', null, ['label' => 'Ocorrência', 'required' => true, 'attr' => ['style' => 'height:150px;']])
                ->add('observacao', null, ['label' => 'Observação', 'attr' => ['style' => 'height:140px;']])
                ->end()
                ->end();


            if($this->getSubject()->getIsPmoc()) {

                $formMapper
                    ->tab('Procedimentos')
                    ->with('Procedimentos do Equipamento')
                    ->add('teste', 'entity', [
                            'label' => 'Procedimentos Restantes',
                            'expanded' => true,
                            'multiple' => true,
                            'mapped' => false,
                            'class' => 'AppBundle:ExecucaoDeProcedimentoEquipamento',
                            'required' => true,
                            'property' => 'procedimentoPmoc.titulo.titulo',
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                                $queryBuilder = $defaultRepository->createQueryBuilder('c');

                                $queryBuilder
                                    ->andWhere($queryBuilder->expr()->in('c.os', ':os'))
                                    ->andWhere($queryBuilder->expr()->in('c.observacao', ':observacao'))
                                    ->setParameters([
                                        'os' => $this->getSubject()->getId(),
                                        'observacao' => 'FALSE'
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('feitos', 'choice', array(
                        'choices' => $procedimentos,
                        'label' => 'Procedimentos Realizados',
                        'expanded' => true,
                        'mapped' => false,
                        'multiple' => true,
                        'required' => false,
                        'data' => array_keys($procedimentos),
                    ))
                    ->end()
                    ->end();
            }

//        }

            $formMapper
                ->tab('Avaliação Técnica')
                ->with('Informações de Avaliação')
                ->add('receptorNome', null, ['label' => 'Nome de quem o recebeu'])
                ->add('receptorRg', null, ['label' => 'RG de quem o recebeu'])
                ->add('relatorioAvaliacao', null, ['label' => 'Relatório de Avaliação', 'attr' => ['style' => 'height:150px;']])
                ->add('isEncerrada', 'checkbox', ['label' => 'Encerrar OS', 'required' => false])
                ->add('isSync', 'checkbox', ['label' => 'Sincronizada', 'required' => false])
                ->add('justificativaEncerramento', null, ['label' => 'Justificativa de encerramento', 'attr' => ['style' => 'height:140px;']]);

            if($this->getSubject()->getIsPmoc()) {
                $formMapper
                    // Técnico que cadastrou esta avaliação
                    ->add('engenheiroResponsavel', 'entity', [
                            'label' => 'Selecione o Engenheiro Reponsável',
                            'class' => 'AppBundle:Colaborador',
                            'empty_data' => '0',
                            'placeholder' => 'Selecione',
                            'required' => true,
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                                $container = $this->getConfigurationPool()->getContainer();
                                $em = $container->get('doctrine.orm.default_entity_manager');
                                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                                $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();
                                $funcoes = $em->getRepository('AppBundle:Funcao')->findAll();

                                foreach ($colaboradores as $colaborador) {
                                    if ($colaborador->getUser() == $colaboradorLogado2) {
                                        $perfilToFilter = $colaborador->getNomePerfil();
                                    }
                                }

                                //                            foreach ($funcoes as $funcao) {
                                //                                if ($funcao->getNome() == 'Engenheiro') {
                                //                                    $funcaoToFilter = $funcao->getId();
                                //                                }
                                //                            }

                                $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                $queryBuilder
                                    ->andWhere($queryBuilder->expr()->in('c.funcao', ':funcaoId'))
                                    ->andWhere($queryBuilder->expr()->in('c.nomePerfil', ':perfl'))
                                    ->setParameters([
                                        'funcaoId' => 5, //'Engenheiro'
                                        'perfl' => $perfilToFilter
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('normaTecnica', 'entity', [
                            'label' => 'Selecione uma Norma',
                            'class' => 'AppBundle:Norma',
                            'empty_data' => '0',
                            'placeholder' => 'Selecione',
                            'required' => true,
                            'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {

                                $container = $this->getConfigurationPool()->getContainer();
                                $em = $container->get('doctrine.orm.default_entity_manager');
                                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();
                                $colaboradorLogado2 = $container->get('security.context')->getToken()->getUser();

                                foreach ($colaboradores as $colaborador) {
                                    if ($colaborador->getUser() == $colaboradorLogado2) {
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
                    );
            }

            $formMapper
                ->add('fichasTecnicasProduto', 'sonata_type_model', ['label' => 'Produtos utilizados na execução', 'required' => false, 'multiple' => true])
                ->end()
                ->with('Fotos de Avaliação')
                ->add('fotos', 'sonata_type_collection',
                    [
                        'label' => false,
                        'cascade_validation' => true,
                        'type_options' => array(
                            'delete' => false,
                        ),
                        'btn_add' => 'Adicionar Foto',
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                        'admin_code' => 'app.admin.fotoos',

                    ])
                ->end()
                ->end();

        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {

        $pmoc = $this->getSubject()->getIsPmoc();

        if ($pmoc) {
            $titleAvaliacao = 'Avaliação Técnica - PMOC';
        } else {
            $titleAvaliacao = 'Avaliação Técnica';
        }

        $showMapper
            ->with('Dados Básicos da OS', ['box_class' => 'box box-solid box-success']);

        if ($pmoc) {
            $showMapper
                ->add('osOriginalPai', null, ['label' => 'Código']);
    //        if ($this->getSubject()->getOsOriginal()) {
    //            $showMapper->add('os_original', null, ['label' => 'Procedimentos:', 'template' => 'AppBundle:Os:os_original.html.twig']);
        } else {
            $showMapper
                ->add('id', null, ['label' => 'Código']);
        }

        $showMapper
                ->add('motivoCancelamento', null, ['label' => 'Motivo de Cancelamento'])
                //   ->add('isEncerrada','boolean',[
    //                    'label'=>'Status',
    //                    'template'=>'AppBundle:Os:boolean.html.twig'
    //                ])
                ->add('status', null, [
                    'label' => 'Status',
                    'template' => 'AppBundle:Os:boolean.html.twig'
                ])
                ->add('prioridade', null, ['label' => 'Prioridade'])
                ->add('justificativaEncerramento', null, ['label' => 'Justificativa de Encerramento'])
                ->add('cliente.nome', null, ['label' => 'Cliente'])
                ->add('cliente.cpfCnpj', null, ['label' => 'CNPJ/CPF'])
                ->add('solicitante', null, ['label' => 'Solicitante'])
//                ->add('id', null, ['label' => 'Código'])
                ->add('createdAt', null, ['label' => 'Data de Abertura'])
                ->add('dataEncerramento', null, ['label' => 'Data de Fechamento'])
                ->add('dataAgendada', null, ['label' => 'Data Agendada', 'template' => 'AppBundle:Os:date.html.twig'])
                ->add('horaAgendada', null, ['label' => 'Hora Agendada'])
                ->add('ocorrencia', null, ['label' => 'Ocorrência'])
                ->end()
                ->with($titleAvaliacao, ['box_class' => 'box box-solid box-primary'])
                ->add('isHomologada', 'boolean', [
                    'label' => 'Está Homologada',
                ])
                ->add('colaboradorAvalista.nome', null, ['label' => 'Técnico Avalista'])
                ->add('colaboradorExecutor.nome', null, ['label' => 'Técnico Executor'])
                ->add('observacao', null, ['label' => 'Observação']);


        if (!$pmoc) {
                $showMapper->add('fotos', 'sonata_type_list', ['label' => 'Fotos', 'template' => 'AppBundle:Os:fotos-list.html.twig']);
        } else {
                $showMapper->add('execucoesProcedimentos', null, ['label' => 'Procedimentos:', 'template' => 'AppBundle:Os:execucoes_pmoc.html.twig']);
                $showMapper->add('relatoriosExecucoesProcedimentos', null, ['label' => 'RELATÓRIO DE PMOC:', 'template' => 'AppBundle:Os:relatorio_pmoc.html.twig']);
        }

        // Footer do relatório
        $showMapper
            ->add('receptorNome', null, ['label' => 'Nome de Quem Recebeu o Técnico'])
                ->add('receptorRg', null, ['label' => 'RG de Quem Recebeu o Técnico'])
                ->add('receptorAssinatura', null, ['label' => 'Assinatura', 'template' => 'AppBundle:Os:assinatura.html.twig'])
            ->end();

    }
}