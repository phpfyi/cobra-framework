<?php

namespace Cobra\Database\Statement;

use Cobra\Database\Factory\DatabaseColumnFactory;
use Cobra\Interfaces\Database\Field\DatabaseFieldInterface;
use Cobra\Object\AbstractObject;

/**
 * Alter Table Add Column Statement
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
class AlterTableAddColumnStatement extends AbstractObject
{
    /**
     * The databse table name.
     *
     * @var string
     */
    protected $table;

    /**
     * DatabaseFieldInterface instance
     *
     * @var DatabaseFieldInterface
     */
    protected $column;

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param string $column
     */
    public function __construct(string $table, DatabaseFieldInterface $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Executes the database query statement and returns the result.
     *
     * @return object
     */
    public function run(): object
    {
        return stmt(sprintf(
            "ALTER TABLE `%s` ADD %s",
            $this->table,
            container_resolve(DatabaseColumnFactory::class, [$this->column])->getSQL()
        ))->execute();
    }
}
