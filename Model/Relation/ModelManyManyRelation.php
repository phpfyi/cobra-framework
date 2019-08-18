<?php

namespace Cobra\Model\Relation;

use Iterator;
use Cobra\Database\Relation\ManyManyRelation;
use Cobra\Interfaces\Model\ModelDataList\ModelDataListInterface;
use Cobra\Model\Traits\ModelDataListManyAccess;
use Cobra\Model\Traits\ModelPolymorphism;
use Cobra\ORM\Factory\QueryFactory;
use Cobra\ORM\Query\Condition\Condition;
use Cobra\ORM\Query\Query;

/**
 * Model Many Many Relation
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
class ModelManyManyRelation extends ManyManyRelation implements Iterator, ModelDataListInterface
{
    use ModelDataListManyAccess, ModelPolymorphism;

    /**
     * Default sort column
     *
     * @var string
     */
    protected $sortColumn = 'sort';

    /**
     * Sets the local and foreign table details
     *
     * @param string $relation
     * @param string $localClass
     * @param string $localTable
     * @param string $foreignClass
     * @param string $foreignTable
     */
    public function __construct(
        string $relation,
        string $localClass,
        string $localTable,
        string $foreignClass,
        string $foreignTable
    ) {
        parent::__construct($relation, $localClass, $localTable, $foreignClass, $foreignTable);

        // Sets default created and sorting columns on the table
        $this->created();
        $this->int('sort');
    }

    /**
     * Sets the sort column.
     *
     * @param  string $column
     * @return ModelManyManyRelation
     */
    public function setSortColumn(string $column): ModelManyManyRelation
    {
        $this->sortColumn = $column;
        return $this;
    }

    /**
     * Returns the sort column.
     *
     * @return string
     */
    public function getSortColumn(): string
    {
        return $this->sortColumn;
    }

    /**
     * Returns the many many record count.
     *
     * @return integer
     */
    public function count(): int
    {
        return container_resolve(QueryFactory::class)
            ->select($this->table)
            ->count('id')
            ->where("{$this->table}.{$this->localColumn}", '=', $this->localID)
            ->limit(1)
            ->bind([$this->localID])
            ->fetch()->count;
    }

    /**
     * Returns the many many relation data.
     *
     * @return ModelDataListInterface
     */
    public function get(): ModelDataListInterface
    {
        $select = container_resolve(QueryFactory::class)
            ->select($this->table, $this->foreignClass)
            ->where("{$this->table}.{$this->localColumn}", '=', $this->localID)
            ->order("{$this->table}.{$this->sortColumn}", 'ASC')
            ->bind([$this->localID]);

        array_map(
            function ($class) use ($select) {
                $table = schema($class)->get('table');
                $select
                    ->joinLeft($table)
                    ->on("{$this->table}.{$this->foreignColumn}", '=', "{$table}.id");
            },
            schema($this->foreignClass)->hierarchy()
        );  
        $this->data = $this->runPolymorphismArray($select->fetch());
        return $this;
    }

    /**
     * Adds a many many list item.
     *
     * @param integer $foreignID
     * @return integer|null
     */
    public function add(int $foreignID):? int
    {
        if ($this->exists($foreignID)) {
            return null;
        }
        return container_resolve(QueryFactory::class)
            ->insert($this->table)
            ->columns([
                $this->localColumn => $this->localID,
                $this->foreignColumn => $foreignID
            ])
            ->execute();
    }

    /**
     * Checks a record exists.
     *
     * @param integer $foreignID
     * @return boolean
     */
    public function exists(int $foreignID): bool
    {
        $stmt = container_resolve(QueryFactory::class)
            ->select($this->table)
            ->count('id')
            ->limit(1)
            ->bind([$this->localID,$foreignID]);

        $this->setWhereConditions($stmt, $foreignID);

        return $stmt->fetch()->count > 0;
    }

    /**
     * Removes a many many list item.
     *
     * @param  integer $foreignID
     * @return integer
     */
    public function remove(int $foreignID): int
    {
        $stmt = container_resolve(QueryFactory::class)
            ->delete($this->table)
            ->limit(1)
            ->bind([$this->localID,$foreignID]);

        $this->setWhereConditions($stmt, $foreignID);

        return $stmt->execute();
    }
    
    /**
     * Updates a many many record sort column.
     *
     * @param  integer $foreignID
     * @param  integer $sort
     * @return integer
     */
    public function sort(int $foreignID, int $sort): int
    {
        $stmt = container_resolve(QueryFactory::class)
            ->update($this->table)
            ->column($this->sortColumn, $sort)
            ->limit(1)
            ->bind([$this->localID,$foreignID]);

        $this->setWhereConditions($stmt, $foreignID);

        return $stmt->execute();
    }

    /**
     * Sets the WHERE column clause based off the local ID and foreign ID.
     *
     * @param  Query   $stmt
     * @param  integer $foreignID
     * @return void
     */
    protected function setWhereConditions(Query $stmt, int $foreignID): void
    {
        $stmt
            ->where("{$this->table}.{$this->localColumn}", '=', $this->localID)
            ->and("{$this->table}.{$this->foreignColumn}", '=', $foreignID);
    }
}
