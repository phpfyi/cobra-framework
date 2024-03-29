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
     * @param string $identifier
     * @param string $namespace
     * @return ContainerInterface
     */
    public function bindNamespace(string $identifier, string $namespace): ContainerInterface;

    /**
     * Binds a referene to an object instance into the container.
     *
     * @param string $identifier
     * @param object $instance
     * @return ContainerInterface
     */
    public function bindInstance(string $identifier, object $instance): ContainerInterface;

    /**
     * Binds a reference to a singleton object into the container.
     *
     * @param string $identifier
     * @param SingletonInterface $instance
     * @return ContainerInterface
     */
    public function bindSingleton(string $identifier, SingletonInterface $instance): ContainerInterface;

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
}
