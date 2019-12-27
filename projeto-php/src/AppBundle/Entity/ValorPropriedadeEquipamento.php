<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * ValorPropriedadeEquipamento
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ValorPropriedadeEquipamento
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
     * @var TituloValorPropriedadeEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TituloValorPropriedadeEquipamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="titulo_valor_propriedade_equipamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $titulo;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

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
        return (string) ($this->id ? $this->getTitulo() . '=>' . $this->getValor() : '-');
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
     * Set valor
     *
     * @param string $valor
     * @return ValorPropriedadeEquipamento
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ValorPropriedadeEquipamento
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
     * @return ValorPropriedadeEquipamento
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
     * @return ValorPropriedadeEquipamento
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
     * @param \AppBundle\Entity\TituloValorPropriedadeEquipamento $titulo
     * @return ValorPropriedadeEquipamento
     */
    public function setTitulo(\AppBundle\Entity\TituloValorPropriedadeEquipamento $titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return \AppBundle\Entity\TituloValorPropriedadeEquipamento 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return UnidadeFederativa
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