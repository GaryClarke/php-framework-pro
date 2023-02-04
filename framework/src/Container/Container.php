<?php

namespace GaryClarke\Framework\Container;

use GaryClarke\Framework\Tests\DependantClass;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object $concrete = null)
    {
        if (null === $concrete) {
            if (!class_exists($id)) {
                throw new ContainerException("Service $id could not be added");
            }

            $concrete = $id;
        }

        $this->services[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service $id could not be resolved");
            }

            $this->add($id);
        }

        $object = $this->resolve($this->services[$id]);

        return $object;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }
}