<?php
namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;

class ListMapperProxy extends AbstractMapperProxy {

    /**
     *
     * @param ListMapper $mapper
     * @param string $baseName
     */
    public function __construct($mapper, $baseName)
    {
        parent::__construct($mapper, $baseName);
    }

    public function addIdentifier($name, $type = null, array $fieldDescriptionOptions = array())
    {
        $fieldDescriptionOptions['label'] = $this->getPropertyLabel($name, $fieldDescriptionOptions);
        $this->mapper->addIdentifier($name, $type, $fieldDescriptionOptions);

        return $this;
    }

    public function add($name, $type = null, array $fieldDescriptionOptions = array())
    {
        $fieldDescriptionOptions['label'] = $this->getPropertyLabel($name, $fieldDescriptionOptions);
        $this->mapper->add($name, $type, $fieldDescriptionOptions);

        return $this;
    }
}