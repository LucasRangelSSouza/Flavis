<?php

namespace AppBundle\Admin;

use AppBundle\Form\FileWithIconType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\ErrorElement;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class PerfilAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
    {

        if ($object->getNomePerfil() == '') {
            $errorElement->with('nomePerfil')->addViolation('Atenção, preencha o campo nome perfil')->end();
        }
        if (preg_match("/[^a-zA-Z]/m", $object->getNomePerfil()) == 1) {
            $errorElement->with('nomePerfil')->addViolation('Atenção, o campo nome perfil não pode conter: espaços, números e caracteres especiais')->end();
        }
        if (strlen($object->getNomePerfil()) > 11) {
            $errorElement->with('nomePerfil')->addViolation('Atenção, o campo nome perfil não pode conter mais que 10(dez) caracteres')->end();
        }
//        if ($object->getDataTermino() == '') {
//            $errorElement->with('dataTermino')->addViolation('Atenção, preencha o campo data de termino')->end();
//        }
        if ($object->getEmail() == '') {
            $errorElement->with('email')->addViolation('Atenção, preencha o campo email')->end();
        }
        if ($object->getEmpresa() == '') {
            $errorElement->with('empresa')->addViolation('Atenção, selecione uma empresa')->end();
        }

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $perfis = $em->getRepository('AppBundle:Perfil')->findAll();

        foreach ($perfis as $perfil) {

            //Validação na criação e na alteração (null ou <>)
            if (($this->getSubject()->getId() == null) || ($perfil->getId() !== $object->getId())) {

                if ($perfil->getNomePerfil() == $object->getNomePerfil()) {
                    $errorElement->with('nomePerfil')->addViolation('Atenção, Nome Perfil informado já cadastrado')->end();
                }

                if ($perfil->getEmail() == $object->getEmail()) {
                    $errorElement->with('email')->addViolation('Atenção, E-mail informado já cadastrado')->end();
                }

                if ($perfil->getNomePerfil() == $object->getNomePerfil()) {
                    $errorElement->with('nomePerfil')->addViolation('Atenção, nome perfil informado já cadastrado')->end();
                }

            }

        }
		
        $colaboradores = $em->getRepository('AppBundle:colaborador')->findAll();

        foreach ($colaboradores as $colaborador) {

            //Validação na criação e na alteração (null ou <>)
            if (($this->getSubject()->getId() == null) || ($colaborador->getId() !== $object->getId())) {

                if ($colaborador->getEmail() == $object->getEmail()) {
                    $errorElement->with('email')->addViolation('Atenção, E-mail informado já cadastrado')->end();
                }

            }

        }

        // Validações de CREATE
//        if (!$this->getSubject()) {
//
//            /*
//             * Certificar que já não existe um usuário com o e-mail informado
//             */
//            $container = $this->getConfigurationPool()->getContainer();
//            $um = $container->get('sonata.user.user_manager');
//
//            // Test user exist
//            $userByEmail = $um->findUserByEmail($object->getEmail());
//
//            if ($userByEmail) {
//                $errorElement->with('email')->addViolation('Ops! Já existe um usuário com este colabordor!');
//            }
//        }

        $object->setTrial(FALSE);

    }


    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    public function preRemove($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $usuarios = $em->getRepository('ApplicationSonataUserBundle:User')->findAll();
        $um = $container->get('sonata.user.user_manager');

        foreach ($usuarios as $usuario) {
            if ($usuario->getEmail() == $object->getEmail() || $usuario->getNomePerfil() == $object->getNomePerfil()) {
                $usuario->setEnabled(FALSE);
                $um->updateUser($usuario);
            }
        }
    }

    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();

        $em = $container->get('doctrine.orm.default_entity_manager');

        // Setando grupo no usuário

        $um = $container->get('sonata.user.user_manager');

        $senhaAcesso = rand(2482, 15155);

        $user = $um->createUser();

        $user->setUsername($object->getEmail());
        $user->setUsernameCanonical($object->getEmail());
        $user->setEmail($object->getEmail());
        $user->setEmailCanonical($object->getEmail());
        $user->setPlainPassword($senhaAcesso);
        $user->setPassword($senhaAcesso);

        $user->setEnabled(true);

