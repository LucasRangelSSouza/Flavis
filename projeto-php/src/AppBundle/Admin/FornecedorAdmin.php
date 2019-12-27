<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class FornecedorAdmin extends Admin
{


    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
    {
        if ($object->getRazaoSocial() == '') {
            $errorElement->with('razaoSocial')->addViolation('Atenção, preencha o campo nom razão social')->end();
        }
        if ($object->getCnpj() == '..-') {
            $errorElement->with('cnpj')->addViolation('Atenção, preencha o campo CNPJ')->end();
        }

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $fornecedores = $em->getRepository('AppBundle:Fornecedor')->findAll();
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }
        $object->setNomePerfil($perfilToFilter);

        if ($this->getSubject()->getId() == null) {

            foreach ($fornecedores as $fornecedor) {

                if ($fornecedor->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                    if ($fornecedor->getCnpj() == $object->getCnpj()) {
                        $errorElement->with('cnpj')->addViolation('Atenção, CNPJ informado já cadastrado')->end();
                    }

                    if ($fornecedor->getRazaoSocial() == $object->getRazaoSocial()) {
                        $errorElement->with('razaoSocial')->addViolation('Atenção, Razão Social informada já cadastrado')->end();
                    }

                }

            }

        } else {

            foreach ($fornecedores as $fornecedor) {

                if ($fornecedor->getId() !== $object->getId()) {
                    if ($fornecedor->getNomePerfil() == $colaboradorLogado->getNomePerfil()) {

                        if ($fornecedor->getRazaoSocial() == $object->getRazaoSocial()) {
                            $errorElement->with('razaoSocial')->addViolation('Atenção, Razão Social informada já cadastrado')->end();
                        }

                        if ($fornecedor->getCnpj() == $object->getCnpj()) {
                            $errorElement->with('cnpj')->addViolation('Atenção, CNPJ informado já cadastrado')->end();
                        }

                    }
                }

            }
        }

        if (!$this->valida_cnpj($object->getCnpj())) {
            $errorElement->with('cnpj')->addViolation('Atenção, CNPJ informado inválido')->end();
        }

    }

    function valida_cnpj($cnpj)
    {
        // Deixa o CNPJ com apenas números
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Garante que o CNPJ é uma string
        $cnpj = (string)$cnpj;

        // O valor original
        $cnpj_original = $cnpj;

        // Captura os primeiros 12 números do CNPJ
        $primeiros_numeros_cnpj = substr($cnpj, 0, 12);

        /**
         * Multiplicação do CNPJ
         *
         * @param string $cnpj Os digitos do CNPJ
         * @param int $posicoes A posição que vai iniciar a regressão
         * @return int O
         *
         */
        if (!function_exists('multiplica_cnpj')) {
            function multiplica_cnpj($cnpj, $posicao = 5)
            {
                // Variável para o cálculo
                $calculo = 0;

                // Laço para percorrer os item do cnpj
                for ($i = 0; $i < strlen($cnpj); $i++) {
                    // Cálculo mais posição do CNPJ * a posição
                    $calculo = $calculo + ($cnpj[$i] * $posicao);

                    // Decrementa a posição a cada volta do laço
                    $posicao--;

                    // Se a posição for menor que 2, ela se torna 9
                    if ($posicao < 2) {
                        $posicao = 9;
                    }
                }
                // Retorna o cálculo
                return $calculo;
            }
        }

        // Faz o primeiro cálculo
        $primeiro_calculo = multiplica_cnpj($primeiros_numeros_cnpj);

        // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
        // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
        $primeiro_digito = ($primeiro_calculo % 11) < 2 ? 0 : 11 - ($primeiro_calculo % 11);

        // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
        // Agora temos 13 números aqui
        $primeiros_numeros_cnpj .= $primeiro_digito;

        // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
        $segundo_calculo = multiplica_cnpj($primeiros_numeros_cnpj, 6);
        $segundo_digito = ($segundo_calculo % 11) < 2 ? 0 : 11 - ($segundo_calculo % 11);

        // Concatena o segundo dígito ao CNPJ
        $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

        // Verifica se o CNPJ gerado é idêntico ao enviado
        if ($cnpj === $cnpj_original) {
            return true;
        } else {
            return false;
        }
    }


    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }


    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

    public function preUpdate($object)
    {
        foreach ($this->getForm()->get('documentos') as $documento) {
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->preUpdate($documento);
        }

        foreach ($this->getForm()->get('enderecos') as $endereco) {
            $param = ['objeto' => $endereco, 'fornecedor' => $object, 'tipo' => 'fornecedor'];
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.endereco')->preUpdate($param);
        }

    }

    public function prePersist($object)
    {
        foreach ($this->getForm()->get('documentos') as $documento) {
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.documento')->prePersist($documento);
        }

        foreach ($this->getForm()->get('enderecos') as $endereco) {
            $param = ['objeto' => $endereco, 'fornecedor' => $object, 'tipo' => 'fornecedor'];
            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.endereco')->preUpdate($param);
        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $fornecedores = $em->getRepository('AppBundle:Fornecedor')->findAll(array(), array('nomeFantasia' => 'ASC'));
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
        $fornecedorLogado = $container->get('security.context')->getToken()->getUser();


        $fornecedorToFilter = array();

        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $fornecedorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach ($fornecedores as $fornecedor) {
            if ($fornecedor->getNomePerfil() == $perfilToFilter) {
                $fornecedorToFilter[$fornecedor->getRazaoSocial()] = $fornecedor->getRazaoSocial();
            }
        }


        $datagridMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('cnpj', null, ['label' => 'CNPJ', 'attr' => ['class' => 'mask_cnpj']])
//            ->add('nomeFantasia',null, ['label'=>'Nome Fantasia'])
//            ->add('nomeFantasia','doctrine_orm_string', array('label'=>'Nome Fantasia'), 'choice',
//                array('choices' => $fornecedor1ToFilter))
            ->add('razaoSocial', 'doctrine_orm_string', array('label' => 'Razão Social'), 'choice',
                array('choices' => $fornecedorToFilter));
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

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
//        echo $perfilToFilter;

        // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
        $query->andWhere(
            $query->expr()->in($query->getRootAlias() . '.nomePerfil', ':perfl')
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
            ->add('razaoSocial', null, ['label' => 'Razão Social'])
//            ->add('nomeFantasia', null, ['label' => 'Nome Fantasia'])
            ->add('cnpj', null, ['label' => 'CNPJ'])
            ->add('telefone', null, ['label' => 'Telefone'])
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
        $formMapper
            ->tab('Fornecedor')
				->with('Fornecedor', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Endereço')
				->with('Endereços', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Documento')
				->with('Documentos', array('class' => 'col-md-6'))->end()
            ->end();

        if ($this->getSubject()->getId()) {

            $formMapper
                ->tab('Fornecedor')
					->with('Fornecedor')
						->add('cnpj', null, ['label' => 'CNPJ','read_only' => true, 'disabled' => true])
						->add('nomeFantasia', null, ['label' => 'Nome Fantasia'])
						->add('razaoSocial', null, ['label' => 'Razão Social'])
						->add('inscricaoEstadual', null, ['label' => 'Inscrição Estadual'])
						->add('inscricaoMunicipal', null, ['label' => 'Inscrição Municipal'])
						->add('email', null, ['label' => 'E-mail'])
						->add('telefone', null, ['label' => 'Telefone', 'attr' => ['class' => 'mask_telefone']])
						->add('nomeVendedor', null, ['label' => 'Nome do vendedor'])
						->add('observacao', null, ['label' => 'Observações'])
					->end()
                ->end()
                ->tab('Endereço')
					->with('Endereços')
						->add('enderecos', 'sonata_type_collection',
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
                ->end()
                ->tab('Documento')
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
                ->end();
        } else {
            $formMapper
                ->tab('Fornecedor')
					->with('Fornecedor')
						->add('cnpj', null, ['label' => 'CNPJ', 'attr' => ['class' => 'mask_cnpj']])
						->add('nomeFantasia', null, ['label' => 'Nome Fantasia'])
						->add('razaoSocial', null, ['label' => 'Razão Social'])
						->add('inscricaoEstadual', null, ['label' => 'Inscrição Estadual'])
						->add('inscricaoMunicipal', null, ['label' => 'Inscrição Municipal'])
						->add('email', null, ['label' => 'E-mail'])
						->add('telefone', null, ['label' => 'Telefone', 'attr' => ['class' => 'mask_telefone']])
						->add('nomeVendedor', null, ['label' => 'Nome do vendedor'])
						->add('observacao', null, ['label' => 'Observações'])
					->end()
				->end()
				->tab('Endereço')
					->with('Endereços')
						->add('enderecos', 'sonata_type_collection',
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
				->end()
				->tab('Documento')
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
                ->end();
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados do Fornecedor', array('class' => 'col-md-6'))
				->add('cnpj', null, ['label' => 'CNPJ'])
				->add('razaoSocial', null, ['label' => 'Razão Social'])
				->add('nomeFantasia', null, ['label' => 'Nome Fantasia'])
				->add('email', null, ['label' => 'E-mail'])
				->add('inscricaoEstadual', null, ['label' => 'Inscrição Estadual'])
				->add('inscricaoMunicipal', null, ['label' => 'Inscrição Municipal'])
				->add('telefone', null, ['label' => 'Telefone'])
				->add('nomeVendedor', null, ['label' => 'Nome do Vendedor'])
//                ->add('enderecos', 'sonata_type_list', ['label'=>false])
//                ->add('documentos','sonata_type_list', [
//                    'label'=>false,
//                    'template'=>'AppBundle:Colaborador:documentos-list.html.twig'
//                ])
            ->end()
            ->with('Endereços', array('class' => 'col-md-6'))
				->add('enderecos', 'sonata_type_list', ['label' => false])
            ->end()
            ->with('Documentos', array('class' => 'col-md-6'))
				->add('documentos', 'sonata_type_list', [
					'label' => false,
					'template' => 'AppBundle:Colaborador:documentos-list.html.twig'
				])
            ->end()
            ->with('Dados do Cadastro', array('class' => 'col-md-6'))
				->add('createdAt', null, ['label' => 'Data de Cadastro'])
				->add('updatedAt', null, ['label' => 'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end();
    }
}
