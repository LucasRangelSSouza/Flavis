<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Fornecedor extends \AppBundle\Entity\Fornecedor implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'cnpj', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'nomeFantasia', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'razaoSocial', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'inscricaoEstadual', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'inscricaoMunicipal', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'email', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'telefone', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'nomeVendedor', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'observacao', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'enderecos', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'documentos');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'cnpj', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'nomeFantasia', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'razaoSocial', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'inscricaoEstadual', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'inscricaoMunicipal', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'email', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'telefone', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'nomeVendedor', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'observacao', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'enderecos', '' . "\0" . 'AppBundle\\Entity\\Fornecedor' . "\0" . 'documentos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Fornecedor $proxy) {
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
    public function setCnpj($cnpj)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCnpj', array($cnpj));

        return parent::setCnpj($cnpj);
    }

    /**
     * {@inheritDoc}
     */
    public function getCnpj()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCnpj', array());

        return parent::getCnpj();
    }

    /**
     * {@inheritDoc}
     */
    public function setRazaoSocial($razaoSocial)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRazaoSocial', array($razaoSocial));

        return parent::setRazaoSocial($razaoSocial);
    }

    /**
     * {@inheritDoc}
     */
    public function getRazaoSocial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRazaoSocial', array());

        return parent::getRazaoSocial();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', array($email));

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', array());

        return parent::getEmail();
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
    public function setNomeVendedor($nomeVendedor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNomeVendedor', array($nomeVendedor));

        return parent::setNomeVendedor($nomeVendedor);
    }

    /**
     * {@inheritDoc}
     */
    public function getNomeVendedor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNomeVendedor', array());

        return parent::getNomeVendedor();
    }

    /**
     * {@inheritDoc}
     */
    public function setNomeFantasia($nomeFantasia)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNomeFantasia', array($nomeFantasia));

        return parent::setNomeFantasia($nomeFantasia);
    }

    /**
     * {@inheritDoc}
     */
    public function getNomeFantasia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNomeFantasia', array());

        return parent::getNomeFantasia();
    }

    /**
     * {@inheritDoc}
     */
    public function setInscricaoEstadual($inscricaoEstadual)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInscricaoEstadual', array($inscricaoEstadual));

        return parent::setInscricaoEstadual($inscricaoEstadual);
    }

    /**
     * {@inheritDoc}
     */
    public function getInscricaoEstadual()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInscricaoEstadual', array());

        return parent::getInscricaoEstadual();
    }

    /**
     * {@inheritDoc}
     */
    public function setInscricaoMunicipal($inscricaoMunicipal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInscricaoMunicipal', array($inscricaoMunicipal));

        return parent::setInscricaoMunicipal($inscricaoMunicipal);
    }

    /**
     * {@inheritDoc}
     */
    public function getInscricaoMunicipal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInscricaoMunicipal', array());

        return parent::getInscricaoMunicipal();
    }

    /**
     * {@inheritDoc}
     */
    public function setTelefone($telefone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTelefone', array($telefone));

        return parent::setTelefone($telefone);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelefone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelefone', array());

        return parent::getTelefone();
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
    public function addEndereco(\AppBundle\Entity\Endereco $enderecos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEndereco', array($enderecos));

        return parent::addEndereco($enderecos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEndereco(\AppBundle\Entity\Endereco $enderecos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEndereco', array($enderecos));

        return parent::removeEndereco($enderecos);
    }

    /**
     * {@inheritDoc}
     */
    public function getEnderecos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnderecos', array());

        return parent::getEnderecos();
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

}
