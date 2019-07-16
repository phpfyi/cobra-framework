<?php

namespace Cobra\Autoloader\Log;

use Cobra\Interfaces\Singleton\SingletonInterface;
use Cobra\Log\Logger;
use Cobra\Object\Traits\SingletonMethods;

/**
 * Autoloader Logger
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
class AutoloaderLogger extends Logger implements SingletonInterface
{
    use SingletonMethods;

    /**
     * Current autoload execution time
     *
     * @var string
     */
    public static $time;

    /**
     * Sets up the singleton instance
     *
     * @return AutoloaderLogger
     */
    public static function instance(): AutoloaderLogger
    {
        new AutoloaderLog('');

        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }
        return $instance;
    }
}
