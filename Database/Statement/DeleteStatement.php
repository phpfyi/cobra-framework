<?php

namespace Cobra\Database\Statement;

use Cobra\Database\Statement\Traits\UsesLimitSQL;
use Cobra\Database\Statement\Traits\UsesWhereSQL;
use Cobra\Object\AbstractObject;

/**
 * Delete Statement
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
class DeleteStatement extends AbstractObject
{
    use UsesLimitSQL, UsesWhereSQL;

    /**
     * The database table name
     *
     * @var string
     */
    protected $table;

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
     * @param integer $id
     * @param integer $limit
     */
    public function __construct(string $table, int $id, int $limit = 1)
    {
        $this->table = $table;
        $this->bind = [$id];
        $this->limit = $limit;
    }

    /**
     * Executes the database query statement and returns the row count.
     *
     * @return integer
     */
    public function run(): int
    {
        $stmt = stmt(
            implode(
                [
                    $this->getTableSQL(),
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
     * Returns the table SQL.
     *
     * @return string
     */
    protected function getTableSQL(): string
    {
        return sprintf('DELETE FROM `%s`', $this->table);
    }
}
