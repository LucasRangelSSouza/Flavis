<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use Application\Sonata\UserBundle\Entity\User;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 *
 */
class Cliente
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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User", inversedBy="cliente", cascade={"persist"})
     */
    private $user;

    /**
     * @var FilialEmpresa
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FilialEmpresa")
     */
    private $filial;

    /**
     * @var \Application\Sonata\UserBundle\Entity\Group
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\Group")
     */
    private $grupoUsuario;

    /**
     * @var Cliente
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cliente")
     */
    private $facilities;

    /**
     * @var string
     * PJ=pessoaFisica, PF=pessoaJuridica
     * @ORM\Column(name="tipo_pessoa", type="string", length=2)
     */
    private $tipoPessoa;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=120)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150, nullable=false)
     */
    private $nomePerfil;


    /**
     * @var string
     *
     * @ORM\Column(name="cpf_cnpj", type="string", length=20, unique=false)
     */
    private $cpfCnpj;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_enabled", type="boolean", nullable=true, unique=false)
     */
    private $userEnabled;

    /**
     * @var string
     *  @ORM\Column(name="email", type="string", length=40, nullable=true, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="razao_social", type="string", length=120, nullable=true)
     */
    private $razaoSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="horario_abertura", type="time", nullable=true)
     */
    private $horarioAbertura;

    /**
     * @var string
     *
     * @ORM\Column(name="horario_fechamento", type="time", nullable=true)
     */
    private $horarioFechamento;

    /**
     * @var string
     *
     * @ORM\Column(name="intervalo_almoco", type="string",length=2, nullable=true, nullable=true)
     */
    private $intervalorAlmoco;

    /**
     * @var string
     * PR=predio, CA=casa, IN=industria, SH=shopping
     * @ORM\Column(name="tipo_local", type="string", length=2)
     */
    private $tipoLocal;

    /**
     * @var TipoNegocio
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="TipoNegocio")
     */
    private $tipoNegocio;

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
     * @ORM\ManyToMany(targetEntity="Telefone", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $telefones;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="Endereco", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $enderecos;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="ResponsavelCliente", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $responsaveis;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="Documento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $documentos;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
     * @ORM\OneToMany(targetEntity="ClienteEquipamento", mappedBy="cliente")
     */
    private $equipamentos;


    public function __toString()
    {
        return (string) ($this->id ? $this->nome : '-');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->telefones     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enderecos     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responsaveis  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipamentos  = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tipoPessoa
     *
     * @param string $tipoPessoa
     * @return Cliente
     */
    public function setTipoPessoa($tipoPessoa)
    {
        $this->tipoPessoa = $tipoPessoa;

        return $this;
    }

    /**
     * Get tipoPessoa
     *
     * @return string 
     */
    public function getTipoPessoa()
    {
        return $this->tipoPessoa;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Cliente
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set userEnabled
     *
     * @param string $userEnabled
     * @return Cliente
     */
    public function setUserEnabled($userEnabled)
    {
        $this->userEnabled = $userEnabled;

        return $this;
    }

    /**
     * Get userEnabled
     *
     * @return string
     */
    public function getUserEnabled()
    {
        return $this->userEnabled;
    }

    /**
     * Set cpfCnpj
     *
     * @param string $cpfCnpj
     * @return Cliente
     */
    public function setCpfCnpj($cpfCnpj)
    {
        $this->cpfCnpj = preg_replace("/\D+/", "", $cpfCnpj);

        return $this;
    }

    /**
     * Get cpfCnpj
     *
     * @return string 
     */
    public function getCpfCnpj()
    {
        if(strlen($this->cpfCnpj) == 11){
            return substr($this->cpfCnpj, 0, 3) . "." . substr($this->cpfCnpj, 3, 3) . "." . substr($this->cpfCnpj, 6, 3) . "-" . substr($this->cpfCnpj, -2);
        }
       elseif(strlen($this->cpfCnpj) == 14){
            return substr($this->cpfCnpj, 0, 2) . '.' . substr($this->cpfCnpj, 2, 3) .
                '.' . substr($this->cpfCnpj, 5, 3) . '/' .
                substr($this->cpfCnpj, 8, 4) . '-' . substr($this->cpfCnpj, 12, 2);
        }else{
            return $this->cpfCnpj;
        }

    }

    /**
     * Set email
     *
     * @param string $email
     * @return Cliente
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
     * Set razaoSocial
     *
     * @param string $razaoSocial
     * @return Cliente
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
     * Set horarioAbertura
     *
     * @param \DateTime $horarioAbertura
     * @return Cliente
     */
    public function setHorarioAbertura($horarioAbertura)
    {
        $this->horarioAbertura = $horarioAbertura;

        return $this;
    }

    /**
     * Get horarioAbertura
     *
     * @return \DateTime 
     */
    public function getHorarioAbertura()
    {
        return $this->horarioAbertura;
    }

    /**
     * Set horarioFechamento
     *
     * @param \DateTime $horarioFechamento
     * @return Cliente
     */
    public function setHorarioFechamento($horarioFechamento)
    {
        $this->horarioFechamento = $horarioFechamento;

        return $this;
    }

    /**
     * Get horarioFechamento
     *
     * @return \DateTime 
     */
    public function getHorarioFechamento()
    {
        return $this->horarioFechamento;
    }

    /**
     * Set intervalorAlmoco
     *
     * @param string $intervalorAlmoco
     * @return Cliente
     */
    public function setIntervalorAlmoco($intervalorAlmoco)
    {
        $this->intervalorAlmoco = $intervalorAlmoco;

        return $this;
    }

    /**
     * Get intervalorAlmoco
     *
     * @return string 
     */
    public function getIntervalorAlmoco()
    {
        return $this->intervalorAlmoco;
    }

    /**
     * Set tipoLocal
     *
     * @param string $tipoLocal
     * @return Cliente
     */
    public function setTipoLocal($tipoLocal)
    {
        $this->tipoLocal = $tipoLocal;

        return $this;
    }

    /**
     * Get tipoLocal
     *
     * @return string 
     */
    public function getTipoLocal()
    {
        return $this->tipoLocal;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Cliente
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
     * @return Cliente
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
     * @return Cliente
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
     * Set tipoNegocio
     *
     * @param \AppBundle\Entity\TipoNegocio $tipoNegocio
     * @return Cliente
     */
    public function setTipoNegocio(\AppBundle\Entity\TipoNegocio $tipoNegocio = null)
    {
        $this->tipoNegocio = $tipoNegocio;

        return $this;
    }

    /**
     * Get tipoNegocio
     *
     * @return \AppBundle\Entity\TipoNegocio 
     */
    public function getTipoNegocio()
    {
        return $this->tipoNegocio;
    }

    /**
     * Add telefones
     *
     * @param \AppBundle\Entity\Telefone $telefones
     * @return Cliente
     */
    public function addTelefone(\AppBundle\Entity\Telefone $telefones)
    {

        $this->telefones[] = $telefones;

        return $this;
    }

    /**
     * Remove telefones
     *
     * @param \AppBundle\Entity\Telefone $telefones
     */
    public function removeTelefone(\AppBundle\Entity\Telefone $telefones)
    {
        $this->telefones->removeElement($telefones);
    }


    /**
     * Get telefones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefones()
    {
//
//        for($i=0;$i<count($this->telefones);$i++){
//
//            $this->telefones[$i]->setNumero($this->formatarNumero($this->telefones[$i]->getNumero()));
//
////            if(strlen($this->telefones[$i]->getNumero()) === 10) {
////                $this->telefones[$i]->setNumero('(' . substr($this->telefones[$i]->getNumero(), 0, 2) . ') ' . substr($this->telefones[$i]->getNumero(), 2, 4)
////                    . '-' . substr($this->telefones[$i]->getNumero(), 6));
////            }
////            elseif (strlen($this->telefones[$i]->getNumero()) === 11){
////                $this->telefones[$i]->setNumero('(' . substr($this->telefones[$i]->getNumero(), 0, 2) . ') ' . substr($this->telefones[$i]->getNumero(), 2, 5)
////                    . '-' . substr($this->telefones[$i]->getNumero(), 7));
////            }
//        }

        return $this->telefones;
    }

    /**
     * Add enderecos
     *
     * @param \AppBundle\Entity\Endereco $enderecos
     * @return Cliente
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
     * Add responsaveis
     *
     * @param \AppBundle\Entity\ResponsavelCliente $responsaveis
     * @return Cliente
     */
    public function addResponsavei(\AppBundle\Entity\ResponsavelCliente $responsaveis)
    {
        $this->responsaveis[] = $responsaveis;

        return $this;
    }

    /**
     * Remove responsaveis
     *
     * @param \AppBundle\Entity\ResponsavelCliente $responsaveis
     */
    public function removeResponsavei(\AppBundle\Entity\ResponsavelCliente $responsaveis)
    {
        $this->responsaveis->removeElement($responsaveis);
    }

    /**
     * Get responsaveis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponsaveis()
    {
        return $this->responsaveis;
    }

    /**
     * Add documentos
     *
     * @param \AppBundle\Entity\Documento $documentos
     * @return Cliente
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
     * Set filial
     *
     * @param \AppBundle\Entity\FilialEmpresa $filial
     * @return Cliente
     */
    public function setFilial(\AppBundle\Entity\FilialEmpresa $filial = null)
    {
        $this->filial = $filial;

        return $this;
    }

    /**
     * Get filial
     *
     * @return \AppBundle\Entity\FilialEmpresa 
     */
    public function getFilial()
    {
        return $this->filial;
    }


    /**
     * Set facilities
     *
     * @param \AppBundle\Entity\Cliente $facilities
     * @return Cliente
     */
    public function setFacilities(\AppBundle\Entity\Cliente $facilities = null)
    {
        $this->facilities = $facilities;

        return $this;
    }

    /**
     * Get facilities
     *
     * @return \AppBundle\Entity\Cliente 
     */
    public function getFacilities()
    {
        return $this->facilities;
    }

    /**
     * Add equipamentos
     *
     * @param \AppBundle\Entity\ClienteEquipamento $equipamentos
     * @return Cliente
     */
    public function addEquipamento(\AppBundle\Entity\ClienteEquipamento $equipamentos)
    {
        $this->equipamentos[] = $equipamentos;

        return $this;
    }

    /**
     * Remove equipamentos
     *
     * @param \AppBundle\Entity\ClienteEquipamento $equipamentos
     */
    public function removeEquipamento(\AppBundle\Entity\ClienteEquipamento $equipamentos)
    {
        $this->equipamentos->removeElement($equipamentos);
    }

    /**
     * Get equipamentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipamentos()
    {
        return $this->equipamentos;
    }


    /**
     * @return \Application\Sonata\UserBundle\Entity\Group
     */
    public function getGrupoUsuario()
    {
        return $this->grupoUsuario;
    }

    /**
     * @param \Application\Sonata\UserBundle\Entity\Group $grupoUsuario
     */
    public function setGrupoUsuario($grupoUsuario)
    {
        $this->grupoUsuario = $grupoUsuario;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Cliente
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil[
     * @return Cliente
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
