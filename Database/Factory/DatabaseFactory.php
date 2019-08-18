<?php

namespace Cobra\Database\Factory;

use Cobra\Database\DatabaseTable;
use Cobra\Object\AbstractObject;
use Cobra\ORM\Factory\QueryFactory;

/**
 * Database Factory
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
class DatabaseFactory extends AbstractObject
{
    /**
     * Array of database tables to create / update
     *
     * @var array
     */
    protected $table = [];

    /**
     * Array of existing database tables
     *
     * @var array
     */
    protected $existingTables = [];

    /**
     * Sets the required properties.
     *
     * @param array $tables
     * @param QueryFactory $factory
     */
    public function __construct(array $tables, QueryFactory $factory)
    {
        $this->tables = $tables;
        $this->existingTables = $factory->tables()->fetch();
    }

    /**
     * Creates the database.
     *
     * @return void
     */
    public function createDatabase(): void
    {
        $this->createTables($this->tables);
    }

    /**
     * Creates a group of database tables.
     *
     * @param array $tables
     * @return void
     */
    protected function createTables(array $tables): void
    {
        array_map(function (DatabaseTable $table) {
            $this->createTable($table);
            $this->createTables($table->getManyManyRelations());
        }, $tables);
    }

    /**
     * Creates a database table.
     *
     * @param DatabaseTable $table
     * @return void
     */
    protected function createTable(DatabaseTable $table): void
    {
        $factory = container_resolve(
            DatabaseTableFactory::class,
            [
                $table,
                in_array($table->getTable(), $this->existingTables)
            ]
        );
        $factory->migrate();
    }
}
