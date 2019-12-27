<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/*
 * Classe para OS
 */
class ClienteCRUDController extends Controller
{

    public function etiquetaAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Objeto não localizado');
        }

        $em = $this->get('doctrine.orm.default_entity_manager');
        $pmocModel = $this->get('relatorio_pmoc_model');

        // Pegando todos os equipemantos de cliente

        $sql = "SELECT ce FROM AppBundle:ClienteEquipamento ce
                JOIN  ce.equipamento e
                WHERE ce.cliente=:cliente
                ";

        $query = $em->createQuery($sql);

        $query->setParameters([
            'cliente' => $object
        ]);

        $equipamentosCliente = $query->getResult();

        if(!count($equipamentosCliente)) {
            $this->addFlash('sonata_flash_error', 'Este cliente não possui equipamento cadastrado.');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        return $this->render('AppBundle:Cliente:etiquetas-equipamentos.html.twig',
            array(
                'cliente' => $object,
                'equipamentos' => $equipamentosCliente,
            )
        );

    }

}