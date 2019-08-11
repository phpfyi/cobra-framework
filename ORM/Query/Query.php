<?php

namespace Cobra\ORM\Query;

use Cobra\Object\AbstractObject;

/**
 * Query
 *
 * Abstract class representing a part of an SQL query.
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

abstract class Query extends AbstractObject
{
    /**
     * Returns the SQL string.
     *
     * @return string
     */
    abstract public function getSQL(): string;

    /**
     * Implodes an array of SQL query parts with seperator.
     *
     * @param array $data
     * @param string $seperator
     * @return string
     */
    protected function getImplodedSQL(array $data, string $seperator = ' '): string
    {
        return implode(
            $seperator,
            array_map(
                function (Query $query) {
                    return $query->getSQL();
                },
                $data
            )
        );
    }
}
