<?php

namespace Application\Sonata\MediaBundle\Provider;

use Symfony\Component\Form\FormBuilder;

class FileProvider extends \Sonata\MediaBundle\Provider\FileProvider
{
    /**
     * {@inheritdoc}
     */
    public function buildMediaType(FormBuilder $formBuilder)
    {
        $formBuilder->add('binaryContent', 'file', array('label' => false));
    }
}