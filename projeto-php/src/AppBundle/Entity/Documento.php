<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Documento
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Uploadable(path="uploads/documentos-admin", filenameGenerator="SHA1")
 */
class Documento
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
     * @var TipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="TipoDocumento")
     */
    private $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150)
     */
    private $titulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_emissao", type="datetime", nullable=true)
     */
    private $dataEmissao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_validade", type="datetime", nullable=true)
     */
    private $dataValidade;

    /**
     * @var string
     *
     * @ORM\Column(name="path_file", type="string", length=255)
     * @Gedmo\UploadableFilePath
     */
    private $pathFile;
    private $oldPathFile;

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
        return (string) ($this->id ? $this->titulo : '-');
    }

    /**
     * @param mixed $oldPathFile
     */
    public function setOldPathFile($oldPathFile)
    {
        $this->oldPathFile = $oldPathFile;
    }

    /**
     * @return mixed
     */
    public function getOldPathFile()
    {
        return $this->oldPathFile;
    }

    /**
     * Set pathFile
     *
     * @param string $pathFile
     * @return Documento
     */
    public function setPathFile($pathFile)
    {
        if (empty($this->oldPathFile)) {
            $this->oldPathFile = $this->pathFile;
        }

        // Se nada foi enviado no form
        if($this->pathFile=='') {
            $this->pathFile = $pathFile;
        }

        return $this;
    }

    /**
     * Get pathFile
     *
     * @return string
     */
    public function getPathFile()
    {
        return $this->pathFile;
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
     * Set titulo
     *
     * @param string $titulo
     * @return Documento
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
     * Set dataEmissao
     *
     * @param \DateTime $dataEmissao
     * @return Documento
     */
    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;

        return $this;
    }

    /**
     * Get dataEmissao
     *
     * @return \DateTime
     */
    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    /**
     * Set dataValidade
     *
     * @param \DateTime $dataValidade
     * @return Documento
     */
    public function setDataValidade($dataValidade)
    {
        $this->dataValidade = $dataValidade;

        return $this;
    }

    /**
     * Get dataValidade
     *
     * @return \DateTime
     */
    public function getDataValidade()
    {
        return $this->dataValidade;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return Documento
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
     * @return Documento
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
     * @return Documento
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
     * @return Documento
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
     * Set tipoDocumento
     *
     * @param \AppBundle\Entity\TipoDocumento $tipoDocumento
     * @return Documento
     */
    public function setTipoDocumento(\AppBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \AppBundle\Entity\TipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
}
