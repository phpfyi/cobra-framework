<?php

namespace Cobra\Database\Query;

use Cobra\Database\Query\Column\Column;

/**
 * Columns Query
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

class ColumnsQuery extends Query
{
    /**
     * Database table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Sets the required properties.
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf('SHOW COLUMNS FROM `%s`', $this->table);
    }


    /**
     * Fetches the data.
     *
     * @return array
     */
    public function fetch(): array
    {
        $tables = stmt($this->getSQL())->fetch();

        array_walk(
            $tables,
            function (&$record) {
                $record = (array) $record;
                $record = $record[key($record)];
            }
        );
        return $tables;
    }
}
