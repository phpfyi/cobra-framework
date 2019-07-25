<?php

namespace Cobra\Autoloader\Log;

use Cobra\Log\Log;

/**
 * Autoloader Log
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
class AutoloaderLog extends Log
{
    /**
     * Loaded class namesspace
     *
     * @var string
     */
    protected $class;

    /**
     * Sets the required properties.
     *
     * @param string $class
     */
    public function __construct(string $class)
    {
        parent::__construct();

        $this->class = $class;
    }

    /**
     * Returns the class namespace.
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Returns the difference between 2 log times.
     *
     * @return string
     */
    public function getDifference(): string
    {
        $start = AutoloaderLogger::$time ?? APP_START;
        $end = $this->time;

        AutoloaderLogger::$time = $end;

        return subtract_microtime($start, $end);
    }
}
