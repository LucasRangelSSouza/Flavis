<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class OrdemCompraProduto extends \AppBundle\Entity\OrdemCompraProduto implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'orcamento', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'colaborador', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'estado', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'fornecedor', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'observacoes', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'colaboradorQueAutorizou', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'autorizadoEm', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'dataCancelamento', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'produtos');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'orcamento', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'colaborador', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'estado', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'fornecedor', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'observacoes', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'colaboradorQueAutorizou', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'autorizadoEm', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'dataCancelamento', '' . "\0" . 'AppBundle\\Entity\\OrdemCompraProduto' . "\0" . 'produtos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (OrdemCompraProduto $proxy) {
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
    public function setEstado($estado)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEstado', array($estado));

        return parent::setEstado($estado);
    }

    /**
     * {@inheritDoc}
     */
    public function getEstado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEstado', array());

        return parent::getEstado();
    }

    /**
     * {@inheritDoc}
     */
    public function setObservacoes($observacoes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setObservacoes', array($observacoes));

        return parent::setObservacoes($observacoes);
    }

    /**
     * {@inheritDoc}
     */
    public function getObservacoes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getObservacoes', array());

        return parent::getObservacoes();
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
    public function setOrcamento(\AppBundle\Entity\OrcamentoProduto $orcamento = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrcamento', array($orcamento));

        return parent::setOrcamento($orcamento);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrcamento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrcamento', array());

        return parent::getOrcamento();
    }

    /**
     * {@inheritDoc}
     */
    public function setColaborador(\AppBundle\Entity\Colaborador $colaborador = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setColaborador', array($colaborador));

        return parent::setColaborador($colaborador);
    }

    /**
     * {@inheritDoc}
     */
    public function getColaborador()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getColaborador', array());

        return parent::getColaborador();
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
    public function addProduto(\AppBundle\Entity\ProdutoSaida $produtos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProduto', array($produtos));

        return parent::addProduto($produtos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProduto(\AppBundle\Entity\ProdutoSaida $produtos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProduto', array($produtos));

        return parent::removeProduto($produtos);
    }

    /**
     * {@inheritDoc}
     */
    public function getProdutos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProdutos', array());

        return parent::getProdutos();
    }

    /**
     * {@inheritDoc}
     */
    public function setAutorizadoEm($autorizadoEm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAutorizadoEm', array($autorizadoEm));

        return parent::setAutorizadoEm($autorizadoEm);
    }

    /**
     * {@inheritDoc}
     */
    public function getAutorizadoEm()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAutorizadoEm', array());

        return parent::getAutorizadoEm();
    }

    /**
     * {@inheritDoc}
     */
    public function setColaboradorQueAutorizou(\AppBundle\Entity\Colaborador $colaboradorQueAutorizou = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setColaboradorQueAutorizou', array($colaboradorQueAutorizou));

        return parent::setColaboradorQueAutorizou($colaboradorQueAutorizou);
    }

    /**
     * {@inheritDoc}
     */
    public function getColaboradorQueAutorizou()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getColaboradorQueAutorizou', array());

        return parent::getColaboradorQueAutorizou();
    }

    /**
     * {@inheritDoc}
     */
    public function setDataCancelamento($dataCancelamento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDataCancelamento', array($dataCancelamento));

        return parent::setDataCancelamento($dataCancelamento);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataCancelamento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDataCancelamento', array());

        return parent::getDataCancelamento();
    }

}
