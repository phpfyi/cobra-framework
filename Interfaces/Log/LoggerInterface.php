<?php

namespace Cobra\Interfaces\Log;

/**
 * Logger Interface
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
interface LoggerInterface
{
    /**
     * Sets a log instance on the logs array
     *
     * @param  LogInterface $log
     * @return LoggerInterface
     */
    public function setLog(LogInterface $log): LoggerInterface;

    /**
     * Returns all log instances
     *
     * @return array
     */
    public function getLogs(): array;
}
