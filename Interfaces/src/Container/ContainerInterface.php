<?php

namespace Cobra\Interfaces\Container;

use Cobra\Interfaces\Object\SingletonInterface;

/**
 * Container Interface
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
interface ContainerInterface
{
    /**
     * Creates a singleton instance of the container.
     *
     * @return ContainerInterface
     */
    public static function instance(): ContainerInterface;

    /**
     * Binds a namespace identifier into the container.
     *
     * Usually an interface reference to a class.
     *
     * @param string $id
     * @param string $namespace
     * @return ContainerInterface
     */
    public function bindNamespace(string $id, string $namespace): ContainerInterface;

    /**
     * Binds a referene to an object instance into the container.
     *
     * @param string $id
     * @param object $instance
     * @return ContainerInterface
     */
    public function bindInstance(string $id, object $instance): ContainerInterface;

    /**
     * Binds a reference to a singleton object into the container.
     *
     * @param string $id
     * @param SingletonInterface $instance
     * @return ContainerInterface
     */
    public function bindSingleton(string $id, SingletonInterface $instance): ContainerInterface;

    /**
     * Returns all namespaces identifiers and namespaces.
     *
     * @return array
     */
    public function getNamespaces(): array;

    /**
     * Returns all instance identifiers and instances.
     *
     * @return array
     */
    public function getInstances(): array;

    /**
     * Returns all singleton instance identifiers and singleton instances.
     *
     * @return array
     */
    public function getSingletons(): array;

    /**
     * Returns all bound identifiers and namespaces / objects /singletons.
     *
     * @return array
     */
    public function getBound(): array;

    /**
     * Resolves an object an its dependencies and returns it
     *
     * @param  string $id
     * @param  array  $args
     * @return object
     */
    public function resolve(string $id, array $arguments = []): object;

    /**
     * Resolves an object method and its dependencies before calling it and returning it
     *
     * @param  object $instance
     * @param  string $method
     * @param  array  $args
     * @return mixed
     */
    public function resolveMethod(object $instance, string $method, array $arguments = []);
}
