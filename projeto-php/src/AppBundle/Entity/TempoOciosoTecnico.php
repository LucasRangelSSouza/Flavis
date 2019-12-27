<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TempoOciosoTecnico
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TempoOciosoTecnico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Colaborador
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tecnico_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tecnico;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=false)
     */
    private $observacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="tempo_gasto", type="integer")
     *
     */
    private $tempoGasto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_hora_atividade", type="datetime", nullable=true)
     */
    private $dataHoraAtividade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TempoOciosoTecnico
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return Colaborador
     */
    public function getTecnico()
    {
        return $this->tecnico;
    }

    /**
     * @param Colaborador $tecnico
     */
    public function setTecnico($tecnico)
    {
        $this->tecnico = $tecnico;
    }

    /**
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param string $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }

    /**
     * @return int
     */
    public function getTempoGasto()
    {
        return $this->tempoGasto;
    }

    /**
     * @param int $tempoGasto
     */
    public function setTempoGasto($tempoGasto)
    {
        $this->tempoGasto = $tempoGasto;
    }

    /**
     * @return \DateTime
     */
    public function getDataHoraAtividade()
    {
        return $this->dataHoraAtividade;
    }

    /**
     * @param \DateTime $dataHoraAtividade
     */
    public function setDataHoraAtividade($dataHoraAtividade)
    {
        $this->dataHoraAtividade = $dataHoraAtividade;
    }

}
