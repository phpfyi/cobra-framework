<?php

namespace Cobra\Interfaces\Autoloader;

/**
 * Autoloader Interface
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
interface AutoloaderInterface
{
    /**
     * Logs the the autoload request before passing to composer.
     *
     * @param  string $class
     * @return void
     */
    public function include(string $class): void;
}
