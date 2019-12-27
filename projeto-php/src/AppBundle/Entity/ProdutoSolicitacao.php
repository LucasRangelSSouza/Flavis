<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProdutoSolicitacao
 *
 * Entidade utilizada para relacionar produtos, fornecedor e orcamento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProdutoSolicitacao
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
     * @var Produto
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
     * @ORM\Column(name="valor", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer",options={"default":1}, nullable=false)
     */
    private $quantidade = 1;


    public function __toString()
    {
        return (string) ($this->id ? $this->getProduto()->getTitulo() : '-');
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
     * @return ProdutoSolicitacao
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
     * Set produto
     *
     * @param \AppBundle\Entity\ProdutoAlmoxarifado $produto
     * @return ProdutoSolicitacao
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
     * Set fornecedor
     *
     * @param \AppBundle\Entity\Fornecedor $fornecedor
     * @return ProdutoSolicitacao
     */
    public function setFornecedor(\AppBundle\Entity\Fornecedor $fornecedor)
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
     * Set quantidade
     *
     * @param integer $quantidade
     * @return ProdutoSolicitacao
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
}
