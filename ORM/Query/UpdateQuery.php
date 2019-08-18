<?php

namespace Cobra\Database\Query;

use Cobra\Database\Query\Column\Column;
use Cobra\Database\Query\Column\ColumnUpdate;
use Cobra\Database\Query\Traits\UsesConditions;
use Cobra\Database\Query\Traits\UsesMutateColumns;
use Cobra\Database\Query\Traits\UsesLimit;
use Cobra\Database\Query\Traits\UsesTableAndStore;

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
    use UsesBindData, UsesConditions, UsesLimit, UsesTableAndStore;

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
