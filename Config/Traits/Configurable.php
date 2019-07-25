<?php

namespace Cobra\Config\Traits;

/**
 * Configurable trait
 *
 * @category  Config
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait Configurable
{
    /**
     * Returns the configuration for this class
     *
     * @param string|null $value
     * @return mixed
     */
    public static function config(string $value = null)
    {
        return config($value ? static::class . '.' . $value : static::class);
    }
}
