<?php

namespace Cobra\ORM\Query\Join;

use Cobra\ORM\Query\Condition;
use Cobra\ORM\Query\Query;
use Cobra\ORM\Query\Traits\UsesConditions;
use Cobra\ORM\Store\QueryStore;

/**
 * Join
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

abstract class Join extends Query
{
    use UsesConditions;

    /**
     * QueryStore instance
     *
     * @var array
     */
    protected $store;

    /**
     * Database table name
     *
     * @var string
     */
    protected $table;

    /**
     * Join type
     *
     * @var string
     */
    protected $join;

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $joinedTable
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->store = container_resolve(QueryStore::class);
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s `%s` %s ',
            $this->join,
            $this->table,
            $this->store->renderConditions()
        );
    }

    /**
     * Sets an ON clause.
     *
     * @param [mixed] ...$args
     * @return Query
     */
    public function on(...$args): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionOn::class, $args);
    }
}
