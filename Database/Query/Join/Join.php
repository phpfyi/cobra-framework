<?php

namespace Cobra\Database\Query\Join;

use Cobra\Database\Query\Condition;
use Cobra\Database\Query\Query;
use Cobra\Database\Query\Traits\UsesConditions;
use Cobra\Database\Query\Traits\UsesQueryIdentifier;
use Cobra\Database\Store\QueryStore;

/**
 * Join
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

abstract class Join extends Query
{
    use UsesConditions, UsesQueryIdentifier;

    /**
     * QueryStore instance
     *
     * @var QueryStore
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
     * @param QueryStore $store
     */
    public function __construct(string $table, QueryStore $store)
    {
        $this->table = $table;
        $this->store = $store;
        
        $this->setQID();
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
            $this->store->renderConditions($this->qid)
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
