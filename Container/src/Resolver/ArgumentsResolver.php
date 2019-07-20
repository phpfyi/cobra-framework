<?php

namespace Cobra\Container\Resolver;

use ReflectionParameter;
use Cobra\Interfaces\Container\ContainerInterface;
use Cobra\Interfaces\Container\Resolver\ArgumentsResolverInterface;

/**
 * Container Arguments Resolver
 *
 * Resolves the injected arguments for class constructors and class methods.
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
class ArgumentsResolver implements ArgumentsResolverInterface
{
    /**
     * ContainerInterface instance
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Parameters to resolve
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Optional arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * Sets the arguments and parameters
     *
     * @param ContainerInterface $container
     * @param array $parameters
     * @param array $arguments
     */
    public function __construct(ContainerInterface $container, array $parameters, array $arguments = [])
    {
        $this->container = $container;
        $this->parameters = $parameters;
        $this->arguments = $arguments;
    }

    /**
     * Get the class instance arguments
     *
     * @return array
     */
    public function getArguments(): array
    {
        array_map(
            function ($index, ReflectionParameter $parameter) {
                if (!array_key_exists($index, $this->arguments)) {
                    $this->arguments[] = $parameter->getClass() != null
                    ? (new ClassResolver(
                        $this->container,
                        $parameter->getClass()->name
                    ))->getInstance()
                    : $parameter->getDefaultValue();
                }
            },
            array_keys($this->parameters),
            $this->parameters
        );
        return $this->arguments;
    }
}
