<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;

class Perfil
{
    protected $em;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager = null)
    {
        $this->em = ($entityManager) ? $entityManager : null;
    }

    public function getUsuarioClienteByUsuario($context)
    {
        $usuario = $this->getUserLogged($context);

        $dql = "SELECT uc FROM AppBundle:UsuarioCliente uc
        WHERE uc.user= :usuario";

        $query = $this->em->createQuery($dql);
        $query->setParameter('usuario',$usuario);

        $usuario = $query->getResult();

        if(!$usuario){
            return false;
        }

        return $usuario[0];
    }

    public function getUserLogged($container)
    {
        return $container
            ->get('security.context')
            ->getToken()
            ->getUser();
    }
} 