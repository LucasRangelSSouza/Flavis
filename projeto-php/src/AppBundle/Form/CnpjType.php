<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;

class CnpjType extends AbstractType
{
    public function getName()
    {
        return 'app_cnpj';
    }
}