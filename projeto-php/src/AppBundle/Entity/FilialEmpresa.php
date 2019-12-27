<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FilialEmpresa
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\HasLifecycleCallbacks()
 */
class FilialEmpresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=120)
     */
    private $nome;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="UnidadeFederativa", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $estadosAbrangencia;

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
     * @ORM\Column(name="nome_perfil", type="string", length=150)
     */
    private $nomePerfil;


    public function __toString()
    {
        return (string) ($this->id ? $this->nome : '-');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estadosAbrangencia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nome
     *
     * @param string $nome
     * @return FilialEmpresa
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilialEmpresa
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
     * @return FilialEmpresa
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
     * @return FilialEmpresa
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
     * Add estadosAbrangencia
     *
     * @param \AppBundle\Entity\UnidadeFederativa $estadosAbrangencia
     * @return FilialEmpresa
     */
    public function addEstadosAbrangencium(\AppBundle\Entity\UnidadeFederativa $estadosAbrangencia)
    {
        $this->estadosAbrangencia[] = $estadosAbrangencia;

        return $this;
    }

    /**
     * Remove estadosAbrangencia
     *
     * @param \AppBundle\Entity\UnidadeFederativa $estadosAbrangencia
     */
    public function removeEstadosAbrangencium(\AppBundle\Entity\UnidadeFederativa $estadosAbrangencia)
    {
        $this->estadosAbrangencia->removeElement($estadosAbrangencia);
    }

    /**
     * Get estadosAbrangencia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstadosAbrangencia()
    {
        return $this->estadosAbrangencia;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return FilialEmpresa
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
