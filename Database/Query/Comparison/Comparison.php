<?php

namespace Cobra\Database\Query\Comparison;

use Cobra\Database\Query\Query;

/**
 * Comparison
 *
 * Class representing an SQL query comparison.
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

abstract class Comparison extends Query
{
    /**
     * Returns all bind data.
     *
     * @return array
     */
    abstract public function getBindValues(): array;
}
