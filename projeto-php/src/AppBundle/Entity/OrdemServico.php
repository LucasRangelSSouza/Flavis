<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * OrdemServico
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OrdemServicoRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Uploadable(path="uploads/sumarios-relatorios-os", filenameGenerator="SHA1")
 */
class OrdemServico
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
     *   @ORM\JoinColumn(name="os_original_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $osOriginal;

    /**
     * @var Cliente
     *
     * MEDIDAS DE VALIDACAO
     * colocar inversedBy aqui, um mappedBy no cliente e um cascadeValidate no admin do cliente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_receptor", type="string", length=45, nullable=true)
     */
    private $receptorNome;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=true)
     */
    private $nomePerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="rg_receptor", type="string", length=45, nullable=true)
     */
    private $receptorRg;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="receptorAssinatura", type="text", nullable=true)
     */
    private $receptorAssinatura;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="motivo_cancelamento", type="text", nullable=true)
     */
    private $motivoCancelamento;

    /**
     * @var string
     *
     * @ORM\Column(name="solicitante", type="string", length=255, nullable=true)
     */
    private $solicitante;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status = 'PEN';

    /**
     * @var Colaborador
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_solicitante_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $colaboradorAtendente;

    /**
     * @var Colaborador
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_avalista_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $colaboradorAvalista;

    /**
     * @var string
     *
     * @ORM\Column(name="relatorio_avaliacao", type="text", nullable=true)
     */
    private $relatorioAvaliacao;

    /**
     * @var Colaborador
     * @JMS\Exclude
     * O Técnico
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="colaborador_executor_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $colaboradorExecutor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataAgendada", type="datetime")
     */
    private $dataAgendada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaAgendada", type="time")
     */
    private $horaAgendada;

    /**
     * @var string
     *
     * @ORM\Column(name="ocorrencia", type="text")
     */
    private $ocorrencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEncerrada", type="boolean", nullable=true, options={"default"=0})
     */
    private $isEncerrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_abertura", type="datetime", nullable=true)
     */
    private $dataAbertura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_encerramento", type="datetime", nullable=true)
     */
    private $dataEncerramento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_pmoc", type="boolean", nullable=true, options={"default"=0})
     */
    private $isPmoc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_homologada", type="boolean", nullable=true, options={"default"=0})
     */
    private $isHomologada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_cancelada", type="boolean", nullable=true, options={"default"=0})
     */
    private $isCancelada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_sync", type="boolean", nullable=true, options={"default"=0})
     */
    private $isSync;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa_encerramento", type="text", nullable=true)
     */
    private $justificativaEncerramento;

    /**
     * @var string
     *
     * @ORM\Column(name="indice_relatorio", type="text", nullable=true)
     */
    private $indiceRelatorio;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="observacao", type="text", nullable=true)
     */
    private $observacao;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="resumo_relatorio", type="text", nullable=true)
     */
    private $resumoRelatorio;

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
     * @var Endereco
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Endereco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="endereco_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $endereco;

    /**
     * @var Endereco
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Norma")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="norma_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $normaTecnica;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\FotoOs", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $fotos;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ExecucaoDeProcedimentoEquipamento", mappedBy="os", cascade={"persist"}, orphanRemoval=true)
     */
    private $execucoesProcedimentos;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento", mappedBy="os", cascade={"persist"}, orphanRemoval=true, fetch="EAGER")
     */
    private $relatoriosExecucoesProcedimentos;

    /**
     * @var Colaborador
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="engenheiro_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $engenheiroResponsavel;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="FichaTecnicaProduto", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $fichasTecnicasProduto;

    /**
     * @var prioridade
     *
     * @ORM\Column(name="prioridade", type="string", length=50)
     */
    private $prioridade;


    /**
     * @var string
     *
     * @ORM\Column(name="pathFoto", type="string", length=255,nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $pathFoto;
    private $oldPathFoto;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="Colaborador", cascade={"persist"})
     */
    private $tecnicosOs;

    /**
     * @var integer
     *
     * @ORM\Column(name="os_original_pai", type="integer", nullable=true)
     */
    private $osOriginalPai;

