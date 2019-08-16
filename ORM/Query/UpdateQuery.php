<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Column\Column;
use Cobra\ORM\Query\Column\ColumnUpdate;
use Cobra\ORM\Query\Traits\UsesBindData;
use Cobra\ORM\Query\Traits\UsesConditions;
use Cobra\ORM\Query\Traits\UsesLimit;
use Cobra\ORM\Store\QueryStore;

/**
 * Update Query
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

class UpdateQuery extends Query
{
    use UsesBindData, UsesConditions, UsesLimit;

    /**
     * Database table name.
     *
     * @var string
     */
    protected $table;

    /**
     * QueryStore instance
     *
     * @var array
     */
    protected $store;

    /**
     * Sets the required properties.
     *
     * @param string $table
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
            'UPDATE %s SET %s %s%s',
            $this->table,
            $this->store->renderColumns(),
            $this->store->renderConditions(),
            $this->limit > 0 ? sprintf(' LIMIT %s', $this->limit) : ''
        );
    }

    /**
     * Sets an array of query column objects.
     *
     * @param array $columns
     * @return UpdateQuery
     */
    public function columns(array $columns): UpdateQuery
    {
        array_map(function (string $column, $value) {
            $this->column($column, $value);
        }, array_keys($columns), $columns);
        return $this;
    }

    /**
     * Sets a query column object.
     *
     * @param string $column
     * @param mixed $value
     * @return UpdateQuery
     */
    public function column(string $column, $value): UpdateQuery
    {
        $this->store->setColumn(ColumnUpdate::class, [$column, $value]);
        return $this;
    }

    /**
     * Executes the update query.
     *
     * @return integer
     */
    public function execute(): int
    {
        $stmt = stmt(
            $this->getSQL(),
            array_merge(
                array_map(function (Column $column) {
                    return $column->getValue();
                }, $this->store->getColumns()),
                $this->bind
            )
        )->execute();
        
        return $stmt->rowCount();
    }
}
