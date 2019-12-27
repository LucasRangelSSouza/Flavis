<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Admin\BaseFieldDescription;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Controller\CRUDController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ExecucaoDeProcedimentosEquipamentoCRUDController extends BaseController
{

    public function listprocedimentosAction(Request $request = null)
    {
        $request = $this->resolveRequest();

        $dataCalendario = $request->get('date');
        $cliente = $request->get('cliente');

        $em = $this->get('doctrine.orm.entity_manager');
        $pmocModel = $this->get('pmoc_model');

        $cliente = $em->getRepository('AppBundle:Cliente')->find($cliente);

        if ($dataCalendario == '') {
            $this->addFlash('sonata_flash_error', 'Data incorreta. Verifique se este parâmetro foi passado!');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        if (!$cliente) {
            $this->addFlash('sonata_flash_error', 'Cliente não encontrado');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }


        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $preResponse = $this->preList($request);

        if ($preResponse !== null) {
            return $preResponse;
        }

        if ($listMode = $request->get('_list_mode')) {
            $this->admin->setListMode($listMode);
        }

        $dataToCalendario = array();
        $datagrid = $this->admin->getDatagrid();

        $dataCalendario = ($dataCalendario != '') ? new \DateTime($dataCalendario) : $dataCalendario = new \DateTime();

        $procedimentos = $pmocModel->getProcedimentosPorClienteNaData($cliente, $dataCalendario, $this->container);

        // set the theme for the current Admin Form
        $formView = $datagrid->getForm()->createView();

        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('AppBundle:CRUD:list_pmoc_agenda_procedimentos.html.twig', array(
            'action' => 'list',
            'form' => $formView,
            'datagrid' => $datagrid,
            'dataToCalendario' => $procedimentos,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
            'data_calendario' => $dataCalendario->format('Y-m-d'),
            'id_cliente' => $cliente->getId(),
            'nome_cliente' => $cliente->getNome()
        ), null, $request);

    }

    public function listAction(Request $request = null)
    {
        $request = $this->resolveRequest();
        $em = $this->get('doctrine.orm.entity_manager');
        $pmocModel = $this->get('pmoc_model');

        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $preResponse = $this->preList($request);

        if ($preResponse !== null) {
            return $preResponse;
        }

        if ($listMode = $request->get('_list_mode')) {
            $this->admin->setListMode($listMode);
        }

        $datagrid = $this->admin->getDatagrid();
        //$query = $datagrid->getQuery();

        $dataToCalendario = array();

        $dataCalendario = $request->get('date');
        $dataCalendario = ($dataCalendario != '') ? new \DateTime($dataCalendario) : $dataCalendario = new \DateTime();
        $idClientes = array();
        $idEquipamentos = array();
        $idClienteEquipamento = array();
        $procedimentosDoMes = $pmocModel->getProcedimentosNoMes($dataCalendario, $this->container);
        if (count($procedimentosDoMes) > 0) {
            foreach ($procedimentosDoMes as $procedimento) {
//                if (!in_array($procedimento->getClienteEquipamento()->getEquipamento()->getId(), $idEquipamentos) ||
//                    (in_array($procedimento->getClienteEquipamento()->getEquipamento()->getId(), $idEquipamentos)
//                        && !in_array($procedimento->getClienteEquipamento()->getCliente()->getId(), $idClientes))
//                    || (in_array($procedimento->getClienteEquipamento()->getEquipamento()->getId(), $idEquipamentos)
//                        && in_array($procedimento->getClienteEquipamento()->getCliente()->getId(), $idClientes))) {
//
//                        $dataToCalendario[] = $procedimento;
//                        $idEquipamentos[] = $procedimento->getClienteEquipamento()->getEquipamento()->getId();
//                        $idClientes[] = $procedimento->getClienteEquipamento()->getCliente()->getId();
//
//                }
            if (((!in_array($procedimento->getClienteEquipamento()->getEquipamento()->getId(), $idEquipamentos) &&
                !in_array($procedimento->getClienteEquipamento()->getCliente()->getId(), $idClientes)) ||
                (in_array($procedimento->getClienteEquipamento()->getEquipamento()->getId(), $idEquipamentos) &&
                    !in_array($procedimento->getClienteEquipamento()->getCliente()->getId(), $idClientes)) ||
                (!in_array($procedimento->getClienteEquipamento()->getEquipamento()->getId(), $idEquipamentos) &&
                    in_array($procedimento->getClienteEquipamento()->getCliente()->getId(), $idClientes)) ||
                    (!in_array($procedimento->getClienteEquipamento()->getId(), $idClienteEquipamento))) && $procedimento->getObservacao()== 'FALSE') {
                        $dataToCalendario[] = $procedimento;
                        $idEquipamentos[] = $procedimento->getClienteEquipamento()->getEquipamento()->getId();
                        $idClientes[] = $procedimento->getClienteEquipamento()->getCliente()->getId();
                        $idClienteEquipamento[] = $procedimento->getClienteEquipamento()->getId();
                }
            }
        }

        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('AppBundle:CRUD:list_pmoc_agenda.html.twig', array(
            'action' => 'list',
            'form' => $formView,
            'datagrid' => $datagrid,
            'dataToCalendario' => $dataToCalendario,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
            'data_calendario' => $dataCalendario->format('Y-m-d')
        ), null, $request);

    }

    /**
     * To keep backwards compatibility with older Sonata Admin code.
     *
     * @internal
     */
    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }



    // OKOK = Que tal listar todos os clientes que tem procedimentos dentro do mês atual?
    // E toda vez que clicar no próximo mes recarregar a págia com o mês para recolocar?
    // Ao clicar em um cliente
    //        $sql = "SELECT cli,ec,exe FROM AppBundle:Cliente cli
    //        JOIN cli.equipamentos ec JOIN ec.execucoesProcedimentos exe
    //        WHERE exe.dataAgendadaExecucao >='{$dataCalendario->format('Y-m-d')}'
    //        AND SIZE(ec.execucoesProcedimentos) > 0";
    //
    //$queryResult = $em->createQuery($sql);
    //if(count($queryResult)>0){
    //
    //    // Para cada cliente, pego os procedimentos de cada um neste mês
    //foreach ( $queryResult as $cliente) {
    //
    //$procedimentosDesteCliente = $pmocModel->getProcedimentosClienteNoMes($cliente, $dataCalendario,$this->container);
    //exit('No');
    //if(count($procedimentosDesteCliente)>0){
    //exit('OKok');
    ////                    foreach ($procedimentosDesteCliente as $procedimento) {
    ////                        $dataToCalendario[]=$procedimento;
    ////                    }
    //}
    //
    //}
    //
    //exit('OK');
    //}

}