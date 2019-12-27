<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Colaborador;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Model\Cliente;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;

class ClienteAdmin extends Admin
{


    /* Validações Fundamentais */
    public function validate(ErrorElement $errorElement, $object)
    {
        if($object->getFilial() == ''){
            $errorElement->with('filial')->addViolation('Atenção, selecione uma filial vinculada')->end();
        }
        if($object->getTipoPessoa() == ''){
            $errorElement->with('tipoPessoa')->addViolation('Atenção, selecione um tipo de pessoa')->end();
        }
        if($object->getTipoNegocio() == ''){
            $errorElement->with('tipoNegocio')->addViolation('Atenção, selecione um tipo de negócio')->end();
        }
        if($object->getNome() == ''){
            $errorElement->with('nome')->addViolation('Atenção, preencha o campo nome')->end();
        }
        if($object->getCpfCnpj() == ''){
            $errorElement->with('cpfCnpj')->addViolation('Atenção, preencha o campo CNPJ')->end();
        }
        if($object->getTipoLocal() == ''){
            $errorElement->with('tipoLocal')->addViolation('Atenção, selecione um tipo do local')->end();
        }
//        if($object->getEmail() == ''){
//            $errorElement->with('email')->addViolation('Atenção, preencha o campo email')->end();
//        }
//        if($object->getGrupoUsuario() == ''){
//            $errorElement->with('grupoUsuario')->addViolation('Atenção, preencha o campo grupo')->end();
//        }
//        if($object->getUserEnabled() == ''){
//            $errorElement->with('userEnabled')->addViolation('Atenção, selecione um status')->end();
//        }

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $clientes = $em->getRepository('AppBundle:Cliente')->findAll();
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }
        $object->setNomePerfil($perfilToFilter);

        if ($this->getSubject()->getId() == null) {

            foreach ($clientes as $cliente) {

                if ($cliente->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                    if($object->getRazaoSocial() != '') {
                        if ($cliente->getRazaoSocial() == $object->getRazaoSocial()) {
                            $errorElement->with('razaoSocial')->addViolation('Atenção, já existe um cliente cadastrado com esta Razão Social')->end();
                        }
                    }

                    if ($cliente->getCpfCnpj() == $object->getCpfCnpj()) {
                        $errorElement->with('cpfCnpj')->addViolation('Atenção, já existe um cliente cadastrado com este CNPJ/CPF')->end();
                    }

                }

            }

        }else {

            foreach ($clientes as $cliente) {

                if ($cliente->getId() !== $object->getId()) {
                    if ($cliente->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                        if($object->getRazaoSocial() != '') {
                            if ($cliente->getRazaoSocial() == $object->getRazaoSocial()) {
                                $errorElement->with('razaoSocial')->addViolation('Atenção, já existe um cliente cadastrado com esta Razão Social')->end();
                            }
                        }

                        if ($cliente->getCpfCnpj() == $object->getCpfCnpj()) {
                            $errorElement->with('cpfCnpj')->addViolation('Atenção, já existe um cliente cadastrado com este CNPJ/CPF')->end();
                        }

                    }

                }

            }

        }

        // Validações de CREATE
        if (!$this->getSubject()) {

            /*
             * Certificar que já não existe um usuário com o e-mail informado
             */
            $container = $this->getConfigurationPool()->getContainer();
            $um = $container->get('sonata.user.user_manager');

            // Test user exist
            $userByEmail = $um->findUserByEmail($object->getEmail());

            if ($userByEmail) {
                $errorElement->with('email')->addViolation('Ops! Já existe um usuário com este colabordor!');
            }
        }

