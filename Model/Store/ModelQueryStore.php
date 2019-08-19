<?php

namespace Cobra\Model\Store;

use Cobra\Database\Query\Column\Column;
use Cobra\Database\Query\Comparison\Comparison;
use Cobra\Database\Query\Comparison\ComparisonColumns;
use Cobra\Database\Store\QueryStore;
use Cobra\Model\Schema\Schema;

/**
 * Model Query Store
 *
 * @category  Model
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

class ModelQueryStore extends QueryStore
{
    /**
     * Sets the required properties.
     *
     * @param Schema $schema
     */
    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * Sets a query column.
     *
     * @param string $namespace
     * @param array $args
     * @return Column
     */
    public function setColumn(string $namespace, array $args = []): Column
    {
        $args[0] = $this->resolveTableColumn($args[0]);

        return parent::setColumn($namespace, $args);
    }

    /**
     * Sets a query comparison.
     *
     * @param string $namespace
     * @param string $qid
     * @param array $args
     * @return Comparison
     */
    public function setComparison(string $namespace, string $qid, array $args = []): Comparison
    {
        if ($namespace !== ComparisonColumns::class) {
            $args[0] = $this->resolveTableColumn($args[0]);
        }
        return parent::setComparison($namespace, $qid, $args);
    }

    /**
     * Finds the table for a column
     *
     * @param string $column
     * @return string
     */
    protected function resolveTableColumn(string $column): string
    {
        return sprintf(
            '%s.%s',
            $this->schema->columns()->get($column)->ownerTable,
            $column
        );
    }
}
