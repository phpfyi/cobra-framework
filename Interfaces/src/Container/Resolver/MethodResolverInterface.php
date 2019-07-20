<?php

namespace Cobra\Interfaces\Container\Resolver;

/**
 * Method Resolver Interface
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
interface MethodResolverInterface
{
    /**
     * Invokes a class method with resolved dependencies and returns the value.
     *
     * @return mixed
     */
    public function invoke();
}
