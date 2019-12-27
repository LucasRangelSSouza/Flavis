<?php
namespace AppBundle\Entity;

use AppBundle\TenantProviderInterface;
use Doctrine\ORM\EntityRepository;

class PerfilRepository extends EntityRepository implements TenantProviderInterface
{
    /**
     * @param $perfil
     * @return null|Perfil
     */
    public function getPerfil($perfil)
    {
        return $this->find($perfil);
    }
}
