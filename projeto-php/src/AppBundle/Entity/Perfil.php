<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Perfil
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Perfil
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_termino", type="datetime", nullable=true)
     */
    private $dataTermino;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=155, nullable=false, unique=true)
     */
    private $nomePerfil;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="logo_path_file", type="string", length=255, nullable=true)
//     */
//    private $logoPathFile;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="banner_path_file", type="string", length=255, nullable=true)
//     */
//    private $bannerPathFile;

    /**
     * @var string
     *
     * @ORM\Column(name="email_manutencao", type="string", length=255, nullable=true)
     */
    private $emailManutencao;

    /**
     * @var string
     *
     * @ORM\Column(name="email_agendamento", type="string", length=255, nullable=true)
     */
    private $emailAgendamento;

    /**
     * @var string
     *
     * @ORM\Column(name="email_solicitacao", type="string", length=255, nullable=true)
     */
    private $emailSolicitacao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="trial", type="boolean", nullable=true)
     */
    protected $trial;

    /**
     * @var string
     *
     * @ORM\Column(name="driver", type="string", length=255, nullable=true)
     */
    protected $driver;

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=255, nullable=true)
     */
    protected $server;

    /**
     * @var integer
     *
     * @ORM\Column(name="porta", type="string", length=255, nullable=true)
     */
    protected $porta;

    /**
     * @var string
     *
     * @ORM\Column(name="dbname", type="string", length=255, nullable=true)
     */
    protected $dbname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * @var Empresa
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="empresa_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $empresa;

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
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
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
     * @ORM\Column(name="user_id", type="integer" nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=false, nullable=false)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var \Application\Sonata\UserBundle\Entity\Group
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\Group")
     */
    private $grupoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_path_file", type="string", length=255, nullable=true)
     * @Gedmo\UploadableFilePath
     */
    private $logoPathFile;
    private $oldLogoPathFile;


    public function __toString()
    {
        return (string) ($this->id ? $this->nomePerfil : '-');
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
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return Perfil
     */
    public function setdataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime
     */
    public function getdataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataTermino
     *
     * @param \DateTime $dataTermino
     * @return Perfil
     */
    public function setDataTermino($dataTermino)
    {
        $this->dataTermino = $dataTermino;

        return $this;
    }

    /**
     * Get dataTermino
     *
     * @return \DateTime
     */
    public function getDataTermino()
    {
        return $this->dataTermino;
    }

    /**
     * Set nomePerfil
     *
     * @param string $nomePerfil
     * @return Perfil
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

//    /**
//     * Set logoPathFile
//     *
//     * @param string $logoPathFile
//     * @return Perfil
//     */
//    public function setLogoPathFile($logoPathFile)
//    {
//        $this->logoPathFile = $logoPathFile;
//
//        return $this;
//    }
//
//    /**
//     * Get logoPathFile
//     *
//     * @return string
//     */
//    public function getLogoPathFile()
//    {
//        return $this->logoPathFile;
//    }

//    /**
//     * Set bannerPathFile
//     *
//     * @param string $bannerPathFile
//     * @return Perfil
//     */
//    public function setBannerPathFile($bannerPathFile)
//    {
//        $this->bannerPathFile = $bannerPathFile;
//
//        return $this;
//    }
//
//    /**
//     * Get bannerPathFile
//     *
//     * @return string
//     */
//    public function getBannerPathFile()
//    {
//        return $this->bannerPathFile;
//    }

    /**
     * Set emailManutencao
     *
     * @param string $emailManutencao
     * @return Perfil
     */
    public function setEmailManutencao($emailManutencao)
    {
        $this->emailManutencao = $emailManutencao;

        return $this;
    }

    /**
     * Get emailManutencao
     *
     * @return string
     */
    public function getEmailManutencao()
    {
        return $this->emailManutencao;
    }

    /**
     * Set emailAgendamento
     *
     * @param string $emailAgendamento
     * @return Perfil
     */
    public function setEmailAgendamento($emailAgendamento)
    {
        $this->emailAgendamento = $emailAgendamento;

        return $this;
    }

    /**
     * Get emailAgendamento
     *
     * @return string
     */
    public function getEmailAgendamento()
    {
        return $this->emailAgendamento;
    }

    /**
     * Set emailSolicitacao
     *
     * @param string $emailSolicitacao
     * @return Perfil
     */
    public function setEmailSolicitacao($emailSolicitacao)
    {
        $this->emailSolicitacao = $emailSolicitacao;

        return $this;
    }

    /**
     * Get emailSolicitacao
     *
     * @return string
     */
    public function getEmailSolicitacao()
    {
        return $this->emailSolicitacao;
    }

    /**
     * Set trial
     *
     * @param string $trial
     * @return Perfil
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;

        return $this;
    }

    /**
     * Get trial
     *
     * @return string
     */
    public function getTrial()
    {
        return $this->trial;
    }

    /**
     * Set driver
     *
     * @param string $driver
     * @return Perfil
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set server
     *
     * @param string $server
     * @return Perfil
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set porta
     *
     * @param integer $porta
     * @return Perfil
     */
    public function setPorta($porta)
    {
        $this->porta = $porta;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPorta()
    {
        return $this->porta;
    }

    /**
     * Set dbname
     *
     * @param string $dbname
     * @return Perfil
     */
    public function setDatabase($dbname)
    {
        $this->dbname = $dbname;

        return $this;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->dbname;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Perfil
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Perfil
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     * @return Perfil
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Perfil
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
     * @return Perfil
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
     * @return Perfil
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Perfil
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
     * Set email
     *
     * @param string $email
     * @return Perfil
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
     * Set logoPathFile
     *
     * @param string $logoPathFile
     * @return Perfil
     */
    public function setLogoPathFile($logoPathFile)
    {
        if (empty($this->oldLogoPathFile)) {
            $this->oldLogoPathFile = $this->logoPathFile;
        }

        // Se nada foi enviado no form
        if($this->logoPathFile=='') {
            $this->logoPathFile = $logoPathFile;
        }

        return $this;
    }

    /**
     * Get logoPathFile
     *
     * @return string
     */
    public function getLogoPathFile()
    {
        return $this->logoPathFile;
    }

    /**
     * Set oldLogoPathFile
     *
     * @param string $oldLogoPathFile
     * @return Perfil
     */
    public function setOldLogoPathFile($oldLogoPathFile)
    {
        $this->oldLogoPathFile = $oldLogoPathFile;

        return $this;
    }

    /**
     * Get oldLogoPathFile
     *
     * @return string
     */
    public function getOldLogoPathFile()
    {
        return $this->oldLogoPathFile;
    }
}