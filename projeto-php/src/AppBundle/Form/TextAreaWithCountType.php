<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;

class TextAreaWithCountType extends AbstractType
{
    public function getName()
    {
        return 'app_textarea_with_count';
    }

    public function getParent()
    {
        return 'text';
    }
}