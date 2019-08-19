<?php

namespace Cobra\Database\Query\Traits;

use Cobra\Database\Query\Query;

/**
 * Uses Mutate Columns trait
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

trait UsesMutateColumns
{
    /**
     * Sets an array of query column objects.
     *
     * @param array $columns
     * @return Query
     */
    public function columns(array $columns): Query
    {
        array_map(function (string $column, $value) {
            $this->column($column, $value);
        }, array_keys($columns), $columns);
        return $this;
    }

    /**
     * Sets a query column object.
     *
     * @param string $column
     * @param mixed $value
     * @return Query
     */
    public function column(string $column, $value): Query
    {
        $this->store->setColumn($this->columnClass, [$column, $value]);
        return $this;
    }
}
