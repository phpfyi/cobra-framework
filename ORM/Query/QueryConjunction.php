<?php

namespace Cobra\ORM\Query;

use Cobra\ORM\Query\Traits\UsesConditions;
use Cobra\ORM\Query\Traits\UsesTable;

/**
 * Query Conjunction
 *
 * Class representing an SQL query conjunction.
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

class QueryConjunction extends Query
{
    use UsesConditions, UsesTable;

    /**
     * Conjunction type
     *
     * @var string
     */
    protected $conjunction;

    /**
     * Sets the required properties.
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }
    
    /**
     * Returns the SQL string.
     *
     * @return string
     */
    public function getSQL(): string
    {
        return sprintf(
            '%s%s%s%s',
            $this->conjunction ? $this->conjunction.' ' : '',
            $this->isNested() ? '(' : '',
            $this->implode($this->getConditions()),
            $this->isNested() ? ')' : ''
        );
    }

    /**
     * Sets the conjunction type.
     *
     * @param string|null $conjunction
     * @return QueryConjunction
     */
    public function setConjunction(?string $conjunction): QueryConjunction
    {
        $this->conjunction = $conjunction;
        return $this;
    }

    /**
     * Determines whether this is a nested query.
     *
     * @return boolean
     */
    protected function isNested(): bool
    {
        return count($this->getConditions()) > 1;
    }
}
