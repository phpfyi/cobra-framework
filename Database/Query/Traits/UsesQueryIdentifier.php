<?php

namespace Cobra\Database\Query\Traits;

/**
 * Uses Query Identifier trait
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

trait UsesQueryIdentifier
{
    /**
     * Query object ID
     *
     * @var string
     */
    protected $qid;

    /**
     * Sets the query identifier.
     *
     * @return void
     */
    protected function setQID(): void
    {
        $this->qid = base64_encode(random_bytes(10));
    }
}
