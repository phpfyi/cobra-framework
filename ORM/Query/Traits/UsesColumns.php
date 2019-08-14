<?php

namespace Cobra\ORM\Query\Traits;

use Cobra\ORM\Query\Column;
use Cobra\ORM\Query\Query;

/**
 * Uses Columns trait
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
     * Sets an array of columns to fetch.
     *
     * @param array $columns
     * @return Query
     */
    public function columns(array $columns): Query
    {
        array_map(function (string $column) {
            $this->store->setColumn(Column\Column::class, [$column]);
        }, $columns);
        return $this;
    }

    /**
     * Sets a query column object.
     *
     * @param string $column
     * @return Query
     */
    public function column(string $column): Query
    {
        $this->store->setColumn(Column\Column::class, [$column]);
        return $this;
    }
}
