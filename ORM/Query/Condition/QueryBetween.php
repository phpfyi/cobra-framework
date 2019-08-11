<?php

namespace Cobra\ORM\Query\Condition;

use Cobra\ORM\Query\QueryCondition;

/**
 * Query Between
 *
 * Class representing an SQL query BETWEEN condition.
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

class QueryBetween extends QueryCondition
{
    /**
     * Condition min value
     *
     * @var mixed
     */
    protected $minValue;

    /**
     * Condition max value
     *
     * @var mixed
     */
    protected $maxValue;

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $column
     * @param mixed $minValue
     * @param mixed $maxValue
     */
    public function __construct(string $table, string $column, $minValue, $maxValue)
    {
        parent::__construct($table, $column);
        
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s BETWEEN ? AND ?',
            $this->getColumnSQL()
        );
    }
}
