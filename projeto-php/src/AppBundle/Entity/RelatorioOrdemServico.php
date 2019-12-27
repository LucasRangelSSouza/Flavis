<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RelatorioOrdemServico
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\Uploadable(path="uploads/fotos-os", filenameGenerator="SHA1")
 */
class RelatorioOrdemServico
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
     * @var AgendamentoOrdemServico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgendamentoOrdemServico",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agendamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $agendamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_receptor", type="string", length=45, nullable=true)
     */
    private $receptorNome;

    /**
     * @var string
     *
     * @ORM\Column(name="rg_receptor", type="string", length=15, nullable=true)
     */
    private $receptorRg;

    /**
     * @var Colaborador
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $colaborador;

    /**
     * @var string
     *
     * @ORM\Column(name="relatorio_avaliacao", type="text", nullable=false)
     */
    private $relatorio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEncerrada", type="boolean", nullable=true, options={"default"=0})
     */
    private $isEncerrada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_homologada", type="boolean", nullable=true, options={"default"=0})
     */
    private $isHomologada;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa_encerramento", type="text", nullable=true)
     */
    private $justificativaEncerramento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_impedido", type="boolean", nullable=true, options={"default"=0})
     */
    private $isImpedido;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa_empedimento", type="text", nullable=true)
     */
    private $justificativaEmpedimento;

    /**
     * @var string
     *
     * @ORM\Column(name="path_file", type="string", length=255, nullable=true)
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

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\FotoOs", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $fotos;

    public function __toString()
    {
        return (string) ($this->id ? $this->id : '-');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fotos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return RelatorioOrdemServico
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
     * Set receptorNome
     *
     * @param string $receptorNome
     * @return RelatorioOrdemServico
     */
    public function setReceptorNome($receptorNome)
    {
        $this->receptorNome = $receptorNome;

        return $this;
    }

    /**
     * Get receptorNome
     *
     * @return string
     */
    public function getReceptorNome()
    {
        return $this->receptorNome;
    }

    /**
     * Set receptorRg
     *
     * @param string $receptorRg
     * @return RelatorioOrdemServico
     */
    public function setReceptorRg($receptorRg)
    {
        $this->receptorRg = $receptorRg;

        return $this;
    }

    /**
     * Get receptorRg
     *
     * @return string
     */
    public function getReceptorRg()
    {
        return $this->receptorRg;
    }

    /**
     * Set relatorio
     *
     * @param string $relatorio
     * @return RelatorioOrdemServico
     */
    public function setRelatorio($relatorio)
    {
        $this->relatorio = $relatorio;

        return $this;
    }

    /**
     * Get relatorio
     *
     * @return string
     */
    public function getRelatorio()
    {
        return $this->relatorio;
    }

    /**
     * Set isEncerrada
     *
     * @param boolean $isEncerrada
     * @return RelatorioOrdemServico
     */
    public function setIsEncerrada($isEncerrada)
    {
        $this->isEncerrada = $isEncerrada;

        return $this;
    }

    /**
     * Get isEncerrada
     *
     * @return boolean
     */
    public function getIsEncerrada()
    {
        return $this->isEncerrada;
    }

    /**
     * Set justificativaEncerramento
     *
     * @param string $justificativaEncerramento
     * @return RelatorioOrdemServico
     */
    public function setJustificativaEncerramento($justificativaEncerramento)
    {
        $this->justificativaEncerramento = $justificativaEncerramento;

        return $this;
    }

    /**
     * Get justificativaEncerramento
     *
     * @return string
     */
    public function getJustificativaEncerramento()
    {
        return $this->justificativaEncerramento;
    }

    /**
     * Set isImpedido
     *
     * @param boolean $isImpedido
     * @return RelatorioOrdemServico
     */
    public function setIsImpedido($isImpedido)
    {
        $this->isImpedido = $isImpedido;

        return $this;
    }

    /**
     * Get isImpedido
     *
     * @return boolean
     */
    public function getIsImpedido()
    {
        return $this->isImpedido;
    }

    /**
     * Set justificativaEmpedimento
     *
     * @param string $justificativaEmpedimento
     * @return RelatorioOrdemServico
     */
    public function setJustificativaEmpedimento($justificativaEmpedimento)
    {
        $this->justificativaEmpedimento = $justificativaEmpedimento;

        return $this;
    }

    /**
     * Get justificativaEmpedimento
     *
     * @return string
     */
    public function getJustificativaEmpedimento()
    {
        return $this->justificativaEmpedimento;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RelatorioOrdemServico
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
     * @return RelatorioOrdemServico
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
     * @return RelatorioOrdemServico
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
     * Set colaborador
     *
     * @param \AppBundle\Entity\Colaborador $colaborador
     * @return RelatorioOrdemServico
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
     * Add fotos
     *
     * @param \AppBundle\Entity\FotoOs $fotos
     * @return RelatorioOrdemServico
     */
    public function addFoto(\AppBundle\Entity\FotoOs $fotos)
    {
        $this->fotos[] = $fotos;

        return $this;
    }

    /**
     * Remove fotos
     *
     * @param \AppBundle\Entity\FotoOs $fotos
     */
    public function removeFoto(\AppBundle\Entity\FotoOs $fotos)
    {
        $this->fotos->removeElement($fotos);
    }

    /**
     * Get fotos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotos()
    {
        return $this->fotos;
    }

    /**
     * Set isHomologada
     *
     * @param boolean $isHomologada
     * @return RelatorioOrdemServico
     */
    public function setIsHomologada($isHomologada)
    {
        $this->isHomologada = $isHomologada;

        return $this;
    }

    /**
     * Get isHomologada
     *
     * @return boolean 
     */
    public function getIsHomologada()
    {
        return $this->isHomologada;
    }

    /**
     * Set agendamento
     *
     * @param \AppBundle\Entity\AgendamentoOrdemServico $agendamento
     * @return RelatorioOrdemServico
     */
    public function setAgendamento(\AppBundle\Entity\AgendamentoOrdemServico $agendamento)
    {
        $this->agendamento = $agendamento;

        return $this;
    }

    /**
     * Get agendamento
     *
     * @return \AppBundle\Entity\AgendamentoOrdemServico 
     */
    public function getAgendamento()
    {
        return $this->agendamento;
    }
}
