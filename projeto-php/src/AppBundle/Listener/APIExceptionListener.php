<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 13/11/15
 * Time: 16:47
 * @copyright Copyright (C) 2015 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class APIExceptionListener
{
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		// do whatever tests you need - in this example I filter by path prefix
		$path = $event->getRequest()->getRequestUri();
		if (strpos($path, '/api/') === 0) {
			return;
		}

		$exception = $event->getException();

		// Customize your response object to display the exception details
		$response = new JsonResponse();
		$response->setData([
			'error' 	=> true,
			'message'   => $exception->getMessage()
		]);

		// HttpExceptionInterface is a special type of exception that
		// holds status code and header details
		if ($exception instanceof HttpExceptionInterface) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
		} else {
			$response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
		}

		// Send the modified response object to the event
		$event->setResponse($response);
	}
} 