<?php

namespace Cobra\ORM\Query\Conjunction;

use Cobra\ORM\Query\QueryConjunction;

/**
 * Query or
 *
 * Class representing an SQL query OR conjunction.
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

class QueryOr extends QueryConjunction
{
    /**
     * Conjunction type
     *
     * @var string
     */
    protected $conjunction = 'OR';
}
