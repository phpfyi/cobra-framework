<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Traits\UsesColumn;
use Cobra\ORM\Query\Traits\UsesTable;

/**
 * Query Condition
 *
 * Class representing an SQL query condition.
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

abstract class QueryCondition extends Query
{
    use UsesColumn, UsesTable;

    /**
     * Condition column
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
