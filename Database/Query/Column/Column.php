<?php

namespace Cobra\Database\Query\Column;

use Cobra\Database\Query\Query;

/**
 * Column
 *
 * Class representing an SQL query column.
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

class Column extends Query
{
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
    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s',
            $this->column
        );
    }
}
