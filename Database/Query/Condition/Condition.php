<?php

namespace Cobra\Database\Query\Condition;

use Cobra\Database\Query\Comparison;
use Cobra\Database\Query\Query;
use Cobra\Database\Query\Traits\UsesQueryIdentifier;
use Cobra\Database\Store\QueryStore;

/**
 * Condition
 *
 * Class representing an SQL query condition.
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

abstract class Condition extends Query
{
    use UsesQueryIdentifier;

    /**
     * Condition type
     *
     * @var string
     */
    protected $condition;

    /**
     * QueryStore instance
     *
     * @var QueryStore
     */
    protected $store;

    /**
     * Sets the required properties.
     *
     * @param QueryStore $store
     */
    public function __construct(QueryStore $store)
    {
        $this->store = $store;

        $this->setQID();
    }

    /**
     * Returns the QueryStore instance.
     *
     * @return QueryStore
     */
    public function getStore(): QueryStore
    {
        return $this->store;
    }
    
    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s %s',
            $this->condition,
            $this->store->renderComparisons($this->qid)
        );
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
        $this->store->setComparison(Comparison\ComparisonBetween::class, $this->qid, [$$column, $minValue, $maxValue]);
        return $this;
    }

    /**
     * Sets a column condition
     *
     * @param [mixed] ...$args
     * @return Query
     */
    public function column(...$args): Query
    {
        $this->store->setComparison(Comparison\ComparisonColumn::class, $this->qid, $args);
        return $this;
    }

    /**
     * Sets a column condition
     *
     * @param [mixed] ...$args
     * @return Query
     */
    public function columns(...$args): Query
    {
        $this->store->setComparison(Comparison\ComparisonColumns::class, $this->qid, $args);
        return $this;
    }

    /**
     * Sets an IN clause.
     *
     * @param string $column
     * @param array $values
     * @return Query
     */
    public function in(string $column, array $values): Query
    {
        $this->store->setComparison(Comparison\ComparisonIn::class, $this->qid, [$column, 'IN', $values]);
        return $this;
    }

    /**
     * Sets a NOT IN clause.
     *
     * @param string $column
     * @param array $values
     * @return Query
     */
    public function notIn(string $column, array $values): Query
    {
        $this->store->setComparison(Comparison\ComparisonIn::class, $this->qid, [$column, 'NOT IN', $values]);
        return $this;
    }

    /**
     * Sets a comparison object in the store.
     *
     * @param string $namespace
     * @param array $args
     * @return Query
     */
    public function setComparison(string $namespace, array $args): Query
    {
        $this->store->setComparison($namespace, $this->qid, $args);
        return $this;
    }
}
