<?php

use Cobra\Interfaces\Config\ConfigInterface;

/**
 * Config function sets
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

if (! function_exists('config')) {
    /**
     * Returns a config value
     *
     * @param  string $name
     * @return void
     */
    function config(string $name)
    {
        return container_object(ConfigInterface::class)->get($name);
    }
}
