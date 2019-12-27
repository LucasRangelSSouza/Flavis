<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProdutoSaida
 *
 * Entidade utilizada para relacionar Requisição de produtos com Produtos no Almoxarifado
 * E também utilizada para relacionar Produtos com compra
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProdutoSaida
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
     * @var decimal
     *
     * @ORM\Column(name="quantidade", type="decimal", precision=10, scale=2 ,options={"default":1.000}, nullable=false)
     */
    private $quantidade = 1.000;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;


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
     * Set produto
     *
     * @param \AppBundle\Entity\ProdutoAlmoxarifado $produto
     * @return ProdutoSaida
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
     * @return ProdutoSaida
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
     * Set valor
     *
     * @param string $valor
     * @return ProdutoSaida
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
}
