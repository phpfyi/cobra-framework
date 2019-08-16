<?php

namespace Cobra\ORM\Query\Traits;

use Cobra\ORM\Query\Query;

/**
 * Uses Bind Data trait
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

trait UsesBindData
{
    /**
     * Query bind data
     *
     * @var array
     */
    protected $bind = [];

    /**
     * Sets the query bind data.
     *
     * @param array $data
     * @return Query
     */
    public function bind(array $data): Query
    {
        $this->bind = $data;
        return $this;
    }
}
