<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Column;
use Cobra\ORM\Query\Join;
use Cobra\ORM\Query\Traits\UsesBindData;
use Cobra\ORM\Query\Traits\UsesConditions;
use Cobra\ORM\Query\Traits\UsesLimit;
use Cobra\ORM\Store\QueryStore;

/**
 * Select Query
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

class SelectQuery extends Query
{
    use UsesBindData, UsesConditions, UsesLimit;

    /**
     * Store Class
     *
     * @var string
     */
    protected $storeClass = QueryStore::class;
    
    /**
     * Database table name.
     *
     * @var string
     */
    protected $table;
    
    /**
     * Database table class.
     *
     * @var string
     */
    protected $class;

    /**
     * QueryStore instance
     *
     * @var array
     */
    protected $store;

    /**
     * The query sort column
     *
     * @var string
     */
    protected $order;

    /**
     * The query sort direction
     *
     * @var string
     */
    protected $sort = 'ASC';

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $class
     */
    public function __construct(string $table, string $class = null)
    {
        $this->table = $table;
        $this->class = $class;
        $this->store = container_resolve($this->storeClass);
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            'SELECT %s FROM `%s` %s%s %s %s',
            $this->store->renderColumns(),
            $this->table,
            $this->store->renderJoins(),
            $this->store->renderConditions(),
            $this->order ? sprintf(' ORDER BY %s %s', $this->order, $this->sort) : '',
            $this->limit > 0 ? sprintf(' LIMIT %s', $this->limit) : ''
        );
    }

    /**
     * Sets an array of query columns.
     *
     * @param array $columns
     * @return SelectQuery
     */
    public function columns(array $columns): SelectQuery
    {
        array_map(function (string $column) {
            $this->column($column);
        }, $columns);
        return $this;
    }

    /**
     * Sets a query column object.
     *
     * @param string $column
     * @return SelectQuery
     */
    public function column(string $column): SelectQuery
    {
        $this->store->setColumn(Column\Column::class, [$column]);
        return $this;
    }

    /**
     * Sets a AS query column object.
     *
     * @param string $column
     * @param string $alias
     * @return SelectQuery
     */
    public function as(string $column, string $alias): SelectQuery
    {
        $this->store->setColumn(Column\ColumnAs::class, [$column, $alias]);
        return $this;
    }

    /**
     * Sets a AVG query column object.
     *
     * @param string $column
     * @return SelectQuery
     */
    public function average(string $column): SelectQuery
    {
        $this->store->setColumn(Column\ColumnAverage::class, [$column]);
        return $this;
    }

    /**
     * Sets a COUNT query column object.
     *
     * @param string $column
     * @param string $alias
     * @return SelectQuery
     */
    public function count(string $column, string $alias = 'count'): SelectQuery
    {
        $this->store->setColumn(Column\ColumnCount::class, [$column, $alias]);
        return $this;
    }

    /**
     * Sets a DISTINCT query column object.
     *
     * @param string $column
     * @return SelectQuery
     */
    public function distinct(string $column): SelectQuery
    {
        $this->store->setColumn(Column\ColumnDistinct::class, [$column]);
        return $this;
    }

    /**
     * Sets a MAX query column object.
     *
     * @param string $column
     * @return SelectQuery
     */
    public function max(string $column): SelectQuery
    {
        $this->store->setColumn(Column\ColumnMax::class, [$column]);
        return $this;
    }

    /**
     * Sets a MIN query column object.
     *
     * @param string $column
     * @return SelectQuery
     */
    public function min(string $column): SelectQuery
    {
        $this->store->setColumn(Column\ColumnMin::class, [$column]);
        return $this;
    }

    /**
     * Sets a SUM query column object.
     *
     * @param string $column
     * @return SelectQuery
     */
    public function sum(string $column): SelectQuery
    {
        $this->store->setColumn(Column\ColumnSum::class, [$column]);
        return $this;
    }

    /**
     * Sets a LEFT JOIN query object.
     *
     * @param string $table
     * @return JoinLeft
     */
    public function joinLeft(string $table): Join\JoinLeft
    {
        return $this->store->setJoin(Join\JoinLeft::class, [$table, $this->storeClass]);
    }

    /**
     * Sets a RIGHT JOIN query object.
     *
     * @param string $table
     * @return JoinRight
     */
    public function joinRight(string $table): Join\JoinRight
    {
        return $this->store->setJoin(Join\JoinRight::class, [$table, $this->storeClass]);
    }

    /**
     * Sets a FULL JOIN query object.
     *
     * @param string $table
     * @return JoinFull
     */
    public function joinFull(string $table): Join\JoinFull
    {
        return $this->store->setJoin(Join\JoinFull::class, [$table, $this->storeClass]);
    }

    /**
     * Sets a INNER JOIN query object.
     *
     * @param string $table
     * @return JoinInner
     */
    public function joinInner(string $table): Join\JoinInner
    {
        return $this->store->setJoin(Join\JoinInner::class, [$table, $this->storeClass]);
    }

    /**
     * Sets the query sort order.
     *
     * @param string $order
     * @param string $sort
     * @return SelectQuery
     */
    public function order(string $order = 'id', string $sort = null): SelectQuery
    {
        $this->order = $order;
        $sort ? $this->sort = $sort : null;
        return $this;
    }

    /**
     * Sets the query sort direction.
     *
     * @param string $sort
     * @return SelectQuery
     */
    public function sort(string $sort = 'ASC'): SelectQuery
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Fetches the data.
     *
     * @return mixed
     */
    public function fetch()
    {
        $stmt = stmt(
            $this->getSQL(),
            $this->bind,
            $this->limit
        );
        if ($this->class) {
            $stmt->setClass($this->class);
        }
        return $stmt->fetch();
    }
}
