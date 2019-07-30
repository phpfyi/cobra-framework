<?php

namespace Cobra\Autoloader;

use Cobra\Autoloader\Log\AutoloaderLog;
use Cobra\Autoloader\Log\AutoloaderLogger;
use Cobra\Interfaces\Autoloader\AutoloaderInterface;
use Cobra\Object\AbstractObject;

/**
 * Autoloader
 *
 * Framework autoloader which intercepts autoload requests.
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
class Autoloader extends AbstractObject implements AutoloaderInterface
{
    /**
     * Sets up the class aliases
     *
     * @param AutoloaderLogger $logger
     */
    public function __construct(AutoloaderLogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Logs the the autoload request before passing to composer.
     *
     * @param  string $class
     * @return void
     */
    public function include(string $class): void
    {
        $this->logger->setLog(
            container_resolve(AutoloaderLog::class, [$class])
        );
    }
}
