<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Column\Column;
use Cobra\ORM\Query\Column\ColumnInsert;
use Cobra\ORM\Query\Traits\UsesBindData;
use Cobra\ORM\Store\QueryStore;

/**
 * Insert Query
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

class InsertQuery extends Query
{
    use UsesBindData;

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
            'INSERT INTO %s (created,%s) VALUES (NOW(),%s)',
            $this->table,
            $this->store->renderColumns(),
            stmt_placeholders($this->store->getColumns())
        );
    }

    /**
     * Sets an array of query column objects.
     *
     * @param array $columns
     * @return InsertQuery
     */
    public function columns(array $columns): InsertQuery
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
     * @return InsertQuery
     */
    public function column(string $column, $value): InsertQuery
    {
        $this->store->setColumn(ColumnInsert::class, [$column, $value]);
        return $this;
    }

    /**
     * Executes the insert query.
     *
     * @return integer
     */
    public function execute(): int
    {
        $stmt = stmt(
            $this->getSQL(),
            array_map(function (Column $column) {
                return $column->getValue();
            }, $this->store->getColumns())
        )->execute();

        return $stmt->insertId();
    }
}
