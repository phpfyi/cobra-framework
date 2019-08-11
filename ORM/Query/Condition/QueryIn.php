<?php

namespace Cobra\ORM\Query\Condition;

use Cobra\ORM\Query\QueryCondition;

/**
 * Query in Condition
 *
 * Class representing an SQL query IN condition.
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

class QueryIn extends QueryCondition
{
    /**
     * Condition operator
     *
     * @var string
     */
    protected $operator = 'IN';

    /**
     * Condition values
     *
     * @var mixed
     */
    protected $values = [];

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $column
     * @param string $operator
     * @param array $values
     */
    public function __construct(string $table, string $column, string $operator = 'IN', array $values = [])
    {
        parent::__construct($table, $column);
        
        $this->operator = $operator;
        $this->values = $values;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s %s (%s)',
            $this->getColumnSQL(),
            $this->operator,
            $this->getSQLPlaceholders()
        );
    }

    /**
     * Returns the placeholders SQL.
     *
     * @return string
     */
    protected function getSQLPlaceholders(): string
    {
        return implode(',', array_fill(0, count($this->values), '?'));
    }
}
