<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * ExecucaoDeProcedimentoEquipamento
 *
 *
 * @ORM\Table()
 * @ORM\Entity
     */
class ExecucaoDeProcedimentoEquipamento
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
     * @var ExecucaoDeProcedimentoEquipamento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgendamentoManutencaoEquipamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="procedimento_pmoc_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $procedimentoPmoc;

    /**
     * @var ClienteEquipamento
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClienteEquipamento", inversedBy="execucoesProcedimentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipamento_cliente_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $clienteEquipamento;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     */
    private $observacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_agendada_execucao", type="datetime")
     */
    private $dataAgendadaExecucao;

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
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico", inversedBy="execucoesProcedimentos")
     * @ORM\JoinColumn(name="os_id", referencedColumnName="id")
     */
    private $os;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\FotoExecucaoOs", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $fotos;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;

    /**
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico", inversedBy="execucoesProcedimentos")
     * @ORM\JoinColumn(name="os_pai", referencedColumnName="id")
     */
    private $osPai;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_execucao", type="datetime", nullable=true)
     */
    private $dataExecucao;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;


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

    public function getColorBackgroundCalendar()
    {
        /*
            Azul = disponível para realizar OS;
            Amarelo = Já vinculado a uma OS
            Verde = Vinculado a uma OS que já foi homologada;
            Vermelho = Passou da data;
         */
        $azul       = '#0000CD';
        $amarelo    = '#FFD700';
        $verde      = '#228B22';
        $vermelho   = '#B22222';

        if(!$this->getOs()){

            return $azul;

        }else{
            if($this->getOs()->getIsHomologada()){
                return $verde;
            }else{
                return $amarelo;
            }
        }

        //return $azul;
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
     * Set observacao
     *
     * @param string $observacao
     * @return ExecucaoDeProcedimentoEquipamento
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
     * @return ExecucaoDeProcedimentoEquipamento
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
     * @return ExecucaoDeProcedimentoEquipamento
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
     * Set procedimentoPmoc
     *
     * @param \AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentoPmoc
     * @return ExecucaoDeProcedimentoEquipamento
     */
    public function setProcedimentoPmoc(\AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentoPmoc)
    {
        $this->procedimentoPmoc = $procedimentoPmoc;

        return $this;
    }

    /**
     * Get procedimentoPmoc
     *
     * @return \AppBundle\Entity\AgendamentoManutencaoEquipamento 
     */
    public function getProcedimentoPmoc()
    {
        return $this->procedimentoPmoc;
    }

    /**
     * Set os
     *
     * @param \AppBundle\Entity\OrdemServico $os
     * @return ExecucaoDeProcedimentoEquipamento
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
     * Set dataAgendadaExecucao
     *
     * @param \DateTime $dataAgendadaExecucao
     * @return ExecucaoDeProcedimentoEquipamento
     */
    public function setDataAgendadaExecucao($dataAgendadaExecucao)
    {
        $this->dataAgendadaExecucao = $dataAgendadaExecucao;

        return $this;
    }

    /**
     * Get dataAgendadaExecucao
     *
     * @return \DateTime 
     */
    public function getDataAgendadaExecucao()
    {
        return $this->dataAgendadaExecucao;
    }

    /**
     * Set clienteEquipamento
     *
     * @param \AppBundle\Entity\ClienteEquipamento $clienteEquipamento
     * @return ExecucaoDeProcedimentoEquipamento
     */
    public function setClienteEquipamento(\AppBundle\Entity\ClienteEquipamento $clienteEquipamento)
    {
        $this->clienteEquipamento = $clienteEquipamento;

        return $this;
    }

    /**
     * Get clienteEquipamento
     *
     * @return \AppBundle\Entity\ClienteEquipamento 
     */
    public function getClienteEquipamento()
    {
        return $this->clienteEquipamento;
    }

    /**
     * Add fotos
     *
     * @param \AppBundle\Entity\FotoExecucaoOs $fotos
     * @return ExecucaoDeProcedimentoEquipamento
     */
    public function addFoto(\AppBundle\Entity\FotoExecucaoOs $fotos)
    {
        $this->fotos[] = $fotos;

        return $this;
    }

    /**
     * Remove fotos
     *
     * @param \AppBundle\Entity\FotoExecucaoOs $fotos
     */
    public function removeFoto(\AppBundle\Entity\FotoExecucaoOs $fotos)
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
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return ExecucaoDeProcedimentoEquipamento
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
     * Set status
     *
     * @param string $status
     * @return ExecucaoDeProcedimentoEquipamento
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
     * Set dataExecucao
     *
     * @param \DateTime $dataExecucao
     * @return ExecucaoDeProcedimentoEquipamento
     */
    public function setDataExecucao($dataExecucao)
    {
        $this->dataExecucao = $dataExecucao;

        return $this;
    }

    /**
     * Get dataExecucao
     *
     * @return \DateTime
     */
    public function getDataExecucao()
    {
        return $this->dataExecucao;
    }

    /**
     * Set osPai
     *
     * @param \AppBundle\Entity\OrdemServico $osPai
     * @return ExecucaoDeProcedimentoEquipamento
     */
    public function setOsPai(\AppBundle\Entity\OrdemServico $osPai = null)
    {
        $this->osPai = $osPai;

        return $this;
    }

    /**
     * Get osPai
     *
     * @return \AppBundle\Entity\OrdemServico
     */
    public function getOsPai()
    {
        return $this->osPai;
    }
}