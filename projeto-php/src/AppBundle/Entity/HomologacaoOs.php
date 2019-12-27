<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * HomologacaoOs
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class HomologacaoOs
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
     * @var OrdemServico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="os_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcelas", type="integer")
     */
    private $parcelas = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="observacoes", type="text")
     */
    private $observacoes;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_erp", type="string", length=45, nullable=true)
     */
    private $codigoErp = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_pago", type="boolean", nullable=true, options={"default"=0})
     */
    private $isPago;

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
     * @ORM\Column(name="nome_perfil", type="string", length=150)
     */
    private $nomePerfil;


    public function __toString()
    {
        return (string) ($this->id ? $this->id : '-');
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
     * @return HomologacaoOs
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
     * Set parcelas
     *
     * @param integer $parcelas
     * @return HomologacaoOs
     */
    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;

        return $this;
    }

    /**
     * Get parcelas
     *
     * @return integer 
     */
    public function getParcelas()
    {
        return $this->parcelas;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return HomologacaoOs
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
     * @return HomologacaoOs
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
     * @return HomologacaoOs
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
     * @return HomologacaoOs
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
     * Set os
     *
     * @param \AppBundle\Entity\OrdemServico $os
     * @return HomologacaoOs
     */
    public function setOs(\AppBundle\Entity\OrdemServico $os)
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
     * Set codigoErp
     *
     * @param string $codigoErp
     * @return HomologacaoOs
     */
    public function setCodigoErp($codigoErp)
    {
        $this->codigoErp = $codigoErp;

        return $this;
    }

    /**
     * Get codigoErp
     *
     * @return string 
     */
    public function getCodigoErp()
    {
        return $this->codigoErp;
    }

    /**
     * Set isPago
     *
     * @param boolean $isPago
     * @return HomologacaoOs
     */
    public function setIsPago($isPago)
    {
        $this->isPago = $isPago;

        return $this;
    }

    /**
     * Get isPago
     *
     * @return boolean 
     */
    public function getIsPago()
    {
        return $this->isPago;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return HomologacaoOs
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