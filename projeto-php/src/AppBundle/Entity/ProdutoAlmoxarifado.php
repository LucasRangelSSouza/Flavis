<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProdutoAlmoxarifado
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Uploadable(path="uploads/fotos-produtos-almoxarifado", filenameGenerator="SHA1")
 */
class ProdutoAlmoxarifado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $status = false;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="unidade_medida", type="string", length=10, nullable=true)
     */
    private $unidadeMedida;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=255, nullable=true)
     */
    private $departamento;

    /**
     * @var string
     *
     * @ORM\Column(name="pathFoto", type="string", length=255,nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $pathFoto;
    private $oldPathFoto;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_fabricante", type="string", length=100)
     */
    private $codigoFabricante;

    /**
     * @var string
     *
     * @ORM\Column(name="seccao", type="string", length=10)
     */
    private $seccao;

    /**
     * @var string
     *
     * @ORM\Column(name="prateleira", type="string", length=10)
     */
    private $prateleira;

    /**
     * @var string
     *
     * @ORM\Column(name="divisao", type="string", length=10)
     */
    private $divisao;

    /**
     * @var string
     *
     * @ORM\Column(name="caixa", type="string", length=10)
     */
    private $caixa;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade_minima", type="integer",options={"default":1})
     */
    private $quantidadeMinima = 1;

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
     * @ORM\ManyToMany(targetEntity="Documento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $documentos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_ocorencia", type="boolean", nullable=true, options={"default"=0})
     */
    private $tipoOcorencia = false;


    public function __toString()
    {
        return (string) ($this->id ? $this->titulo : '-');
    }

    public function getTituloAmplo()
    {
        return
        $this->getTitulo() . ' - ' .
        $this->getCodigoFabricante();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set seccao
     *
     * @param string $seccao
     * @return ProdutoAlmoxarifado
     */
    public function setSeccao($seccao)
    {
        $this->seccao = $seccao;

        return $this;
    }

    /**
     * Get seccao
     *
     * @return string 
     */
    public function getSeccao()
    {
        return $this->seccao;
    }

    /**
     * Set prateleira
     *
     * @param string $prateleira
     * @return ProdutoAlmoxarifado
     */
    public function setPrateleira($prateleira)
    {
        $this->prateleira = $prateleira;

        return $this;
    }

    /**
     * Get prateleira
     *
     * @return string 
     */
    public function getPrateleira()
    {
        return $this->prateleira;
    }

    /**
     * Set divisao
     *
     * @param string $divisao
     * @return ProdutoAlmoxarifado
     */
    public function setDivisao($divisao)
    {
        $this->divisao = $divisao;

        return $this;
    }

    /**
     * Get divisao
     *
     * @return string 
     */
    public function getDivisao()
    {
        return $this->divisao;
    }

    /**
     * Set caixa
     *
     * @param string $caixa
     * @return ProdutoAlmoxarifado
     */
    public function setCaixa($caixa)
    {
        $this->caixa = $caixa;

        return $this;
    }

    /**
     * Get caixa
     *
     * @return string 
     */
    public function getCaixa()
    {
        return $this->caixa;
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
     * Set titulo
     *
     * @param string $titulo
     * @return ProdutoAlmoxarifado
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set codigoFabricante
     *
     * @param string $codigoFabricante
     * @return ProdutoAlmoxarifado
     */
    public function setCodigoFabricante($codigoFabricante)
    {
        $this->codigoFabricante = $codigoFabricante;

        return $this;
    }

    /**
     * Get codigoFabricante
     *
     * @return string 
     */
    public function getCodigoFabricante()
    {
        return $this->codigoFabricante;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ProdutoAlmoxarifado
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ProdutoAlmoxarifado
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
     * @return ProdutoAlmoxarifado
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
     * @return ProdutoAlmoxarifado
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
     * Add documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     * @return ProdutoAlmoxarifado
     */
    public function addDocumento(\AppBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\AppBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     * @return ProdutoAlmoxarifado
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set quantidadeMinima
     *
     * @param integer $quantidadeMinima
     * @return ProdutoAlmoxarifado
     */
    public function setQuantidadeMinima($quantidadeMinima)
    {
        $this->quantidadeMinima = $quantidadeMinima;

        return $this;
    }

    /**
     * Get quantidadeMinima
     *
     * @return integer 
     */
    public function getQuantidadeMinima()
    {
        return $this->quantidadeMinima;
    }

    /**
     * Set fornecedor
     *
     * @param \AppBundle\Entity\Fornecedor $fornecedor
     * @return ProdutoAlmoxarifado
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
     * Set unidadeMedida
     *
     * @param string $unidadeMedida
     * @return ProdutoAlmoxarifado
     */
    public function setUnidadeMedida($unidadeMedida)
    {
        $this->unidadeMedida = $unidadeMedida;

        return $this;
    }

    /**
     * Get unidadeMedida
     *
     * @return string 
     */
    public function getUnidadeMedida()
    {
        return $this->unidadeMedida;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return ProdutoAlmoxarifado
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

    /**
     * Set tipoOcorencia
     *
     * @param boolean $tipoOcorencia
     * @return ProdutoAlmoxarifado
     */
    public function setTipoOcorencia($tipoOcorencia)
    {
        $this->tipoOcorencia = $tipoOcorencia;

        return $this;
    }

    /**
     * Get tipoOcorencia
     *
     * @return boolean
     */
    public function getTipoOcorencia()
    {
        return $this->tipoOcorencia;
    }
}
