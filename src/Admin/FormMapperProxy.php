<?php

namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;

class FormMapperProxy extends AbstractMapperProxy {

    /**
     *
     * @param FormMapper $mapper
     * @param string $baseName
     */
    public function __construct($mapper, $baseName)
    {
        parent::__construct($mapper, $baseName);
    }

    public function add($name, $type = null, array $options = array(), array $fieldDescriptionOptions = array())
    {
        $options['label'] = $this->getPropertyLabel($name, $options);
        $this->mapper->add($name, $type, $options, $fieldDescriptionOptions);

        return $this;
    }
}
