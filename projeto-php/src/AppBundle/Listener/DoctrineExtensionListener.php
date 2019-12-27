<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 10/04/15
 * Time: 00:08
 * @copyright Copyright (C) 2010 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace AppBundle\Listener;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class DoctrineExtensionListener implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $securityContext = $this->container->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        if (null !== $securityContext && null !== $securityContext->getToken() && $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $blameable = $this->container->get('gedmo.listener.blameable');
            $blameable->setUserValue($securityContext->getToken()->getUser());
        }
    }
} 