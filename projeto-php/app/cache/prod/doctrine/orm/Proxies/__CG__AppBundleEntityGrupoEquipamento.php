<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class GrupoEquipamento extends \AppBundle\Entity\GrupoEquipamento implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'tipoAmbiente', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'funcao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'grupoUsuario', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'user', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'nome', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'email', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'sexo', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'dataNascimento', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'cpf', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'rg', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'crea', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'artigoCrea', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'estadoCivil', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'dataAdmissao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'dataRecisao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'formacao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'nivelEscolaridade', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoNumero', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoAgencia', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoNome', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoCCorrente', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'horarioEntrada', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'horarioSaida', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'intervalorAlmoco', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'status', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'filiais', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'telefones', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'enderecos', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'documentos', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'pathFoto', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'oldPathFoto');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'tipoAmbiente', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'funcao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'grupoUsuario', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'user', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'nome', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'email', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'sexo', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'dataNascimento', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'cpf', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'rg', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'crea', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'artigoCrea', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'estadoCivil', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'dataAdmissao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'dataRecisao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'formacao', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'nivelEscolaridade', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoNumero', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoAgencia', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoNome', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'bancoCCorrente', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'horarioEntrada', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'horarioSaida', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'intervalorAlmoco', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'status', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'filiais', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'telefones', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'enderecos', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'documentos', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'pathFoto', '' . "\0" . 'AppBundle\\Entity\\Ambiente' . "\0" . 'oldPathFoto');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Ambiente $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }


    /**
     * {@inheritDoc}
     */
    public function setTitulo($titulo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitulo', array($titulo));

        return parent::setTitulo($titulo);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitulo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitulo', array());

        return parent::getTitulo();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt($createdAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', array($createdAt));

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', array());

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt($updatedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', array($updatedAt));

        return parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', array());

        return parent::getUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedAt($deletedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedAt', array($deletedAt));

        return parent::setDeletedAt($deletedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedAt', array());

        return parent::getDeletedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getNomePerfil()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNomePerfil', array());

        return parent::getNomePerfil();
    }

    /**
     * {@inheritDoc}
     */
    public function setNomePerfil($artigoCrea)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNomePerfil', array($artigoCrea));

        return parent::setNomePerfil($artigoCrea);
    }

}
