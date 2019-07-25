<?php

use Cobra\Interfaces\Autoloader\ComposerAutoloaderInterface;

/**
 * Autoloader function sets
 *
 * @category  Autoloader
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

if (! function_exists('subclasses')) {
    /**
     * Gets the sub classes of a specific class in array format optionally
     * including the parent class.
     *
     * @param  string  $namespace
     * @param  boolean $parent
     * @return array
     */
    function subclasses(string $namespace, $parent = false): array
    {
        return container_object(ComposerAutoloaderInterface::class)->getSubclasses($namespace, $parent);
    }
}
