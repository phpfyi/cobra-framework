<?php

namespace Cobra\Database\Query;

use Cobra\Database\Query\Traits\UsesConditions;
use Cobra\Database\Query\Traits\UsesLimit;
use Cobra\Database\Query\Traits\UsesTableAndStore;

/**
 * Delete Query
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

class DeleteQuery extends Query
{
    use UsesConditions, UsesLimit, UsesTableAndStore;

    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            'DELETE FROM `%s` %s%s',
            $this->table,
            $this->store->renderConditions($this->qid),
            $this->limit > 0 ? sprintf(' LIMIT %s', $this->limit) : ''
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
            $this->store->getBind()
        );
        if ($this->limit) {
            $stmt->setLimit($this->limit);
        }
        return $stmt->execute()->rowCount();
    }
}
