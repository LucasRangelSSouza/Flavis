<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FerramentaAlmoxarifado
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class FerramentaAlmoxarifado
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
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $status = false;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;


    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer")
     */
    private $quantidade;

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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Documento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $documentos;


    public function __toString()
    {
        return (string) ($this->id ? $this->titulo : '-');
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set status
     *
     * @param boolean $status
     * @return FerramentaAlmoxarifado
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return FerramentaAlmoxarifado
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
     * Set quantidade
     *
     * @param integer $quantidade
     * @return FerramentaAlmoxarifado
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return integer 
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FerramentaAlmoxarifado
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
     * @return FerramentaAlmoxarifado
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
     * @return FerramentaAlmoxarifado
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
     * Add documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     * @return FerramentaAlmoxarifado
     */
    public function addDocumento(\AppBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\AppBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return FerramentaAlmoxarifado
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
