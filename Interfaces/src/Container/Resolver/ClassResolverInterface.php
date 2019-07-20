<?php

namespace Cobra\Interfaces\Container\Resolver;

/**
 * Class Resolver Interface
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
interface ClassResolverInterface
{
    /**
     * Returns a class instance from the container if bound or creates a new one
     * with resolved dependencies.
     *
     * @return object
     */
    public function getInstance(): object;

    /**
     * Returns a new class instance with or without resolved dependencies.
     *
     * @return object
     */
    public function newInstance(): object;
}
