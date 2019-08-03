<?php

namespace Cobra\Database\Statement;

use Cobra\Database\Factory\DatabaseColumnFactory;
use Cobra\Database\Field\DatabaseField;
use Cobra\Interfaces\Database\DatabaseTableInterface;
use Cobra\Object\AbstractObject;

/**
 * Create Table Statement
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
class CreateTableStatement extends AbstractObject
{
    /**
     * Database table name.
     *
     * @var string
     */
    protected $name;

    /**
     * Database table engine.
     *
     * @var string
     */
    protected $engine;

    /**
     * Database table charset.
     *
     * @var string
     */
    protected $charset;

    /**
     * Database table columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Sets the required properties.
     *
     * @param DatabaseTableInterface $table
     */
    public function __construct(DatabaseTableInterface $table)
    {
        $this->name = $table->getTable();
        $this->engine = $table->getEngine();
        $this->charset = $table->getCharset();
        $this->columns = $table->getColumns() + $table->getHasOneRelations();
    }

    /**
     * Executes the database query statement and returns the result.
     *
     * @return bool
     */
    public function run(): bool
    {
        return stmt(implode(
            [
                $this->getTableSQL(),
                $this->getColumnsSQL(),
                $this->getEnginesSQL(),
                $this->getCharsetSQL()
            ]
        ))->execute();
    }

    /**
     * Returns the table SQL
     *
     * @return string
     */
    protected function getTableSQL(): string
    {
        return sprintf('CREATE TABLE IF NOT EXISTS `%s` (', $this->name).PHP_EOL;
    }

    /**
     * Returns the columns SQL
     *
     * @return string
     */
    protected function getColumnsSQL(): string
    {
        return implode(
            ',',
            array_map(
                function (DatabaseField $column) {
                    return container_resolve(DatabaseColumnFactory::class, [$column])->getSQL();
                },
                $this->columns
            )
        );
    }

    /**
     * Returns the table engine SQL
     *
     * @return string
     */
    protected function getEnginesSQL(): string
    {
        return sprintf(') ENGINE=%s', $this->engine);
    }

    /**
     * Returns the table charset SQL
     *
     * @return string
     */
    protected function getCharsetSQL(): string
    {
        return sprintf(' DEFAULT CHARSET=%s;', $this->charset).PHP_EOL;
    }
}
