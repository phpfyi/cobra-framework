<?php

namespace Cobra\ORM\Query\Traits;

use Cobra\ORM\Query\Condition;
use Cobra\ORM\Query\Query;

/**
 * Uses Columns trait
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

trait UsesConditions
{
    /**
     * Sets a AND clause.
     *
     * @param [mixed] ...$args
     * @return ConditionAnd
     */
    public function and(...$args): Condition\ConditionAnd
    {
        return $this->store->setCondition(Condition\ConditionAnd::class, $args);
    }

    /**
     * Sets a ON clause.
     *
     * @param [mixed] ...$args
     * @return ConditionOr
     */
    public function or(...$args): Condition\ConditionOr
    {
        return $this->store->setCondition(Condition\ConditionOr::class, $args);
    }

    /**
     * Sets a WHERE clause.
     *
     * @param [mixed] ...$args
     * @return ConditionWhere
     */
    public function where(...$args): Condition\ConditionWhere
    {
        return $this->store->setCondition(Condition\ConditionWhere::class, $args);
    }
}
