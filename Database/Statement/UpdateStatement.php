<?php

namespace Cobra\Database\Statement;

use Cobra\Object\AbstractObject;

/**
 * Update Statement
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
class UpdateStatement extends AbstractObject
{
    /**
     * The database table name
     *
     * @var string
     */
    protected $table;

    /**
     * The database columns to update
     *
     * @var string
     */
    protected $columns = [];

    /**
     * The database data to bind
     *
     * @var string
     */
    protected $bind = [];

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param array $data
     * @param integer $id
     */
    public function __construct(string $table, array $data, int $id)
    {
        $this->table = $table;
        $this->columns = array_keys($data);
        $this->bind = array_values($data);
        $this->bind[] = $id;
    }

    /**
     * Executes the database query statement and returns the row count.
     *
     * @return int
     */
    public function run(): int
    {
        $stmt = stmt(
            implode(
                [
                    $this->getTableSQL(),
                    $this->getColumnsSQL(),
                    $this->getWhereSQL()
                ]
            ),
            $this->bind
        );
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Returns the table SQL
     *
     * @return string
     */
    protected function getTableSQL(): string
    {
        return sprintf('UPDATE `%s` SET ', $this->table);
    }

    /**
     * Returns the columns SQL.
     *
     * @return string
     */
    protected function getColumnsSQL(): string
    {
        return implode(
            ',',
            array_map(
                function (string $column) {
                    return sprintf('%s = ?', $column);
                },
                $this->columns
            )
        );
    }

    /**
     * Returns the where SQL
     *
     * @return string
     */
    protected function getWhereSQL(): string
    {
        return ' WHERE id = ?';
    }
}
