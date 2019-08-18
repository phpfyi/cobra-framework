<?php

namespace Cobra\Database\Query\Column;

/**
 * Column Min
 *
 * Class representing an SQL query MIN column.
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

class ColumnMin extends Column
{
    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            'MIN(%s)',
            $this->column
        );
    }
}
