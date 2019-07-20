<?php

namespace Cobra\Container\Resolver;

use ReflectionMethod;
use Cobra\Interfaces\Container\ContainerInterface;
use Cobra\Interfaces\Container\Resolver\MethodResolverInterface;

/**
 * Container Method Resolver
 *
 * Resolves a class method and its injected properties.
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
class MethodResolver implements MethodResolverInterface
{
    /**
     * ContainerInterface instance
     *
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * The instance to resolve the method on
     *
     * @var object
     */
    protected $instance;

    /**
     * Method name to resolve
     *
     * @var string
     */
    protected $method;

    /**
     * Additional parameters
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * Sets up the instance, method, and additional parameters
     *
     * @param ContainerInterface $container
     * @param object $instance
     * @param string $method
     * @param array  $arguments
     */
    public function __construct(ContainerInterface $container, object $instance, string $method, array $arguments = [])
    {
        $this->container = $container;
        $this->instance = $instance;
        $this->method = $method;
        $this->arguments = $arguments;
    }

    /**
     * Returns an executed instance method with resolved dependencies
     *
     * @return mixed
     */
    public function invoke()
    {
        $method = new ReflectionMethod(
            $this->instance,
            $this->method
        );
        $argumentResolver = new ArgumentsResolver(
            $this->container,
            $method->getParameters(),
            $this->arguments
        );
        return $method->invokeArgs(
            $this->instance,
            $argumentResolver->getArguments()
        );
    }
}
