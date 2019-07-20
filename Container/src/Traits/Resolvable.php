<?php

namespace Cobra\Container\Traits;

/**
 * Resolvable Trait
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
trait Resolvable
{
    /**
     * Returns a resolved instance of the calling class.
     *
     * @param  mixed[] ...$args
     * @return void
     */
    public static function resolve(...$args)
    {
        return container_resolve(static::class, func_get_args());
    }
}
