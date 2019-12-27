<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 05/05/15
 * Time: 11:13
 * @copyright Copyright (C) 2015 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace Application\Sonata\UserBundle\Security;

use Symfony\Component\Security\Core\User\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiTokenUserProvider implements UserProviderInterface
{
    /** @var \Symfony\Component\DependencyInjection\ContainerInterface  */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getUsernameForApiToken($apiToken)
    {
        // Look up the username based on the token in the database, via
        // an API call, or do something entirely different
        $um = $this->container->get('sonata.user.user_manager');
        $user = $um->findOneBy(['apiToken' => $apiToken]);

        return $user ? $user->getUsername() : null;
    }

    public function loadUserByUsername($username)
    {
        $um = $this->container->get('sonata.user.user_manager');
        return $um->findUserByUsername($username);
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return 'Application\Sonata\UserBundle\Entity\User' === $class;
    }
} 