<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class RelatorioOrdemServico extends \AppBundle\Entity\RelatorioOrdemServico implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'agendamento', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'receptorNome', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'receptorRg', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'colaborador', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'relatorio', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'isEncerrada', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'isHomologada', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'justificativaEncerramento', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'isImpedido', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'justificativaEmpedimento', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'pathFile', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'oldPathFile', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'fotos');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'agendamento', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'receptorNome', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'receptorRg', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'colaborador', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'relatorio', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'isEncerrada', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'isHomologada', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'justificativaEncerramento', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'isImpedido', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'justificativaEmpedimento', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'pathFile', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'oldPathFile', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\RelatorioOrdemServico' . "\0" . 'fotos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (RelatorioOrdemServico $proxy) {
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
    public function setOldPathFile($oldPathFile)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOldPathFile', array($oldPathFile));

        return parent::setOldPathFile($oldPathFile);
    }

    /**
     * {@inheritDoc}
     */
    public function getOldPathFile()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOldPathFile', array());

        return parent::getOldPathFile();
    }

    /**
     * {@inheritDoc}
     */
    public function setPathFile($pathFile)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPathFile', array($pathFile));

        return parent::setPathFile($pathFile);
    }

    /**
     * {@inheritDoc}
     */
    public function getPathFile()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPathFile', array());

        return parent::getPathFile();
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
    public function setReceptorNome($receptorNome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReceptorNome', array($receptorNome));

        return parent::setReceptorNome($receptorNome);
    }

    /**
     * {@inheritDoc}
     */
    public function getReceptorNome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReceptorNome', array());

        return parent::getReceptorNome();
    }

    /**
     * {@inheritDoc}
     */
    public function setReceptorRg($receptorRg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReceptorRg', array($receptorRg));

        return parent::setReceptorRg($receptorRg);
    }

    /**
     * {@inheritDoc}
     */
    public function getReceptorRg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReceptorRg', array());

        return parent::getReceptorRg();
    }

    /**
     * {@inheritDoc}
     */
    public function setRelatorio($relatorio)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRelatorio', array($relatorio));

        return parent::setRelatorio($relatorio);
    }

    /**
     * {@inheritDoc}
     */
    public function getRelatorio()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRelatorio', array());

        return parent::getRelatorio();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsEncerrada($isEncerrada)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsEncerrada', array($isEncerrada));

        return parent::setIsEncerrada($isEncerrada);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsEncerrada()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsEncerrada', array());

        return parent::getIsEncerrada();
    }

    /**
     * {@inheritDoc}
     */
    public function setJustificativaEncerramento($justificativaEncerramento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setJustificativaEncerramento', array($justificativaEncerramento));

        return parent::setJustificativaEncerramento($justificativaEncerramento);
    }

    /**
     * {@inheritDoc}
     */
    public function getJustificativaEncerramento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJustificativaEncerramento', array());

        return parent::getJustificativaEncerramento();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsImpedido($isImpedido)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsImpedido', array($isImpedido));

        return parent::setIsImpedido($isImpedido);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsImpedido()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsImpedido', array());

        return parent::getIsImpedido();
    }

    /**
     * {@inheritDoc}
     */
    public function setJustificativaEmpedimento($justificativaEmpedimento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setJustificativaEmpedimento', array($justificativaEmpedimento));

        return parent::setJustificativaEmpedimento($justificativaEmpedimento);
    }

    /**
     * {@inheritDoc}
     */
    public function getJustificativaEmpedimento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJustificativaEmpedimento', array());

        return parent::getJustificativaEmpedimento();
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
    public function addFoto(\AppBundle\Entity\FotoOs $fotos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addFoto', array($fotos));

        return parent::addFoto($fotos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeFoto(\AppBundle\Entity\FotoOs $fotos)
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

    /**
     * {@inheritDoc}
     */
    public function setIsHomologada($isHomologada)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsHomologada', array($isHomologada));

        return parent::setIsHomologada($isHomologada);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsHomologada()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsHomologada', array());

        return parent::getIsHomologada();
    }

    /**
     * {@inheritDoc}
     */
    public function setAgendamento(\AppBundle\Entity\AgendamentoOrdemServico $agendamento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAgendamento', array($agendamento));

        return parent::setAgendamento($agendamento);
    }

    /**
     * {@inheritDoc}
     */
    public function getAgendamento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAgendamento', array());

        return parent::getAgendamento();
    }

}