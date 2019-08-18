<?php

namespace Cobra\Database\Query\Comparison;

use Cobra\Database\Query\Query;

/**
 * Comparison Column
 *
 * Class representing an SQL query comparison.
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

class ComparisonColumn extends Comparison
{
    /**
     * Comparison column
     *
     * @var string
     */
    protected $column;

    /**
     * Comparison operator
     *
     * @var string
     */
    protected $operator;

    /**
     * Comparison value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Sets the required properties.
     *
     * @param string $column
     * @param string $operator
     * @param string|int|array $value
     */
    public function __construct(string $column, string $operator, $value)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s %s ? ',
            $this->column,
            $this->operator
        );
    }

    /**
     * Returns all bind data.
     *
     * @return array
     */
    public function getBindValues(): array
    {
        return [
            $this->value,
        ];
    }
}
