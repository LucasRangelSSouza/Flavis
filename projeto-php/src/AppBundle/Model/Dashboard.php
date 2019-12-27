<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;

class Dashboad
{
    protected $em;

    /**
     * @param UserInterface $user
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    public function totalOsAbertas()
    {
        //$os = $this->em->getRepository('AppBundle:OrdemServico')->findAll();
//
//        $sql = "SELECT o FROM AppBundle:OrdemServico o
//        WHERE cliente in(:clientes)";
//
//        $query = $this->em->createQuery($sql);
//
//        $usuarioLogado = $this->getClienteLogado();
//
//        $query->setParameters([
//            'isHomologada' => TRUE,
//            'clientes' => $usuarioLogado->getClientes()->toArray()
//        ]);
//
//        $os = $query->getResult();
//
//        return str_pad(count($os),6,0,STR_PAD_LEFT);

        return 0;
    }

    public function totalOsFechadas()
    {
        $os = $this->em->getRepository('AppBundle:OrdemServico')->findAll();
        return str_pad(count($os),6,0,STR_PAD_LEFT);
    }

    public function totalOsHomologadas()
    {
        $os = $this->em->getRepository('AppBundle:OrdemServico')->findAll();
        return str_pad(count($os),6,0,STR_PAD_LEFT);
    }

    private function getClienteLogado()
    {
        $clienteModel  = $this->container->get('cliente_model');
        $usuarioLogado = $clienteModel->getUsuarioClienteByUsuario($this->container);

        return $usuarioLogado;
    }

}