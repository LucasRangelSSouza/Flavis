<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class FichaTecnicaProduto extends \AppBundle\Entity\FichaTecnicaProduto implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'titulo', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'fabricante', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'observacao', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'pathFoto', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'oldPathFoto', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'os');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'titulo', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'fabricante', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'observacao', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'pathFoto', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'oldPathFoto', '' . "\0" . 'AppBundle\\Entity\\FichaTecnicaProduto' . "\0" . 'os');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (FichaTecnicaProduto $proxy) {
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
    public function setOs(\AppBundle\Entity\OrdemServico $os = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOs', array($os));

        return parent::setOs($os);
    }

    /**
     * {@inheritDoc}
     */
    public function getOs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOs', array());

        return parent::getOs();
    }

    /**
     * {@inheritDoc}
     */
    public function setPathFoto($pathFoto)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPathFoto', array($pathFoto));

        return parent::setPathFoto($pathFoto);
    }

    /**
     * {@inheritDoc}
     */
    public function getPathFoto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPathFoto', array());

        return parent::getPathFoto();
    }

    /**
     * {@inheritDoc}
     */
    public function setOldPathFoto($oldPathFoto)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOldPathFoto', array($oldPathFoto));

        return parent::setOldPathFoto($oldPathFoto);
    }

    /**
     * {@inheritDoc}
     */
    public function getOldPathFoto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOldPathFoto', array());

        return parent::getOldPathFoto();
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
    public function setObservacao($observacao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setObservacao', array($observacao));

        return parent::setObservacao($observacao);
    }

    /**
     * {@inheritDoc}
     */
    public function getObservacao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getObservacao', array());

        return parent::getObservacao();
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
    public function setFabricante(\AppBundle\Entity\Fornecedor $fabricante)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFabricante', array($fabricante));

        return parent::setFabricante($fabricante);
    }

    /**
     * {@inheritDoc}
     */
    public function getFabricante()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFabricante', array());

        return parent::getFabricante();
    }

}
