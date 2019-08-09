<?php

namespace Cobra\Database\Statement;

use Cobra\Database\Statement\Traits\UsesLimitSQL;
use Cobra\Database\Statement\Traits\UsesWhereSQL;
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
    use UsesLimitSQL, UsesWhereSQL;

    /**
     * The database table name
     *
     * @var string
     */
    protected $table;

    /**
     * The table columns to update
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
     * The limit clause number.
     *
     * @var string
     */
    protected $limit = 1;

    /**
     * Sets the required properties.
     *
     * @param string $table
     * @param array $data
     * @param integer $id
     * @param integer $limit
     */
    public function __construct(string $table, array $data, int $id, int $limit = 1)
    {
        $this->table = $table;
        $this->columns = array_keys($data);
        $this->bind = array_values($data);
        $this->bind[] = $id;
        $this->limit = $limit;
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
                    $this->getWhereSQL(),
                    $this->getLimitSQL()
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
}
