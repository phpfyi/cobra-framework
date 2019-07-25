<?php

namespace Cobra\Container;

use Cobra\Container\Exception\NotFoundException;
use Cobra\Interfaces\Container\ContainerInterface;
use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Object\Traits\SingletonMethods;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * Container
 *
 * A singleton class container implementation that tracks object and method
 * dependencies and allows the swopping out of those injected dependencies.
 *
 * @category  Container
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Container implements ContainerInterface, PsrContainerInterface, SingletonInterface
{
    use SingletonMethods;

    /**
     * Namespaces bound to the container
     *
     * @var array
     */
    protected $namespaces = [];

    /**
     * Instances bound to the container
     *
     * @var array
     */
    protected $instances = [];

    /**
     * Singletons bound to the container
     *
     * @var array
     */
    protected $singletons = [];

    /**
     * All entries bound to the container
     *
     * @var array
     */
    protected $bound = [];

    /**
     * Creates a singleton instance of the container.
     *
     * @return ContainerInterface
     */
    public static function instance(): ContainerInterface
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
            $instance->bindSingleton(ContainerInterface::class, $instance);
        }
        return $instance;
    }

    /**
     * Binds a namespace identifier into the container.
     *
     * Usually an interface reference to a class.
     *
     * @param string $identifier
     * @param string $namespace
     * @return ContainerInterface
     */
    public function bindNamespace(string $identifier, string $namespace): ContainerInterface
    {
        $this->bound[$identifier] = $this->namespaces[$identifier] = $namespace;
        return $this;
    }

    /**
     * Binds a referene to an object instance into the container.
     *
     * @param string $identifier
     * @param object $instance
     * @return ContainerInterface
     */
    public function bindInstance(string $identifier, object $instance): ContainerInterface
    {
        $this->bound[$identifier] = $this->instances[$identifier] = $instance;
        return $this;
    }

    /**
     * Binds a reference to a singleton object into the container.
     *
     * @param string $identifier
     * @param SingletonInterface $instance
     * @return ContainerInterface
     */
    public function bindSingleton(string $identifier, SingletonInterface $instance): ContainerInterface
    {
        $this->bound[$identifier] = $this->singletons[$identifier] = $instance;
        return $this;
    }

    /**
     * Returns all namespaces identifiers and namespaces.
     *
     * @return array
     */
    public function getNamespaces(): array
    {
        return $this->namespaces;
    }

    /**
     * Returns all instance identifiers and instances.
     *
     * @return array
     */
    public function getInstances(): array
    {
        return $this->instances;
    }

    /**
     * Returns all singleton instance identifiers and singleton instances.
     *
     * @return array
     */
    public function getSingletons(): array
    {
        return $this->singletons;
    }

    /**
     * Returns all bound identifiers and namespaces / objects /singletons.
     *
     * @return array
     */
    public function getBound(): array
    {
        return $this->bound;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $identifier Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($identifier)
    {
        if ($this->has($identifier)) {
            return $this->bound[$identifier];
        }
        throw new NotFoundException("Container entry not found for: {$identifier}");
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $identifier Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($identifier): bool
    {
        return array_key_exists($identifier, $this->bound);
    }
}
