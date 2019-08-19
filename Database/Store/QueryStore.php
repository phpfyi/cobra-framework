<?php

namespace Cobra\Database\Store;

use Cobra\Database\Query\Column\Column;
use Cobra\Database\Query\Column\ColumnMutator;
use Cobra\Database\Query\Comparison\Comparison;
use Cobra\Database\Query\Condition\Condition;
use Cobra\Database\Query\Join\Join;
use Cobra\Database\Query\Query;
use Cobra\Object\AbstractObject;

/**
 * Query Store
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

class QueryStore extends AbstractObject
{
    /**
     * Array of query columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Array of query joins.
     *
     * @var array
     */
    protected $joins = [];

    /**
     * Array of query conditions.
     *
     * @var array
     */
    protected $conditions = [];

    /**
     * Array of query comparisons.
     *
     * @var array
     */
    protected $comparisons = [];

    /**
     * Array of query bind data.
     *
     * @var array
     */
    protected $bind = [];

    /**
     * Returns the query bind data array.
     *
     * @return array
     */
    public function getBind(): array
    {
        return $this->bind;
    }

    /**
     * Sets a query column.
     *
     * @param string $namespace
     * @param array $args
     * @return Column
     */
    public function setColumn(string $namespace, array $args = []): Column
    {
        $column = container_resolve($namespace, $args);

        if ($column instanceof ColumnMutator) {
            $this->bind = array_merge($this->bind, $column->getBindValues());
        }
        return $this->columns[] = $column;
    }

    /**
     * Returns all query columns.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Sets a query join.
     *
     * @param string $namespace
     * @param array $args
     * @return Join
     */
    public function setJoin(string $namespace, array $args = []): Join
    {
        return $this->joins[] = container_resolve($namespace, $args);
    }

    /**
     * Returns all query joins.
     *
     * @return array
     */
    public function getJoins(): array
    {
        return $this->joins;
    }

    /**
     * Sets a query condition.
     *
     * @param string $namespace
     * @param array $args
     * @return Condition
     */
    public function setCondition(string $namespace, string $qid, array $args = []): Condition
    {
        return $this->conditions[$qid][] = container_resolve($namespace, $args);
    }

    /**
     * Returns query conditions based on an identifier.
     *
     * @param string $qid
     * @return array
     */
    public function getConditions(string $qid): array
    {
        return array_key($qid, $this->conditions, []);
    }

    /**
     * Sets a query comparison.
     *
     * @param string $namespace
     * @param string $qid
     * @param array $args
     * @return Comparison
     */
    public function setComparison(string $namespace, string $qid, array $args = []): Comparison
    {
        $comparison = container_resolve($namespace, $args);
        
        $this->bind = array_merge($this->bind, $comparison->getBindValues());
        
        return $this->comparisons[$qid][] = $comparison;
    }

    /**
     * Returns query comparisons based on an identifier.
     *
     * @param string $qid
     * @return array
     */
    public function getComparisons(string $qid): array
    {
        return array_key($qid, $this->comparisons, []);
    }

    /**
     * Renders the query columns SQL.
     *
     * @return string
     */
    public function renderColumns(): string
    {
        if (count($this->columns) === 0) {
            return '*';
        }
        return $this->renderPortion($this->columns, ', ');
    }

    /**
     * Renders the query joins SQL.
     *
     * @return string
     */
    public function renderJoins(): string
    {
        return $this->renderPortion($this->joins);
    }

    /**
     * Renders query conditions based on an identifier.
     *
     * @param string $qid
     * @return string
     */
    public function renderConditions(string $qid): string
    {
        return $this->renderPortion($this->getConditions($qid));
    }

    /**
     * Renders query comparisons based on an identifier.
     *
     * @param string $qid
     * @return string
     */
    public function renderComparisons(string $qid): string
    {
        return $this->renderPortion($this->getComparisons($qid));
    }

    /**
     * Renders an SQL portion.
     *
     * @param array $parts
     * @param string $seperator
     * @return void
     */
    protected function renderPortion(array $parts, string $seperator = '')
    {
        return implode(
            $seperator,
            array_map(function (Query $part) {
                return $part->getSQL();
            }, $parts)
        );
    }
}
