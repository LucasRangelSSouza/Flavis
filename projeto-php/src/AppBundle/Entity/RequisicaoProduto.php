<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RequisicaoProduto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RequisicaoProduto
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
     * @var OrdemServico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="os_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $os;

    /**
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id", referencedColumnName="id", nullable=true)
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
     * @var string
     * Aberto
     * Cancelado
     * Orcando
     * @ORM\Column(name="estado", type="string", length=25)
     */
    private $estado;

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
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ProdutoSaida", cascade={"persist", "remove"}),
     */
    private $produtos;


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
     * @return RequisicaoProduto
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
     * @return RequisicaoProduto
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
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return RequisicaoProduto
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
     * Set estado
     *
     * @param string $estado
     * @return RequisicaoProduto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set os
     *
     * @param \AppBundle\Entity\OrdemServico $os
     * @return RequisicaoProduto
     */
    public function setOs(\AppBundle\Entity\OrdemServico $os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return \AppBundle\Entity\OrdemServico 
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return RequisicaoProduto
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
