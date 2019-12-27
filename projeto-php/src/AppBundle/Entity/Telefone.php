<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Telefone
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Telefone
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
     * @var TipoTelefone
     *
     * @ORM\ManyToOne(targetEntity="TipoTelefone")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=14)
     */
    private $numero;

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


    public function __toString()
    {
        return (string) ($this->id ? $this->numero : '-');
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
     * Set numero
     *
     * @param string $numero
     * @return Telefone
     */
    public function setNumero($numero)
    {
       // $this->numero = $numero;

        $this->numero = preg_replace('/[^0-9]/', '', $numero);

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {

//        if(strlen($this->numero) === 10) {
//            $this->numero = '(' . substr($this->numero, 0, 2) . ') ' . substr($this->numero, 2, 4)
//                . '-' . substr($this->numero, 6);
//        }
//        elseif (strlen($this->numero) === 11){
//            $this->numero = '(' . substr($this->numero, 0, 2) . ') ' . substr($this->numero, 2, 5)
//                . '-' . substr($this->numero, 7);
//        }

        return $this->numero;
    }

    /**
     * Set tipo
     *
     * @param \AppBundle\Entity\TipoTelefone $tipo
     * @return Telefone
     */
    public function setTipo(\AppBundle\Entity\TipoTelefone $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \AppBundle\Entity\TipoTelefone
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Telefone
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
     * @return Telefone
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
     * @return Telefone
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



}
