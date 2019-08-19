<?php

namespace Cobra\Database\Query;

use Cobra\Database\Query\Column\Column;
use Cobra\Database\Query\Column\ColumnInsert;
use Cobra\Database\Query\Traits\UsesMutateColumns;
use Cobra\Database\Query\Traits\UsesTableAndStore;

/**
 * Insert Query
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

class InsertQuery extends Query
{
    use UsesMutateColumns, UsesTableAndStore;

    /**
     * Mutate column class.
     *
     * @var string
     */
    protected $columnClass = ColumnInsert::class;

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
