<?php

namespace Cobra\Database\Query\Column;

use Cobra\Database\Query\Query;

/**
 * Column Mutator
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

abstract class ColumnMutator extends Query
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
