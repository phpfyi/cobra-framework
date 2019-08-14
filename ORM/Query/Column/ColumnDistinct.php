<?php

namespace Cobra\ORM\Query\Column;

/**
 * Column Distinct
 *
 * Class representing an SQL query DISTINCT column.
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

class ColumnDistinct extends Column
{
    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            'DISTINCT(%s)',
            $this->column
        );
    }
}
