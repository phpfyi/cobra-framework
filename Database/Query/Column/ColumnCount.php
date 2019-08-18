<?php

namespace Cobra\Database\Query\Column;

/**
 * Column Count
 *
 * Class representing an SQL query COUNT column.
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

class ColumnCount extends Column
{
    /**
     * Database table column alias
     *
     * @var string
     */
    protected $alias;

    /**
     * Sets the required properties.
     *
     * @param string $column
     * @param string $alias
     */
    public function __construct(string $column, string $alias)
    {
        parent::__construct($column);

        $this->alias = $alias;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            'COUNT(%s) AS %s',
            $this->column,
            $this->alias
        );
    }
}
