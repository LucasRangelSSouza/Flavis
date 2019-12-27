<?php
/**
 * Created by Logics Software.
 * User: romeu
 * Date: 08/03/15
 * Time: 16:18
 */

namespace AppBundle\Model;


class PessoaFisica
{
    const ESTADO_CIVIL_SOLTEIRO = 'SO';
    const ESTADO_CIVIL_CASADO = 'CA';
    const ESTADO_CIVIL_DIVORCIADO = 'DI';
    const ESTADO_CIVIL_VIUVO = 'VI';

    const SEXO_MASCULINO = 'M';
    const SEXO_FEMININO = 'F';


    public static function getEstadosCivis()
    {
        return [
            self::ESTADO_CIVIL_SOLTEIRO => 'Solteiro',
            self::ESTADO_CIVIL_CASADO => 'Casado',
            self::ESTADO_CIVIL_DIVORCIADO => 'Divorciado',
            self::ESTADO_CIVIL_VIUVO => 'Viúvo'
        ];
    }

    public static function getSexos()
    {
        return [
            self::SEXO_MASCULINO => 'Masculino',
            self::SEXO_FEMININO => 'Feminino'
        ];
    }
} 