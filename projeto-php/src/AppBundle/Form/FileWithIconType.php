<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;

class FileWithIconType extends AbstractType
{
    public function getName()
    {
        return 'app_file_with_icon';
    }
}