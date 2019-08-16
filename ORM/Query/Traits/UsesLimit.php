<?php

namespace Cobra\ORM\Query\Traits;

use Cobra\ORM\Query\Query;

/**
 * Uses Limit Trait
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

trait UsesLimit
{
    /**
     * The query LIMIT
     *
     * @var array
     */
    protected $limit = 0;

    /**
     * Sets the query LIMIT.
     *
     * @param int $limit
     * @return Query
     */
    public function limit(int $limit = 0): Query
    {
        $this->limit = $limit;
        return $this;
    }
}
