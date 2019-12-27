<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CidadeAdmin extends Admin
{

    /* Validações Fundamentais */
    public function validate(\Sonata\CoreBundle\Validator\ErrorElement $errorElement, $object)
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

        $cidades = $em->getRepository('AppBundle:Cidade')->findAll();

        if ($this->getSubject()->getId() == null) {

            foreach ($cidades as $cidade) {

                if ($cidade->getUf() == $object->getUf()) {
                    if ($cidade->getNome() == $object->getNome()) {
                        $errorElement->with('nome')->addViolation('Atenção, já existe uma cidade cadastrada com este nome')->end();
                    }
                }

                if ($object->getCodigoIbge() != '') {
                    if ($cidade->getCodigoIbge() == $object->getCodigoIbge()) {
                        $errorElement->with('codigoIbge')->addViolation('Atenção, já existe uma cidade cadastrada com este codigo Ibge')->end();
                    }
                }

            }

        } else {

            foreach ($cidades as $cidade) {

                if ($cidade->getId() !== $object->getId()) {

                    if ($cidade->getUf() == $object->getUf()) {
                        if ($cidade->getNome() == $object->getNome()) {
                            $errorElement->with('nome')->addViolation('Atenção, já existe uma cidade cadastrado com este nome')->end();
                        }
                    }

                    if($object->getCodigoIbge() != '') {
                        if ($cidade->getCodigoIbge() == $object->getCodigoIbge()) {
                            $errorElement->with('codigoIbge')->addViolation('Atenção, já existe uma cidade cadastrado com este codigo Ibge')->end();
                        }
                    }

                }

            }
        }


        $object->setNomePerfil($perfilToFilter);

    }


    // Removendo ações da lista
    public
    function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected
    function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $cidades = $em->getRepository('AppBundle:Cidade')->findAll();
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll();

        $cidadesToFilter = array();

        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();


        foreach ($colaboradores as $colaborador) {
            if ($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        foreach ($cidades as $cidade) {
            if ($cidade->getNomePerfil() == $perfilToFilter) {
                $cidadesToFilter[$cidade->getNome()] = $cidade->getNome();
            }
        }

        $datagridMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('uf')
            ->add('nome', 'doctrine_orm_string', array('label' => 'Nome'), 'choice',
                array('choices' => $cidadesToFilter))
            ->add('codigoIbge');
    }

//    public
//    function createQuery($context = 'list')
//    {
//        $query = parent::createQuery($context);
//
//        if (FALSE == $this->isGranted('ROLE_SUPER_ADMIN')) {
//
//            $container = $this->getConfigurationPool()->getContainer();
//            $em = $container->get('doctrine.orm.default_entity_manager');
//
//            $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(), array('nome' => 'ASC'));
//
//            $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
//
//            $perfilToFilter = array();
//
//            foreach ($colaboradores as $colaborador) {
//                if ($colaborador->getUser() == $colaboradorLogado) {
//                    $perfilToFilter = $colaborador->getNomePerfil();
//                }
//            }
//
//            // OS com esses clientes. Esses clientes são os que estão vinculados ao usuário criado pela Flavis no sistema.
//            $query->andWhere(
//                $query->expr()->in($query->getRootAlias() . '.nomePerfil', ':perfl')
//            );
//
//            $query->setParameters([
//                'perfl' => $perfilToFilter
//            ]);
//
//        }
//
//        return $query;
//    }

    /**
     * @param ListMapper $listMapper
     */
    protected
    function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, ['label' => 'Código'])
            ->add('uf')
            ->add('nome')
            ->add('codigoIbge')
//            ->add('_action', 'actions', array(
//                'actions' => array(
//                    'show' => array(),
//                    'edit' => array(),
////                    'delete' => array(),
//                )
//            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected
    function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('uf', 'choice',
                array(
                    'choices' => array(
                        "AC" => "Acre",
                        "AL" => "Alagoas",
                        "AM" => "Amazonas",
                        "AP" => "Amapá",
                        "BA" => "Bahia",
                        "CE" => "Ceará",
                        "DF" => "Distrito Federal",
                        "ES" => "Espírito Santo",
                        "GO" => "Goiás",
                        "MA" => "Maranhão",
                        "MT" => "Mato Grosso",
                        "MS" => "Mato Grosso do Sul",
                        "MG" => "Minas Gerais",
                        "PA" => "Pará",
                        "PB" => "Paraíba",
                        "PR" => "Paraná",
                        "PE" => "Pernambuco",
                        "PI" => "Piauí",
                        "RJ" => "Rio de Janeiro",
                        "RN" => "Rio Grande do Norte",
                        "RO" => "Rondônia",
                        "RS" => "Rio Grande do Sul",
                        "RR" => "Roraima",
                        "SC" => "Santa Catarina",
                        "SE" => "Sergipe",
                        "SP" => "São Paulo",
                        "TO" => "Tocantins"
                    ),
                    'label' => 'UF',
                    'placeholder' => 'Selecione'
                )
            )
            ->add('nome')
            ->add('codigoIbge');
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected
    function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Dados da Cidade', array('class' => 'col-md-6'))
                ->add('id', null, ['label' => 'Código'])
                ->add('uf')
                ->add('nome')
                ->add('codigoIbge')
            ->end()
            ->with('Dados do Cadastro', array('class' => 'col-md-6'))
                ->add('createdAt', null, ['label' => 'Data de Cadastro'])
                ->add('updatedAt', null, ['label' => 'Última alteração'])
//                ->add('deletedAt',null, ['label'=>'Data de exclusão'])
            ->end();
    }
}