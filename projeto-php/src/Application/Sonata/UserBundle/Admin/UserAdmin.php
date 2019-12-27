<?php
/**
 * Created by PhpStorm.
 * User: romeu
 * Date: 18/02/15
 * Time: 12:37
 */

namespace Application\Sonata\UserBundle\Admin;


use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends \Sonata\UserBundle\Admin\Model\UserAdmin
{
    protected $baseRouteName = 'app_user';
    protected $baseRoutePattern = 'user';

    // Removendo ações da lista
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // define group zoning
        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Alteração de Senha', array('class' => 'col-md-6'))->end()
//                ->with('Status', array('class' => 'col-md-4'))->end()
//                ->with('Groups', array('class' => 'col-md-6'))->end()
                ->with('Permissões', array('class' => 'col-md-6'))->end()
            ;
        }else{
            $formMapper
                ->with('Alteração de Senha', array('class' => 'col-md-6'))->end()
            ;
        }

        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Alteração de Senha')
                    ->add('username')
                    ->add('email')
                    ->add('plainPassword', 'password', array(
                        'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
                    ))
                ->end()
            ;
        }else{
            $formMapper
                ->with('Alteração de Senha')
//                    ->add('username')
//                    ->add('email')
                    ->add('plainPassword', 'password', array(
                        'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
                    ))
                ->end()
            ;
        }

//        if (TRUE === $this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
        if (TRUE === $this->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Status')
                    ->add('locked', null, array('required' => false))
                    ->add('expired', null, array('required' => false))
                    ->add('enabled', null, array('required' => false))
                    ->add('credentialsExpired', null, array('required' => false))
                ->end()
                ->with('Groups')
                    ->add('groups', 'sonata_type_model', array(
                        'required' => false,
                        'expanded' => true,
                        'multiple' => true
                    ))
                ->end()
               ->with('Permissões')
                    ->add('realRoles', 'sonata_security_roles', array(
                        'label'    => 'form.label_roles',
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false
                    ))
                ->end()
            ;
        }
    }
} 