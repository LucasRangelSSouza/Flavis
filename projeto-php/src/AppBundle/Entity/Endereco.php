<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Endereco
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Endereco
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
     * @var Cliente
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cliente",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=true)
     * })
     */
    public $cliente;

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
     * @var TipoEndereco
     *
     * @ORM\ManyToOne(targetEntity="TipoEndereco")
     */
    private $tipo;

    /**
     * @var Bairro
     *
     * @ORM\ManyToOne(targetEntity="Bairro")
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=150, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=150, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="zoom_mapa", type="string", length=2, nullable=true)
     */
    private $zoomMapa;

    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="string", length=150)
     */
    private $logradouro;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=8)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="complemento", type="string", length=255, nullable=true)
     */
    private $complemento;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=255, nullable=true)
     */
    private $referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     */
    private $observacao;


    ########| METODOS CUSTOMIZADOS |###############################

    public function __toString()
    {
        return (string) ($this->id ? $this->cep : '-');
    }

    ########| FIM - METODOS CUSTOMIZADOS |###############################


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
     * Set logradouro
     *
     * @param string $logradouro
     * @return Endereco
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string 
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Endereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set cep
     *
     * @param string $cep
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = preg_replace('/[^0-9]/m', '', $cep);

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {

        return $this->cep;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     * @return Endereco
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento
     *
     * @return string 
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Endereco
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string 
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     * @return Endereco
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string 
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set tipo
     *
     * @param \AppBundle\Entity\TipoEndereco $tipo
     * @return Endereco
     */
    public function setTipo(\AppBundle\Entity\TipoEndereco $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \AppBundle\Entity\TipoEndereco 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set bairro
     *
     * @param \AppBundle\Entity\Bairro $bairro
     * @return Endereco
     */
    public function setBairro(\AppBundle\Entity\Bairro $bairro = null)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return \AppBundle\Entity\Bairro 
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     * @return Endereco
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return Endereco
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
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getZoomMapa()
    {
        return $this->zoomMapa;
    }

    /**
     * @param string $zoomMapa
     */
    public function setZoomMapa($zoomMapa)
    {
        $this->zoomMapa = $zoomMapa;
    }
}
