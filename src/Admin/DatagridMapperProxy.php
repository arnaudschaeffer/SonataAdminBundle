<?php

namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;

class DatagridMapperProxy extends AbstractMapperProxy {

    /**
     *
     * @param DatagridMapper $mapper
     * @param string $baseName
     */
    public function __construct($mapper, $baseName)
    {
        parent::__construct($mapper, $baseName);
    }

    public function add($name,
                        $type = null,
                        array $filterOptions = [],
                        $fieldType = null,
                        $fieldOptions = null,
                        array $fieldDescriptionOptions = [])
    {
        $filterOptions['label'] = $this->getPropertyLabel($name, $filterOptions);
        $this->mapper->add($name, $type, $filterOptions, $fieldType, $fieldOptions, $fieldDescriptionOptions);

        return $this;
    }
}
