<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RelatorioExecucaoDeProcedimentoEquipamento
 *
 * Cada relatório corresponde a uma execução. Lembrando que uma os pode ter várias execuções
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RelatorioExecucaoDeProcedimentoEquipamento
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ExecucaoDeProcedimentoEquipamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="execucao_de_procedimento_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $execucaoDeProcedimentoEquipamento;

    /**
     * @var string
     *
     * @ORM\Column(name="relatorio_de_execucao", type="text", nullable=true)
     */
    private $relatorioDeExecucao;

    /**
     * @var string
     *
     * Quando houver propriedade a ser verificada pegar os valores numa string json [{'id':'valor',...}]
     *
     * @ORM\Column(name="propriedade_equipamento_com_valores_coletado", type="text", nullable=true)
     */
    private $propriedadeEquipamentoComValoresColetado;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OrdemServico", inversedBy="relatoriosExecucoesProcedimentos")
     * @ORM\JoinColumn(name="os_id", referencedColumnName="id")
     */
    private $os;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;


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
     * Set relatorioDeExecucao
     *
     * @param string $relatorioDeExecucao
     * @return RelatorioExecucaoDeProcedimentoEquipamento
     */
    public function setRelatorioDeExecucao($relatorioDeExecucao)
    {
        $this->relatorioDeExecucao = $relatorioDeExecucao;

        return $this;
    }

    /**
     * Get relatorioDeExecucao
     *
     * @return string 
     */
    public function getRelatorioDeExecucao()
    {
        return $this->relatorioDeExecucao;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RelatorioExecucaoDeProcedimentoEquipamento
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
     * Set execucaoDeProcedimentoEquipamento
     *
     * @param \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucaoDeProcedimentoEquipamento
     * @return RelatorioExecucaoDeProcedimentoEquipamento
     */
    public function setExecucaoDeProcedimentoEquipamento(\AppBundle\Entity\ExecucaoDeProcedimentoEquipamento $execucaoDeProcedimentoEquipamento)
    {
        $this->execucaoDeProcedimentoEquipamento = $execucaoDeProcedimentoEquipamento;

        return $this;
    }

    /**
     * Get execucaoDeProcedimentoEquipamento
     *
     * @return \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento 
     */
    public function getExecucaoDeProcedimentoEquipamento()
    {
        return $this->execucaoDeProcedimentoEquipamento;
    }

    /**
     * Set propriedadeEquipamentoComValoresColetado
     *
     * @param string $propriedadeEquipamentoComValoresColetado
     * @return RelatorioExecucaoDeProcedimentoEquipamento
     */
    public function setPropriedadeEquipamentoComValoresColetado($propriedadeEquipamentoComValoresColetado)
    {
        $this->propriedadeEquipamentoComValoresColetado = $propriedadeEquipamentoComValoresColetado;

        return $this;
    }

    /**
     * Get propriedadeEquipamentoComValoresColetado
     *
     * @return string 
     */
    public function getPropriedadeEquipamentoComValoresColetado()
    {
        return $this->propriedadeEquipamentoComValoresColetado;
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
}
