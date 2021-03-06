<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ProdutoAlmoxarifado extends \AppBundle\Entity\ProdutoAlmoxarifado implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'fornecedor', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'status', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'titulo', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'unidadeMedida', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'departamento', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'pathFoto', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'oldPathFoto', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'codigoFabricante', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'seccao', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'prateleira', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'divisao', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'caixa', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'quantidadeMinima', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'documentos');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'fornecedor', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'status', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'titulo', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'unidadeMedida', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'departamento', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'pathFoto', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'oldPathFoto', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'codigoFabricante', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'seccao', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'prateleira', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'divisao', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'caixa', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'quantidadeMinima', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\ProdutoAlmoxarifado' . "\0" . 'documentos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ProdutoAlmoxarifado $proxy) {
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
    public function getTituloAmplo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTituloAmplo', array());

        return parent::getTituloAmplo();
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
    public function setSeccao($seccao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSeccao', array($seccao));

        return parent::setSeccao($seccao);
    }

    /**
     * {@inheritDoc}
     */
    public function getSeccao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSeccao', array());

        return parent::getSeccao();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrateleira($prateleira)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrateleira', array($prateleira));

        return parent::setPrateleira($prateleira);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrateleira()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrateleira', array());

        return parent::getPrateleira();
    }

    /**
     * {@inheritDoc}
     */
    public function setDivisao($divisao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDivisao', array($divisao));

        return parent::setDivisao($divisao);
    }

    /**
     * {@inheritDoc}
     */
    public function getDivisao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDivisao', array());

        return parent::getDivisao();
    }

    /**
     * {@inheritDoc}
     */
    public function setCaixa($caixa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCaixa', array($caixa));

        return parent::setCaixa($caixa);
    }

    /**
     * {@inheritDoc}
     */
    public function getCaixa()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCaixa', array());

        return parent::getCaixa();
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
    public function setCodigoFabricante($codigoFabricante)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodigoFabricante', array($codigoFabricante));

        return parent::setCodigoFabricante($codigoFabricante);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodigoFabricante()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodigoFabricante', array());

        return parent::getCodigoFabricante();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', array($status));

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', array());

        return parent::getStatus();
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
    public function addDocumento(\AppBundle\Entity\Documento $documentos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDocumento', array($documentos));

        return parent::addDocumento($documentos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDocumento(\AppBundle\Entity\Documento $documentos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDocumento', array($documentos));

        return parent::removeDocumento($documentos);
    }

    /**
     * {@inheritDoc}
     */
    public function getDocumentos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDocumentos', array());

        return parent::getDocumentos();
    }

    /**
     * {@inheritDoc}
     */
    public function setDepartamento($departamento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDepartamento', array($departamento));

        return parent::setDepartamento($departamento);
    }

    /**
     * {@inheritDoc}
     */
    public function getDepartamento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDepartamento', array());

        return parent::getDepartamento();
    }

    /**
     * {@inheritDoc}
     */
    public function setQuantidadeMinima($quantidadeMinima)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setQuantidadeMinima', array($quantidadeMinima));

        return parent::setQuantidadeMinima($quantidadeMinima);
    }

    /**
     * {@inheritDoc}
     */
    public function getQuantidadeMinima()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getQuantidadeMinima', array());

        return parent::getQuantidadeMinima();
    }

    /**
     * {@inheritDoc}
     */
    public function setFornecedor(\AppBundle\Entity\Fornecedor $fornecedor = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFornecedor', array($fornecedor));

        return parent::setFornecedor($fornecedor);
    }

    /**
     * {@inheritDoc}
     */
    public function getFornecedor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFornecedor', array());

        return parent::getFornecedor();
    }

    /**
     * {@inheritDoc}
     */
    public function setUnidadeMedida($unidadeMedida)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUnidadeMedida', array($unidadeMedida));

        return parent::setUnidadeMedida($unidadeMedida);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnidadeMedida()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUnidadeMedida', array());

        return parent::getUnidadeMedida();
    }

}
