<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Empresa
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Uploadable(path="uploads/rotulos-ficha-tenica-produto", filenameGenerator="SHA1")
 */
class Empresa
{

    const SERVER_PATH_TO_IMAGE_FOLDER = '../web/uploads/logo';

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
     * @ORM\Column(name="cnpj", type="string", length=30, nullable=false, unique=true)
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_fantasia", type="string", length=155, nullable=true)
     */
    private $nomeFantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="razao_social", type="string", length=155, nullable=false, unique=true)
     */
    private $razaoSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="cnae", type="string", length=255, nullable=true)
     */
    private $cnae;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
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


    public function __toString()
    {
        return (string)($this->id ? $this->razaoSocial : '-');
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
     * Set cnpj
     *
     * @param string $cnpj
     * @return Empresa
     */
    public function setCnpj($cnpj)
    {
        $cnpj = preg_replace("/\D+/", "", $cnpj);

        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string
     */
    public function getCnpj()
    {
        return substr($this->cnpj, 0, 2) . '.' . substr($this->cnpj, 2, 3) .
            '.' . substr($this->cnpj, 5, 3) . '/' .
            substr($this->cnpj, 8, 4) . '-' . substr($this->cnpj, 12, 2);
        //return $this->cnpj;
    }

    /**
     * Set nomeFantasia
     *
     * @param string $nomeFantasia
     * @return Empresa
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;

        return $this;
    }

    /**
     * Get nomeFantasia
     *
     * @return string
     */
    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    /**
     * Set razaoSocial
     *
     * @param string $razaoSocial
     * @return Empresa
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    /**
     * Get razaoSocial
     *
     * @return string
     */
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * Set cnae
     *
     * @param string $cnae
     * @return Empresa
     */
    public function setCnae($cnae)
    {
        $this->cnae = $cnae;

        return $this;
    }

    /**
     * Get cnae
     *
     * @return string
     */
    public function getCnae()
    {
        return $this->cnae;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Empresa
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * Set pathFoto
     *
     * @param string $pathFoto
     * @return Empresa
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
     * @return Empresa
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
