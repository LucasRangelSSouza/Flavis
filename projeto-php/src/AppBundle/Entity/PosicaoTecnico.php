<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PosicaoTecnico
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PosicaoTecnico
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
     * @var Colaborador
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colaborador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tecnico_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tecnico;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=false)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="battery_level", type="integer")
     */
    private $batteryLevel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_perfil", type="string", length=155, nullable=false)
     */
    private $nomePerfil;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PosicaoTecnico
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
     * @return Colaborador
     */
    public function getTecnico()
    {
        return $this->tecnico;
    }

    /**
     * @param Colaborador $tecnico
     */
    public function setTecnico($tecnico)
    {
        $this->tecnico = $tecnico;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getBatteryLevel()
    {
        return $this->batteryLevel;
    }

    /**
     * @param string $batteryLevel
     */
    public function setBatteryLevel($batteryLevel)
    {
        $this->batteryLevel = $batteryLevel;
    }

    /**
     * @param string $nomePerfil
     */
    public function setNomePerfil($nomePerfil)
    {
        $this->nomePerfil = $nomePerfil;

        return $this;
    }

    /**
     * @return string
     */
    public function getNomePerfil()
    {
        return $this->nomePerfil;
    }
}