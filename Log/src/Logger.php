<?php

namespace Cobra\Log;

use Cobra\Interfaces\Log\LogInterface;
use Cobra\Interfaces\Log\LoggerInterface;
use Cobra\Object\AbstractObject;

/**
 * Logger
 *
 * @category  Log
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Logger extends AbstractObject implements LoggerInterface
{
    /**
     * Array of log objects
     *
     * @var array
     */
    protected $logs = [];

    /**
     * Sets a log instance on the logs array
     *
     * @param  LogInterface $log
     * @return LoggerInterface
     */
    public function setLog(LogInterface $log): LoggerInterface
    {
        $this->logs[] = $log;
        return $this;
    }

    /**
     * Returns all log instances
     *
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }
}
