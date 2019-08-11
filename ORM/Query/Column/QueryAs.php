<?php

namespace Cobra\ORM\Query\Column;

use Cobra\ORM\Query\QueryColumn;

/**
 * Query As
 *
 * Class representing an SQL query AS column.
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

class QueryAs extends QueryColumn
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
     * @param string $table
     * @param string $column
     * @param string $alias
     */
    public function __construct(string $table, string $column, string $alias)
    {
        parent::__construct($table, $column);

        $this->alias = $alias;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf('%s AS %s', $this->getColumnSQL(), $this->alias);
    }
}
