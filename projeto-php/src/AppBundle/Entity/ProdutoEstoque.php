<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProdutoEstoque
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ProdutoEstoque
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
     * @var Produto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProdutoAlmoxarifado",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $produto;

    /**
     * @var string
     *
     * @ORM\Column(name="quantidade", type="integer")
     */
    private $quantidade;


    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ProdutoEstoque
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
     * @return ProdutoEstoque
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
     * @return ProdutoEstoque
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
     * Set produto
     *
     * @param \AppBundle\Entity\ProdutoAlmoxarifado $produto
     * @return ProdutoEstoque
     */
    public function setProduto(\AppBundle\Entity\ProdutoAlmoxarifado $produto = null)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return \AppBundle\Entity\ProdutoAlmoxarifado 
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set quantidade
     *
     * @param integer $quantidade
     * @return ProdutoEstoque
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
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return ProdutoEstoque
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