//        $entity = $em->getRepository('ApplicationSonataUserBundle:Group')->find($object->getGrupoUsuario()->getId());
//        $user->addGroup($entity);

        $user->setNomePerfil($object->getNomePerfil());

        $tokenGenerator = $this->getConfigurationPool()->getContainer()->get('fos_user.util.token_generator');

        $user->setConfirmationToken($tokenGenerator->generateToken());

//        $registrar = new RegistrationFOSUser1Controller();
//
//        $registrar->registerAction($user);

        $container = $this->getConfigurationPool()->getContainer();//Call to a member function getContainer() on null
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }
        $url = $container->get('router')->generate('fos_user_registration_register', array(null => null), UrlGeneratorInterface::ABSOLUTE_URL, $perfilToFilter);

        $urlBase = $this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath();

        $body = '
                 <p>
                    Olá, <br/><br/>
                    Este E-MAIL é referente a criação do seu usuário para acessar o sistema!<br/>
                    Para criar seu usuário : 
                    <a href="' . $url . '">Clique aqui</a>
                 </p>

                 <p style="padding-top:20px;">
                    Contato da manutenção<br/>
                    Fone: 062-39546527<br/>
                    Email: <a href="mailto:viniciusam.senai@sistemafieg.org.br">viniciusam.senai@sistemafieg.org.br</a>
                 </p>

                 <p><img style="width:200px;" src="' . $urlBase . '/bundles/app/img/logo_email.png"/></p>
                 ';

        $message = \Swift_Message::newInstance()
            ->setSubject('Criação de usuário de acesso')
            ->setFrom('agendamento@flavis.com.br')
            ->setBcc($object->getEmail())
            ->setBody($body, 'text/html');
        $container->get('mailer')->send($message);

//        $object->setUser($user);
    }


    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('dataInicio', 'doctrine_orm_callback', array(
                'label' => 'Data de inicio',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) {
                        return;
                    }
                    //   $date = \DateTime::createFromFormat('d/m/Y', $value['value']);
                    //  if(!$date) { return; }

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data . ' 00:00:00');

                    $queryBuilder->andWhere($alias . '.dataInicio = :data_inicio');
                    $queryBuilder->setParameter('data_inicio', $dataParam->format('Y-m-d'));

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'))
            ->add('dataTermino', 'doctrine_orm_callback', array(
                'label' => 'Data de fim',
                'callback' => function ($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) {
                        return;
                    }
                    //   $date = \DateTime::createFromFormat('d/m/Y', $value['value']);
                    //  if(!$date) { return; }

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data . ' 00:00:00');

                    $queryBuilder->andWhere($alias . '.dataTermino = :data_temino');
                    $queryBuilder->setParameter('data_termino', $dataParam->format('Y-m-d'));

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'));
    }


    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('nomePerfil', null, ['label' => 'Nome do Perfil'])
            ->add('empresa')
//            ->add('dataTermino')
//            ->add('trial', 'choice', [
//                'label' => 'Perfil de Teste',
//                'choices' => [true=>'Sim',false=>'Não'],
//                'required' => false,
//                'empty_value' => 'Selecione'
//                        ])
            ->add('email', 'email', ['label' => 'E-mail'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }


    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
//        // Definição da disposição dos blocos
        $formMapper
            ->tab('Perfil')
                ->with('Perfil', array('class' => 'col-md-6'))->end()
            ->end()

            ->tab('Usuário de Acesso')
                ->with('Usuário', array('class' => 'col-md-12'))->end()
            ->end()
        ;


        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
            'format' => 'dd/MM/yyyy',
            'required' => false
        );

        $colaborador = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Imagem do logo do Perfil';

        if ($colaborador->getLogoPathFile() != '') {
            $fileFieldOptions['help'] = '*<br/><img src="/' . $colaborador->getLogoPathFile() . '" class="admin-preview img-thumbnail"/>';
        } else {
            $fileFieldOptions['help'] = '';
        }

