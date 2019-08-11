<?php

namespace Cobra\ORM\Query\Traits;

/**
 * Uses Table trait
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

trait UsesTable
{
    /**
     * Database table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Returns the database table name.
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
}
