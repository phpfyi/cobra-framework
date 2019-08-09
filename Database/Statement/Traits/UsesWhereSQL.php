<?php

namespace Cobra\Database\Statement\Traits;

/**
 * Uses Where SQL
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
trait UsesWhereSQL
{
    /**
     * Returns the where SQL.
     *
     * @return string
     */
    protected function getWhereSQL(): string
    {
        return ' WHERE id = ?';
    }
}
