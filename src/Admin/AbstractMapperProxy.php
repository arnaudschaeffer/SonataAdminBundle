<?php

namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Mapper\MapperInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

abstract class AbstractMapperProxy {

    protected MapperInterface $mapper;

    protected \ReflectionClass $delegateClass;

    protected string $baseName;

    protected string $normalizer;

    /**
     * @var NameConverterInterface
     */
    protected $converter;

    protected $useCommon = ['id', 'label', 'updatedAt', 'createdAt', 'enabled', 'position', 'lastUpdate', 'slug', 'createdByUsername', 'updatedByUsername', '_action'];

    public function __construct(MapperInterface $mapper, string $baseName)
    {
        $this->mapper = $mapper;
        $this->delegateClass = new \ReflectionClass($this->mapper);

        $this->baseName = $baseName;

        $this->converter = new CamelCaseToSnakeCaseNameConverter();
    }


    protected function getPropertyLabel(string $name, array $options = array()): string
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
