<?php

namespace Cobra\Log;

use Cobra\Interfaces\Log\LogInterface;
use Cobra\Object\AbstractObject;

/**
 * Log
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
class Log extends AbstractObject implements LogInterface
{
    /**
     * Log time
     *
     * @var int
     */
    protected $time;

    /**
     * Sets the log time
     */
    public function __construct()
    {
        $this->time = microtime();
    }

    /**
     * Returns the log time.
     *
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }
}
