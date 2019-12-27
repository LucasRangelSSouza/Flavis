<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TextAreaMaximizeWithCountType extends TextareaType
{
    public function getName()
    {
        return 'app_textarea_maximize_with_count';
    }
}