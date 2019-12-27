<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ClienteEquipamentoLog
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ClienteEquipamentoLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_LOG", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATA_LOG", type="datetime", nullable=true)
     */
    private $dataLog;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="equipamento_id", type="integer", nullable=false)
//     */
    /**
     * @var EquipamentoCliente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EquipamentoCliente",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipamento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $equipamento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_pmoc", type="boolean", nullable=true, options={"default"=0})
     */
    private $isPmoc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio_pmoc", type="datetime", nullable=true)
     */
    private $dataInicioPmoc;

//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="cliente_id", type="integer", nullable=false)
//     */
    /**
     * @var Cliente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cliente", inversedBy="equipamentos")
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text", nullable=true)
     */
    private $observacoes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

//    /** Não existe nas tabelas cliente_equipamento e cliente_equipamento_log
//     * @var ArrayCollection
//     *
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AgendamentoManutencaoEquipamento", cascade={"persist", "remove"})
//     * @ORM\JoinTable(
//     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
//     * )
//     */
//    private $procedimentosPreventivos;

//    /** Não existe nas tabelas cliente_equipamento e cliente_equipamento_log
//     * @var ArrayCollection
//     *
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\PropriedadeEquipamento", cascade={"persist", "remove"})
//     * @ORM\JoinTable(
//     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
//     * )
//     */
//    private $propriedades;

//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="foto_id", type="integer", nullable=true)
//     */
    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="foto_id", referencedColumnName="id", nullable=true)
     * })
     *
     */
    private $foto;

//    /** Não existe nas tabelas cliente_equipamento e cliente_equipamento_log
//     * @var ArrayCollection
//     * @ORM\OneToMany(targetEntity="ExecucaoDeProcedimentoEquipamento", mappedBy="ClienteEquipamento")
//     */
//    private $execucoesProcedimentos;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=false)
     */
    private $nomePerfil;

    /**
     * @var prioridade
     *
     * @ORM\Column(name="prioridade", type="string", length=50, nullable=true)
     */
    private $prioridade;

    /**
     * @var integer
     *
     * @ORM\Column(name="tempo_os", type="integer", nullable=true)
     */
    private $tempoOs;

    /**
     * @var string
     *
     * @ORM\Column(name="unidade_tempo", type="string", length=10, nullable=true)
     */
    private $unidadeTempo;


    public function __toString()
    {
        return (string) ($this->id ? $this->getEquipamento()->getMarca()->getTitulo() . ' - ' .
            $this->getEquipamento()->getModelo()->getTitulo() : '-');
    }

    /**
     * Set foto
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $foto
     * @return ClienteEquipamentoLog
     */
    public function setFoto(\Application\Sonata\MediaBundle\Entity\Media $foto = null)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->propriedades = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->procedimentosPreventivos = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->execucoesProcedimentos  = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
//
//    #### VALIDACAO PMOC
//
//        // Validar se o isPmoc é true;
//        if($this->getIsPmoc() && !$this->getDataInicioPmoc()){
//            $context->buildViolation('Caso seja PMOC é necessário informar uma data de início para os agendamentos')
//                ->atPath('dataInicioPmoc')
//                ->addViolation();
//        }
//
//        // Validar se a data é maior que hoje;
//
    }

