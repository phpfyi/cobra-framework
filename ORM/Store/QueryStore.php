<?php

namespace Cobra\ORM\Store;

use Cobra\Object\AbstractObject;
use Cobra\ORM\Query\Column\Column;
use Cobra\ORM\Query\Comparison\Comparison;
use Cobra\ORM\Query\Condition\Condition;
use Cobra\ORM\Query\Join\Join;
use Cobra\ORM\Query\Query;

/**
 * Query Store
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
     * Sets a query column.
     *
     * @param string $namespace
     * @param array $args
     * @return Column
     */
    public function setColumn(string $namespace, array $args = []): Column
    {
        return $this->columns[] = container_resolve($namespace, $args);
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
     * Sets a query condition.
     *
     * @param string $namespace
     * @param array $args
     * @return Condition
     */
    public function setCondition(string $namespace, array $args = []): Condition
    {
        return $this->conditions[] = container_resolve($namespace, $args);
    }

    /**
     * Sets a query comparison.
     *
     * @param string $namespace
     * @param array $args
     * @return Comparison
     */
    public function setComparison(string $namespace, array $args = []): Comparison
    {
        return $this->comparisons[] = container_resolve($namespace, $args);
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
     * Renders the query conditions SQL.
     *
     * @return string
     */
    public function renderConditions(): string
    {
        return $this->renderPortion($this->conditions);
    }

    /**
     * Renders the query comparisons SQL.
     *
     * @return string
     */
    public function renderComparisons(): string
    {
        return $this->renderPortion($this->comparisons);
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