//    /**
//     * @var boolean
//     *
//     * @ORM\Column(name="is_paralisada", type="boolean", nullable=true, options={"default"=0})
//     */
//    private $isParalisada;


    public function __toString()
    {
        return (string)($this->id ? $this->id : '-');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fichasTecnicasProduto = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fotos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->execucoesProcedimentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relatoriosExecucoesProcedimentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tecnicosOs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dataAgendada
     *
     * @param \DateTime $dataAgendada
     * @return OrdemServico
     */
    public function setDataAgendada($dataAgendada)
    {
        $this->dataAgendada = $dataAgendada;

        return $this;
    }

    /**
     * Get dataAgendada
     *
     * @return \DateTime
     */
    public function getDataAgendada()
    {
        return $this->dataAgendada;
    }

    /**
     * Set horaAgendada
     *
     * @param \DateTime $horaAgendada
     * @return OrdemServico
     */
    public function setHoraAgendada($horaAgendada)
    {
        $this->horaAgendada = $horaAgendada;

        return $this;
    }

    /**
     * Get horaAgendada
     *
     * @return \DateTime
     */
    public function getHoraAgendada()
    {
        return $this->horaAgendada;
    }

    /**
     * Set ocorrencia
     *
     * @param string $ocorrencia
     * @return OrdemServico
     */
    public function setOcorrencia($ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;

        return $this;
    }

    /**
     * Get ocorrencia
     *
     * @return string
     */
    public function getOcorrencia()
    {
        return $this->ocorrencia;
    }

    /**
     * Set isEncerrada
     *
     * @param boolean $isEncerrada
     * @return OrdemServico
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
     * Set observacao
     *
     * @param string $observacao
     * @return OrdemServico
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
     * @return OrdemServico
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
     * @return OrdemServico
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
     * @return OrdemServico
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
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     * @return OrdemServico
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
     * Set colaboradorAtendente
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorAtendente
     * @return OrdemServico
     */
    public function setColaboradorAtendente(\AppBundle\Entity\Colaborador $colaboradorAtendente)
    {
        $this->colaboradorAtendente = $colaboradorAtendente;

        return $this;
    }

    /**
     * Get colaboradorAtendente
     *
     * @return \AppBundle\Entity\Colaborador
     */
    public function getColaboradorAtendente()
    {
        return $this->colaboradorAtendente;
    }

    /**
     * Set colaboradorExecutor
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorExecutor
     * @return OrdemServico
     */
    public function setColaboradorExecutor(\AppBundle\Entity\Colaborador $colaboradorExecutor)
    {
        $this->colaboradorExecutor = $colaboradorExecutor;

        return $this;
    }

    /**
     * Get colaboradorExecutor
     *
     * @return \AppBundle\Entity\Colaborador
     */
    public function getColaboradorExecutor()
    {
        return $this->colaboradorExecutor;
    }

    /**
     * Set relatorioAvaliacao
     *
     * @param string $relatorioAvaliacao
     * @return OrdemServico
     */
    public function setRelatorioAvaliacao($relatorioAvaliacao)
    {
        $this->relatorioAvaliacao = $relatorioAvaliacao;

        return $this;
    }

    /**
     * Get relatorioAvaliacao
     *
     * @return string
     */
    public function getRelatorioAvaliacao()
    {
        return $this->relatorioAvaliacao;
    }

    /**
     * Set justificativaEncerramento
     *
     * @param string $justificativaEncerramento
     * @return OrdemServico
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
     * Set colaboradorAvalista
     *
     * @param \AppBundle\Entity\Colaborador $colaboradorAvalista
     * @return OrdemServico
     */
    public function setColaboradorAvalista(\AppBundle\Entity\Colaborador $colaboradorAvalista = null)
    {
        $this->colaboradorAvalista = $colaboradorAvalista;

        return $this;
    }

    /**
     * Get colaboradorAvalista
     *
     * @return \AppBundle\Entity\Colaborador
     */
    public function getColaboradorAvalista()
    {
        return $this->colaboradorAvalista;
    }

    /**
     * Add fotos
     *
     * @param \AppBundle\Entity\FotoOs $fotos
     * @return OrdemServico
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
     * Set receptorNome
     *
     * @param string $receptorNome
     * @return OrdemServico
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
     * @return OrdemServico
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
     * Set isHomologada
     *
     * @param boolean $isHomologada
     * @return OrdemServico
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
     * Set endereco
     *
     * @param \AppBundle\Entity\Endereco $endereco
     * @return OrdemServico
     */
    public function setEndereco(\AppBundle\Entity\Endereco $endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return \AppBundle\Entity\Endereco
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set solicitante
     *
     * @param string $solicitante
     * @return OrdemServico
     */
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    /**
     * Get solicitante
     *
     * @return string
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return OrdemServico
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
     * Set osOriginal
     *
     * @param \AppBundle\Entity\OrdemServico $osOriginal
     * @return OrdemServico
     */
    public function setOsOriginal(\AppBundle\Entity\OrdemServico $osOriginal)
    {
        $this->osOriginal = $osOriginal;

        return $this;
    }

    /**
     * Get osOriginal
     *
     * @return \AppBundle\Entity\OrdemServico
     */
    public function getOsOriginal()
    {
        return $this->osOriginal;
    }

    /**
     * Set isPmoc
     *
     * @param boolean $isPmoc
     * @return OrdemServico
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
     * Add execucoesProcedimentos
     *
     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos
     * @return OrdemServico
     */
    public function addExecucaoProcedimento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos)
    {
        $this->execucoesProcedimentos[] = $execucoesProcedimentos;

        return $this;
    }

    /**
     * Remove execucoesProcedimentos
     *
     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos
     */
    public function removeExecucaoProcedimento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos)
    {
        $this->execucoesProcedimentos->removeElement($execucoesProcedimentos);
    }

    /**
     * Get execucoesProcedimentos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExecucoesProcedimentos()
    {
        return $this->execucoesProcedimentos;
    }

    /**
     * Set isSync
     *
     * @param boolean $isSync
     * @return OrdemServico
     */
    public function setIsSync($isSync)
    {
        $this->isSync = $isSync;

        return $this;
    }

    /**
     * Get isSync
     *
     * @return boolean
     */
    public function getIsSync()
    {
        return $this->isSync;
    }

    /**
     * Add execucoesProcedimentos
     *
     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos
     * @return OrdemServico
     */
    public function addExecucoesProcedimento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos)
    {
        $this->execucoesProcedimentos[] = $execucoesProcedimentos;

        return $this;
    }

    /**
     * Remove execucoesProcedimentos
     *
     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos
     */
    public function removeExecucoesProcedimento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucoesProcedimentos)
    {
        $this->execucoesProcedimentos->removeElement($execucoesProcedimentos);
    }

    /**
     * Set receptorAssinatura
     *
     * @param string $receptorAssinatura
     * @return OrdemServico
     */
    public function setReceptorAssinatura($receptorAssinatura)
    {
        $this->receptorAssinatura = $receptorAssinatura;

        return $this;
    }

    /**
     * Get receptorAssinatura
     *
     * @return string
     */
    public function getReceptorAssinatura()
    {
        return $this->receptorAssinatura;
    }

    /**
     * Add relatoriosExecucoesProcedimentos
     *
     * @param \AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento $relatoriosExecucoesProcedimentos
     * @return OrdemServico
     */
    public function addRelatoriosExecucoesProcedimento(\AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento $relatoriosExecucoesProcedimentos)
    {
        $this->relatoriosExecucoesProcedimentos[] = $relatoriosExecucoesProcedimentos;

        return $this;
    }

    /**
     * Remove relatoriosExecucoesProcedimentos
     *
     * @param \AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento $relatoriosExecucoesProcedimentos
     */
    public function removeRelatoriosExecucoesProcedimento(\AppBundle\Entity\RelatorioExecucaoDeProcedimentoEquipamento $relatoriosExecucoesProcedimentos)
    {
        $this->relatoriosExecucoesProcedimentos->removeElement($relatoriosExecucoesProcedimentos);
    }

    /**
     * Get relatoriosExecucoesProcedimentos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelatoriosExecucoesProcedimentos()
    {
        return $this->relatoriosExecucoesProcedimentos;
    }

    /**
     * Set isCancelada
     *
     * @param boolean $isCancelada
     * @return OrdemServico
     */
    public function setIsCancelada($isCancelada)
    {
        $this->isCancelada = $isCancelada;

        return $this;
    }

    /**
     * Get isCancelada
     *
     * @return boolean
     */
    public function getIsCancelada()
    {
        return $this->isCancelada;
    }

    /**
     * Set engenheiroResponsavel
     *
     * @param \AppBundle\Entity\Colaborador $engenheiroResponsavel
     * @return OrdemServico
     */
    public function setEngenheiroResponsavel(\AppBundle\Entity\Colaborador $engenheiroResponsavel)
    {
        $this->engenheiroResponsavel = $engenheiroResponsavel;

        return $this;
    }

    /**
     * Get engenheiroResponsavel
     *
     * @return \AppBundle\Entity\Colaborador
     */
    public function getEngenheiroResponsavel()
    {
        return $this->engenheiroResponsavel;
    }

    /**
     * Add fichasTecnicasProduto
     *
     * @param \AppBundle\Entity\FichaTecnicaProduto $fichasTecnicasProduto
     * @return OrdemServico
     */
    public function addFichasTecnicasProduto(\AppBundle\Entity\FichaTecnicaProduto $fichasTecnicasProduto)
    {
        $this->fichasTecnicasProduto[] = $fichasTecnicasProduto;

        return $this;
    }

    /**
     * Remove fichasTecnicasProduto
     *
     * @param \AppBundle\Entity\FichaTecnicaProduto $fichasTecnicasProduto
     */
    public function removeFichasTecnicasProduto(\AppBundle\Entity\FichaTecnicaProduto $fichasTecnicasProduto)
    {
        $this->fichasTecnicasProduto->removeElement($fichasTecnicasProduto);
    }

    /**
     * Get fichasTecnicasProduto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFichasTecnicasProduto()
    {
        return $this->fichasTecnicasProduto;
    }

    /**
     * Set normaTecnica
     *
     * @param \AppBundle\Entity\Norma $normaTecnica
     * @return OrdemServico
     */
    public function setNormaTecnica(\AppBundle\Entity\Norma $normaTecnica = null)
    {
        $this->normaTecnica = $normaTecnica;

        return $this;
    }

    /**
     * Get normaTecnica
     *
     * @return \AppBundle\Entity\Norma
     */
    public function getNormaTecnica()
    {
        return $this->normaTecnica;
    }

    /**
     * @return string
     */
    public function getMotivoCancelamento()
    {
        return $this->motivoCancelamento;
    }

    /**
     * @param string $motivoCancelamento
     */
    public function setMotivoCancelamento($motivoCancelamento)
    {
        $this->motivoCancelamento = $motivoCancelamento;
    }

    /**
     * @return \DateTime
     */
    public function getDataAbertura()
    {
        return $this->dataAbertura;
    }

    /**
     * @param \DateTime $dataAbertura
     */
    public function setDataAbertura($dataAbertura)
    {
        $this->dataAbertura = $dataAbertura;
    }

    /**
     * @return \DateTime
     */
    public function getDataEncerramento()
    {
        return $this->dataEncerramento;
    }

    /**
     * @param \DateTime $dataEncerramento
     */
    public function setDataEncerramento($dataEncerramento)
    {
        $this->dataEncerramento = $dataEncerramento;
    }

    /**
     * @return string
     */
    public function getIndiceRelatorio()
    {
        return $this->indiceRelatorio;
    }

    /**
     * @param string $indiceRelatorio
     */
    public function setIndiceRelatorio($indiceRelatorio)
    {
        $this->indiceRelatorio = $indiceRelatorio;
    }

    /**
     * @return string
     */
    public function getResumoRelatorio()
    {
        return $this->resumoRelatorio;
    }

    /**
     * @param string $resumoRelatorio
     */
    public function setResumoRelatorio($resumoRelatorio)
    {
        $this->resumoRelatorio = $resumoRelatorio;
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
     * Add tecnicosOs
     *
     * @param \AppBundle\Entity\Colaborador $tecnicosOs
     * @return OrdemServico
     */
    public function addTecnicosO(\AppBundle\Entity\Colaborador $tecnicosOs)
    {
        $this->tecnicosOs[] = $tecnicosOs;

        return $this;
    }

    /**
     * Remove tecnicosOs
     *
     * @param \AppBundle\Entity\Colaborador $tecnicosOs
     */
    public function removeTecnicosO(\AppBundle\Entity\Colaborador $tecnicosOs)
    {
        $this->tecnicosOs->removeElement($tecnicosOs);
    }

    /**
     * Get tecnicosOs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTecnicosOs()
    {
        return $this->tecnicosOs;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return OrdemServico
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
     * @return OrdemServico
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
     * Set osOriginalPai
     *
     * @param integer $osOriginalPai
     * @return OrdemServico
     */
    public function setOsOriginalPai($osOriginalPai)
    {
        $this->osOriginalPai = $osOriginalPai;

        return $this;
    }

    /**
     * Get osOriginalPai
     *
     * @return integer
     */
    public function getOsOriginalPai()
    {
        return $this->osOriginalPai;
    }

//    /**
//     * Set isParalisada
//     *
//     * @param boolean $isParalisada
//     * @return OrdemServico
//     */
//    public function setIsParalisada($isParalisada)
//    {
//        $this->isParalisada = $isParalisada;
//
//        return $this;
//    }

//    /**
//     * Get isParalisada
//     *
//     * @return boolean
//     */
//    public function getIsParalisada()
//    {
//        return $this->isParalisada;
//    }
}