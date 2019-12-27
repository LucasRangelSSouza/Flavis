<?php
/**
 * Created by Logics Software.
 * User: Romeu Godoi <romeu@logics.com.br>
 * Date: 10/03/15
 * Time: 09:25
 */

namespace AppBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Colaborador extends PessoaFisica
{
    const STATUS_ATIVO = 'AT';
    const STATUS_FERIAS = 'FE';
    const STATUS_LICENCA = 'LI';
    const STATUS_DESLIGADO = 'DE';

    const TIPO_COLABORADOR_FUNCIONARIO  = 'F';
    const TIPO_COLABORADOR_TERCEIRIZARO = 'T';

    const NIVEL_ESCOLARSUPERIOR  = 'superior';
    const NIVEL_ESCOLARSUPERIOR_INCOMPLETO  = 'superior-incompleto';
    const NIVEL_ESCOLARMEDIO = 'ensino-medio';
    const NIVEL_ESCOLARBASICO = 'ensino-basico';

    protected $em;
    protected $container = NULL;

//    /**
//     * @param EntityManagerInterface $entityManager
//     */
//    public function __construct(EntityManagerInterface $entityManager = null)
//    {
//        $this->em = ($entityManager) ? $entityManager : null;
//    }
    /**
     * @param EntityManagerInterface $entityManager
     * @param $container
     */
    public function __construct(EntityManagerInterface $entityManager = null, ContainerInterface $container = null)
    {
        $this->em = ($entityManager) ? $entityManager : null;//$this->em = $entityManager;
        $this->container = ($container) ? $container : null;//$this->container = $container;
    }

    public static function getAllNivelEscolar()
    {
        return array(
            self::NIVEL_ESCOLARSUPERIOR => 'Superior Completo',
            self::NIVEL_ESCOLARSUPERIOR_INCOMPLETO => 'Superior Incompleto',
            self::NIVEL_ESCOLARMEDIO => 'Curso Médio',
            self::NIVEL_ESCOLARBASICO => 'Curso Básico',
        );
    }

    public static function getAllStatus()
    {
        return array(
            self::STATUS_ATIVO => 'Ativo',
            self::STATUS_FERIAS => 'Férias',
            self::STATUS_LICENCA => 'Licença',
            self::STATUS_DESLIGADO => 'Desligado',
        );
    }

    public static function getAllTiposFuncionario()
    {
        return array(
            self::TIPO_COLABORADOR_FUNCIONARIO => 'Funcionário',
            self::TIPO_COLABORADOR_TERCEIRIZARO => 'Terceirizado',
        );
    }

    public function getPerfilLogado($container)
    {
        $dql = "SELECT e FROM AppBundle:Colaborador e
        JOIN e.nomePerfil c WHERE c.id={$container->getId()}";
        $colaborador = $this->em->createQuery($dql)->getResult();

        return $colaborador;
    }

    public function getColaboradorLogado($em,$container)
    {
        $dql = "SELECT c FROM AppBundle:Colaborador c
         JOIN c.user u
         WHERE u.id={$this->getUserLogged($container)->getId()}";
        $colaborador = $em->getEntityManager()->createQuery($dql)->getResult();

        if(!count($colaborador)){
            //throw new NotFoundHttpException("Usuário não vinculado a nenhum colaborador!");
            exit('Usuário não vinculado a nenhum colaborador!...');
        }

        return $colaborador[0];
    }

    public function getColaborares($tipo=NULL)
    {
//        $dql = "SELECT c FROM AppBundle:Colaborador c";
//        $dql2 = "SELECT p FROM AppBundle:Perfil p";//Errado, esta sempre pegando
//        $colaboradores = $this->em->createQuery($dql)->getResult();
//        $perfis = $this->em->createQuery($dql2)->getResult();
//
//        foreach ($colaboradores as $colaborador){
//            foreach ($perfis as $perfil){
//                if($colaborador->getNomePerfil() == $perfil->getNomePerfil()){
//                    $nomePerfil = $perfil->getNomePerfil();
//                }
//            }
//        }
        $colaboradores = $this->em->getRepository('AppBundle:Colaborador')->findAll(array(),array('nome' => 'ASC'));
        $colaboradorLogado = $this->container->get('security.context')->getToken()->getUser();
        $perfilToFilter = '';
        foreach($colaboradores as $colaborador) {
            if($colaborador->getUser() == $colaboradorLogado) {
                $perfilToFilter = $colaborador->getNomePerfil();
            }
        }

        $dql3 = "SELECT c FROM AppBundle:Colaborador c
        where c.nomePerfil=:nomePerfil
        AND c.funcao=:funcao";

        $colaboradoresDoPerfil = $this->em->createQuery($dql3);

        $colaboradoresDoPerfil->setParameter('nomePerfil',$perfilToFilter);
        $colaboradoresDoPerfil->setParameter('funcao',4);

        return $colaboradoresDoPerfil->getResult();
    }

    public function getUserLogged($container)
    {
        return $container
            ->get('security.context')
            ->getToken()
            ->getUser();
    }
} 