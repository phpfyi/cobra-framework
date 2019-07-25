<?php

namespace Cobra\Interfaces\Autoloader;

use Composer\Autoload\ClassLoader;

/**
 * Composer Autoloader interface
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
interface ComposerAutoloaderInterface
{
    /**
     * Returns the class autoloader instance.
     *
     * @return ClassLoader
     */
    public function getAutoloader(): ClassLoader;

    /**
     * Gets the sub classes of a specific class in array format optionally
     * including the parent class.
     *
     * @param  string  $namespace
     * @param  boolean $parent
     * @return array
     */
    public function getSubclasses(string $namespace, $parent = false): array;
}
