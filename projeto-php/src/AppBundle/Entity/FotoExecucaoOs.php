<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FotoExecucaoOs
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Uploadable(path="uploads/fotos-os", filenameGenerator="SHA1")
 */
class FotoExecucaoOs
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
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="path_file", type="string", length=255)
     * @Gedmo\UploadableFilePath
     */
    private $pathFile;
    private $oldPathFile;

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
     * @return FotoExecucaoOs
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FotoExecucaoOs
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
     * @return FotoExecucaoOs
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
     * @return FotoExecucaoOs
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
}
