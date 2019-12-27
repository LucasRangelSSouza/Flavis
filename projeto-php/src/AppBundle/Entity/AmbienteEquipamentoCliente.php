<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AmbienteEquipamentoCliente
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class AmbienteEquipamentoCliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

//    /**
//     * @var Localizacao
//     *
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Localizacao",cascade={"persist"})
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="localizacao_id", referencedColumnName="id", nullable=false)
//     * })
//     */
//    private $localizacaoEquipamento;

    /**
     * @var EquipamentoCliente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EquipamentoCliente",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipamento_cliente_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $equipamento;

    /**
     * @var Ambiente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ambiente",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ambiente_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $ambiente;

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


    public function __toString()
    {
        return (string) ($this->id ? $this->getEquipamento()->getAmbienteEquipamento()->getTitulo() . ' - ' .
            $this->getEquipamento()->getAmbienteEquipamento()->getLocalizacao()->getTitulo() : '-');
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

//    /**
//     * Set localizacaoEquipamento
//     *
//     * @param \AppBundle\Entity\Localizacao $localizacaoEquipamento
//     * @return AmbienteEquipamentoCliente
//     */
//    public function setLocalizacaoEquipamento(\AppBundle\Entity\Localizacao $localizacaoEquipamento)
//    {
//        $this->localizacaoEquipamento = $localizacaoEquipamento;
//
//        return $this;
//    }
//
//    /**
//     * Get localizacaoEquipamento
//     *
//     * @return \AppBundle\Entity\Localizacao
//     */
//    public function getLocalizacaoEquipamento()
//    {
//        return $this->localizacaoEquipamento;
//    }

    /**
     * Set equipamento
     *
     * @param \AppBundle\Entity\EquipamentoCliente $equipamento
     * @return AmbienteEquipamentoCliente
     */
    public function setEquipamento(\AppBundle\Entity\EquipamentoCliente $equipamento = null)
    {
        $this->equipamento = $equipamento;

        return $this;
    }

    /**
     * Get equipamento
     *
     * @return \AppBundle\Entity\EquipamentoCliente
     */
    public function getEquipamento()
    {
        return $this->equipamento;
    }

    /**
     * Set ambiente
     *
     * @param \AppBundle\Entity\Ambiente $ambiente
     * @return AmbienteEquipamentoCliente
     */
    public function setAmbiente(\AppBundle\Entity\Ambiente $ambiente)
    {
        $this->ambiente = $ambiente;

        return $this;
    }

    /**
     * Get ambiente
     *
     * @return \AppBundle\Entity\Ambiente
     */
    public function getAmbiente()
    {
        return $this->ambiente;
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
     * @return AmbienteEquipamentoCliente
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
     * @return AmbienteEquipamentoCliente
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
}