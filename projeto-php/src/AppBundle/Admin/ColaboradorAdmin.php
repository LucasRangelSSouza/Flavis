<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Documento;
use AppBundle\Model\Colaborador;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;
use IT\InputMaskBundle\Form\Type\TextMaskType;

class ColaboradorAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(ErrorElement $errorElement, $object)
    {
        $now = new \DateTime();

        if ($object->getNome() == '') {
            $errorElement->with('nome')->addViolation('Atenção, preencha o campo nome')->end();
        }
        if ($object->getSexo() == '') {
            $errorElement->with('sexo')->addViolation('Atenção, selecione o sexo')->end();
        }
        if ($object->getDataNascimento() == '') {
            $errorElement->with('dataNascimento')->addViolation('Atenção, preencha o campo data de nascimento')->end();
        } else {
            if ($object->getDataNascimento() > $now ) {
                $errorElement->with('dataNascimento')->addViolation('Atenção, data de nascimento maior que data atual')->end();
            }
        }
        if ($object->getRg() == '') {
            $errorElement->with('rg')->addViolation('Atenção, preencha o campo RG')->end();
        }
        if ($object->getCpf() == '..-') {
            $errorElement->with('cpf')->addViolation('Atenção, preencha o campo CPF')->end();
        }
        if ($object->getEstadoCivil() == '') {
            $errorElement->with('estadoCivil')->addViolation('Atenção, selecione um estado civil')->end();
        }
        if ($object->getTipoColaborador() == '') {
            $errorElement->with('tipoColaborador')->addViolation('Atenção, selecione um tipo de colaborador')->end();
        }
        if ($object->getFuncao() == '') {
            $errorElement->with('funcao')->addViolation('Atenção, selecione uma função')->end();
        }
        if ($object->getNivelEscolaridade() == '') {
            $errorElement->with('nivelEscolaridade')->addViolation('Atenção, selecione um nível de escolaridade')->end();
        }
        if ($object->getStatus() == '') {
            $errorElement->with('status')->addViolation('Atenção, selecione um status')->end();
        }
        if ($object->getDataAdmissao() == '') {
            $errorElement->with('dataAdmissao')->addViolation('Atenção, preencha o campo data de admissão')->end();
        } else {
            if ($object->getDataAdmissao() > $now ) {
                $errorElement->with('dataAdmissao')->addViolation('Atenção, data de admissão maior que data atual')->end();
            }
        }
        if ($object->getDataRecisao() !== '') {
            if ($object->getDataRecisao() > $now ) {
                $errorElement->with('dataRecisao')->addViolation('Atenção, data de admissão maior que data atual')->end();
            }
        }
        if($object->getEmail() == ''){
            $errorElement->with('email')->addViolation('Atenção, preencha o campo email')->end();
        }

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

        if ($this->getSubject()->getId() == null) {

            foreach ($colaboradores as $colaborador) {

                if ($colaborador->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                    if ($colaborador->getCpf() == $object->getCpf()) {
                        $errorElement->with('cpf')->addViolation('Atenção, CPF informado já cadastrado')->end();
                    }

                }

                if ($colaborador->getEmail() == $object->getEmail()) {
                    $errorElement->with('email')->addViolation('Ops! Já existe um usuário com este colabordor!')->end();
                }

            }

        }else{

            foreach ($colaboradores as $colaborador) {

                if ($colaborador->getId() !== $object->getId()) {
                    if ($colaborador->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                        if ($colaborador->getCpf() == $object->getCpf()) {
                            $errorElement->with('cpf')->addViolation('Atenção, CPF informado já cadastrado')->end();
                        }

                    }

                    if ($colaborador->getEmail() == $object->getEmail()) {
                        $errorElement->with('email')->addViolation('Ops! Já existe um usuário com este colabordor!')->end();
                    }
                }

            }
        }
		
        $perfis = $em->getRepository('AppBundle:Perfil')->findAll();

        foreach ($perfis as $perfil) {

            //Validação na criação e na alteração (null ou <>)
            if (($this->getSubject()->getId() == null) || ($perfil->getId() !== $object->getId())) {

                if ($perfil->getEmail() == $object->getEmail()) {
                    $errorElement->with('email')->addViolation('Atenção, E-mail informado já cadastrado')->end();
                }

            }

        }

        if(!$this->validaCPF($object->getCpf())){
            $errorElement->with('cpf')->addViolation('Atenção, CPF informado inválido')->end();
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

    }


   public function validaCPF($cpf)
   {

       // Extrai somente os números
       $cpf = preg_replace('/[^0-9]/is', '', $cpf);

       // Verifica se foi informado todos os digitos corretamente
       if (strlen($cpf) != 11) {
           return false;
       }
       // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
       if (preg_match('/(\d)\1{10}/', $cpf)) {
           return false;
       }
       // Faz o calculo para validar o CPF
       for ($t = 9; $t < 11; $t++) {
           for ($d = 0, $c = 0; $c < $t; $c++) {
               $d += $cpf{$c} * (($t + 1) - $c);
           }
           $d = ((10 * $d) % 11) % 10;
           if ($cpf{$c} != $d) {
               return false;
           }
       }
       return true;

   }

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }
//    // Removendo rotas de ações na lista
//    protected function configureRoutes(RouteCollection $collection)
//    {
//        // OR remove all route except named ones
//        $collection->remove('delete');
//    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'AppBundle:Colaborador:list.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function preUpdate($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $um = $container->get('sonata.user.user_manager');

        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->preUpdate($documento);
        }

        foreach($this->getForm()->get('enderecos') as $endereco){
            $param = ['objeto'=>$endereco,'colaborador'=>$object,'tipo'=>'colaborador'];
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.endereco')->preUpdate($param);
        }

        $senhaAcesso = '';

        $object->getUser()->setUsername($object->getEmail());
        $object->getUser()->setUsernameCanonical($object->getEmail());
        $object->getUser()->setEmail($object->getEmail());
        $object->getUser()->setEmailCanonical($object->getEmail());

        if($object->getStatus() == 'DE') {
            $object->getUser()->setEnabled(false);
        }else{
            $object->getUser()->setEnabled(true);
        }

        $object->getUser()->removeRole('ROLE_USER_API');

        if($senhaAcesso!=''){
            $object->getUser()->setPlainPassword($senhaAcesso);
            $object->getUser()->setPassword($senhaAcesso);
        }

        $grupos = $object->getUser()->getGroups();
        $grupos->clear();

        $entity = $em->getRepository('ApplicationSonataUserBundle:Group')->find($object->getGrupoUsuario()->getId());
        $object->getUser()->addGroup($entity);
        //$object->getUser()->addRole($object->getGrupoUsuario()->getName());

        if($object->getGrupoUsuario()->getName()=='Técnico'){
            $object->getUser()->addRole('ROLE_USER_API');
        }

        $um->updateUser($object->getUser());
    }

    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();

        $em = $container->get('doctrine.orm.default_entity_manager');

        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->prePersist($documento);
        }

        foreach($this->getForm()->get('enderecos') as $endereco){
            $param = ['objeto'=>$endereco,'colaborador'=>$object,'tipo'=>'colaborador'];
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.endereco')->preUpdate($param);
        }

        // Setando grupo no usuário

        $um = $container->get('sonata.user.user_manager');

        $senhaAcesso = rand(2482,15155);

        $user = $um->createUser();

        $user->setUsername($object->getEmail());
        $user->setUsernameCanonical($object->getEmail());
        $user->setEmail($object->getEmail());
        $user->setEmailCanonical($object->getEmail());
        $user->setPlainPassword($senhaAcesso);
        $user->setPassword($senhaAcesso);

        $user->setEnabled(true);


        $entity = $em->getRepository('ApplicationSonataUserBundle:Group')->find($object->getGrupoUsuario()->getId());
        $user->addGroup($entity);

        if($object->getGrupoUsuario()->getName()=='Técnico'){
            $user->addRole('ROLE_USER_API');
        }


        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $user->setNomePerfil($perfilToFilter);

        $tokenGenerator =  $this->getConfigurationPool()->getContainer()->get('fos_user.util.token_generator');

        $user->setConfirmationToken($tokenGenerator->generateToken());


        $this->getConfigurationPool()
            ->getContainer()->get('fos_user.mailer')->sendResettingEmailMessage($user);

        $object->setUser($user);
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

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));

        $colaboradoresToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach($colaboradores as $colaborador) {
            if($colaborador->getNomePerfil() == $perfilToFilter) {
                $colaboradoresToFilter[$colaborador->getNome()] = $colaborador->getNome();
            }
        }


        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('nome','doctrine_orm_string', array('label'=>'Nome'), 'choice',
                array('choices' => $colaboradoresToFilter))
            ->add('funcao', 'doctrine_orm_choice', array(
                'label' => 'Funçao'),
                'choice',
                array(
                    'choices' => array(
                        1 => 'Diretor',
                        2 => 'Financeiro',
                        3 => 'Gestor  Operacional',
                        4 => 'Técnico',
                        5 => 'Engenheiro'
                    ),
                    'expanded' => false,
                    'multiple' => false))
