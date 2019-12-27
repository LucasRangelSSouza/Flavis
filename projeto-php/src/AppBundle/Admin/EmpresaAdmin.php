<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class EmpresaAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(ErrorElement $errorElement, $object)
    {
        if($object->getRazaoSocial() == ''){
            $errorElement->with('razaoSocial')->addViolation('Atenção, preencha o campo')->end();
        }
//        if(preg_match("/[^a-zA-Z]/m", $object->getRazaoSocial()) == 1){
//            $errorElement->with('razaoSocial')->addViolation('Atenção, o campo razão social não pode conter: espaços, números e caracteres especiais')->end();
//        }
        if($object->getCnpj() == ''){
            $errorElement->with('cnpj')->addViolation('Atenção, preencha o campo CNPJ')->end();
        }

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $empresas = $em->getRepository('AppBundle:Empresa')->findAll(array(),array('nome' => 'ASC'));
//        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();

        if ($this->getSubject()->getId() == null) {

            foreach($empresas as $empresa) {

                if ($empresa->getCnpj() == $object->getCnpj()) {
                    $errorElement->with('cnpj')->addViolation('Atenção, CNPJ informado já cadastrado')->end();
                }

                if ($empresa->getRazaoSocial() == $object->getRazaoSocial()) {
                    $errorElement->with('razaoSocial')->addViolation('Atenção, Razão Social informada já cadastrado')->end();
                }
            }

        }


        if (!$this->valida_cnpj($object->getCnpj())) {
            $errorElement->with('cnpj')->addViolation('Atenção, CNPJ informado inválido')->end();
        }

//        $perfis = $em->getRepository('AppBundle:Perfil')->findAll();
//
//        foreach ($perfis as $perfil) {
//            if ($perfil->getEmpresa()->getId() == $object->getId()) {
//                $errorElement->addViolation('Atenção, não pode ser excluída enquanto existir perfil relacionado!')->end();
//                break;
//            }
//        }
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

    public function prePersist($image) {
        if ($image->getFile()) {
            $this->manageFileUpload($image);
            $image->setPathFoto('/uploads/logo/' . $image->getFile()->getClientOriginalName());
        }
    }

    public function preUpdate($image) {
        if ($image->getFile()) {
            $this->manageFileUpload($image);
            $image->setPathFoto('/uploads/logo/' . $image->getFile()->getClientOriginalName());
        }
    }

    private function manageFileUpload($image) {
        if ($image->getFile()) {
          $image->lifecycleFileUpload();
        }
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('AppBundle:Custom:custom_one_to_many.html.twig')
        );
    }

//    public function preUpdate($object)
//    {
//        foreach($this->getForm()->get('perfis') as $perfil){
//            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.perfil')->preUpdate($perfil);
//        }
//    }
//
//    public function prePersist($object)
//    {
//        foreach($this->getForm()->get('perfis') as $perfil){
//            $this->getConfigurationPool()->getAdminByAdminCode('app.admin.perfil')->prePersist($perfil);
//        }
//    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $empresa2 = $em->getRepository('AppBundle:Empresa')->findAll(array(),array('razaoSocial' => 'ASC'));

        $empresa2ToFilter = array();

        foreach($empresa2 as $empresa) {
            $empresa2ToFilter[$empresa->getRazaoSocial()] = $empresa->getRazaoSocial();
        }


        $datagridMapper
            ->add('id',null,['label'=>'Código'])
            ->add('cnpj',null, ['label'=>'CNPJ','attr' => ['class' => 'mask_cnpj']])
            ->add('razaoSocial','doctrine_orm_string', array('label'=>'Razão Social'), 'choice',
                array('choices' => $empresa2ToFilter))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null,['label'=>'Código'])
            ->add('razaoSocial',null,['label' => 'Razão Social'])
            ->add('cnpj', null, ['label'=>'CNPJ'])
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
//        $formMapper
//            ->tab('Geral')
//            ->with('Geral', array('class' => 'col-md-6'))->end()
//            ->end()
//        ;

        $colaborador = $this->getSubject();
        $fileFieldOptions['data_class'] = null;
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Logo da Empresa (PNG, JPG, JPEG)';
        $fileFieldOptions['attr'] = ['class' => 'foto'];

        if($colaborador->getPathFoto()!=''){
            $fileFieldOptions['help'] = '<img src="'.$this->getRequest()->getScheme() . '://' . $this->getRequest()->getHttpHost() . $this->getRequest()->getBasePath().$colaborador->getPathFoto().'" class="admin-preview img-thumbnail"/>';
        }


        $formMapper
//            ->tab('Geral')
                ->with('Geral')
                    ->add('cnpj',null, ['label'=>'CNPJ', 'attr' => ['class' => 'mask_cnpj'], 'required'=>true])
                    ->add('razaoSocial',null, ['label'=>'Razão Social', 'required'=>true])
                    ->add('cnae',null, ['label'=>'CNAE'])
                    ->add('file', 'file',$fileFieldOptions)
                ->end()
//            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados da Empresa')
                ->add('id')
                ->add('cnpj',null, ['label'=>'CNPJ'])
                ->add('razaoSocial',null, ['label'=>'Razão Social'])
                ->add('cnae',null, ['label'=>'CNAE'])
            ->end()
            ->with('Dados do Cadastro',array('class' => 'col-md-6'))
                ->add('createdAt',null, ['label'=>'Data de Cadastro'])
                ->add('updatedAt',null, ['label'=>'Última alteração'])
            //                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end()
        ;
    }
}