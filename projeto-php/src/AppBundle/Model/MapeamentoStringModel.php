<?php
/**
 * Created by Logics Software.
 * User: romeu
 * Date: 08/03/15
 * Time: 16:18
 */

namespace AppBundle\Model;


class MapeamentoStringModel
{
    const ROLE_ACESSO_OS_ADMIN = 'ROLE_APP_ADMIN_ORDEM_SERVICO_ADMIN';
    const ROLE_GERENTE_OPERACIONAL = 'ROLE_GERENTE_OPERACIONAL';

    public static function getStringsMapeadas()
    {
        return [
            self::ROLE_ACESSO_OS_ADMIN => 'Permissão de Acesso Admin às OS\s'
        ];
    }

    public function getRoleGerenteOperacional(){
        return self::ROLE_GERENTE_OPERACIONAL;
    }
} 