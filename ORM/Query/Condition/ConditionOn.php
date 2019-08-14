<?php

namespace Cobra\ORM\Query\Condition;

/**
 * Condition on
 *
 * Class representing an SQL query ON condition.
 *
 * @category  ORM
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

class ConditionOn extends Condition
{
    /**
     * Condition type
     *
     * @var string
     */
    protected $condition = 'ON';
}
