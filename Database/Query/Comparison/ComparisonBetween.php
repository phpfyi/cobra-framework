<?php

namespace Cobra\Database\Query\Comparison;

/**
 * Comparison Between
 *
 * Class representing an SQL query BETWEEN comparison.
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

class ComparisonBetween extends Comparison
{
    /**
     * Comparison min value
     *
     * @var mixed
     */
    protected $minValue;

    /**
     * Comparison max value
     *
     * @var mixed
     */
    protected $maxValue;

    /**
     * Sets the required properties.
     *
     * @param string $column
     * @param mixed $minValue
     * @param mixed $maxValue
     */
    public function __construct(string $column, $minValue, $maxValue)
    {
        $this->column = $column;
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s BETWEEN ? AND ? ',
            $this->column
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
            $this->minValue,
            $this->maxValue,
        ];
    }
}
