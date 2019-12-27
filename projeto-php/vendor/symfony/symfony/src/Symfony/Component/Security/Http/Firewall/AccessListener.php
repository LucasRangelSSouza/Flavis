<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Http\Firewall;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Http\AccessMapInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * AccessListener enforces access control rules.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class AccessListener extends ContainerAware implements ListenerInterface
{
    /**
     * @return \Sonata\AdminBundle\Admin\Pool
     */
    protected function getAdminPool()
    {
        return $this->container->get('sonata.admin.pool');//Call to a member function get() on null
    }

    private function perfilLogado()
    {
        $container = $this->getAdminPool()->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $colaboradores = $em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $container->get('security.context')->getToken()->getUser();
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        return $perfilToFilter;
    }
    private $context;
    private $accessDecisionManager;
    private $map;
    private $authManager;

    public function __construct(SecurityContextInterface $context, AccessDecisionManagerInterface $accessDecisionManager, AccessMapInterface $map, AuthenticationManagerInterface $authManager)
    {
        $this->context = $context;
        $this->accessDecisionManager = $accessDecisionManager;
        $this->map = $map;
        $this->authManager = $authManager;
    }

    /**
     * Handles access authorization.
     *
     * @param GetResponseEvent $event A GetResponseEvent instance
     *
     * @throws AccessDeniedException
     * @throws AuthenticationCredentialsNotFoundException
     */
    public function handle(GetResponseEvent $event)
    {
        if (null === $token = $this->context->getToken()) {
            throw new AuthenticationCredentialsNotFoundException('A Token was not found in the SecurityContext.');
        }

        $request = $event->getRequest();

        list($attributes) = $this->map->getPatterns($request);

        if (null === $attributes) {
            return;
        }

        if (!$token->isAuthenticated()) {
//            echo 'Rastreabilidade! 2º. Usuário autenticando!                             ';
            $token = $this->authManager->authenticate($token);
            $this->context->setToken($token);
        }

//        $perfilLogado = $this->perfilLogado();
//        echo 'Rastreabilidade! 1º. Inicializa tela de login em AccessListener (handle) - perfil logado: sem perfil                            ';
        if (!$this->accessDecisionManager->decide($token, $attributes, $request)) {
            throw new AccessDeniedException();
        }
    }
}
