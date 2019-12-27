<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Cidade
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Cidade
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
     * @ORM\Column(name="uf", type="string", length=2)
     */
    private $uf;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100)
     */
    private $nome;

    /**
     * Código do munício segundo a tabela do IBGE.
     *
     * @var string $codigoIbge
     *
     * @ORM\Column(name="codigo_ibge", type="string", length=10, nullable=true)
     */
    private $codigoIbge;

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
        return (string)$this->nome;
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
     * Set uf
     *
     * @param string $uf
     * @return Cidade
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return string 
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Cidade
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
     * Set codigoIbge
     *
     * @param string $codigoIbge
     * @return Cidade
     */
    public function setCodigoIbge($codigoIbge)
    {
        $this->codigoIbge = $codigoIbge;

        return $this;
    }

    /**
     * Get codigoIbge
     *
     * @return string 
     */
    public function getCodigoIbge()
    {
        return $this->codigoIbge;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Cidade
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
     * @return Cidade
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
     * @return Cidade
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
     * @param string $nomePerfil[
     * @return Cidade
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