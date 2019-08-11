<?php

namespace Cobra\ORM\Query\Traits;

use Cobra\ORM\Query\Column;
use Cobra\ORM\Query\Query;
use Cobra\ORM\Query\QueryColumn;

/**
 * Uses Columns
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

trait UsesColumns
{
    /**
     * Array of query columns.
     *
     * @var array
     */
    protected $columns = [];
    
    /**
     * Returns an array of all query column objects.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Sets an array of query column objects.
     *
     * @param array $columns
     * @return Query
     */
    public function columns(array $columns): Query
    {
        array_map(function (string $column) {
            $this->column($column);
        }, $columns);
    }

    /**
     * Sets a query column object.
     *
     * @param string $column
     * @return Query
     */
    public function column(string $column): Query
    {
        return $this->setColumnObject(Column\QueryColumn::class, func_get_args());
    }

    /**
     * Sets a DISTINCT query column object.
     *
     * @param string $column
     * @return Query
     */
    public function distinct(string $column): Query
    {
        return $this->setColumnObject(Column\QueryDistinct::class, func_get_args());
    }

    /**
     * Sets a MIN query column object.
     *
     * @param string $column
     * @return Query
     */
    public function min(string $column): Query
    {
        return $this->setColumnObject(Column\QueryMin::class, func_get_args());
    }

    /**
     * Sets a MAX query column object.
     *
     * @param string $column
     * @return Query
     */
    public function max(string $column): Query
    {
        return $this->setColumnObject(Column\QueryMax::class, func_get_args());
    }

    /**
     * Sets a AVG query column object.
     *
     * @param string $column
     * @return Query
     */
    public function average(string $column): Query
    {
        return $this->setColumnObject(Column\QueryAverage::class, func_get_args());
    }

    /**
     * Sets a SUM query column object.
     *
     * @param string $column
     * @return Query
     */
    public function sum(string $column): Query
    {
        return $this->setColumnObject(Column\QuerySum::class, func_get_args());
    }

    /**
     * Sets a AS query column object.
     *
     * @param string $column
     * @param string $alias
     * @return Query
     */
    public function as(string $column, string $alias): Query
    {
        return $this->setColumnObject(Column\QueryAs::class, func_get_args());
    }

    /**
     * Sets a query column object.
     *
     * @param string $namespace
     * @param array $args
     * @return Query
     */
    protected function setColumnObject(string $namespace, array $args): Query
    {
        $this->columns[] = container_resolve(
            $namespace,
            array_merge(
                [$this->getTable()],
                $args
            )
        );
        return $this;
    }
}
