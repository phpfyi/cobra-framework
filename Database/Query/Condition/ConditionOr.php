<?php

namespace Cobra\Database\Query\Condition;

/**
 * Condition or
 *
 * Class representing an SQL query OR condition.
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

class ConditionOr extends Condition
{
    /**
     * Condition type
     *
     * @var string
     */
    protected $condition = 'OR';
}
