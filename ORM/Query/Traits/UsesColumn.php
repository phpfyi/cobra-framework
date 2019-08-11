<?php

namespace Cobra\ORM\Query\Traits;

/**
 * Uses Column
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

trait UsesColumn
{
    /**
     * Returns the column name SQL.
     *
     * @return string
     */
    protected function getColumnSQL(): string
    {
        return sprintf('`%s`.`%s`', $this->table, $this->column);
    }
}
