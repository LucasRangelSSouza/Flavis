<?php
/**
 * Created by Logics Software.
 * User: Romeu Godoi <romeu@logics.com.br>
 * Date: 10/03/15
 * Time: 09:25
 */

namespace AppBundle\Model;

use AppBundle\Entity\ProdutoEstoque;
use Doctrine\ORM\EntityManagerInterface;

class AlmoxarifadoModel
{
    protected $em;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager = null)
    {
        $this->em = ($entityManager) ? $entityManager : null;
    }

    /**
     * Retorna a quantidade disponível do produto do catálogo passado
     */
    public function getQuantidadeItemDisponivelNoEstoqueByProdutoID($produtoID)
    {
        // Retorna quantidade total deste produto no estoque

        /*
         * Regra para saber a quantidade de um produto no estoque
         * Seleciona quantidade de ProdutoEstoque. Esta entidade é responsavel em
         * guardar todas as quantidades de produtos no estoque
         */

        $sql = "SELECT pe FROM AppBundle:ProdutoEstoque pe JOIN pe.produto p WHERE p.id=$produtoID";

        $query = $this->em->createQuery($sql);

        if(!count($query->getResult())){
            return 0;
        }

        $produto = $query->getResult()[0];
        return $produto->getQuantidade();

    }

    /**
     * Cria uma nova entrada no estoque. Se o produto já existir no estoque
     * só incrementa a quantidade que está entrando
     */
    public function criaOuIncrementaProdutoNoEstoque($produto,$quantidade, $nomePerfil)
    {
        $sql = "SELECT pe FROM AppBundle:ProdutoEstoque pe
        LEFT JOIN pe.produto p WHERE p.id={$produto->getId()}";

        $query = $this->em->createQuery($sql);

        if(!count($query->getResult())){

            // Crio este produto no estoque já com a quantidade

           $produtoEstoque = new ProdutoEstoque();
           $produtoEstoque->setProduto($produto);
           $produtoEstoque->setQuantidade($quantidade);
           $produtoEstoque->setNomePerfil($nomePerfil);

           $this->em->persist($produtoEstoque);
           $this->em->flush();

        }else{

            // Atualizo a quantidade deste produto no estoque
            $produtoEncontrado = $query->getResult();
            $produtoEncontrado = $produtoEncontrado[0];

            $produtoEncontrado->setQuantidade($produtoEncontrado->getQuantidade()+$quantidade);

            $this->em->flush();

        }

        return $produto;
    }

    public function removeQuantidadeProdutoEstoque($produto,$quantidade)
    {
        $sql = "SELECT pe FROM AppBundle:ProdutoEstoque pe
        LEFT JOIN pe.produto p WHERE p.id={$produto->getId()}";

        $query = $this->em->createQuery($sql);
        $produtoEncontrado = $query->getResult();

        if(count($produtoEncontrado)){

            $produtoEncontrado = $produtoEncontrado[0];

            if($produtoEncontrado->getQuantidade()>0){
                $produtoEncontrado->setQuantidade($produtoEncontrado->getQuantidade()-$quantidade);
            }

            $this->em->flush();
        }
    }
} 