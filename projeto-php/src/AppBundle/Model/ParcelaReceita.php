<?php
/**
 * Created by Logics Software.
 * User: Bruno Trindade <bruno@logics.com.br>
 * Date: 05/05/15
 * Time: 14:30
 */

namespace AppBundle\Model;

use AppBundle\Entity\Empresa;
use AppBundle\Entity\ParcelaReceita as Parcela;

class ParcelaReceita
{

    const VALOR_CORTE_IMPOSTO = 667.00;
    const VALOR_CORTE_MINIMO_IMPOSTO = 215.00;

    // Identificador Hidrante Engenharia
    const CNPJ_ENGENHARIA = '02927697000176';

    /**
     * Adicionar Regras:
     *
     * - Cálculo de ISS:
     *   + Se é substituta sempre paga ISS. Se não, vai depender da empresa para a qual foi pretado o serviço;
     *   +
     *
     * - Cálculo de IR = Cobra quando valor bruto >= R$ 667,00
     */

    public function __construct()
    {

    }

    public function valorCorteImposto()
    {
        return self::VALOR_CORTE_IMPOSTO;
    }

    public function valorCorteMinimoImposto()
    {
        return self::VALOR_CORTE_MINIMO_IMPOSTO;
    }

    /*
     * @param decimal valorParcela, Empresa $empresa
     * @return decimal
     *
     * Soma todos os percentuais de impostos
     * cadastrados na empresa, dependendo de um valor de corte
     *
     *
     * Criar regra para que se na receita estiver setado se o cliente é substituto ou não.
     * Se o cliente for substituto descontar a alíquota do ISS
     *
     */
    public function totalPercentualImpostos(Parcela $parcela, Empresa $empresa)
    {
        $totalImposto = 0;

        if($empresa){

            if($empresa->getCnpj()===$this::CNPJ_ENGENHARIA){

                // Caso o cliente seja substituto
                // descontamos do bruto a alíquota do ISS
                if($parcela->getReceita()->getProjeto()->getIsSubstitutoTributario()){
                    $totalImposto = $empresa->getImpostoIss();
                }

            }else{

                if($parcela->getValorBruto() >= self::VALOR_CORTE_IMPOSTO){

                    $totalImposto =  $empresa->getImpostCofis()+
                        $empresa->getImpostoIr()+
                        $empresa->getImpostoPis()+
                        $empresa->getImpostoCssl();

                }else if($parcela->getValorBruto() < self::VALOR_CORTE_IMPOSTO &&
                    $parcela->getValorBruto() >= self::VALOR_CORTE_MINIMO_IMPOSTO){

                    $totalImposto =  $empresa->getImpostCofis()+
                        $empresa->getImpostoPis()+
                        $empresa->getImpostoCssl();

                }
            }

            return $totalImposto;

        }else{
            return 0;
        }
    }

    /*
     * @param decimal valorBruto, Empresa $empresa
     * @return decimal
     *
     * Calcula qual o valor deduzido de uma parcela,
     * baseado em uma empresa, visto que la terá as configurações de imposto
     */
    public function valorDeducao(Parcela $parcela, Empresa $empresa)
    {
        $imposto = $this->totalPercentualImpostos($parcela,$empresa);
        $valorPercentual = (($parcela->getValorBruto()*$imposto)/100);
        return $valorPercentual;
    }

    /*
     * @param decimal valorBruto, Empresa $empresa
     * @return decimal
     *
     * Calcula qual o valor líquido, ou seja, com a deducão dos impostos
     * baseado em uma empresa, visto que la terá as configurações de imposto
     */
    public function valorLiquido(Parcela $parcela, Empresa $empresa)
    {
        $deducao = $this->valorDeducao($parcela,$empresa);
        $valorLiquido = $parcela->getValorBruto()-$deducao;
        return $valorLiquido;
    }

    /*
     * @param decimal valorBruto, percentual
     * @return decimal
     *
     * Calcula qual o valor descontato de uma parcela informado um imposto,
     */
    public function valorImposto($label,$valorParcela, $percentual)
    {
        $valorPercentual = (($valorParcela*$percentual)/100);

        if(empty($percentual)){
            $return = " [$label: Não definido] ";
        }else{
            $return = " [$label: $percentual% - Desconto: R$ $valorPercentual] ";
        }

        return $return;

    }

    public function cobraIncc($dataInicioInccReceita,$dataEmissaoNota)
    {
        $dataEmissaoNota = new \DateTime($dataEmissaoNota);
        $dateIncc = new \DateTime($dataInicioInccReceita);
        return ($dataEmissaoNota >= $dateIncc) ? true : false;
    }


    public function diferencaIncc($parcela)
    {
        return $parcela->getValorBruto();
    }

    public function isVencida($parcela,$dataPrevisaoPagamento)
    {
        $now = new \DateTime();
        $dataPagamento = new \DateTime($dataPrevisaoPagamento);

        if($this->isParcelaPaga($parcela)){
            return '';
        }

        return ($dataPagamento < $now) ? 'tr-vencida' : '';
    }

    public function isParcelaPaga($parcela)
    {
        if($parcela->getSituacaoPagamento()=='1'){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getNossoNumero($parcela)
    {
        $nossoNumero = $parcela->getiD() . $this->calculaDigitoNossoNumeroBoletoSicoob(
            $parcela->getReceita()->getProjeto()->getEmpresa()->getBoletoAgencia(),
            $parcela->getReceita()->getProjeto()->getEmpresa()->getBoletoConvenio(),
            $parcela->getId()
        );

//        return str_pad($nossoNumero, 8, '0', STR_PAD_LEFT);
        return $nossoNumero;
    }

    private function calculaDigitoNossoNumeroBoletoSicoob($numCooperativa,$numCliente,$nossoNumero,$debug=false)
    {
        $constante = '319731973197319731973';
        $numeroInteiro = str_pad($numCooperativa, 4, '0', STR_PAD_LEFT).
            str_pad($numCliente, 10, '0', STR_PAD_LEFT).
            str_pad($nossoNumero, 7, '0', STR_PAD_LEFT);

        if($debug){
            echo $numeroInteiro . '<br/>';
            echo $constante . '<br/>';
        }

        // Pegando numeros e suas posições na string
        $resMultiplicacao = 0;
        for($i=0;$i<=20;$i++){
            if($numeroInteiro[$i]!='0'){

                if($debug)
                    echo $numeroInteiro[$i] . '*' . $constante[$i] . ' + ';

                $resMultiplicacao += $numeroInteiro[$i]*$constante[$i];
            }
        }
        $resto = intval($resMultiplicacao%11);
        $digito = ($resto==0 || $resto==1) ? 0 : 11 - intval($resMultiplicacao%11);
        return $digito;
    }

} 