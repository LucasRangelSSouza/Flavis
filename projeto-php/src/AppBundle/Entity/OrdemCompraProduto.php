<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * OrdemCompraProduto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrdemCompraProduto
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
     * @var Orcamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrcamentoProduto",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orcamento_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $orcamento;

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
     * Aberto
     * Autorizado
     * Cancelado
     * @ORM\Column(name="estado", type="string", length=25)
     */
    private $estado;

    /**
     * @var Fornecedor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fornecedor",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fornecedor_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $fornecedor;


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
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id_autorizou_orcamento", referencedColumnName="id", nullable=true)
     * })
     */
    private $colaboradorQueAutorizou;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="autorizado_em", type="datetime",nullable=true)
     */
    private $autorizadoEm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cancelamento", type="datetime",nullable=true)
     */
    private $dataCancelamento;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ProdutoSaida", cascade={"persist", "remove"}),
     */
    private $produtos;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;


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
     * Set estado
     *
     * @param string $estado
     * @return OrdemCompraProduto
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
     * Set observacoes
     *
     * @param string $observacoes
     * @return OrdemCompraProduto
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
     * @return OrdemCompraProduto
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
     * Set orcamento
     *
     * @param \AppBundle\Entity\OrcamentoProduto $orcamento
     * @return OrdemCompraProduto
     */
    public function setOrcamento(\AppBundle\Entity\OrcamentoProduto $orcamento = null)
    {
        $this->orcamento = $orcamento;

        return $this;
    }

    /**
     * Get orcamento
     *
     * @return \AppBundle\Entity\OrcamentoProduto 
     */
    public function getOrcamento()
    {
        return $this->orcamento;
    }

    /**
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return OrdemCompraProduto
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
     * Set fornecedor
     *
     * @param \AppBundle\Entity\Fornecedor $fornecedor
     * @return OrdemCompraProduto
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
     * Add produtos
     *
     * @param \AppBundle\Entity\ProdutoSaida $produtos
     * @return OrdemCompraProduto
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
     * Set autorizadoEm
     *
     * @param \DateTime $autorizadoEm
     * @return OrdemCompraProduto
     */
    public function setAutorizadoEm($autorizadoEm)
    {
        $this->autorizadoEm = $autorizadoEm;

        return $this;
    }

    /**
     * Get autorizadoEm
     *
     * @return \DateTime 
     */
    public function getAutorizadoEm()
    {
        return $this->autorizadoEm;
    }

    /**
     * Set colaboradorQueAutorizou
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorQueAutorizou
     * @return OrdemCompraProduto
     */
    public function setColaboradorQueAutorizou(\AppBundle\Entity\Colaborador $colaboradorQueAutorizou = null)
    {
        $this->colaboradorQueAutorizou = $colaboradorQueAutorizou;

        return $this;
    }

    /**
     * Get colaboradorQueAutorizou
     *
     * @return \AppBundle\Entity\Colaborador 
     */
    public function getColaboradorQueAutorizou()
    {
        return $this->colaboradorQueAutorizou;
    }

    /**
     * Set dataCancelamento
     *
     * @param \DateTime $dataCancelamento
     * @return OrdemCompraProduto
     */
    public function setDataCancelamento($dataCancelamento)
    {
        $this->dataCancelamento = $dataCancelamento;

        return $this;
    }

    /**
     * Get dataCancelamento
     *
     * @return \DateTime 
     */
    public function getDataCancelamento()
    {
        return $this->dataCancelamento;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return OrdemCompraProduto
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