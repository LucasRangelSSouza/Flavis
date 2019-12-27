<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AgendamentoOrdemServico
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class AgendamentoOrdemServico
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
     * @var OrdemServico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="os_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $os;

    /**
     * @var ResponsavelCliente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ResponsavelCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="solicitante_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $solicitante;

    /**
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $colaborador;

    /**
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_executor_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $colaboradorExecutor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataAgendada", type="datetime")
     */
    private $dataAgendada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaAgendada", type="time")
     */
    private $horaAgendada;

    /**
     * @var string
     *
     * @ORM\Column(name="ocorrencia", type="text")
     */
    private $ocorrencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tem_relatorio", type="boolean", nullable=true, options={"default"=0})
     */
    private $temRelatorio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;


    public function __toString()
    {
        return (string) ($this->id ? $this->id : '-');
    }



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
     * Set dataAgendada
     *
     * @param \DateTime $dataAgendada
     * @return AgendamentoOrdemServico
     */
    public function setDataAgendada($dataAgendada)
    {
        $this->dataAgendada = $dataAgendada;

        return $this;
    }

    /**
     * Get dataAgendada
     *
     * @return \DateTime 
     */
    public function getDataAgendada()
    {
        return $this->dataAgendada;
    }

    /**
     * Set horaAgendada
     *
     * @param \DateTime $horaAgendada
     * @return AgendamentoOrdemServico
     */
    public function setHoraAgendada($horaAgendada)
    {
        $this->horaAgendada = $horaAgendada;

        return $this;
    }

    /**
     * Get horaAgendada
     *
     * @return \DateTime 
     */
    public function getHoraAgendada()
    {
        return $this->horaAgendada;
    }

    /**
     * Set ocorrencia
     *
     * @param string $ocorrencia
     * @return AgendamentoOrdemServico
     */
    public function setOcorrencia($ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;

        return $this;
    }

    /**
     * Get ocorrencia
     *
     * @return string 
     */
    public function getOcorrencia()
    {
        return $this->ocorrencia;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AgendamentoOrdemServico
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return AgendamentoOrdemServico
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return AgendamentoOrdemServico
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set os
     *
     * @param \AppBundle\Entity\OrdemServico $os
     * @return AgendamentoOrdemServico
     */
    public function setOs(\AppBundle\Entity\OrdemServico $os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return \AppBundle\Entity\OrdemServico 
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set solicitante
     *
     * @param \AppBundle\Entity\ResponsavelCliente $solicitante
     * @return AgendamentoOrdemServico
     */
    public function setSolicitante(\AppBundle\Entity\ResponsavelCliente $solicitante)
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    /**
     * Get solicitante
     *
     * @return \AppBundle\Entity\ResponsavelCliente 
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return AgendamentoOrdemServico
     */
    public function setColaborador(\AppBundle\Entity\Colaborador $colaborador = null)
    {
        $this->colaborador = $colaborador;

        return $this;
    }

    /**
     * Get colaborador
     *
     * @return \AppBundle\Entity\Colaborador 
     */
    public function getColaborador()
    {
        return $this->colaborador;
    }

    /**
     * Set colaboradorExecutor
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorExecutor
     * @return AgendamentoOrdemServico
     */
    public function setColaboradorExecutor(\AppBundle\Entity\Colaborador $colaboradorExecutor)
    {
        $this->colaboradorExecutor = $colaboradorExecutor;

        return $this;
    }

    /**
     * Get colaboradorExecutor
     *
     * @return \AppBundle\Entity\Colaborador 
     */
    public function getColaboradorExecutor()
    {
        return $this->colaboradorExecutor;
    }

    /**
     * Set temRelatorio
     *
     * @param boolean $temRelatorio
     * @return AgendamentoOrdemServico
     */
    public function setTemRelatorio($temRelatorio)
    {
        $this->temRelatorio = $temRelatorio;

        return $this;
    }

    /**
     * Get temRelatorio
     *
     * @return boolean 
     */
    public function getTemRelatorio()
    {
        return $this->temRelatorio;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return AgendamentoOrdemServico
     */
    public function setNomePerfil($nomePerfil)
    {
        $this->nomePerfil = $nomePerfil;

        return $this;
    }

    /**
     * Get nomePerfil
     *
     * @return string
     */
    public function getNomePerfil()
    {
        return $this->nomePerfil;
    }
}