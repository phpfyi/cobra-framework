<?php

namespace Cobra\Database\Query\Traits;

use Cobra\Database\Query\Query;
use Cobra\Database\Store\QueryStore;

/**
 * Uses Table And Store Trait
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

trait UsesTableAndStore
{
    /**
     * Store Class
     *
     * @var string
     */
    protected $storeClass = QueryStore::class;

    /**
     * QueryStore instance
     *
     * @var array
     */
    protected $store;

    /**
     * Database table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Sets the required properties.
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->store = container_resolve($this->storeClass);
    }
}
