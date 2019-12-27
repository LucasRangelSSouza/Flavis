<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 19/05/15
 * Time: 17:06
 * @copyright Copyright (C) 2010 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace AppBundle\Controller;

use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;

class BaseRestAPIController extends FOSRestController
{
    /**
     * Processes the form.
     *
     * @param object            $object
     * @param Request           $request
     * @param FormTypeInterface $formType
     * @param String            $method
     * @param bool              $flush
     *
     * @throws \AppBundle\Exception\InvalidFormException
     * @return object
     *
     */
    protected function processForm($object, Request $request, FormTypeInterface $formType, $method = "PUT", $flush = true)
    {
        $form = $this->createForm($formType, $object, array('method' => $method));
        $form->handleRequest($request, 'PATCH' !== $method);

        if ($form->isValid()) {

            $om = $this->getDoctrine()->getManager();

            $object = $form->getData();
            $om->persist($object);

            if ($flush) {
                $om->flush($object);
            }

            return $object;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }
} 