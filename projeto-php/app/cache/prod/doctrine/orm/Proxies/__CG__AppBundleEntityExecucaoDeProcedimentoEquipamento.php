<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ExecucaoDeProcedimentoEquipamento extends \AppBundle\Entity\ExecucaoDeProcedimentoEquipamento implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'procedimentoPmoc', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'clienteEquipamento', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'observacao', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'dataAgendadaExecucao', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'os', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'fotos');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'procedimentoPmoc', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'clienteEquipamento', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'observacao', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'dataAgendadaExecucao', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'os', '' . "\0" . 'AppBundle\\Entity\\ExecucaoDeProcedimentoEquipamento' . "\0" . 'fotos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ExecucaoDeProcedimentoEquipamento $proxy) {
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
    public function getColorBackgroundCalendar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getColorBackgroundCalendar', array());

        return parent::getColorBackgroundCalendar();
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
    public function setProcedimentoPmoc(\AppBundle\Entity\AgendamentoManutencaoEquipamento $procedimentoPmoc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProcedimentoPmoc', array($procedimentoPmoc));

        return parent::setProcedimentoPmoc($procedimentoPmoc);
    }

    /**
     * {@inheritDoc}
     */
    public function getProcedimentoPmoc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProcedimentoPmoc', array());

        return parent::getProcedimentoPmoc();
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
    public function setDataAgendadaExecucao($dataAgendadaExecucao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDataAgendadaExecucao', array($dataAgendadaExecucao));

        return parent::setDataAgendadaExecucao($dataAgendadaExecucao);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataAgendadaExecucao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDataAgendadaExecucao', array());

        return parent::getDataAgendadaExecucao();
    }

    /**
     * {@inheritDoc}
     */
    public function setClienteEquipamento(\AppBundle\Entity\ClienteEquipamento $clienteEquipamento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setClienteEquipamento', array($clienteEquipamento));

        return parent::setClienteEquipamento($clienteEquipamento);
    }

    /**
     * {@inheritDoc}
     */
    public function getClienteEquipamento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClienteEquipamento', array());

        return parent::getClienteEquipamento();
    }

    /**
     * {@inheritDoc}
     */
    public function addFoto(\AppBundle\Entity\FotoExecucaoOs $fotos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addFoto', array($fotos));

        return parent::addFoto($fotos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeFoto(\AppBundle\Entity\FotoExecucaoOs $fotos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeFoto', array($fotos));

        return parent::removeFoto($fotos);
    }

    /**
     * {@inheritDoc}
     */
    public function getFotos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFotos', array());

        return parent::getFotos();
    }

}
