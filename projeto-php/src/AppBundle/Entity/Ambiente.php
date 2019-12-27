<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * Ambiente
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Ambiente
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
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150)
     */
    private $titulo;

    /**
     * @var integer //var decimal
     *
     * @ORM\Column(name="area", type="integer", nullable=false) //type="decimal", precision=12, scale=2
     */
    private $area;

    /**
     * @var integer
     *
     * @ORM\Column(name="ocupante_fixo", type="integer", nullable=false)
     */
    private $ocupanteFixo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ocupante_flutuante", type="integer", nullable=false)
     */
    private $ocupanteFlutuante;

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
     * @ORM\Column(name="nome_perfil", type="text", nullable=true)
     */
    private $nomePerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=5)
     */
    private $sigla;

//    /**
//     * @var Localizacao
//     *
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Localizacao",cascade={"persist"})
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="localizacao_id", referencedColumnName="id", nullable=false)
//     * })
//     */
//    private $localizacao;

    /**
     * @var Localizacao
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Localizacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localizacao_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $localizacao;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     */
    private $observacao;

    /**
     * @var Colaborador
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $colaborador;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\EquipamentoCliente", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $equipamentos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true, options={"default"=0})
     */
    private $habilitado;


    public function __toString()
    {
        return (string)$this->titulo;
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
     * Set titulo
     *
     * @param string $titulo
     * @return Ambiente
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }


    /**
     * Set area
     *
     * @param integer $area
     * @return Ambiente
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return integer
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set ocupanteFixo
     *
     * @param integer $ocupanteFixo
     * @return Ambiente
     */
    public function setOcupanteFixo($ocupanteFixo)
    {
        $this->ocupanteFixo = $ocupanteFixo;

        return $this;
    }

    /**
     * Get ocupanteFixo
     *
     * @return integer
     */
    public function getOcupanteFixo()
    {
        return $this->ocupanteFixo;
    }

    /**
     * Set ocupanteFlutuante
     *
     * @param integer $ocupanteFlutuante
     * @return Ambiente
     */
    public function setOcupanteFlutuante($ocupanteFlutuante)
    {
        $this->ocupanteFlutuante = $ocupanteFlutuante;

        return $this;
    }

    /**
     * Get ocupanteFlutuante
     *
     * @return integer
     */
    public function getOcupanteFlutuante()
    {
        return $this->ocupanteFlutuante;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Ambiente
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
     * @return Ambiente
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
     * @return Ambiente
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
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return Ambiente
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

    /**
     * Set sigla
     *
     * @param string $sigla
     * @return Ambiente
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

//    /**
//     * Set localizacao
//     *
//     * @param \AppBundle\Entity\localizacao $localizacao
//     * @return Ambiente
//     */
//    public function setLocalizacao(\AppBundle\Entity\Localizacao $localizacao = null)
//    {
//        $this->localizacao = $localizacao;
//
//        return $this;
//    }
//
//    /**
//     * Get localizacao
//     *
//     * @return \AppBundle\Entity\localizacao
//     */
//    public function getLocalizacao()
//    {
//        return $this->localizacao;
//    }

    /**
     * Set localizacao
     *
     * @param \AppBundle\Entity\Localizacao $localizacao
     * @return Ambiente
     */
    public function setLocalizacao(\AppBundle\Entity\Localizacao $localizacao)
    {
        $this->localizacao = $localizacao;

        return $this;
    }

    /**
     * Get localizacao
     *
     * @return \AppBundle\Entity\Localizacao
     */
    public function getLocalizacao()
    {
        return $this->localizacao;
    }

    /**
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return Ambiente
     */
    public function setColaborador(\AppBundle\Entity\Colaborador $colaborador)
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
     * Set observacao
     *
     * @param string $observacao
     * @return Ambiente
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return Ambiente
     */
    public function setHabilitado($habilitado)//era para ser setInativado
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean
     */
    public function getHabilitado()//era para ser getInativado
    {
        return $this->habilitado;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipamentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add equipamentos
     *
     * @param \AppBundle\Entity\EquipamentoCliente $equipamentos
     * @return Ambiente
     */
    public function addEquipamento(\AppBundle\Entity\EquipamentoCliente $equipamentos)
    {
        $this->equipamentos[] = $equipamentos;

        return $this;
    }

    /**
     * Remove equipamentos
     *
     * @param \AppBundle\Entity\EquipamentoCliente $equipamentos
     */
    public function removeEquipamento(\AppBundle\Entity\EquipamentoCliente $equipamentos)
    {
        $this->equipamentos->removeElement($equipamentos);
    }

    /**
     * Get equipamentos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipamentos()
    {
        return $this->equipamentos;
    }

    /**
     * Add equipamentos
     *
     * @param \AppBundle\Entity\EquipamentoCliente $equipamentos
     * @return Ambiente
     */
    public function addEquipamentoi(\AppBundle\Entity\EquipamentoCliente $equipamentos)
    {
        $this->equipamentos[] = $equipamentos;

        return $this;
    }

    /**
     * Remove equipamentos
     *
     * @param \AppBundle\Entity\EquipamentoCliente $equipamentos
     */
    public function removeEquipamentoi(\AppBundle\Entity\EquipamentoCliente $equipamentos)
    {
        $this->equipamentos->removeElement($equipamentos);
    }

//    /**
//     * Add equipamentos
//     *
//     * @param \AppBundle\Entity\EquipamentoCliente $equipamentos
//     * @return Ambiente
//     */
//    public function addEquipamento(\AppBundle\Entity\EquipamentoCliente $equipamentos)
//    {
//        $this->equipamentos[] = $equipamentos;
//
//        return $this;
//    }
//
//    /**
//     * Remove equipamentos
//     *
//     * @param \AppBundle\Entity\EquipamentoCliente $equipamentos
//     */
//    public function removeEquipamento(\AppBundle\Entity\EquipamentoCliente $equipamentos)
//    {
//        $this->equipamentos->removeElement($equipamentos);
//    }
//
//    /**
//     * Get equipamentos
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getEquipamentos()
//    {
//        return $this->equipamentos;
//    }
}