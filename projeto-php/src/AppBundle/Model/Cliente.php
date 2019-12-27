<?php
/**
 * Created by Logics Software.
 * User: Romeu Godoi <romeu@logics.com.br>
 * Date: 10/03/15
 * Time: 09:25
 */

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;

class Cliente extends PessoaFisica
{
    const TIPO_PESSOA_FISICA = 'PF';
    const TIPO_PESSOA_JURIDICA = 'PJ';

    const TIPO_LOCAL_PREDIO = 'PR';
    const TIPO_LOCAL_CASA = 'CA';
    const TIPO_LOCAL_SHOPPING = 'SH';

    protected $em;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager = null)
    {
        $this->em = ($entityManager) ? $entityManager : null;
    }

    public function clienteTemEquipamento($cliente) {

        if ($cliente->getEquipamentos()->count()<=0){
            return false;
        }

        return true;

    }

    public function getPropriedadeParaEtiqueta($equipamento) {

        $propriedadesUsada = '';

        // Pega todas as propriedades do equipamento

        if( !count($equipamento->getPropriedades()) ){
            return $propriedadesUsada;
        }

        foreach($equipamento->getPropriedades() as $propriedade) {

            if($propriedade->getIsEtiqueta()){
                $propriedadesUsada .= implode('.',$propriedade->getValores()->toArray());
            }

        }

        return $propriedadesUsada;

    }

    public static function getAllTiposPessoa()
    {
        return array(
            self::TIPO_PESSOA_FISICA => 'Pessoa Física',
            self::TIPO_PESSOA_JURIDICA => 'Pessoa Jurídica',
        );
    }

    public static function getAllTiposLocais()
    {
        return array(
            self::TIPO_LOCAL_PREDIO => 'Prédio',
            self::TIPO_LOCAL_CASA => 'Casa',
            self::TIPO_LOCAL_SHOPPING => 'Shopping',
        );
    }


    public function getUsuarioClienteByUsuario($context)
    {
        $usuario = $this->getUserLogged($context);

        $dql = "SELECT uc FROM AppBundle:UsuarioCliente uc
        WHERE uc.user= :usuario";

        $query = $this->em->createQuery($dql);
        $query->setParameter('usuario',$usuario);

        $usuario = $query->getResult();

        if(!$usuario){
            return false;
        }

        return $usuario[0];
    }

    public function getEnderecos($cliente)
    {
        $dql = "SELECT e FROM AppBundle:Endereco e
        JOIN e.cliente c WHERE c.id={$cliente->getId()}";
        $enderecos = $this->em->createQuery($dql)->getResult();

        return $enderecos;
    }

    public function informacoesQRcode()
    {
        $dql = "SELECT e FROM AppBundle:ClienteEquipamento e";

        $query = $this->em->createQuery($dql);

        $informacoes = $query->getResult();

        return $informacoes;
    }

    public function ambienteEquipamento()
    {
        $dql = "SELECT e FROM AppBundle:Ambiente e";

        $query = $this->em->createQuery($dql);

        $informacoes = $query->getResult();

        return $informacoes;
    }

    public function getUserLogged($container)
    {
        return $container
            ->get('security.context')
            ->getToken()
            ->getUser();
    }

    public function getPerfis()
    {
        $dql = "SELECT e FROM AppBundle:Perfil e ";

        $perfis = $this->em->createQuery($dql)->getResult();

        return  $perfis;
    }

    public function getEmpresas()
    {
        $dql = "SELECT e FROM AppBundle:Empresa e ";

        $empresas = $this->em->createQuery($dql)->getResult();

        return  $empresas;
    }

}