<?php

namespace Cobra\Interfaces\Log;

/**
 * Log Interface
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
interface LogInterface
{
    /**
     * Returns the log time.
     *
     * @return string
     */
    public function getTime(): string;
}
