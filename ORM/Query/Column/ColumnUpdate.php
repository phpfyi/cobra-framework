<?php

namespace Cobra\ORM\Query\Column;

/**
 * Column UPdate
 *
 * Class representing an SQL query update query column.
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

class ColumnUpdate extends Column
{
    /**
     * Database table column value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Sets the required properties.
     *
     * @param string $column
     * @param mixed $value
     */
    public function __construct(string $column, $value)
    {
        parent::__construct($column);

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
            '%s = ?',
            $this->column
        );
    }

    /**
     * Returns the column value.
     *
     * @return void
     */
    public function getValue()
    {
        return $this->value;
    }
}
