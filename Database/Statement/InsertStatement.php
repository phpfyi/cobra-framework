<?php

namespace Cobra\Database\Statement;

use Cobra\Object\AbstractObject;

/**
 * Insert Statement
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
class InsertStatement extends AbstractObject
{
    /**
     * The database table name
     *
     * @var string
     */
    protected $table;

    /**
     * The table columns to insert
     *
     * @var string
     */
    protected $columns = [];

    /**
     * The table columns data to bind
     *
     * @var string
     */
    protected $bind = [];

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param array $data
     */
    public function __construct(string $table, array $data)
    {
        $this->table = $table;
        $this->columns = array_keys($data);
        $this->bind = array_values($data);
    }

    /**
     * Executes the database query statement and returns the insert ID.
     *
     * @return integer
     */
    public function run(): int
    {
        $stmt = stmt(
            implode(
                [
                    $this->getTableSQL(),
                    $this->getColumnsSQL(),
                    $this->getValuesSQL()
                ]
            ),
            $this->bind
        );
        $stmt->execute();

        return $stmt->insertId();
    }

    /**
     * Returns the table SQL.
     *
     * @return string
     */
    protected function getTableSQL(): string
    {
        return sprintf('INSERT INTO `%s`(created,', $this->table);
    }

    /**
     * Returns the columns SQL.
     *
     * @return string
     */
    protected function getColumnsSQL(): string
    {
        return implode(',', $this->columns);
    }

    /**
     * Returns the values SQL.
     *
     * @return string
     */
    protected function getValuesSQL(): string
    {
        return ') VALUES (NOW(),'.implode(
            ',',
            array_map(
                function ($column) {
                    return '?';
                },
                $this->columns
            )
        ).')';
    }
}
