<?php

namespace Cobra\Database\Statement;

use Cobra\Object\AbstractObject;

/**
 * Show Tables Statement
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
class ShowTablesStatement extends AbstractObject
{
    /**
     * Executes the database query statement and returns the result.
     *
     * @param boolean $format
     * @return array
     */
    public function run(bool $format = true): array
    {
        $tables = (array) stmt('SHOW TABLES')->fetch();

        if ($format) {
            array_walk(
                $tables,
                function (&$record) {
                    $record = (array) $record;
                    $record = $record[key($record)];
                }
            );
        }
        return $tables;
    }
}
