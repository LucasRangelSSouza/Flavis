<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AgendamentoManutencaoEquipamento
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class AgendamentoManutencaoEquipamento
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
     * @var PropriedadeEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PropriedadeEquipamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="propriedade_equipamento", referencedColumnName="id", nullable=true)
     * })
     */
    private $propriedadeEquipamento;

    /**
     * @var TituloAgendamentoManutencaoEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TituloAgendamentoManutencaoEquipamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="titulo_agendamento_manutencao_equipamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="periodicidade", type="integer")
     */
    private $periodicidade;

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
        return (string) ($this->id ? $this->getTitulo()->getTitulo() : '-');
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
     * Set periodicidade
     *
     * @param string $periodicidade
     * @return AgendamentoManutencaoEquipamento
     */
    public function setPeriodicidade($periodicidade)
    {
        $this->periodicidade = $periodicidade;

        return $this;
    }

    /**
     * Get periodicidade
     *
     * @return string 
     */
    public function getPeriodicidade()
    {
        return $this->periodicidade;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AgendamentoManutencaoEquipamento
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
     * @return AgendamentoManutencaoEquipamento
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
     * @return AgendamentoManutencaoEquipamento
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
     * Set titulo
     *
     * @param \AppBundle\Entity\TituloAgendamentoManutencaoEquipamento $titulo
     * @return AgendamentoManutencaoEquipamento
     */
    public function setTitulo(\AppBundle\Entity\TituloAgendamentoManutencaoEquipamento $titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return \AppBundle\Entity\TituloAgendamentoManutencaoEquipamento 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set propriedadeEquipamento
     *
     * @param \AppBundle\Entity\PropriedadeEquipamento $propriedadeEquipamento
     * @return AgendamentoManutencaoEquipamento
     */
    public function setPropriedadeEquipamento(\AppBundle\Entity\PropriedadeEquipamento $propriedadeEquipamento = null)
    {
        $this->propriedadeEquipamento = $propriedadeEquipamento;

        return $this;
    }

    /**
     * Get propriedadeEquipamento
     *
     * @return \AppBundle\Entity\PropriedadeEquipamento 
     */
    public function getPropriedadeEquipamento()
    {
        return $this->propriedadeEquipamento;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return AgendamentoManutencaoEquipamento
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