//            ->add('nome','doctrine_orm_callback',array(
//                'label'=>'Nome',
//                'callback' => function($queryBuilder, $alias, $field, $value) {
//
//                        if (!$value['value']) {
//                            return;
//                        }
//
//                        $value = strtolower($value['value']);
//                        $queryBuilder
//                            ->andWhere("LOWER(o.nome) LIKE :nome")
//                            ->setParameter('nome', "%$value%");
//                        return true;
//                    },
//                'field_type' => 'text'
//            ))
//            ->add('dataAdmissao',null,array(
//                'label'=>'Data de Admissão',
//                'field_type' => 'text'), null, array('attr' => array('class' => 'mask_date')))

            ->add('data_admissao', 'doctrine_orm_callback', array(
                'label'=>'Data de Admissão',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) { return; }
                    //   $date = \DateTime::createFromFormat('d/m/Y', $value['value']);
                    //  if(!$date) { return; }

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data.' 00:00:00');

                    $queryBuilder->andWhere($alias . '.dataAdmissao = :data_admissao');
                    $queryBuilder->setParameter('data_admissao',$dataParam->format('Y-m-d'));

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'))
//            ->add('dataRecisao',null,array(
//                'label'=>'Data de Recisão',
//                'field_type' => 'text'), null, array('attr' => array('class' => 'mask_date')))

            ->add('data_recisao', 'doctrine_orm_callback', array(
                'label'=>'Data de Recisão',
                'callback' => function($queryBuilder, $alias, $field, $value) {

                    if (!$value['value']) { return; }
                    //   $date = \DateTime::createFromFormat('d/m/Y', $value['value']);
                    //  if(!$date) { return; }

                    $data = $value['value']->format('d-m-Y');
                    $dataParam = new \DateTime($data.' 00:00:00');

                    $queryBuilder->andWhere($alias . '.dataRecisao = :data_recisao');
                    $queryBuilder->setParameter('data_recisao',$dataParam->format('Y-m-d'));

                    return true;
                },
                'field_options' => array(
                    'format' => 'dd/MM/yyyy'
                ),
                'field_type' => 'sonata_type_date_picker'))
            ->add('status', 'doctrine_orm_choice', array(
                'label' => 'Status'),
                'choice',
                array(
                    'choices' => array(
                        'AT' => 'Ativo',
                        'FE' => 'Férias',
                        'LI' => 'Licença',
                        'DE' => 'Desligado'
                    ),
                    'expanded' => false,
                    'multiple' => false))
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
           // ->add('id',null,['label'=>'Código'])
            ->add('nome')
            ->add('email')
            ->add('cpf')
            ->add('funcao','text', ['label'=>'Função'])
