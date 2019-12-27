<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * EquipamentoCliente
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class EquipamentoCliente
{

    const SERVER_PATH_TO_IMAGE_FOLDER = '../web/uploads/catalogo-equipamentos';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var MarcaEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MarcaEquipamento",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marca_equipamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $marca;

    /**
     * @var ModeloEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ModeloEquipamento",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modelo_equipamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $modelo;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AgendamentoManutencaoEquipamento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $procedimentosPreventivos;

    /**
     * @var string
     *
     * @ORM\Column(name="especificacoes", type="text")
     */
    private $especificacoes;

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
     * @ORM\Column(name="pathFoto", type="string", length=255,nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $pathFoto;
    private $oldPathFoto;

    private $file;


//http://stackoverflow.com/questions/13648467/sonata-admin-one-to-many-relationship-with-file-upload-appendformfieldelement
//    /**
//     * @var Media
//     *
//     * @ORM\OneToMany(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", mappedBy="item")
//     * ORM\JoinTable(name="item_media",
//     *     joinColumns={@ORM\JoinColumn(name="item_id", referencedColumnName="id")}
//     *   , inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id", unique=true)}
//     * )
//     */
//    protected $media;

//    /**
//     * @var Media
//     *
//     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media",cascade={"persist"})
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="foto_id", referencedColumnName="id", nullable=true)
//     * })
//     *
//     */
//    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150)
     */
    private $nomePerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacidade", type="integer", nullable=true)
     */
    private $capacidade;

    /**
     * @var string
     *
     * @ORM\Column(name="unidade_medida", type="string", length=10, nullable=true)
     */
    private $unidadeMedida;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=20, nullable=true)
     */
    private $serie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_aquisicao", type="datetime", nullable=true)
     */
    private $dataAquisicao;

    /**
     * @var grupoEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GrupoEquipamento",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_equipamento_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $grupoEquipamento;

    /**
     * @var ambiente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ambiente",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ambiente_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $ambiente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inativado", type="boolean", nullable=true, options={"default"=0})
     */
    private $inativado;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa", type="text", nullable=true)
     */
    private $justificativa;


    public function __toString()
    {
        return (string) ($this->id ? $this->grupoEquipamento . ' - ' . $this->marca . ' - ' . $this->modelo . ' - ' . $this->serie : '-');
//        return (string) ($this->id ? $this->getMarca()->getTitulo() . ' - ' . $this->getModelo()->getTitulo() : '-');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->procedimentosPreventivos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set especificacoes
     *
     * @param string $especificacoes
     * @return EquipamentoCliente
     */
    public function setEspecificacoes($especificacoes)
    {
        $this->especificacoes = $especificacoes;

        return $this;
    }

    /**
     * Get especificacoes
     *
     * @return string 
     */
    public function getEspecificacoes()
    {
        return $this->especificacoes;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EquipamentoCliente
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
     * @return EquipamentoCliente
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
     * @return EquipamentoCliente
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
     * Set marca
     *
     * @param \AppBundle\Entity\MarcaEquipamento $marca
     * @return EquipamentoCliente
     */
    public function setMarca(\AppBundle\Entity\MarcaEquipamento $marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return \AppBundle\Entity\MarcaEquipamento 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param \AppBundle\Entity\ModeloEquipamento $modelo
     * @return EquipamentoCliente
     */
    public function setModelo(\AppBundle\Entity\ModeloEquipamento $modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return \AppBundle\Entity\ModeloEquipamento 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Add procedimentosPreventivos
     *
     * @param \AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos
     * @return EquipamentoCliente
     */
    public function addProcedimentosPreventivo(\AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos)
    {
        $this->procedimentosPreventivos[] = $procedimentosPreventivos;

        return $this;
    }

    /**
     * Remove procedimentosPreventivos
     *
     * @param \AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos
     */
    public function removeProcedimentosPreventivo(\AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos)
    {
        $this->procedimentosPreventivos->removeElement($procedimentosPreventivos);
    }

    /**
     * Get procedimentosPreventivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcedimentosPreventivos()
    {
        return $this->procedimentosPreventivos;
    }

//    /**
//     * Set foto
//     *
//     * @param \Application\Sonata\MediaBundle\Entity\Media $foto
//     * @return EquipamentoCliente
//     */
//    public function setFoto(\Application\Sonata\MediaBundle\Entity\Media $foto = null)
//    {
//        $this->foto = $foto;
//
//        return $this;
//    }
//
//    /**
//     * Get foto
//     *
//     * @return \Application\Sonata\MediaBundle\Entity\Media
//     */
//    public function getFoto()
//    {
//        return $this->foto;
//    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return EquipamentoCliente
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
     * Set capacidade
     *
     * @param integer $capacidade
     * @return EquipamentoCliente
     */
    public function setCapacidade($capacidade)
    {
        $this->capacidade = $capacidade;

        return $this;
    }

    /**
     * Get capacidade
     *
     * @return integer
     */
    public function getCapacidade()
    {
        return $this->capacidade;
    }

    /**
     * Set unidadeMedida
     *
     * @param string $unidadeMedida
     * @return EquipamentoCliente
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
     * Set serie
     *
     * @param string $serie
     * @return EquipamentoCliente
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set dataAquisicao
     *
     * @param \DateTime $dataAquisicao
     * @return EquipamentoCliente
     */
    public function setDataAquisicao($dataAquisicao)
    {
        $this->dataAquisicao = $dataAquisicao;

        return $this;
    }

    /**
     * Get dataAquisicao
     *
     * @return \DateTime
     */
    public function getDataAquisicao()
    {
        return $this->dataAquisicao;
    }

    /**
     * Set grupoEquipamento
     *
     * @param \AppBundle\Entity\GrupoEquipamento $grupoEquipamento
     * @return EquipamentoCliente
     */
    public function setGrupoEquipamento(\AppBundle\Entity\GrupoEquipamento $grupoEquipamento)
    {
        $this->grupoEquipamento = $grupoEquipamento;

        return $this;
    }

    /**
     * Get grupoEquipamento
     *
     * @return \AppBundle\Entity\GrupoEquipamento
     */
    public function getGrupoEquipamento()
    {
        return $this->grupoEquipamento;
    }

    /**
     * Set ambiente
     *
     * @param \AppBundle\Entity\Ambiente $ambiente
     * @return EquipamentoCliente
     */
    public function setAmbiente(\AppBundle\Entity\Ambiente $ambiente)
    {
        $this->ambiente = $ambiente;

        return $this;
    }

    /**
     * Get ambiente
     *
     * @return \AppBundle\Entity\Ambiente
     */
    public function getAmbiente()
    {
        return $this->ambiente;
    }

    /**
     * Set inativado
     *
     * @param boolean $inativado
     * @return EquipamentoCliente
     */
    public function setInativado($inativado)
    {
        $this->inativado = $inativado;

        return $this;
    }

    /**
     * Get inativado
     *
     * @return boolean
     */
    public function getInativado()
    {
        return $this->inativado;
    }

    /**
     * Set justificativa
     *
     * @param string $justificativa
     * @return EquipamentoCliente
     */
    public function setJustificativa($justificativa)
    {
        $this->justificativa = $justificativa;

        return $this;
    }

    /**
     * Get justificativa
     *
     * @return string
     */
    public function getJustificativa()
    {
        return $this->justificativa;
    }

    /**
     * Set pathFoto
     *
     * @param string $pathFoto
     * @return EquipamentoCliente
     */
    public function setPathFoto($pathFoto)
    {
        $this->pathFoto = $pathFoto;


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
     * @return EquipamentoCliente
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

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and target filename as params
        $this->getFile()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER, $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->filename = $this->getFile()->getClientOriginalName();

    }

    /**
     * Lifecycle callback to upload the file to the server
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }


}