<?php

namespace Cobra\ORM\Query;

use Closure;
use Cobra\ORM\Factory\SelectQueryFactory;
use Cobra\ORM\Query\Traits\UsesColumns;
use Cobra\ORM\Query\Traits\UsesConditions;
use Cobra\ORM\Query\Traits\UsesTable;

/**
 * Select Query
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

class QuerySelect extends Query
{
    use UsesColumns, UsesConditions, UsesTable;

    /**
     * SelectQueryFactory instance
     *
     * @var SelectQueryFactory
     */
    protected $queryFactory;

    /**
     * Array of query join instances
     *
     * @var array
     */
    protected $joins = [];

    /**
     * Sets the required properties.
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->queryFactory = container_resolve(SelectQueryFactory::class, [$this]);
    }

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return $this->queryFactory->getSQL();
    }

    /**
     * Returns an array of all SQL join objects.
     *
     * @return array
     */
    public function getJoins(): array
    {
        return $this->joins;
    }

    /**
     * Sets a LEFT JOIN query object.
     *
     * @param string $table
     * @param Closure $closure
     * @return QuerySelect
     */
    public function leftJoin(string $table, Closure $closure): QuerySelect
    {
        return $this->setJoinObject(Join\QueryLeftJoin::class, $table, $closure);
    }

    /**
     * Sets a RIGHT JOIN query object.
     *
     * @param string $table
     * @param Closure $closure
     * @return QuerySelect
     */
    public function rightJoin(string $table, Closure $closure): QuerySelect
    {
        return $this->setJoinObject(Join\QueryRightJoin::class, $table, $closure);
    }

    /**
     * Sets a FULL JOIN query object.
     *
     * @param string $table
     * @param Closure $closure
     * @return QuerySelect
     */
    public function fullJoin(string $table, Closure $closure): QuerySelect
    {
        return $this->setJoinObject(Join\QueryFullJoin::class, $table, $closure);
    }

    /**
     * Sets a INNER JOIN query object.
     *
     * @param string $table
     * @param Closure $closure
     * @return QuerySelect
     */
    public function innerJoin(string $table, Closure $closure): QuerySelect
    {
        return $this->setJoinObject(Join\QueryInnerJoin::class, $table, $closure);
    }

    /**
     * Sets a table JOIN query object.
     *
     * @param string $namespace
     * @param string $table
     * @param Closure $closure
     * @return QuerySelect
     */
    protected function setJoinObject(string $namespace, string $table, Closure $closure): QuerySelect
    {
        $closure($this->joins[$table] = container_resolve($namespace, [$table, $this->getTable()]));
        return $this;
    }
}