//            ->add('funcao','choice',
//                array(
//                    'label'=>'Função',
//                    'choices' => array(
//                        1 => 'Diretor',
//                        2 => 'Financeiro',
//                        3 => 'Gestor  Operacional',
//                        4 => 'Técnico',
//                        5 => 'Engenheiro'
//                    )
//                ))
            ->add('status','choice',
                array(
                    'label'=>'Status',
                    'choices' => array(
                        'AT' => 'Ativo',
                        'FE' => 'Férias',
                        'LI' => 'Licença',
                        'DE' => 'Desligado'
                    )
                ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
//                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // Definição da disposição dos blocos
        $formMapper
            ->tab('Colaborador')
                ->with('Pessoal', array('class' => 'col-md-3'))->end()
                ->with('Profissional', array('class' => 'col-md-9'))->end()
//                ->with('Dados Bancários', array('class' => 'col-md-3'))->end()
//                ->with('Usuário de Acesso', array('class' => 'col-md-3'))->end()
            ->end()

            ->tab('Filiais Vinculadas')
                ->with('Filiais', array('class' => 'col-md-12'))->end()
            ->end()

            ->tab('Endereço/Contato')
                ->with('Endereços', array('class' => 'col-md-6'))->end()
                ->with('Telefones', array('class' => 'col-md-6'))->end()
            ->end()

            ->tab('Documentos')
                ->with('Documentos', array('class' => 'col-md-12'))->end()
            ->end()

            ->tab('Dados Bancário')
                ->with('Banco', array('class' => 'col-md-12'))->end()
            ->end()

            ->tab('Usuário de Acesso')
                ->with('Usuário', array('class' => 'col-md-12'))->end()
            ->end()
        ;

        $now = new \DateTime();
        $dateFieldConfig = array(
            'years' => range(1900, $now->format('Y')),
            'dp_min_date' => '1-1-1900',
            'dp_max_date' => date('d') . '-' . date('m') . date('Y'),
            'format'=>'dd/MM/yyyy'
        );

        $horasArray = array();

        for ($i=0;$i<24;$i++)
        {
            $h1=sprintf("%02d",$i).":00:00";
            $h2=sprintf("%02d",$i).":30:00";

            $horasArray[$h1] = $h1;
            $horasArray[$h2] = $h2;
        }

        $colaborador = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Foto da Assinatura do Colaborador';

        if($colaborador->getPathFoto()!=''){
            $fileFieldOptions['help'] = '*Caso seja engenheiro<br/><img src="/'.$colaborador->getPathFoto().'" class="admin-preview img-thumbnail"/>';
        } else {
            $fileFieldOptions['help'] = '*Caso seja engenheiro';
        }

        if($this->getSubject()->getId()) {
            $formMapper
                ->tab('Colaborador')
                ->with('Pessoal')
                ->add('cpf', null, ['label' => 'CPF', 'read_only' => true, 'disabled' => true, 'required' => true, 'attr' => ['class' => 'mask_cpf']])
                ->add('nome', null, ['label' => 'Nome', 'required' => true, 'help' => '*Nome completo do colaborador'])
                ->add('sexo', 'choice', ['choices' => Colaborador::getSexos(), 'label' => 'Sexo', 'required' => true, 'placeholder' => 'Selecione'])
                ->add('dataNascimento', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Data de Nascimento', 'attr' => ['class' => 'mascara_data'],'required' => true])
                ->add('rg', null, ['label' => 'RG', 'required' => true]);

        }else{
            $formMapper
                ->tab('Colaborador')
                ->with('Pessoal')
                ->add('cpf', null, ['label' => 'CPF', 'required' => true,'attr' => ['class' => 'mask_cpf']])
                ->add('nome', null, ['label'=>'Nome', 'required' => true,'help'=>'*Nome completo do colaborador'])
//                    ->add('email',null,['label'=>'E-mail','required'=>true])
                ->add('sexo', 'choice', ['choices' => Colaborador::getSexos(), 'label' => 'Sexo','required' => true,'placeholder'=>'Selecione'])
                ->add('dataNascimento', 'sonata_type_date_picker', $dateFieldConfig + ['label' => 'Data de Nascimento','attr' => ['class' => 'mascara_data'],'required' => true])
                ->add('rg', null, ['label' => 'RG','required'=>true]);
        }
        $formMapper
                ->add('estadoCivil', 'choice', [
                            'label' => 'Estado Civil',
                            'choices' => Colaborador::getEstadosCivis(),
                            'required' => true,
                            'empty_value' => 'Selecione'
                        ])
                ->end()
                ->with('Profissional')
                    ->add('tipoColaborador', 'choice', ['choices' => Colaborador::getAllTiposFuncionario(), 'label' => 'Tipo Colaborador','required' => true,'placeholder'=>'Selecione'])
                    ->add('funcao', 'sonata_type_model', ['placeholder' => 'Selecione','required' => true,'label'=>'Função'])//, "btn_add" => true
//                    ->add('grupoUsuario', null, ['placeholder' => 'Selecione','label'=>'Grupo de Usuários'])
//                    ->add('senhaAcesso',null, ['mapped' => false, 'label'=>'Senha de Acesso'],['type'=>'string'])
                    ->add('horarioEntrada', 'time', ['input'=>'datetime','widget' => 'choice','placeholder'=>'Selecione', 'required'=>false])
                    ->add('horarioSaida', 'time', ['placeholder'=>'Selecione', 'required'=>false])
                    ->add('intervalorAlmoco', 'choice', ['choices' =>['1'=>'1h','2'=>'2h'],'placeholder'=>'Selecione', 'required'=>false])
                    ->add('dataAdmissao', 'sonata_type_date_picker', $dateFieldConfig + [
                        'label' => 'Data de Admissão'
                            ,'required' => true,'attr' => ['class' => 'mascara_data']
                    ])
                    ->add('dataRecisao', 'sonata_type_date_picker', $dateFieldConfig + [
                        'label' => 'Data de Recisão',
                        'required' => false,'attr' => ['class' => 'mascara_data']
                    ])
                    ->add('formacao', null, ['label'=>'Formação'])
                    ->add('nivelEscolaridade', 'choice', ['choices' => Colaborador::getAllNivelEscolar(),'required' => true,'placeholder'=>'Selecione','label'=>'Nível de Escolaridade']);

                if($this->getSubject()->getId() == null)
                    {
                    $formMapper
                    ->add('status', 'choice', ['choices' => [ 'AT' => 'Ativo', 'FE' => 'Férias', 'LI' => 'Licença'], 'label' => 'Status', 'placeholder' => 'Selecione', 'required' => true]);
                    }
                else{
                    $formMapper
                    ->add('status', 'choice', ['choices' => Colaborador::getAllStatus(), 'label' => 'Status', 'placeholder' => 'Selecione', 'required' => true]);
                     }
        $formMapper
                    ->add('crea',null,['label'=>'CREA','help'=>'*Caso seja engenheiro'])
                    ->add('pathFoto', 'file',$fileFieldOptions)
                ->end()
            ->end()
        ;

        $formMapper
            ->tab('Filiais Vinculadas')
                ->with('Filiais')
            ->add('filiais', 'entity', [
                    'label' => 'Filiais',
                    'class' => 'AppBundle:FilialEmpresa',
                    'multiple'  => true,
                    'placeholder' => 'Selecione',
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
//                   ->add('filiais','sonata_type_model',['label'=>false,'required'=>false,'multiple'=>true,"btn_add" => false])
                ->end()
            ->end()
        ;

        $formMapper
            ->tab('Endereço/Contato')
                ->with('Endereços')
                    ->add('enderecos',  'sonata_type_collection',
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
                        'admin_code' => 'app.admin.endereco'
                    ])
                ->end()
                ->with('Telefones')
                    ->add('telefones', 'sonata_type_collection',
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
                            'admin_code' => 'app.admin.telefone'
                        ])
                ->end()
            ->end()
        ;

        $formMapper
            ->tab('Documentos')
                ->with('Documentos')
                    ->add('documentos', 'sonata_type_collection',
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
                        'admin_code' => 'app.admin.documento'
                        ])
                ->end()
            ->end()
        ;

        $formMapper
            ->tab('Dados Bancário')
                ->with('Banco')
                    ->add('bancoNome', null, ['label' => 'Nome do Banco'])
                    ->add('bancoNumero', null, ['label' => 'Número do Banco'])
                    ->add('bancoAgencia', null, ['label' => 'Agência'])
                    ->add('bancoCCorrente', null, ['label' => 'Conta Corrente'])
                ->end()
//                ->with('Usuário de Acesso')
//                    ->add('user', 'sonata_type_model', ['placeholder' => 'Selecione', 'btn_add' => ' ', 'required'=>false])
//                ->end()
            ->end()
        ;

        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->tab('Usuário de Acesso')
                    ->with('Usuário')
                        ->add('email', null, ['label'=>'E-mail'])
//                        ->add('nomePerfil', null, ['placeholder' => 'Selecione','label'=>'Perfil']))
                        ->add('grupoUsuario', null, ['placeholder' => 'Selecione','label'=>'Grupo de Usuários'])
                        ->add('senhaAcesso', null, ['mapped' => false, 'label'=>'Senha'],['type'=>'string'])
//                        ->add('userEnabled', 'choice', ['label'=>'Status','choices' =>[true=>'Ativo',false=>'Inativo'],'placeholder'=>'Selecione', 'required'=>false])
                    ->end()
                ->end()
            ;
        }else{
            $formMapper
                ->tab('Usuário de Acesso')
                    ->with('Usuário')
                        ->add('email', null, ['label'=>'E-mail'])
//                        ->add('grupoUsuario', null, ['placeholder' => 'Selecione','label'=>'Grupo de Usuários'])
                        ->add('grupoUsuario', 'entity', [
                                'label' => 'Grupo de Usuários',
                                'class' => 'ApplicationSonataUserBundle:Group',
                                'placeholder' => 'Selecione',
                                'required' => true,
                                'query_builder' => function (\Doctrine\ORM\EntityRepository $defaultRepository) {
                                    $container = $this->getConfigurationPool()->getContainer();
                                    $em = $container->get('doctrine.orm.default_entity_manager');
                                    $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
                                    $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


                                    $queryBuilder = $defaultRepository->createQueryBuilder('c');
                                    $queryBuilder
                                        ->andWhere($queryBuilder->expr()->not('c.name = :nome'))
                                        ->andWhere($queryBuilder->expr()->not('c.name = :name'))
                                        ->setParameters([
                                            'nome' => 'Suporte Técnico',
                                            'name' => 'Gerente Master'
                                        ]);

                                    return $queryBuilder;
                                },
                            ]
                        )
//                        ->add('senhaAcesso', null, ['mapped' => false, 'label'=>'Senha'],['type'=>'string'])
//                        ->add('userEnabled', 'choice', ['label'=>'Status','choices' =>[true=>'Ativo',false=>'Inativo'],'placeholder'=>'Selecione', 'required'=>false])
                    ->end()
                ->end()
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Pessoal', array('class' => 'col-md-6'))->end()
            ->with('Profissional', array('class' => 'col-md-6'))->end()
            ->with('Usuário de Acesso', array('class' => 'col-md-6'))->end()
            ->with('Endereços', array('class' => 'col-md-6'))->end()
            ->with('Telefones', array('class' => 'col-md-6'))->end()
            ->with('Documentos', array('class' => 'col-md-6'))->end()
        ;

        $showMapper
            ->with('Pessoal')
                ->add('nome')
                ->add('email')
                ->add('sexo','choice',
                    array(
                        'label'=>'Sexo',
                        'choices' => array(
                            'M' => 'Masculino',
                            'F' => 'Feminino'
                        )
                    ))
                ->add('dataNascimento')
                ->add('rg', null, ['label' => 'RG'])
                ->add('cpf', null, ['label' => 'CPF'])
                ->add('estadoCivil','choice',
                    array(
                        'label'=>'Estado Civil',
                        'choices' => array(
                            'CA' => 'Casado(a)',
                            'SO' => 'Solteiro(a)',
                            'DI' => 'Divorcido(a)',
                            'VI' => 'Viuvo(a)'
                        )
                    ))
            ->end()
            ->with('Profissional')
                ->add('funcao','text', ['label'=>'Função'])
                ->add('dataAdmissao')
                ->add('dataRecisao')
                ->add('status','choice',
                    array(
                        'label'=>'Status',
                        'choices' => array(
                            'AT' => 'Ativo',
                            'FE' => 'Férias',
                            'LI' => 'Licença',
                            'DE' => 'Desligado'
                        )
                    ))
            ->end()

            ->with('Usuário de Acesso')
                ->add('user','text', ['label'=>'Usuário'])
            ->end()

            ->with('Endereços')
                ->add('enderecos', 'sonata_type_list', ['label'=>false])
            ->end()

            ->with('Telefones')
                ->add('telefones','sonata_type_list', ['label'=>false])
            ->end()

            ->with('Documentos')
                ->add('documentos','sonata_type_list', [
                'label'=>false,
                'template'=>'AppBundle:Colaborador:documentos-list.html.twig'
                ])
            ->end()
        ;
    }
}