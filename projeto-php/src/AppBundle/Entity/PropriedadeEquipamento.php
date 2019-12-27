<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PropriedadeEquipamento
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class PropriedadeEquipamento
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
     * @var boolean
     *
     * @ORM\Column(name="is_etiqueta", type="boolean", nullable=true, options={"default"=0})
     */
    private $isEtiqueta;

    /**
     * @var TituloPropriedadeEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TituloPropriedadeEquipamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="titulo_propriedade_equipamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $titulo;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ValorPropriedadeEquipamento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $valores;

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
     * Constructor
     */
    public function __construct()
    {
        $this->valores = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PropriedadeEquipamento
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
     * @return PropriedadeEquipamento
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
     * @return PropriedadeEquipamento
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
     * @param \AppBundle\Entity\TituloPropriedadeEquipamento $titulo
     * @return PropriedadeEquipamento
     */
    public function setTitulo(\AppBundle\Entity\TituloPropriedadeEquipamento $titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return \AppBundle\Entity\TituloPropriedadeEquipamento 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Add valores
     *
     * @param \AppBundle\Entity\ValorPropriedadeEquipamento $valores
     * @return PropriedadeEquipamento
     */
    public function addValor(\AppBundle\Entity\ValorPropriedadeEquipamento $valores)
    {
        $this->valores[] = $valores;

        return $this;
    }

    /**
     * Remove valores
     *
     * @param \AppBundle\Entity\ValorPropriedadeEquipamento $valores
     */
    public function removeValor(\AppBundle\Entity\ValorPropriedadeEquipamento $valores)
    {
        $this->valores->removeElement($valores);
    }

    /**
     * Get valores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValores()
    {
        return $this->valores;
    }

    /**
     * Add valores
     *
     * @param \AppBundle\Entity\ValorPropriedadeEquipamento $valores
     * @return PropriedadeEquipamento
     */
    public function addValore(\AppBundle\Entity\ValorPropriedadeEquipamento $valores)
    {
        $this->valores[] = $valores;

        return $this;
    }

    /**
     * Remove valores
     *
     * @param \AppBundle\Entity\ValorPropriedadeEquipamento $valores
     */
    public function removeValore(\AppBundle\Entity\ValorPropriedadeEquipamento $valores)
    {
        $this->valores->removeElement($valores);
    }

    /**
     * Set isEtiqueta
     *
     * @param boolean $isEtiqueta
     * @return PropriedadeEquipamento
     */
    public function setIsEtiqueta($isEtiqueta)
    {
        $this->isEtiqueta = $isEtiqueta;

        return $this;
    }

    /**
     * Get isEtiqueta
     *
     * @return boolean 
     */
    public function getIsEtiqueta()
    {
        return $this->isEtiqueta;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return Bairro
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