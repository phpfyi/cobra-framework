<?php

use Cobra\Environment\Environment;

/**
 * Environment function sets
 *
 * @category  Environment
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

if (! function_exists('env')) {
    /**
     * Returns an environment value.
     *
     * @param  string $name
     * @return mixed
     */
    function env(string $name)
    {
        return Environment::get($name);
    }
}
