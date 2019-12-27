<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * OrcamentoProduto
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\Uploadable(path="uploads/copias-orcamento", filenameGenerator="SHA1")
 */
class OrcamentoProduto
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_prevista_entrega", type="datetime",nullable=true)
     */
    private $dataPrevistaEntrega;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_entrega", type="datetime",nullable=true)
     */
    private $dataEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string",length=155)
     */
    private $estado;

    /**
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id_enviou_orcamento", referencedColumnName="id", nullable=true)
     * })
     */
    private $colaboradorQueEnviouOrcamento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enviado_para_orcar_em", type="datetime",nullable=true)
     */
    private $enviadoParaOrcarEm;

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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ProdutoSolicitacao",
     * inversedBy="solicitacoesProduto",cascade={"persist","remove"})
     */
    private $produtos;

    /**
     * @var string
     *
     * @ORM\Column(name="pathFoto", type="string", length=255,nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $pathFoto;
    private $oldPathFoto;


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
     * Set pathFoto
     *
     * @param string $pathFoto
     * @return ProdutoAlmoxarifado
     */
    public function setPathFoto($pathFoto)
    {
        if (empty($this->oldPathFoto)) {
            $this->oldPathFoto = $this->pathFoto;
        }

        // Se nada foi enviado no form
        if($this->pathFoto=='') {
            $this->pathFoto = $pathFoto;
        }

        return $this;
    }

    /**
     * Get pathFoto
     *
     * @return string
     */
    public function getPathFoto()
    {
        return $this->pathFoto;
    }

    /**
     * Set oldAvatar
     *
     * @param string $oldAvatar
     * @return Produto
     */
    public function setOldPathFoto($oldPathFoto)
    {
        $this->oldPathFoto = $oldPathFoto;

        return $this;
    }

    /**
     * Get oldPathFoto
     *
     * @return string
     */
    public function getOldPathFoto()
    {
        return $this->oldPathFoto;
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
     * @return OrcamentoProduto
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
     * Add produtos
     *
     * @param \AppBundle\Entity\ProdutoSolicitacao $produtos
     * @return OrcamentoProduto
     */
    public function addProduto(\AppBundle\Entity\ProdutoSolicitacao $produtos)
    {
        $this->produtos[] = $produtos;

        return $this;
    }

    /**
     * Remove produtos
     *
     * @param \AppBundle\Entity\ProdutoSolicitacao $produtos
     */
    public function removeProduto(\AppBundle\Entity\ProdutoSolicitacao $produtos)
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
     * Set enviadoParaOrcarEm
     *
     * @param \DateTime $enviadoParaOrcarEm
     * @return OrcamentoProduto
     */
    public function setEnviadoParaOrcarEm($enviadoParaOrcarEm)
    {
        $this->enviadoParaOrcarEm = $enviadoParaOrcarEm;

        return $this;
    }

    /**
     * Get enviadoParaOrcarEm
     *
     * @return \DateTime 
     */
    public function getEnviadoParaOrcarEm()
    {
        return $this->enviadoParaOrcarEm;
    }

    /**
     * Set autorizadoEm
     *
     * @param \DateTime $autorizadoEm
     * @return OrcamentoProduto
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
     * Set dataCancelamento
     *
     * @param \DateTime $dataCancelamento
     * @return OrcamentoProduto
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OrcamentoProduto
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
     * Set colaboradorQueEnviouOrcamento
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorQueEnviouOrcamento
     * @return OrcamentoProduto
     */
    public function setColaboradorQueEnviouOrcamento(\AppBundle\Entity\Colaborador $colaboradorQueEnviouOrcamento = null)
    {
        $this->colaboradorQueEnviouOrcamento = $colaboradorQueEnviouOrcamento;

        return $this;
    }

    /**
     * Get colaboradorQueEnviouOrcamento
     *
     * @return \AppBundle\Entity\Colaborador 
     */
    public function getColaboradorQueEnviouOrcamento()
    {
        return $this->colaboradorQueEnviouOrcamento;
    }

    /**
     * Set colaboradorQueAutorizou
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorQueAutorizou
     * @return OrcamentoProduto
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
     * Set dataPrevistaEntrega
     *
     * @param \DateTime $dataPrevistaEntrega
     * @return OrcamentoProduto
     */
    public function setDataPrevistaEntrega($dataPrevistaEntrega)
    {
        $this->dataPrevistaEntrega = $dataPrevistaEntrega;

        return $this;
    }

    /**
     * Get dataPrevistaEntrega
     *
     * @return \DateTime 
     */
    public function getDataPrevistaEntrega()
    {
        return $this->dataPrevistaEntrega;
    }

    /**
     * Set dataEntrega
     *
     * @param \DateTime $dataEntrega
     * @return OrcamentoProduto
     */
    public function setDataEntrega($dataEntrega)
    {
        $this->dataEntrega = $dataEntrega;

        return $this;
    }

    /**
     * Get dataEntrega
     *
     * @return \DateTime 
     */
    public function getDataEntrega()
    {
        return $this->dataEntrega;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return OrcamentoProduto
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
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return OrcamentoProduto
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
