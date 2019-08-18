<?php

namespace Cobra\ORM\Factory;

use Cobra\Object\AbstractObject;
use Cobra\ORM\Query\ColumnsQuery;
use Cobra\ORM\Query\DeleteQuery;
use Cobra\ORM\Query\InsertQuery;
use Cobra\ORM\Query\SelectQuery;
use Cobra\ORM\Query\TablesQuery;
use Cobra\ORM\Query\UpdateQuery;

/**
 * Query Factory
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

class QueryFactory extends AbstractObject
{
    /**
     * Returns a select statement object
     *
     * @param [string] ...$args
     * @return SelectQuery
     */
    public function select(...$args): SelectQuery
    {
        return container_resolve(SelectQuery::class, $args);
    }

    /**
     * Returns a insert statement object
     *
     * @param [string] ...$args
     * @return InsertQuery
     */
    public function insert(...$args): InsertQuery
    {
        return container_resolve(InsertQuery::class, $args);
    }

    /**
     * Returns a update statement object
     *
     * @param [string] ...$args
     * @return UpdateQuery
     */
    public function update(...$args): UpdateQuery
    {
        return container_resolve(UpdateQuery::class, $args);
    }

    /**
     * Returns a delete statement object
     *
     * @param [string] ...$args
     * @return DeleteQuery
     */
    public function delete(...$args): DeleteQuery
    {
        return container_resolve(DeleteQuery::class, $args);
    }

    /**
     * Returns a tables statement object
     *
     * @param [string] ...$args
     * @return TablesQuery
     */
    public function tables(...$args): TablesQuery
    {
        return container_resolve(TablesQuery::class, $args);
    }

    /**
     * Returns a table columns statement object
     *
     * @param [string] ...$args
     * @return ColumnsQuery
     */
    public function columns(...$args): ColumnsQuery
    {
        return container_resolve(ColumnsQuery::class, $args);
    }
}
