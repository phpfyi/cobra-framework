<?php

namespace Cobra\Database\Factory;

use Cobra\Database\Statement\AlterTableAddColumnStatement;
use Cobra\Database\Statement\AlterTableChangeColumnStatement;
use Cobra\Database\Statement\CreateTableStatement;
use Cobra\Interfaces\Database\DatabaseTableInterface;
use Cobra\Interfaces\Database\Field\DatabaseFieldInterface;
use Cobra\Object\AbstractObject;
use Cobra\ORM\Factory\QueryFactory;

/**
 * Database Table Factory
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
class DatabaseTableFactory extends AbstractObject
{
    /**
     * DatabaseTableInterface instance
     *
     * @var DatabaseTableInterface
     */
    protected $table;

    /**
     * Whether the database table exists already
     *
     * @var boolean
     */
    protected $exists = false;

    /**
     * Array of existing database columns
     *
     * @var array
     */
    protected $existingColumns = [];

    /**
     * Sets the requires properties.
     *
     * @param DatabaseTableInterface $table
     * @param boolean $exists
     */
    public function __construct(DatabaseTableInterface $table, bool $exists)
    {
        $this->table = $table;
        $this->exists = $exists;
    }

    /**
     * Runs the process to create or update the table
     *
     * @return void
     */
    public function migrate(): void
    {
        $this->exists ? $this->update() : $this->create();
    }

    /**
     * Creates the database table.
     *
     * @return void
     */
    protected function create(): void
    {
        container_resolve(CreateTableStatement::class, [$this->table])->run();
    }
    
    /**
     * Updates the database table.
     *
     * @return void
     */
    protected function update(): void
    {
        $this->existingColumns = container_resolve(QueryFactory::class)
            ->columns($this->table->getTable())->fetch();

        $this->alterTable(AlterTableAddColumnStatement::class, $this->getInsertColumns());
        $this->alterTable(AlterTableChangeColumnStatement::class, $this->getUpdateColumns());
    }

    /**
     * Alters the database table columns.
     *
     * @param string $statement
     * @param array $columns
     * @return void
     */
    protected function alterTable(string $statement, array $columns): void
    {
        array_map(function (DatabaseFieldInterface $column) use ($statement) {
            container_resolve(
                $statement,
                [$this->table->getTable(), $column]
            )->run();
        }, $columns);
    }

    /**
     * Returns the database columns to insert.
     *
     * @return array
     */
    protected function getInsertColumns(): array
    {
        $columns = array_diff(
            array_keys($this->table->getColumns()),
            $this->existingColumns
        );
        return $this->getCandidateColumns($columns);
    }

    /**
     * Returns the database columns to update.
     *
     * @return array
     */
    protected function getUpdateColumns(): array
    {
        $columns = array_intersect(
            array_keys($this->table->getColumns()),
            $this->existingColumns
        );
        return $this->getCandidateColumns($columns);
    }

    /**
     * Returns the difference between current database columns and another set.
     *
     * @param array $columns
     * @return array
     */
    protected function getCandidateColumns(array $columns): array
    {
        return array_intersect_key(
            $this->table->getColumns(),
            array_flip($columns)
        );
    }
}
