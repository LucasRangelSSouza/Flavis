<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 01/12/15
 * Time: 15:14
 * @copyright Copyright (C) 2015 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace AppBundle\Model;

use AppBundle\AppBundle;
use AppBundle\Entity\StatusFase;
use Doctrine\ORM\EntityManagerInterface;

class FaseDetalhe
{
	protected $em;

	/**
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->em = $entityManager;
	}

	public function fasesPrevistasParaNotificacao()
	{
		$fases = array();

		$query = $this->em->createQuery("SELECT s FROM AppBundle:StatusFase s WHERE s.diasNotificacaoPrevia IS NOT NULL");

		/** @var StatusFase $status */
		foreach ($query->getResult() as $status) {
			$dataPrevista = new \DateTime();
			$dataPrevista->add(new \DateInterval("P{$status->getDiasNotificacaoPrevia()}D"));

			$fasesANotificar = $this->getPrevistasPorStatus($dataPrevista, $status);

			foreach ($fasesANotificar as $fase) {
				if ($fase instanceof \AppBundle\Entity\FaseDetalhe) {
					$fases[] = $fase;
				}
			}
		}

		return $fases;
	}

	public function getPrevistasPorStatus(\DateTime $dataPrevista, StatusFase $status)
	{
		$query = $this->em->createQuery("
			SELECT fd FROM AppBundle:FaseDetalhe fd JOIN fd.status s JOIN fd.projeto p
			WHERE fd.previsaoTermino = :dataPrevista
			AND s.id = :status
		");
		$query->setParameters([
			'dataPrevista' => $dataPrevista->format('Y-m-d'),
			'status' => $status
		]);

		$query->setFetchMode('AppBundle:Projeto', 'responsaveis', 'EAGER');

		return $query->getResult();
	}
} 