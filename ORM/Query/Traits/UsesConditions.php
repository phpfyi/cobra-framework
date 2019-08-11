<?php

namespace Cobra\ORM\Query\Traits;

use Closure;
use Cobra\ORM\Query\Condition;
use Cobra\ORM\Query\Conjunction\QueryAnd;
use Cobra\ORM\Query\Conjunction\QueryOr;
use Cobra\ORM\Query\Conjunction\QueryWhere;
use Cobra\ORM\Query\Query;
use Cobra\ORM\Query\QueryCondition;
use Cobra\ORM\Query\QueryConjunction;
use Cobra\ORM\Query\QueryJoin;
use Cobra\ORM\Query\QuerySelect;

/**
 * Uses Conditions trait
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

trait UsesConditions
{
    /**
     * Array of conditions.
     *
     * @var array
     */
    protected $conditions = [];

    /**
     * Returns all query conditions.
     *
     * @return array
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * Sets a query condition
     *
     * @param QueryCondition $condition
     * @return Query
     */
    public function setCondition(QueryCondition $condition): Query
    {
        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * Sets a WHERE clause / WHERE IN(value,value,...) / WHERE IN (SELECT...)
     *
     * @param string|Closure $column
     * @param string $operator
     * @param mixed $value
     * @return Query
     */
    public function where($column, string $operator = null, $value = null): Query
    {
        return $this->setConjunctionForCondition($column, func_get_args(), QueryWhere::class, Condition\QueryComparison::class);
    }

    /**
     * Sets a AND clause.
     *
     * @param string|Closure $column
     * @param string $operator
     * @param mixed $value
     * @return Query
     */
    public function and($column, string $operator = null, $value = null): Query
    {
        return $this->setConjunctionForCondition($column, func_get_args(), QueryAnd::class, Condition\QueryComparison::class);
    }

    /**
     * Sets a OR clause.
     *
     * @param string|Closure $column
     * @param string $operator
     * @param mixed $value
     * @return Query
     */
    public function or($column, string $operator = null, $value = null): Query
    {
        return $this->setConjunctionForCondition($column, func_get_args(), QueryOr::class, Condition\QueryComparison::class);
    }

    /**
     * Sets a WHERE column BETWEEN minValue AND maxValue;
     *
     * @param mixed $column
     * @param mixed $minValue
     * @param mixed $maxValue
     * @return Query
     */
    public function between(string $column, $minValue, $maxValue): Query
    {
        return $this->setConjunctionForCondition($column, func_get_args(), QueryWhere::class, Condition\QueryBetween::class);
    }

    /**
     * Sets a OR clause.
     *
     * @param string $column
     * @param array $values
     * @return Query
     */
    public function in(string $column, array $values): Query
    {
        return $this->setConjunctionForCondition($column, [$column, 'IN', $values], QueryWhere::class, Condition\QueryIn::class);
    }

    /**
     * Sets a OR clause.
     *
     * @param string $column
     * @param array $values
     * @return Query
     */
    public function notIn(string $column, array $values): Query
    {
        return $this->setConjunctionForCondition($column, [$column, 'NOT IN', $values], QueryWhere::class, Condition\QueryIn::class);
    }

    /**
     * Sets a condition or conjunction query object.
     *
     * @param string|Closure $column
     * @param array $args
     * @param string $conjunction
     * @param string $condition
     * @return Query
     */
    protected function setConjunctionForCondition($column, array $args, string $conjunction, string $condition): Query
    {
        $conjunction = container_resolve($conjunction, [$this->table]);
        array_unshift($args, $this->table);

        $column instanceof Closure
        ? $column($conjunction)
        : $conjunction->setCondition(container_resolve($condition, $args));

        $this->conditions[] = $this->setConjunctionForWhere($conjunction);
        return $this;
    }

    /**
     * Returns a correct WHERE or AND conjunction based off the previous conditions.
     *
     * @param QueryConjunction $conjunction
     * @return QueryConjunction
     */
    protected function setConjunctionForWhere(QueryConjunction $conjunction): QueryConjunction
    {
        if ($conjunction instanceof QueryWhere) {
            // if within nested query remove WHERE
            if (!$this instanceof QuerySelect && !$this instanceof QueryJoin) {
                $conjunction->setConjunction(null);
            }
            // normalise WHERE to AND
            if (count($this->conditions) > 0) {
                $conjunction->setConjunction('AND');
            }
        }
        return $conjunction;
    }
}
