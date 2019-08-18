<?php

namespace Cobra\Database\Query\Comparison;

use Cobra\Database\Query\Query;

/**
 * Comparison Columns
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

class ComparisonColumns extends Comparison
{
    /**
     * Database table column
     *
     * @var string
     */
    protected $column;

    /**
     * Join operator
     *
     * @var string
     */
    protected $operator;

    /**
     * Database join table column
     *
     * @var string
     */
    protected $joinColumn;

    /**
     * Sets the required properties.
     *
     * @param string $column
     * @param string $operator
     * @param string $joinColumn
     */
    public function __construct(string $column, string $operator, string $joinColumn)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->joinColumn = $joinColumn;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s %s %s ',
            $this->column,
            $this->operator,
            $this->joinColumn
        );
    }

    /**
     * Returns all bind data.
     *
     * @return array
     */
    public function getBindValues(): array
    {
        return [];
    }
}
