<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FichaTecnicaProduto
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Uploadable(path="uploads/rotulos-ficha-tenica-produto", filenameGenerator="SHA1")
 */
class FichaTecnicaProduto
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
     * @ORM\Column(name="titulo", type="string", length=150)
     */
    private $titulo;

    /**
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fornecedor",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fabricante_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $fabricante;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     */
    private $observacao;

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
     * @var string
     *
     * @ORM\Column(name="pathFoto", type="string", length=255,nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $pathFoto;
    private $oldPathFoto;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico", inversedBy="fichasTecnicasProduto")
     * @ORM\JoinColumn(name="os_id", referencedColumnName="id")
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="text", nullable=true)
     */
    private $nomePerfil;

    public function __toString()
    {
        return (string)$this->titulo;
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
     * Set os
     *
     * @param \AppBundle\Entity\OrdemServico $os
     * @return RelatorioExecucaoDeProcedimentoEquipamento
     */
    public function setOs(\AppBundle\Entity\OrdemServico $os = null)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return \AppBundle\Entity\OrdemServico
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set pathFoto
     *
     * @param string $pathFoto
     * @return FichaTecnicaProduto
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
     * @return FichaTecnicaProduto
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
     * @return FichaTecnicaProduto
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
     * Set observacao
     *
     * @param string $observacao
     * @return FichaTecnicaProduto
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FichaTecnicaProduto
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
     * @return FichaTecnicaProduto
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
     * Set fabricante
     *
     * @param \AppBundle\Entity\Fornecedor $fabricante
     * @return FichaTecnicaProduto
     */
    public function setFabricante(\AppBundle\Entity\Fornecedor $fabricante)
    {
        $this->fabricante = $fabricante;

        return $this;
    }

    /**
     * Get fabricante
     *
     * @return \AppBundle\Entity\Fornecedor 
     */
    public function getFabricante()
    {
        return $this->fabricante;
    }


    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return FichaTecnicaProduto
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
