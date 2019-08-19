<?php

namespace Cobra\Database\Query\Comparison;

/**
 * Query in Comparison
 *
 * Class representing an SQL query IN comparison.
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

class ComparisonIn extends Comparison
{
    /**
     * Comparison operator
     *
     * @var string
     */
    protected $operator = 'IN';

    /**
     * Comparison values
     *
     * @var mixed
     */
    protected $values = [];

    /**
     * Sets the required properties.
     *
     * @param string $column
     * @param string $operator
     * @param array $values
     */
    public function __construct(string $column, string $operator = 'IN', array $values = [])
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->values = $values;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s %s (%s) ',
            $this->column,
            $this->operator,
            stmt_placeholders($this->values)
        );
    }

    /**
     * Returns all bind data.
     *
     * @return array
     */
    public function getBindValues(): array
    {
        return $this->values;
    }
}