        if(strlen($object->getCpfCnpj()) == 14){
            if(!$this->validaCPF($object->getCpfCnpj())){
                $errorElement->with('cpfCnpj')->addViolation('Atenção, CPF informado inválido')->end();
            }
        }
        if(strlen($object->getCpfCnpj()) == 18){
            if(!$this->valida_cnpj($object->getCpfCnpj())){
                $errorElement->with('cpfCnpj')->addViolation('Atenção, CNPJ informado inválido')->end();
            }
        }

    }


    function valida_cnpj ( $cnpj ) {
        // Deixa o CNPJ com apenas números
        $cnpj = preg_replace( '/[^0-9]/', '', $cnpj );

        // Garante que o CNPJ é uma string
        $cnpj = (string)$cnpj;

        // O valor original
        $cnpj_original = $cnpj;

        // Captura os primeiros 12 números do CNPJ
        $primeiros_numeros_cnpj = substr( $cnpj, 0, 12 );

        /**
         * Multiplicação do CNPJ
         *
         * @param string $cnpj Os digitos do CNPJ
         * @param int $posicoes A posição que vai iniciar a regressão
         * @return int O
         *
         */
        if ( ! function_exists('multiplica_cnpj') ) {
            function multiplica_cnpj( $cnpj, $posicao = 5 ) {
                // Variável para o cálculo
                $calculo = 0;

                // Laço para percorrer os item do cnpj
                for ( $i = 0; $i < strlen( $cnpj ); $i++ ) {
                    // Cálculo mais posição do CNPJ * a posição
                    $calculo = $calculo + ( $cnpj[$i] * $posicao );

                    // Decrementa a posição a cada volta do laço
                    $posicao--;

                    // Se a posição for menor que 2, ela se torna 9
                    if ( $posicao < 2 ) {
                        $posicao = 9;
                    }
                }
                // Retorna o cálculo
                return $calculo;
            }
        }

        // Faz o primeiro cálculo
        $primeiro_calculo = multiplica_cnpj( $primeiros_numeros_cnpj );

        // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
        // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
        $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 :  11 - ( $primeiro_calculo % 11 );

        // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
        // Agora temos 13 números aqui
        $primeiros_numeros_cnpj .= $primeiro_digito;

        // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
        $segundo_calculo = multiplica_cnpj( $primeiros_numeros_cnpj, 6 );
        $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 :  11 - ( $segundo_calculo % 11 );

        // Concatena o segundo dígito ao CNPJ
        $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

        // Verifica se o CNPJ gerado é idêntico ao enviado
        if ( $cnpj === $cnpj_original ) {
            return true;
        }else{
            return false;
        }
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

    // Removendo rotas de ações na lista
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->remove('delete');
        $collection->add('etiqueta', $this->getRouterIdParameter().'/etiqueta');
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array(
                'AppBundle:Custom:custom_one_to_many.html.twig',
                'AppBundle:Custom:custom_one_one_to_many.html.twig'
            )
        );
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        if(!$this->hasParentFieldDescription()) {

            $parameters = [];

//            // Somente o Colaborador Executor pode ver, além do admin
//            if (FALSE === $this->isGranted('ROLE_SUPER_ADMIN')) {
//
//                $container = $this->getConfigurationPool()->getContainer();
//                $colaboradorModel  =  $container->get('colaborador_model');
//                $colaboradorLogado = $colaboradorModel->getColaboradorLogado($container->get('doctrine'),$container);
//                $em = $container->get('doctrine.orm.default_entity_manager');
//
//                $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
//
//                $perfilToFilter = array();
//
//                foreach($colaboradores as $colaborador) {
//                    if($colaborador->getUser() == $colaboradorLogado){
//                        $perfilToFilter = $colaborador->getNomePerfil();
//                    }
//                }
//
//                // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
//                $query->andWhere(
//                    $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
//                );
//
//
//                $query->setParameters([
//                    'perfl' => $perfilToFilter
//                ]);
//
//            }else{

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

                // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
                $query->andWhere(
                    $query->expr()->in($query->getRootAlias(). '.nomePerfil', ':perfl')
                );

                $query->setParameters([
                    'perfl' => $perfilToFilter
                ]);

            }

//        }

        return $query;
    }

    public function preUpdate($object)
    {
        $em = $this->getConfigurationPool()
            ->getContainer()
            ->get('doctrine.orm.entity_manager');

        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->preUpdate($documento);
        }

        foreach($object->getResponsaveis() as $responsavel){
            $responsavel->setCliente($object);
            $em->persist($responsavel);
            $em->flush($responsavel);
        }

        foreach($this->getForm()->get('enderecos') as $endereco){

            $param = [
                'objeto'=>$endereco,
                'latitude'=>$this->getRequest()->request->get('latitude_mapa'),
                'longitude'=>$this->getRequest()->request->get('longitude_mapa'),
                'zoom'=>$this->getRequest()->request->get('zoom_map'),
                'cliente'=>$object,
                'tipo'=>'cliente'
            ];

            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.endereco')->preUpdate($param);
        }

