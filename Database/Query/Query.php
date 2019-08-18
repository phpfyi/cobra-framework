<?php

namespace Cobra\Database\Query;

use Cobra\Object\AbstractObject;

/**
 * Query
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

abstract class Query extends AbstractObject
{
    /**
     * Returns the SQL string.
     *
     * @return string
     */
    abstract public function getSQL(): string;
}