//    public function clearProcedimentos()
//    {
//        $this->getProcedimentosPreventivos()->clear();
//    }
//
//    /**
//     * Add procedimentosPreventivos
//     *
//     * @param \AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos
//     * @return ClienteEquipamentoLog
//     */
//    public function addProcedimentosPreventivo(\AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos)
//    {
//        $this->procedimentosPreventivos[] = $procedimentosPreventivos;
//
//        return $this;
//    }
//
//    /**
//     * Remove procedimentosPreventivos
//     *
//     * @param \AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos
//     */
//    public function removeProcedimentosPreventivo(\AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentosPreventivos)
//    {
//        $this->procedimentosPreventivos->removeElement($procedimentosPreventivos);
//    }
//
//    /**
//     * Get procedimentosPreventivos
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getProcedimentosPreventivos()
//    {
//        return $this->procedimentosPreventivos;
//    }
//
//    /**
//     * Add propriedades
//     *
//     * @param \AppBundle\Entity\PropriedadeEquipamento $propriedades
//     * @return EquipamentoCliente
//     */
//    public function addPropriedade(\AppBundle\Entity\PropriedadeEquipamento $propriedades)
//    {
//        $this->propriedades[] = $propriedades;
//
//        return $this;
//    }
//
//    /**
//     * Remove propriedades
//     *
//     * @param \AppBundle\Entity\PropriedadeEquipamento $propriedades
//     */
//    public function removePropriedade(\AppBundle\Entity\PropriedadeEquipamento $propriedades)
//    {
//        $this->propriedades->removeElement($propriedades);
//    }
//
//    /**
//     * Get propriedades
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getPropriedades()
//    {
//        return $this->propriedades;
//    }

    /**
     * Get idLog
     *
     * @return integer
     */
    public function getIdLog()
    {
        return $this->idLog;
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
     * @return ClienteEquipamentoLog
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
     * Set equipamento
     *
     * @param \AppBundle\Entity\EquipamentoCliente $equipamento
     * @return ClienteEquipamentoLog
     */
    public function setEquipamento(\AppBundle\Entity\EquipamentoCliente $equipamento)
    {
        $this->equipamento = $equipamento;

        return $this;
    }

    /**
     * Get equipamento
     *
     * @return \AppBundle\Entity\EquipamentoCliente 
     */
    public function getEquipamento()
    {
        return $this->equipamento;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     * @return ClienteEquipamentoLog
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ClienteEquipamentoLog
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
     * @return ClienteEquipamentoLog
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
     * @return ClienteEquipamentoLog
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
     * Set isPmoc
     *
     * @param boolean $isPmoc
     * @return ClienteEquipamentoLog
     */
    public function setIsPmoc($isPmoc)
    {
        $this->isPmoc = $isPmoc;

        return $this;
    }

    /**
     * Get isPmoc
     *
     * @return boolean 
     */
    public function getIsPmoc()
    {
        return $this->isPmoc;
    }

    /**
     * Set dataInicioPmoc
     *
     * @param \DateTime $dataInicioPmoc
     * @return ClienteEquipamentoLog
     */
    public function setDataInicioPmoc($dataInicioPmoc)
    {
        $this->dataInicioPmoc = $dataInicioPmoc;

        return $this;
    }

    /**
     * Get dataInicioPmoc
     *
     * @return \DateTime 
     */
    public function getDataInicioPmoc()
    {
        return $this->dataInicioPmoc;
    }

//    /**
//     * Add execucoesProcedimentos
//     *
//     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos
//     * @return ClienteEquipamentoLog
//     */
//    public function addExecucoesProcedimento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos)
//    {
//        $this->execucoesProcedimentos[] = $execucoesProcedimentos;
//
//        return $this;
//    }
//
//    /**
//     * Remove execucoesProcedimentos
//     *
//     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos
//     */
//    public function removeExecucoesProcedimento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos)
//    {
//        $this->execucoesProcedimentos->removeElement($execucoesProcedimentos);
//    }
//
//    /**
//     * Get execucoesProcedimentos
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getExecucoesProcedimentos()
//    {
//        return $this->execucoesProcedimentos;
//    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return ClienteEquipamentoLog
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
     * Set prioridade
     *
     * @param string $prioridade
     * @return ClienteEquipamentoLog
     */
    public function setPrioridade($prioridade)
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    /**
     * Get prioridade
     *
     * @return string
     */
    public function getPrioridade()
    {
        return $this->prioridade;
    }

    /**
     * Set tempoOs
     *
     * @param integer $tempoOs
     * @return ClienteEquipamentoLog
     */
    public function setTempoOs($tempoOs)
    {
        $this->tempoOs = $tempoOs;

        return $this;
    }

    /**
     * Get tempoOs
     *
     * @return integer
     */
    public function getTempoOs()
    {
        return $this->tempoOs;
    }

    /**
     * Set unidadeTempo
     *
     * @param string $unidadeTempo
     * @return ClienteEquipamentoLog
     */
    public function setUnidadeTempo($unidadeTempo)
    {
        $this->unidadeTempo = $unidadeTempo;

        return $this;
    }

    /**
     * Get unidadeTempo
     *
     * @return string
     */
    public function getUnidadeTempo()
    {
        return $this->unidadeTempo;
    }

    /**
     * Set dataLog
     *
     * @param \DateTime $dataLog
     * @return ClienteEquipamentoLog
     */
    public function setDataLog($dataLog)
    {
        $this->dataLog = $dataLog;

        return $this;
    }

    /**
     * Get dataLog
     *
     * @return \DateTime
     */
    public function getDataLog()
    {
        return $this->dataLog;
    }
}