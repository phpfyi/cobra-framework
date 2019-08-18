<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Traits\UsesBindData;
use Cobra\ORM\Query\Traits\UsesConditions;
use Cobra\ORM\Query\Traits\UsesLimit;
use Cobra\ORM\Query\Traits\UsesTableAndStore;

/**
 * Delete Query
 *
 * @category  ORM
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
    use UsesBindData, UsesConditions, UsesLimit, UsesTableAndStore;

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
            $this->store->renderConditions(),
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
            $this->bind
        )->execute();

        return $stmt->rowCount();
    }
}
