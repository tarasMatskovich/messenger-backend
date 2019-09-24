<?php

namespace App\Container;

use App\Container\Exceptions\ContainerException;
use App\Container\Exceptions\NotFoundException;
use Closure;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class Container
 * @package App\Container
 */
class Container implements \App\Container\ContainerInterface
{

    /**
     * @var array
     */
    private $definitions = [];

    /**
     * @var array
     */
    private $singletons = [];

    /**
     * @var array
     */
    private $cachedSingletons = [];

    /**
     * Container constructor.
     * @param array $definitions
     */
    public function __construct(array $definitions)
    {
        if (isset($definitions['definitions']) && is_array($definitions['definitions']))
            $this->definitions = $definitions['definitions'];
        if (isset($definitions['singletons']) && is_array($definitions['singletons']))
            $this->singletons = $definitions['singletons'];
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return mixed Entry.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerException
     */
    public function get($id)
    {
        if ($this->has($id)) {
            if ($this->hasSingleton($id)) {
                if ($this->hasCachedSingleton($id)) {
                    return $this->cachedSingletons[$id];
                }
                $definition = $this->singletons[$id];
            } else {
                $definition = $this->definitions[$id];
            }
            if ($definition instanceof Closure) {
                return $definition($this);
            }
            if (is_object($definition)) {
                return $definition;
            }
            if (!class_exists($definition)) {
                throw new ContainerException("Class {$definition} was not found!");
            }
            $definition = $this->resolveDependencies($definition);
            if ($this->hasSingleton($id)) {
                $this->cachedSingletons[$id] = $definition;
            }
            return $definition;
        } else {
            if (class_exists($id)) {
                return $this->resolveDependencies($id);
            }
        }
        throw new NotFoundException($id);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {
        return isset($this->definitions[$id]) || isset($this->singletons[$id]);
    }

    /**
     * @param $id
     * @return bool
     */
    private function hasCachedSingleton($id)
    {
        return isset($this->cachedSingletons[$id]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function hasSingleton($id)
    {
        return isset($this->singletons[$id]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function hasDefinition($id)
    {
        return isset($this->definitions[$id]);
    }

    /**
     * @param $definition
     * @return object
     * @throws ContainerException
     */
    private function resolveDependencies($definition)
    {
        try {
            $reflector = new ReflectionClass($definition);
            $constructor = $reflector->getConstructor();
            $args = [];
            if ($constructor) {
                $parameters = $constructor->getParameters();
                foreach ($parameters as $parameter) {
                    $paramClass = $parameter->getClass();
                    if ($paramClass) {
                        $args[] = $this->get($paramClass->getName());
                    } elseif($parameter->isArray()) {
                        $args[] = [];
                    } elseif (!$parameter->isDefaultValueAvailable()) {
                        throw new ContainerException($parameter->getName());
                    }
                }
            }
            return $reflector->newInstanceArgs($args);
        } catch (ReflectionException $e) {
            throw new ContainerException($definition);
        }
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function set(string $key, $value)
    {
        if (!$this->has($key)) {
            $this->definitions[$key] = $value;
        }
    }

    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function reset(string $key, $value)
    {
       $this->definitions[$key] = $value;
    }
}
