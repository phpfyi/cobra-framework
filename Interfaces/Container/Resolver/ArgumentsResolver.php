<?php

namespace Cobra\Interfaces\Container\Resolver;

/**
 * Arguments Resolver interface
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
interface ArgumentsResolverInterface
{
    /**
     * Returns the resolved arguments for a class constructor or class method.
     *
     * @return array
     */
    public function getArguments(): array;
}
