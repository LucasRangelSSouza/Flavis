<?php
/**
 * Created by Logics Tecnologia e Serviços LTDA.
 * @author: Romeu Godoi <romeu@logics.com.br>
 * Date: 11/06/15
 * Time: 17:34
 * @copyright Copyright (C) 2015 LogicSITE. Todos os Direitos Reservados.
 * LogicSITE. Este software é de propriedade exclusiva da LOGICS TEC. E SERV. LTDA
 * e seu uso só pode ser dado por usuários licenciados por escrito.
 * O uso indevido desta plataforma, ou parte dela estará sujeita a penalidades
 * previstas em lei, conforme legislação pertinente.
 */

namespace AppBundle\Model;

use Application\Sonata\UserBundle\Model\UserInterface;
use Doctrine\ORM\EntityManagerInterface;


class Aviso
{
    protected $user;

    protected $em;

    /**
     * @param UserInterface $user
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserInterface $user, EntityManagerInterface $entityManager)
    {
        $this->user = $user;
        $this->em = $entityManager;
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getMeusAvisos($limit = null)
    {
        $colaborador = $this->user->getColaborador();
        $avisos = [];

        if ($colaborador instanceof \AppBundle\Entity\Colaborador) {

            // Buscar os avisos do colaborador
            $avisos = $this->em->getRepository('AppBundle:Aviso')->findAvisosPendentesDoColaborador($colaborador, $limit);
        }

        return $avisos;
    }

	public function avisosPrevistosParaNotificacao()
	{
		$fases = array();

		$query = $this->em->createQuery("SELECT a FROM AppBundle:Aviso a WHERE a.dataNotificacao IS NOT NULL");

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
}