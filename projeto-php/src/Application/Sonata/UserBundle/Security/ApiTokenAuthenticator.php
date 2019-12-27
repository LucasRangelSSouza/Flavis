<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 05/05/15
 * Time: 10:30
 * @copyright Copyright (C) 2015 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace Application\Sonata\UserBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiTokenAuthenticator implements SimplePreAuthenticatorInterface
{
    protected $userProvider;

    public function __construct(ApiTokenUserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function createToken(Request $request, $providerKey)
    {
        // or if you want to use an "apiToken" header, then do something like this:
        $apiToken = $request->headers->get('apiToken');

        if (!$apiToken) {
            throw new BadCredentialsException('No API key found');
        }

        return new PreAuthenticatedToken(
            'anon.',
            $apiToken,
            $providerKey
        );
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiToken = $token->getCredentials();
        $username = $this->userProvider->getUsernameForapiToken($apiToken);

        if (!$username) {
            throw new AuthenticationException(
                sprintf('API Key "%s" does not exist.', $apiToken)
            );
        }

        $user = $this->userProvider->loadUserByUsername($username);

        return new PreAuthenticatedToken(
            $user,
            $apiToken,
            $providerKey,
            $user->getRoles()
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }
} 