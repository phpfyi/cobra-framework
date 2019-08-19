<?php

namespace Cobra\Database\Query\Condition;

/**
 * Condition where
 *
 * Class representing an SQL query WHERE condition.
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

class ConditionWhere extends Condition
{
    /**
     * Condition type
     *
     * @var string
     */
    protected $condition = 'WHERE';
}
