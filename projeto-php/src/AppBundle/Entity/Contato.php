<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Contato
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Contato
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
     * @ORM\Column(name="nome", type="string", length=90)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="sobrenome", type="string", length=100)
     */
    private $sobrenome;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=150)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

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
     * @ORM\ManyToMany(targetEntity="Telefone", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $telefones;


    public function __toString()
    {
        return $this->getNome();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->telefones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Contato
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
     * Set sobrenome
     *
     * @param string $sobrenome
     * @return Contato
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Get sobrenome
     *
     * @return string 
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return Contato
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contato
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Contato
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
     * @return Contato
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
     * @return Contato
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
     * Add telefones
     *
     * @param \AppBundle\Entity\Telefone $telefones
     * @return Contato
     */
    public function addTelefone(\AppBundle\Entity\Telefone $telefones)
    {
        $this->telefones[] = $telefones;

        return $this;
    }

    /**
     * Remove telefones
     *
     * @param \AppBundle\Entity\Telefone $telefones
     */
    public function removeTelefone(\AppBundle\Entity\Telefone $telefones)
    {
        $this->telefones->removeElement($telefones);
    }

    /**
     * Get telefones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefones()
    {
        return $this->telefones;
    }
}