//        // Caso tenha arquivo vinculado
//        // Adiciona um tipo view_file
//
//        if(!$this->getSubject()){
//            $file = '';
//        }else{
//            $file = $this->getSubject()->getLogoPathFile();
//        }
//
//        if(!empty($file)){
//
//            $extension = explode('.',$this->getSubject()->getLogoPathFile());
//            $fileFieldOptions['label'] = "Selecionar outra Foto";
//
//            if(count($extension)>1){
//
//                switch(strtolower($extension[1])){
//                    case 'jpg';case 'jpeg';case 'png';
//                        $htmlToViewFile = '<img src="/'.$this->getSubject()->getLogoPathFile().'" class="admin-preview img-thumbnail"/>';
//                        break;
//                    default:
//                        $htmlToViewFile = '<a class="btn btn-primary" href="/'.$this->getSubject()->getLogoPathFile().'" target="_blank"><i class="fa fa-file-o"></i> Clique para baixar o arquivo</a>';
//                        break;
//                }
//
//            }
//        }

//        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->tab('Perfil')
                    ->with('Perfil')
                        ->add('nomePerfil', null, ['label' => 'Nome Perfil', 'help' => '( Campo não pode conter: espaços, números e caracteres especiais(#$_) )', 'required' => true])
    //                    ->add('dataTermino', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Data de Termino'])
    //                    ->add('logoPathFile', 'file', $fileFieldOptions)
    //                        ->add('bannerPathFile', 'file', $fileFieldOptions)
                    //            ->add('emailManutencao', null, ['label'=>'Email Manutenção', 'required' => false])
                    //            ->add('emailAgendamento', null, ['label'=>'Email Agendamento', 'required' => false])
                    //            ->add('emailSolicitacao', null, ['label'=>'Email Solicitação', 'required' => false])
    //                        ->add('trial', 'choice', [
    //                            'label' => 'Perfil de Teste',
    //                            'choices' => [true=>'Sim',false=>'Não'],
    //                            'required' => false,
    //                            'empty_value' => 'Selecione'
    //                        ])
                        ->add('empresa', null, ['label' => 'Empresa', 'placeholder' => 'Selecione', 'required' => true])
                    ->end()
                ->end()
                ->tab('Usuário de Acesso')
                    ->with('Usuário')
    //                    ->add('username', 'text', ['label' => 'Usuário'])
                        ->add('email', 'email', ['label' => 'E-mail', 'required' => true])
    //                    ->add('grupoUsuario', null, ['placeholder' => 'Selecione','label'=>'Grupo de Usuários'])
    //                    ->add('senhaAcesso', null, ['mapped' => false, 'label'=>'Senha'],['type'=>'string'])
    //                    ->add('userEnabled', 'choice', ['label'=>'Status','choices' =>[true=>'Ativo',false=>'Inativo'],'placeholder'=>'Selecione', 'required'=>false])
                    ->end()
                ->end()
            ;
//        } else {
//
//        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Perfil')
                ->add('id', null, ['label' => 'Código'])
                ->add('nomePerfil')
                ->add('dataTermino')
                ->add('empresa')
//                ->add('trial','choice',
//                    array(
//                        'label'=>'Trial',
//                        'choices' => array(
//                            true => 'Sim',
//                            false => 'Não'
//                        )
//                    ))
            ->end()
            ->with('Dados do Cadastro', array('class' => 'col-md-6'))
                ->add('createdAt', null, ['label' => 'Data de Cadastro'])
                ->add('updatedAt', null, ['label' => 'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
            ->with('Usuário de Acesso', array('class' => 'col-md-6'))
//                ->add('username', 'text', ['label' => 'Usuário'])
                ->add('email', 'email', ['label' => 'E-mail'])
//                ->add('grupoUsuario', 'text', ['label'=>'Grupo de Usuários'])
//                ->add('userEnabled', 'choice', ['label'=>'Status'])
            ->end();
    }
}