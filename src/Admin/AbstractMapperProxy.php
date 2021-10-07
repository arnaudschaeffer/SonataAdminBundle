<?php

namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

abstract class AbstractMapperProxy {

    protected $mapper;

    protected $delegateClass;

    protected $baseName;

    protected $normalizer;

    /**
     * @var NameConverterInterface
     */
    protected $converter;

    protected $useCommon = ['id', 'label', 'updatedAt', 'createdAt', 'enabled', 'position', 'lastUpdate', 'slug', 'createdByUsername', 'updatedByUsername', '_action'];

    /**
     *
     * @param FormMapper|ShowMapper|ListMapper|DatagridMapper $mapper
     * @param string $baseName
     */
    public function __construct($mapper, $baseName)
    {
        $this->mapper = $mapper;
        $this->delegateClass = new \ReflectionClass($this->mapper);

        $this->baseName = $baseName;

        $this->converter = new CamelCaseToSnakeCaseNameConverter();
    }


    protected function getPropertyLabel($name, array $options = array())
    {
        if (!array_key_exists('label', $options)) {
            $baseName = lcfirst($this->baseName);
            if (in_array($name, $this->useCommon)) {
                $baseName = 'common';
            }

            if (strpos($name, '.') !== false) {
                $explode = explode('.', $name);
                $name = end($explode);
            }

            return 'admin.' . $this->converter->normalize($baseName) . '.' . $this->converter->normalize(lcfirst($name));
        }

        return $options['label'];
    }

    public function __call($name, $args)
    {
        $method = $this->delegateClass->getMethod($name);
        $res = $method->invokeArgs($this->mapper, $args);

        if ($res === $this->mapper) {
            return $this;
        }

        return $res;
    }
}
