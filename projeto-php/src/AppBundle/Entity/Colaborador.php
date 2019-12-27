<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Application\Sonata\UserBundle\Entity\User;
use JMS\Serializer\Annotation as JMS;

/**
 * Colaborador
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity(fields="user", message="Este usuário já está vinculado a outro Colaborador.")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Uploadable(path="uploads/assinaturas-engenheiros", filenameGenerator="SHA1")
 */
class Colaborador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @JMS\Exclude
     * F=funcionario, T=terceirizado
     * @ORM\Column(name="tipo_colaborador", type="string", length=10)
     */
    private $tipoColaborador;

    /**
     * @var Funcao
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="Funcao")
     */
    private $funcao;

    /**
     * @var \Application\Sonata\UserBundle\Entity\Group
     * @JMS\Exclude
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\Group")
     */
    private $grupoUsuario;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User", inversedBy="colaborador", cascade={"persist"})
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=120)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=150)
     */
    private $nomePerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=false, nullable=false)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1)
     */
    private $sexo;

    /**
     * @var \DateTime
     * @JMS\Exclude
     * @ORM\Column(name="data_nascimento", type="date")
     */
    private $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11, unique=false)
     */
    private $cpf;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="rg", type="string", length=20)
     */
    private $rg;

    /**
     * @var string
     *
     * @ORM\Column(name="cra", type="string", length=120, nullable=true)
     */
    private $crea;

    /**
     * @var string
     *
     * @ORM\Column(name="artigo_crea", type="string", length=120, nullable=true)
     */
    private $artigoCrea;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="estado_civil", type="string", length=2)
     */
    private $estadoCivil;

    /**
     * @var \DateTime
     * @JMS\Exclude
     * @ORM\Column(name="data_admissao", type="date", nullable=true)
     */
    private $dataAdmissao;

    /**
     * @var \DateTime
     * @JMS\Exclude
     * @ORM\Column(name="data_recisao", type="date", nullable=true)
     */
    private $dataRecisao;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="formacao", type="string", length=255, nullable=true)
     */
    private $formacao;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="nivel_escolaridade", type="string", length=40, nullable=true)
     */
    private $nivelEscolaridade;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="banco_conta", type="string", length=10, nullable=true)
     */
    private $bancoNumero;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="banco_agencia", type="string", length=10, nullable=true)
     */
    private $bancoAgencia;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="banco_nome", type="string", length=150, nullable=true)
     */
    private $bancoNome;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="banco_ccorrente", type="string", length=150, nullable=true)
     */
    private $bancoCCorrente;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="horario_entrada", type="time", nullable=true)
     */
    private $horarioEntrada;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="horario_saida", type="time", nullable=true)
     */
    private $horarioSaida;

    /**
     * @var string
     * @JMS\Exclude
     * @ORM\Column(name="intervalo_almoco", type="string",length=2, nullable=true)
     */
    private $intervalorAlmoco;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=2)
     */
    private $status = 'AT';

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
     * @JMS\Exclude
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\FilialEmpresa", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $filiais;

    /**
     * @var ArrayCollection
     * @JMS\Exclude
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
     * @ORM\ManyToMany(targetEntity="Documento", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private $documentos;


    /**
     * @var string
     *
     * @ORM\Column(name="pathFoto", type="string", length=255,nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $pathFoto;
    private $oldPathFoto;

    public function __toString()
    {
        return (string) ($this->id ? $this->nome : '-');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filiais    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->telefones  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enderecos  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tipoColaborador
     *
     * @param string $tipoColaborador
     * @return Colaborador
     */
    public function setTipoColaborador($tipoColaborador)
    {
        $this->tipoColaborador = $tipoColaborador;

        return $this;
    }

    /**
     * Get tipoColaborador
     *
     * @return string 
     */
    public function getTipoColaborador()
    {
        return $this->tipoColaborador;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Colaborador
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
      * Set nome
      *
      * @param string $nome
      * @return Colaborador
      */
    public function setNomePerfil($nomePerfil)
    {
        $this->nomePerfil = $nomePerfil;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNomePerfil()
    {
        return $this->nomePerfil;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Colaborador
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
     * Set sexo
     *
     * @param string $sexo
     * @return Colaborador
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     * @return Colaborador
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime 
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     * @return Colaborador
     */
    public function setCpf($cpf)
    {
        $re = '/[^0-9]/' ;

        $cpf = preg_replace($re, '', $cpf);

        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return substr($this->cpf, 0, 3) . "." . substr($this->cpf, 3, 3) . "." . substr($this->cpf, 6, 3) . "-" . substr($this->cpf, -2);
       // return $this->cpf;
    }

    /**
     * Set rg
     *
     * @param string $rg
     * @return Colaborador
     */
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get rg
     *
     * @return string 
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     * @return Colaborador
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set dataAdmissao
     *
     * @param \DateTime $dataAdmissao
     * @return Colaborador
     */
    public function setDataAdmissao($dataAdmissao)
    {
        $this->dataAdmissao = $dataAdmissao;

        return $this;
    }

    /**
     * Get dataAdmissao
     *
     * @return \DateTime 
     */
    public function getDataAdmissao()
    {
        return $this->dataAdmissao;
    }

    /**
     * Set dataRecisao
     *
     * @param \DateTime $dataRecisao
     * @return Colaborador
     */
    public function setDataRecisao($dataRecisao)
    {
        $this->dataRecisao = $dataRecisao;

        return $this;
    }

    /**
     * Get dataRecisao
     *
     * @return \DateTime 
     */
    public function getDataRecisao()
    {
        return $this->dataRecisao;
    }

    /**
     * Set formacao
     *
     * @param string $formacao
     * @return Colaborador
     */
    public function setFormacao($formacao)
    {
        $this->formacao = $formacao;

        return $this;
    }

    /**
     * Get formacao
     *
     * @return string 
     */
    public function getFormacao()
    {
        return $this->formacao;
    }

    /**
     * Set nivelEscolaridade
     *
     * @param string $nivelEscolaridade
     * @return Colaborador
     */
    public function setNivelEscolaridade($nivelEscolaridade)
    {
        $this->nivelEscolaridade = $nivelEscolaridade;

        return $this;
    }

    /**
     * Get nivelEscolaridade
     *
     * @return string 
     */
    public function getNivelEscolaridade()
    {
        return $this->nivelEscolaridade;
    }

    /**
     * Set bancoNumero
     *
     * @param string $bancoNumero
     * @return Colaborador
     */
    public function setBancoNumero($bancoNumero)
    {
        $this->bancoNumero = $bancoNumero;

        return $this;
    }

    /**
     * Get bancoNumero
     *
     * @return string 
     */
    public function getBancoNumero()
    {
        return $this->bancoNumero;
    }

    /**
     * Set bancoAgencia
     *
     * @param string $bancoAgencia
     * @return Colaborador
     */
    public function setBancoAgencia($bancoAgencia)
    {
        $this->bancoAgencia = $bancoAgencia;

        return $this;
    }

    /**
     * Get bancoAgencia
     *
     * @return string 
     */
    public function getBancoAgencia()
    {
        return $this->bancoAgencia;
    }

    /**
     * Set bancoNome
     *
     * @param string $bancoNome
     * @return Colaborador
     */
    public function setBancoNome($bancoNome)
    {
        $this->bancoNome = $bancoNome;

        return $this;
    }

    /**
     * Get bancoNome
     *
     * @return string 
     */
    public function getBancoNome()
    {
        return $this->bancoNome;
    }

    /**
     * Set bancoCCorrente
     *
     * @param string $bancoCCorrente
     * @return Colaborador
     */
    public function setBancoCCorrente($bancoCCorrente)
    {
        $this->bancoCCorrente = $bancoCCorrente;

        return $this;
    }

    /**
     * Get bancoCCorrente
     *
     * @return string 
     */
    public function getBancoCCorrente()
    {
        return $this->bancoCCorrente;
    }

    /**
     * Set horarioEntrada
     *
     * @param \DateTime $horarioEntrada
     * @return Colaborador
     */
    public function setHorarioEntrada($horarioEntrada)
    {
        $this->horarioEntrada = $horarioEntrada;

        return $this;
    }

    /**
     * Get horarioEntrada
     *
     * @return \DateTime 
     */
    public function getHorarioEntrada()
    {
        return $this->horarioEntrada;
    }

    /**
     * Set horarioSaida
     *
     * @param \DateTime $horarioSaida
     * @return Colaborador
     */
    public function setHorarioSaida($horarioSaida)
    {
        $this->horarioSaida = $horarioSaida;

        return $this;
    }

    /**
     * Get horarioSaida
     *
     * @return \DateTime 
     */
    public function getHorarioSaida()
    {
        return $this->horarioSaida;
    }

    /**
     * Set intervalorAlmoco
     *
     * @param \DateTime $intervalorAlmoco
     * @return Colaborador
     */
    public function setIntervalorAlmoco($intervalorAlmoco)
    {
        $this->intervalorAlmoco = $intervalorAlmoco;

        return $this;
    }

    /**
     * Get intervalorAlmoco
     *
     * @return \DateTime 
     */
    public function getIntervalorAlmoco()
    {
        return $this->intervalorAlmoco;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Colaborador
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Colaborador
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
     * @return Colaborador
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
     * @return Colaborador
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
     * Set funcao
     *
     * @param \AppBundle\Entity\Funcao $funcao
     * @return Colaborador
     */
    public function setFuncao(\AppBundle\Entity\Funcao $funcao = null)
    {
        $this->funcao = $funcao;

        return $this;
    }

    /**
     * Get funcao
     *
     * @return \AppBundle\Entity\Funcao 
     */
    public function getFuncao()
    {
        return $this->funcao;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Colaborador
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
     * Add telefones
     *
     * @param \AppBundle\Entity\Telefone $telefones
     * @return Colaborador
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

        for($i=0;$i<count($this->telefones);$i++){

            if(strlen($this->telefones[$i]->getNumero()) === 10) {
                $this->telefones[$i]->setNumero('(' . substr($this->telefones[$i]->getNumero(), 0, 2) . ') ' . substr($this->telefones[$i]->getNumero(), 2, 4)
                    . '-' . substr($this->telefones[$i]->getNumero(), 6));
            }
            elseif (strlen($this->telefones[$i]->getNumero()) === 11){
                $this->telefones[$i]->setNumero('(' . substr($this->telefones[$i]->getNumero(), 0, 2) . ') ' . substr($this->telefones[$i]->getNumero(), 2, 5)
                    . '-' . substr($this->telefones[$i]->getNumero(), 7));
            }
        }


        return $this->telefones;
    }

    /**
     * Add enderecos
     *
     * @param \AppBundle\Entity\Endereco $enderecos
     * @return Colaborador
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
     * @return Colaborador
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
     * Add filiais
     *
     * @param \AppBundle\Entity\FilialEmpresa $filiais
     * @return Colaborador
     */
    public function addFilial(\AppBundle\Entity\FilialEmpresa $filiais)
    {
        $this->filiais[] = $filiais;

        return $this;
    }

    /**
     * Remove filiais
     *
     * @param \AppBundle\Entity\FilialEmpresa $filiais
     */
    public function removeFilial(\AppBundle\Entity\FilialEmpresa $filiais)
    {
        $this->filiais->removeElement($filiais);
    }

    /**
     * Get filiais
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiliais()
    {
        return $this->filiais;
    }

    /**
     * Add filiais
     *
     * @param \AppBundle\Entity\FilialEmpresa $filiais
     * @return Colaborador
     */
    public function addFiliai(\AppBundle\Entity\FilialEmpresa $filiais)
    {
        $this->filiais[] = $filiais;

        return $this;
    }

    /**
     * Remove filiais
     *
     * @param \AppBundle\Entity\FilialEmpresa $filiais
     */
    public function removeFiliai(\AppBundle\Entity\FilialEmpresa $filiais)
    {
        $this->filiais->removeElement($filiais);
    }

    /**
     * Set crea
     *
     * @param string $crea
     * @return Colaborador
     */
    public function setCrea($crea)
    {
        $this->crea = $crea;

        return $this;
    }

    /**
     * Get crea
     *
     * @return string 
     */
    public function getCrea()
    {
        return $this->crea;
    }


    /**
     * Set pathFoto
     *
     * @param string $pathFoto
     * @return Colaborador
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
     * @return Colaborador
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
     * @return string
     */
    public function getArtigoCrea()
    {
        return $this->artigoCrea;
    }

    /**
     * @param string $artigoCrea
     */
    public function setArtigoCrea($artigoCrea)
    {
        $this->artigoCrea = $artigoCrea;
    }

}
