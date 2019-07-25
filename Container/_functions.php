<?php

use Cobra\Container\Container;
use Cobra\Container\Resolver\ClassResolver;
use Cobra\Container\Resolver\MethodResolver;

/**
 * Container function sets
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

if (! function_exists('contain_object')) {
    /**
     * Binds an object instance to the container
     *
     * @param string $name
     * @param object $instance
     * @return void
     */
    function contain_object(string $name, object $instance): void
    {
        Container::instance()->bindInstance($name, $instance);
    }
}

if (! function_exists('contain_namespace')) {
    /**
     * Binds an namespace reference to the container
     *
     * @param string $name
     * @param string $namespace
     * @return void
     */
    function contain_namespace(string $name, string $namespace): void
    {
        Container::instance()->bindNamespace($name, $namespace);
    }
}

if (! function_exists('container_object')) {
    /**
     * Return a bound container instance
     *
     * @param string $name
     * @return object
     */
    function container_object(string $name): object
    {
        return Container::instance()->get($name);
    }
}

if (! function_exists('container_resolve')) {
    /**
     * Resolves an object an its dependencies and returns it
     *
     * @param  string $namespace
     * @param  array  $args
     * @return object
     */
    function container_resolve(string $namespace, array $args = []): object
    {
        return (new ClassResolver(
            Container::instance(),
            $namespace,
            $args
        ))->getInstance();
    }
}

if (! function_exists('container_resolve_method')) {
    /**
     * Resolves an object method and its dependencies before calling it and returning it
     *
     * @param  object $instance
     * @param  string $method
     * @param  array  $args
     * @return mixed
     */
    function container_resolve_method(object $instance, string $method, array $arguments = [])
    {
        return (new MethodResolver(
            Container::instance(),
            $instance,
            $method,
            $arguments
        ))->invoke();
    }
}
