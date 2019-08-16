<?php

namespace Cobra\ORM\Query\Traits;

use Closure;
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
     * @param Closure $closure
     * @return Query
     */
    public function and(Closure $closure = null): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionAnd::class, $closure);
    }

    /**
     * Sets a query ON clause.
     *
     * @param Closure $closure
     * @return Query
     */
    public function or(Closure $closure = null): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionOr::class, $closure);
    }

    /**
     * Sets a query WHERE clause.
     *
     * @param Closure $closure
     * @return Query
     */
    public function where(Closure $closure = null): Query
    {
        return $this->setConditionOrClosure(Condition\ConditionWhere::class, $closure);
    }

    /**
     * Sets a query clause with optional closure.
     *
     * @param string $namespace
     * @param Closure $closure
     * @return Query
     */
    protected function setConditionOrClosure(string $namespace, Closure $closure = null): Query
    {
        $condition = $this->store->setCondition($namespace);
        if ($closure) {
            $closure($condition);
            return $this;
        }
        return $condition;
    }
}
