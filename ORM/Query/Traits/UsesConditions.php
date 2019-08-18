<?php

namespace Cobra\ORM\Query\Traits;

use Closure;
use Cobra\ORM\Query\Comparison;
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
     * Sets a query AND clause.
     *
     * @param [mixed] ...$args
     * @return Query
     */
    public function and(...$args): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionAnd::class, $args);
    }

    /**
     * Sets a query ON clause.
     *
     * @param [mixed] ...$args
     * @return Query
     */
    public function or(...$args): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionOr::class, $args);
    }

    /**
     * Sets a query WHERE clause.
     *
     * @param [mixed] ...$args
     * @return Query
     */
    public function where(...$args): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionWhere::class, $args);
    }

    /**
     * Sets a query clause with optional closure.
     *
     * @param string $namespace
     * @param [mixed] ...$args
     * @return Query
     */
    protected function setConditionOrClosure(string $namespace, $args): Query
    {
        $condition = $this->store->setCondition($namespace);
        // return the condition object
        if (empty($args)) {
            return $condition;
        }
        // run closure and return this
        if ($args[0] instanceof Closure) {
            $args[0]($condition);
            return $this;
        }
        // fallback to where query or on query for join
        $condition->setComparison(
            $condition instanceof Condition\ConditionOn
            ? Comparison\ComparisonColumns::class
            : Comparison\ComparisonColumn::class,
            $args
        );
        return $this;
    }
}
