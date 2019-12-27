<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Fornecedor
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Fornecedor
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
     * @ORM\Column(name="cnpj", type="string", length=30)
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
     * @ORM\Column(name="razao_social", type="string", length=155)
     */
    private $razaoSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="inscricao_estadual", type="string", length=30, nullable=true)
     */
    private $inscricaoEstadual;

    /**
     * @var string
     *
     * @ORM\Column(name="inscricao_municipal", type="string", length=30, nullable=true)
     */
    private $inscricaoMunicipal;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=25, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_vendedor", type="string", length=45, nullable=true, options={"default"="Vendedor Teste"})
     */
    private $nomeVendedor;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text",nullable=true)
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
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Endereco", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $enderecos;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Documento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $documentos;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150)
     */
    private $nomePerfil;


    public function __toString()
    {
        return (string) ($this->id ? $this->razaoSocial : '-');
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
     * @return Fornecedor
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
      return  substr($this->cnpj, 0, 2) . '.' . substr($this->cnpj, 2, 3) .
        '.' . substr($this->cnpj, 5, 3) . '/' .
        substr($this->cnpj, 8, 4) . '-' . substr($this->cnpj, 12, 2);
        //return $this->cnpj;
    }

    /**
     * Set razaoSocial
     *
     * @param string $razaoSocial
     * @return Fornecedor
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
     * Set email
     *
     * @param string $email
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * Set nomeVendedor
     *
     * @param string $nomeVendedor
     * @return Fornecedor
     */
    public function setNomeVendedor($nomeVendedor)
    {
        $this->nomeVendedor = $nomeVendedor;

        return $this;
    }

    /**
     * Get nomeVendedor
     *
     * @return string 
     */
    public function getNomeVendedor()
    {
        return $this->nomeVendedor;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enderecos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nomeFantasia
     *
     * @param string $nomeFantasia
     * @return Fornecedor
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
     * Set inscricaoEstadual
     *
     * @param string $inscricaoEstadual
     * @return Fornecedor
     */
    public function setInscricaoEstadual($inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual;

        return $this;
    }

    /**
     * Get inscricaoEstadual
     *
     * @return string 
     */
    public function getInscricaoEstadual()
    {
        return $this->inscricaoEstadual;
    }

    /**
     * Set inscricaoMunicipal
     *
     * @param string $inscricaoMunicipal
     * @return Fornecedor
     */
    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;

        return $this;
    }

    /**
     * Get inscricaoMunicipal
     *
     * @return string 
     */
    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     * @return Fornecedor
     */
    public function setTelefone($telefone)
    {
        $telefone = preg_replace("/\D+/", "", $telefone);

        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string 
     */
    public function getTelefone()
    {
            if(strlen($this->telefone)) {
                $this->telefone = ('(' . substr($this->telefone, 0, 2) . ') ' . substr($this->telefone, 2, 4)
                    . '-' . substr($this->telefone, 6));
            }


        return $this->telefone;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     * @return Fornecedor
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
     * Add enderecos
     *
     * @param \AppBundle\Entity\Endereco $enderecos
     * @return Fornecedor
     */
    public function addEndereco(\AppBundle\Entity\Endereco $enderecos)
    {
        $this->enderecos[] = $enderecos;

        return $this;
    }

    /**
     * Remove enderecos
     *
     * @param \AppBundle\Entity\Endereco $enderecos
     */
    public function removeEndereco(\AppBundle\Entity\Endereco $enderecos)
    {
        $this->enderecos->removeElement($enderecos);
    }

    /**
     * Get enderecos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnderecos()
    {
        return $this->enderecos;
    }

    /**
     * Add documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     * @return Fornecedor
     */
    public function addDocumento(\AppBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\AppBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return Fornecedor
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