//        // Setando o cliente do equipamento que está sendo vinculado
//        foreach($object->getEquipamentos() as $equipamento){
//            $equipamento->setCliente($object);
//        }

        if(!$object->getEmail() == '') {
			$container = $this->getConfigurationPool()->getContainer();

			$um = $container->get('sonata.user.user_manager');

			$senhaAcesso = '';

	//           $user = $um->createUser();
	//        $object->setUser($user);

				$object->getUser()->setUsername($this->getForm()->get('email')->getData());
				$object->getUser()->setUsernameCanonical($this->getForm()->get('email')->getData());
				$object->getUser()->setEmail($this->getForm()->get('email')->getData());
				$object->getUser()->setEmailCanonical($this->getForm()->get('email')->getData());
	//            $object->getUser()->setEnabled($this->getForm()->get('userEnabled')->getData());

			$object->getUser()->removeRole('ROLE_USER_API');

			$entity = $em->getRepository('ApplicationSonataUserBundle:Group')->find(4);
			$object->getUser()->addGroup($entity);

	//        $tokenGenerator =  $this->getConfigurationPool()
	//            ->getContainer()->get('fos_user.util.token_generator');
	//
	//        $object->getUser()->setConfirmationToken($tokenGenerator->generateToken());

			$um->updateUser($object->getUser());

	//        $this->getConfigurationPool()
	//            ->getContainer()->get('fos_user.mailer')->sendResettingEmailMessage($object->getUser());
        }
    }

    public function prePersist($object)
    {
        foreach($this->getForm()->get('documentos') as $documento){
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->prePersist($documento);
        }

        $em = $this->getConfigurationPool()
            ->getContainer()
            ->get('doctrine.orm.entity_manager');

        foreach($object->getResponsaveis() as $responsavel){
            $responsavel->setCliente($object);
            $em->persist($responsavel);
            $em->flush($responsavel);
        }

        foreach($this->getForm()->get('enderecos') as $endereco){

            $param = [
                'objeto'=>$endereco,
                'latitude'=>$this->getRequest()->request->get('latitude_mapa'),
                'longitude'=>$this->getRequest()->request->get('longitude_mapa'),
                'zoom'=>$this->getRequest()->request->get('zoom_map'),
                'cliente'=>$object,
                'tipo'=>'cliente'
            ];

            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.endereco')->preUpdate($param);
        }

        // Setando o cliente do equipamento que está sendo vinculado
//        foreach($this->getForm()->get('equipamentos') as $equipamento){
//            $param = ['objeto'=>$equipamento,'cliente'=>$object,'acao'=>'insert'];
//            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.cliente_equipamento')->preInsert($param);
//        }

        if(!$object->getEmail() == '') {
            $container = $this->getConfigurationPool()->getContainer();

            $um = $container->get('sonata.user.user_manager');

            $object->setEmail($this->getForm()->get('email')->getData());

            $senhaAcesso = rand(2000, 5000);

            $user = $um->createUser();

            $user->setUsername($this->getForm()->get('email')->getData());
            $user->setUsernameCanonical($this->getForm()->get('email')->getData());
            $user->setEmail($this->getForm()->get('email')->getData());
            $user->setEmailCanonical($this->getForm()->get('email')->getData());
            $user->setEnabled(true);//($this->getForm()->get('userEnabled')->getData());

            $user->setPlainPassword($senhaAcesso);
            $user->setPassword($senhaAcesso);

            $user->setEnabled(true);
            $user->setNomePerfil($object->getNomePerfil());

            $entity = $em->getRepository('ApplicationSonataUserBundle:Group')->find(4);

            $user->addGroup($entity);

            $tokenGenerator = $this->getConfigurationPool()->getContainer()->get('fos_user.util.token_generator');

            $user->setConfirmationToken($tokenGenerator->generateToken());


            $this->getConfigurationPool()
                ->getContainer()->get('fos_user.mailer')->sendResettingEmailMessage($user);

            $object->setUser($user);


            $objectColaborador = new Colaborador();
            $objectColaborador->setTipoColaborador('F');
            $objectColaborador->setNome($user->getNomePerfil());
            $objectColaborador->setSexo('M');
            $objectColaborador->setDataNascimento(new \DateTime());
            $objectColaborador->setCpf('00000000000');
            $objectColaborador->setRg('00000000');
            $objectColaborador->setEstadoCivil('SO');
            $objectColaborador->setStatus('AT');
            $objectColaborador->setCreatedAt(new \DateTime());
            $objectColaborador->setUpdatedAt(new \DateTime());
            $objectColaborador->setUser($user);
            $objectColaborador->setNomePerfil($user->getNomePerfil());
            $objectColaborador->setEmail($user->getEmail());
            $objectColaborador->setDataAdmissao(new \DateTime());
            $objectColaborador->setGrupoUsuario($em->getRepository('ApplicationSonataUserBundle:Group')->find(4));
            $objectColaborador->setFuncao($em->getRepository('AppBundle:Funcao')->find(1));

            $em->persist($objectColaborador);
            $em->flush();
        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $clientes = $em->getRepository('AppBundle:Cliente')->findAll(array(),array('nome' => 'ASC'));
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $clientesToFilter = array();

        foreach($clientes as $cliente) {
            if($cliente->getNomePerfil() == $perfilToFilter) {
                $clientesToFilter[$cliente->getNome()] = $cliente->getNome();
            }
        }


        $datagridMapper
            ->add('id',null,['label'=>'Código'])
           // ->add('tipoPessoa', null, ['label'=>'Tipo de Pessoa'])
           ->add('tipoPessoa', 'doctrine_orm_choice', array(
               'label' => 'Tipo de Pessoa'),
               'choice',
               array(
                   'choices' => array(
                       'PF' => 'Pessoa Física',
                       'PJ' => 'Pessoa Jurídica',
                   ),
                   'expanded' => false,
                   'multiple' => false))
//            ->add('nome','doctrine_orm_callback',[
//                'label'=>'Nome',
//                'callback'   => array($this, 'filterComString'),
//                'field_type' => 'text',
//            ])
            ->add('nome','doctrine_orm_string', array('label'=>'Nome Fantasia'), 'choice',
                array('choices' => $clientesToFilter))
            ->add('cpfCnpj', null, ['label'=>'CPF/CNPJ'])
//            ->add('razaoSocial','doctrine_orm_callback',[
//                'label'=>'Razão Social',
//                'callback'   => array($this, 'filterComString'),
//                'field_type' => 'text',
//            ])
//            ->add('deleted_at', null, ['label'=>'Status','choices' =>[true=>'Ativo',false=>'Inativo'],'placeholder'=>'Selecione', 'required'=>false])
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

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $colaboradorModel  =  $container->get('cliente_model');

        $obj = $this->getSubject();

        $listMapper
          //  ->add('id',null,['label'=>'Código'])
            ->add('nome', null, ['label'=>'Nome Fantasia'])
            ->add('cpfCnpj', null, ['label'=>'CNPJ/CPF'])
            ->add('telefones', null, ['label'=>'Telefone','template'=>'AppBundle:Cliente:telefone-list.html.twig'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
//                    'delete' => array(),
                    'etiqueta' => array(
                        'template' => 'AppBundle:CRUD:list__action_etiqueta.html.twig'
                    ),
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
            ->tab('Cliente')
                ->with('Institucional', array('class' => 'col-md-6'))->end()
                ->with('Funcionamento', array('class' => 'col-md-6'))->end()
            ->end()

            ->tab('Endereço/Contato')
                ->with('Endereços', array('class' => 'col-md-6'))->end()
                ->with('Telefones', array('class' => 'col-md-6'))->end()
            ->end()

            ->tab('Responsáveis')
                ->with('Responsáveis', array('class' => 'col-md-12'))->end()
            ->end()

            ->tab('Documentos')
                ->with('Documentos', array('class' => 'col-md-12'))->end()
            ->end()

//            ->tab('Usuário de Acesso')
//                ->with('Usuário', array('class' => 'col-md-12'))->end()
//            ->end()
        ;

//        $formMapper
//            ->tab('Usuário de Acesso')
//                 ->with('Usuário')
//                    ->add('email', null, ['label'=>'E-mail', 'required'=>false])
////                        ->add('grupoUsuario', null, ['placeholder' => 'Selecione','label'=>'Grupo de Usuários'])
////                        ->add('senhaAcesso', null, ['mapped' => false, 'label'=>'Senha'],['type'=>'string'])
////                        ->add('userEnabled', 'choice', ['label'=>'Status','choices' =>[true=>'Ativo',false=>'Inativo'],'placeholder'=>'Selecione', 'required'=>false])
//                 ->end()
//            ->end()
//        ;

        if($this->getSubject()->getId()){
            $formMapper
                ->tab('Cliente')
                ->with('Institucional')

                ->add('cpfCnpj', null, ['label'=>'CNPJ/CPF','required'=>true, 'read_only' => true,'disabled' => true, 'attr' => ['class' => 'mask_cpfcnpj']]);
//                ->add('tipoPessoa', 'choice', ['label'=>'Tipo de Pessoa*','read_only' => true,'required'=>false,'choices' => Cliente::getAllTiposPessoa(), 'placeholder'=>'Selecione']);
        }else{
            $formMapper
                ->tab('Cliente')
                ->with('Institucional')

                ->add('tipoPessoa', 'choice', ['label'=>'Tipo de Pessoa','required'=>true,'choices' => Cliente::getAllTiposPessoa(), 'placeholder'=>'Selecione'])
                ->add('cpfCnpj', null, ['label'=>'CNPJ/CPF','required'=>true,  'attr' => ['class' => 'mask_cpfcnpj']]);
        }


        $formMapper
                    ->add('filial', 'entity', [
                            'label' => 'Filiais',
                            'class' => 'AppBundle:FilialEmpresa',
                            'empty_data'  => '0',
                            'placeholder' => 'Selecione uma filial',
                            'required' => true,
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
                    ->add('facilities', 'entity', [
                            'label' => 'Facilities',
                            'class' => 'AppBundle:Cliente',
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
                    ->add('tipoNegocio', 'entity', [
                            'label' => 'Tipo do Negócio',
                            'class' => 'AppBundle:TipoNegocio',
                            'placeholder' => 'Selecione',
                            'required' => true,
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
                                    ->andWhere($queryBuilder->expr()->in('c.perfilTipoNegocio', ':perfl'))
                                    ->setParameters([
                                        'perfl' => $perfilToFilter
                                    ]);

                                return $queryBuilder;
                            },
                        ]
                    )
                    ->add('nome', null, ['label'=>'Nome','required' => true])
                    ->add('razaoSocial', null, ['label'=>'Razão Social'])
                ->end()
                ->with('Funcionamento')
                    ->add('horarioAbertura', 'time', ['label'=>'Horário de Abertura','placeholder'=>'Selecione', 'required'=>false])
                    ->add('horarioFechamento', 'time', ['label'=>'Horário de Fechamento','placeholder'=>'Selecione', 'required'=>false])
                    ->add('intervalorAlmoco', 'choice', ['label'=>'Intervalo de Almoço','choices' =>['1'=>'1h','2'=>'2h'],'placeholder'=>'Selecione', 'required'=>false])
                    ->add('tipoLocal', 'choice', ['label'=>'Tipo do Local','required'=>true,'choices' => Cliente::getAllTiposLocais(), 'placeholder'=>'Selecione'])
                ->end()
            ->end()

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

            ->tab('Responsáveis')
                ->with('Responsáveis')
                    ->add('responsaveis', 'entity', [
                            'label' => 'Responsavel',
                            'class' => 'AppBundle:ResponsavelCliente',
                            'multiple'=>true,
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
                ->end()
            ->end()

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
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $obj = $this->getSubject();


        $showMapper
            ->with('Dados do Cliente',array('class' => 'col-md-6'))
                //->add('tipoPessoa', null, ['label'=>'Tipo de Pessoa']);
                ->add('tipoPessoa','choice',
                    array(
                        'label'=>'Tipo de Pessoa',
                        'choices' => array(
                            'PF' => 'Pessoa Física',
                            'PJ' => 'Pessoa Jurídica',
                        )
                    ));

            if($obj->getTipoPessoa()=='PF'){
                $showMapper
                    ->add('nome', null, ['label'=>'Nome'])
                    ->add('cpfCnpj', null, ['label'=>'CPF'])
                    ->add('filial', 'text', ['label'=>'Filial'])
                ->add('userEnabled','choice',
                    array(
                        'label'=>'Status',
                        'choices' => array(
                            true => 'Ativo',
                            false => 'Inativo',
                        )
                    ));
            }else{
                $showMapper
                    ->add('razaoSocial', null, ['label'=>'Razão Social'])
                    ->add('filial', 'text', ['label'=>'Filial'])
                    ->add('cpfCnpj', null, ['label'=>'CNPJ'])
                    ->add('horarioAbertura', null, ['label'=>'Horário Abertura'])
                    ->add('horarioFechamento', null, ['label'=>'Horário Fechamento'])
                    ->add('intervalorAlmoco','choice',
                        array(
                            'label'=>'Intervalo de Almoço ',
                            'choices' => array(
                                '1' => '1h',
                                '2' => '2h',
                            )
                        ))
                    ->add('tipoLocal','choice',
                        array(
                            'label'=>'Tipo de Local',
                            'choices' => array(
                                'PR' => 'Prédio',
                                'CA' => 'Casa',
                                'SH' => 'Shopping',
                            )
                        ))
                    ->add('userEnabled','choice',
                        array(
                            'label'=>'Status',
                            'choices' => array(
                                true => 'Ativo',
                                false => 'Inativo',
                            )
                        ));
            }

            $showMapper->end()
//                ->with('Telefones',array('class' => 'col-md-6'))
//                ->add('telefones','sonata_type_list', ['label'=>false])
//                ->end()

//            ->with('Endereços',array('class' => 'col-md-6'))
//                ->add('enderecos', 'sonata_type_list', ['label'=>false])
//            ->end()

            ->with('Documentos',array('class' => 'col-md-6'))
                ->add('documentos','sonata_type_list', [
                    'label'=>false,
                    'template'=>'AppBundle:Colaborador:documentos-list.html.twig'
                ])
            ->end()

            ->with('Dados de Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}
