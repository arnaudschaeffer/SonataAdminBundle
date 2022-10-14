<?php

namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;

class DatagridMapperProxy extends AbstractMapperProxy {

    public function __construct(DatagridMapper $mapper, string $baseName)
    {
        parent::__construct($mapper, $baseName);
    }

    public function add($name,
                        $type = null,
                        array $filterOptions = [],
                        array $fieldDescriptionOptions = []): self
    {
        $filterOptions['label'] = $this->getPropertyLabel($name, $filterOptions);
        $this->mapper->add($name, $type, $filterOptions, $fieldDescriptionOptions);

        return $this;
    }
}
