<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
// DON'T forget this use statement!!!
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * EntradaProduto
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class EntradaProduto
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
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $colaborador;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;

    /**
     * @var Fornecedor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fornecedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fornecedor_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $fornecedor;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ProdutoSaida", cascade={"persist", "remove"}),
     */
    private $produtos;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_xml_content", type="text", nullable=true)
     */
    private $notaXmlContent;

    /**
     * @var string
     *
     * @ORM\Column(name="id_nota", type="string", length=255, nullable=true, unique=false)
     */
    private $idNota;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text", nullable=true)
     */
    private $observacoes;

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
     * Constructor
     */
    public function __construct()
    {
        $this->produtos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set observacoes
     *
     * @param string $observacoes
     * @return EntradaProduto
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string 
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EntradaProduto
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
     * @return EntradaProduto
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
     * @return EntradaProduto
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
     * Add produtos
     *
     * @param \AppBundle\Entity\ProdutoSaida $produtos
     * @return RequisicaoProduto
     */
    public function addProduto(\AppBundle\Entity\ProdutoSaida $produtos)
    {
        $this->produtos[] = $produtos;

        return $this;
    }

    /**
     * Remove produtos
     *
     * @param \AppBundle\Entity\ProdutoSaida $produtos
     */
    public function removeProduto(\AppBundle\Entity\ProdutoSaida $produtos)
    {
        $this->produtos->removeElement($produtos);
    }

    /**
     * Get produtos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return OrcamentoProduto
     */
    public function setColaborador(\AppBundle\Entity\Colaborador $colaborador = null)
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
     * Set notaXmlContent
     *
     * @param string $notaXmlContent
     * @return EntradaProduto
     */
    public function setNotaXmlContent($notaXmlContent)
    {
        $this->notaXmlContent = $notaXmlContent;

        return $this;
    }

    /**
     * Get notaXmlContent
     *
     * @return string 
     */
    public function getNotaXmlContent()
    {
        return $this->notaXmlContent;
    }

    /**
     * Set idNota
     *
     * @param string $idNota
     * @return EntradaProduto
     */
    public function setIdNota($idNota)
    {
        $this->idNota = $idNota;

        return $this;
    }

    /**
     * Get idNota
     *
     * @return string 
     */
    public function getIdNota()
    {
        return $this->idNota;
    }

    /**
     * Set fornecedor
     *
     * @param \AppBundle\Entity\Fornecedor $fornecedor
     * @return EntradaProduto
     */
    public function setFornecedor(\AppBundle\Entity\Fornecedor $fornecedor = null)
    {
        $this->fornecedor = $fornecedor;

        return $this;
    }

    /**
     * Get fornecedor
     *
     * @return \AppBundle\Entity\Fornecedor 
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }


    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return EntradaProduto
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
