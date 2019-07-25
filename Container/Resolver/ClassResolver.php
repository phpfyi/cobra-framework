<?php

namespace Cobra\Container\Resolver;

use ReflectionClass;
use Cobra\Interfaces\Container\ContainerInterface;
use Cobra\Interfaces\Container\Resolver\ClassResolverInterface;
use Cobra\Interfaces\Object\SingletonInterface;

/**
 * Container Class Resolver
 *
 * Resolves a class and its constructor injected properties.
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
class ClassResolver implements ClassResolverInterface
{
    /**
     * ContainerInterface instance
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * The class namespace to resolve
     *
     * @var string
     */
    protected $namespace;

    /**
     * The object optional arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The resolved class object
     *
     * @var object
     */
    protected $class;

    /**
     * Sets the required properties
     *
     * @param ContainerInterface $container
     * @param string $namespace
     * @param array $arguments
     */
    public function __construct(ContainerInterface $container, string $namespace, $arguments = [])
    {
        $this->container = $container;
        $this->namespace = $namespace;
        $this->arguments = $arguments;
    }

    /**
     * Returns a class instance from the container if bound or creates a new one
     * with resolved dependencies.
     *
     * @return object
     */
    public function getInstance(): object
    {
        // check for container entry
        if ($this->container->has($this->namespace)) {
            $bound = $this->container->get($this->namespace);
            
            // return if there is a container instance
            if (is_object($bound)) {
                return $bound;
            }
            // sets the namespace to the bound container namespace
            $this->namespace = $bound;
        }
        $this->class = new ReflectionClass($this->namespace);
        
        // return singleton if class implements SingletonInterface
        if ($this->class->implementsInterface(SingletonInterface::class)) {
            return $this->namespace::instance();
        }
        return $this->newInstance();
    }

    /**
     * Returns a new class instance with or without resolved dependencies.
     *
     * @return object
     */
    public function newInstance(): object
    {
        $constructor = $this->class->getConstructor();

        if ($constructor && $constructor->isPublic()) {
            if (count($constructor->getParameters()) > 0) {
                $argumentResolver = new ArgumentsResolver(
                    $this->container,
                    $constructor->getParameters(),
                    $this->arguments
                );
                $this->arguments = $argumentResolver->getArguments();
            }
            return $this->class->newInstanceArgs($this->arguments);
        }
        return $this->class->newInstanceWithoutConstructor();
    }
}
