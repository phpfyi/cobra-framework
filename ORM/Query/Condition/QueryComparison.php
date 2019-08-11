<?php

namespace Cobra\ORM\Query\Condition;

use Cobra\ORM\Query\QueryCondition;

/**
 * Query Comparison
 *
 * Class representing an SQL query comparison condition.
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

class QueryComparison extends QueryCondition
{
    /**
     * Condition operator
     *
     * @var string
     */
    protected $operator;

    /**
     * Condition value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $column
     * @param string $operator
     * @param string|int|array $value
     */
    public function __construct(string $table, string $column, string $operator, $value)
    {
        parent::__construct($table, $column);
        
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s %s ?',
            $this->getColumnSQL(),
            $this->operator
        );
    }
}
