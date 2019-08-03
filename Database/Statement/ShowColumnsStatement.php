<?php

namespace Cobra\Database\Statement;

use Cobra\Object\AbstractObject;

/**
 * Show Columns Statement
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
class ShowColumnsStatement extends AbstractObject
{
    /**
     * The databse table name.
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
     * Executes the database query statement and returns the result.
     *
     * @param boolean $format
     * @return array
     */
    public function run(bool $format = true): array
    {
        $columns = (array) stmt(sprintf('SHOW COLUMNS FROM `%s`', $this->table))->fetch();

        if ($format) {
            array_walk(
                $columns,
                function (&$record) {
                    $record = (array) $record;
                    $record = $record[key($record)];
                }
            );
        }
        return $columns;
    }
}
