<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Traits\UsesColumn;

/**
 * Query Column
 *
 * Abstract class representing an SQL query column.
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

abstract class QueryColumn extends Query
{
    use UsesColumn;

    /**
     * Database table name
     *
     * @var string
     */
    protected $table;

    /**
     * Database table column name
     *
     * @var string
     */
    protected $column;

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $column
     */
    public function __construct(string $table, string $column)
    {
        $this->table = $table;
        $this->column = $column;
    }
}
