<?php

namespace Cobra\Database\Query\Join;

/**
 * Join Right
 *
 * @category  Database
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

class JoinRight extends Join
{
    /**
     * Join type
     *
     * @var string
     */
    protected $join = 'RIGHT JOIN';
}
