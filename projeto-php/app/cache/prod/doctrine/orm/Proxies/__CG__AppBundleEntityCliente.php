<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Cliente extends \AppBundle\Entity\Cliente implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'filial', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'facilities', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'tipoPessoa', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'nome', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'cpfCnpj', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'razaoSocial', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'horarioAbertura', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'horarioFechamento', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'intervalorAlmoco', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'tipoLocal', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'tipoNegocio', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'telefones', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'enderecos', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'responsaveis', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'documentos', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'equipamentos');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'filial', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'facilities', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'tipoPessoa', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'nome', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'cpfCnpj', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'razaoSocial', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'horarioAbertura', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'horarioFechamento', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'intervalorAlmoco', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'tipoLocal', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'tipoNegocio', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'createdAt', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'updatedAt', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'deletedAt', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'telefones', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'enderecos', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'responsaveis', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'documentos', '' . "\0" . 'AppBundle\\Entity\\Cliente' . "\0" . 'equipamentos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Cliente $proxy) {
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
    public function setTipoPessoa($tipoPessoa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTipoPessoa', array($tipoPessoa));

        return parent::setTipoPessoa($tipoPessoa);
    }

    /**
     * {@inheritDoc}
     */
    public function getTipoPessoa()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipoPessoa', array());

        return parent::getTipoPessoa();
    }

    /**
     * {@inheritDoc}
     */
    public function setNome($nome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNome', array($nome));

        return parent::setNome($nome);
    }

    /**
     * {@inheritDoc}
     */
    public function getNome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNome', array());

        return parent::getNome();
    }

    /**
     * {@inheritDoc}
     */
    public function setCpfCnpj($cpfCnpj)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCpfCnpj', array($cpfCnpj));

        return parent::setCpfCnpj($cpfCnpj);
    }

    /**
     * {@inheritDoc}
     */
    public function getCpfCnpj()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCpfCnpj', array());

        return parent::getCpfCnpj();
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
    public function setHorarioAbertura($horarioAbertura)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHorarioAbertura', array($horarioAbertura));

        return parent::setHorarioAbertura($horarioAbertura);
    }

    /**
     * {@inheritDoc}
     */
    public function getHorarioAbertura()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHorarioAbertura', array());

        return parent::getHorarioAbertura();
    }

    /**
     * {@inheritDoc}
     */
    public function setHorarioFechamento($horarioFechamento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHorarioFechamento', array($horarioFechamento));

        return parent::setHorarioFechamento($horarioFechamento);
    }

    /**
     * {@inheritDoc}
     */
    public function getHorarioFechamento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHorarioFechamento', array());

        return parent::getHorarioFechamento();
    }

    /**
     * {@inheritDoc}
     */
    public function setIntervalorAlmoco($intervalorAlmoco)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIntervalorAlmoco', array($intervalorAlmoco));

        return parent::setIntervalorAlmoco($intervalorAlmoco);
    }

    /**
     * {@inheritDoc}
     */
    public function getIntervalorAlmoco()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIntervalorAlmoco', array());

        return parent::getIntervalorAlmoco();
    }

    /**
     * {@inheritDoc}
     */
    public function setTipoLocal($tipoLocal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTipoLocal', array($tipoLocal));

        return parent::setTipoLocal($tipoLocal);
    }

    /**
     * {@inheritDoc}
     */
    public function getTipoLocal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipoLocal', array());

        return parent::getTipoLocal();
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
    public function setTipoNegocio(\AppBundle\Entity\TipoNegocio $tipoNegocio = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTipoNegocio', array($tipoNegocio));

        return parent::setTipoNegocio($tipoNegocio);
    }

    /**
     * {@inheritDoc}
     */
    public function getTipoNegocio()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipoNegocio', array());

        return parent::getTipoNegocio();
    }

    /**
     * {@inheritDoc}
     */
    public function addTelefone(\AppBundle\Entity\Telefone $telefones)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTelefone', array($telefones));

        return parent::addTelefone($telefones);
    }

    /**
     * {@inheritDoc}
     */
    public function removeTelefone(\AppBundle\Entity\Telefone $telefones)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeTelefone', array($telefones));

        return parent::removeTelefone($telefones);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelefones()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelefones', array());

        return parent::getTelefones();
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
    public function addResponsavei(\AppBundle\Entity\ResponsavelCliente $responsaveis)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addResponsavei', array($responsaveis));

        return parent::addResponsavei($responsaveis);
    }

    /**
     * {@inheritDoc}
     */
    public function removeResponsavei(\AppBundle\Entity\ResponsavelCliente $responsaveis)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeResponsavei', array($responsaveis));

        return parent::removeResponsavei($responsaveis);
    }

    /**
     * {@inheritDoc}
     */
    public function getResponsaveis()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResponsaveis', array());

        return parent::getResponsaveis();
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
    public function setFilial(\AppBundle\Entity\FilialEmpresa $filial = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFilial', array($filial));

        return parent::setFilial($filial);
    }

    /**
     * {@inheritDoc}
     */
    public function getFilial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFilial', array());

        return parent::getFilial();
    }

    /**
     * {@inheritDoc}
     */
    public function setFacilities(\AppBundle\Entity\Cliente $facilities = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFacilities', array($facilities));

        return parent::setFacilities($facilities);
    }

    /**
     * {@inheritDoc}
     */
    public function getFacilities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFacilities', array());

        return parent::getFacilities();
    }

    /**
     * {@inheritDoc}
     */
    public function addEquipamento(\AppBundle\Entity\ClienteEquipamento $equipamentos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEquipamento', array($equipamentos));

        return parent::addEquipamento($equipamentos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEquipamento(\AppBundle\Entity\ClienteEquipamento $equipamentos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEquipamento', array($equipamentos));

        return parent::removeEquipamento($equipamentos);
    }

    /**
     * {@inheritDoc}
     */
    public function getEquipamentos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEquipamentos', array());

        return parent::getEquipamentos();
    }

}