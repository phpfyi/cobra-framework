<?php

namespace Cobra\Model\Relation;

use Iterator;
use Cobra\Database\Factory\QueryFactory;
use Cobra\Database\Query\Condition\Condition;
use Cobra\Database\Relation\HasManyRelation;
use Cobra\Interfaces\Model\ModelDataList\ModelDataListInterface;
use Cobra\Model\Exception\InvalidModelRelationException;
use Cobra\Model\Traits\ModelDataListManyAccess;

/**
 * Model Has Many Relation
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
class ModelHasManyRelation extends HasManyRelation implements Iterator, ModelDataListInterface
{
    use ModelDataListManyAccess;

    /**
     * Returns the has many relation data.
     *
     * @return ModelDataListInterface
     */
    public function get(): ModelDataListInterface
    {
        $class = $this->getRelationClass(true);
        $this->data = $class::get()->where(
            $this->getHasOneColumnName(),
            '=',
            $this->getParentID()
        )->all(false);


        return $this;
    }

    /**
     * Returns the has many record count.
     *
     * @return integer
     */
    public function count(): int
    {
        return container_resolve(QueryFactory::class)
            ->select($this->relationTable)
            ->count('id')
            ->where("{$this->relationTable}.{$this->getHasOneColumnName()}", '=', $this->parentID)
            ->limit(1)
            ->bind([$this->parentID])
            ->fetch()->count;
    }

    /**
     * Checks a record exists.
     *
     * @param  integer $relationID
     * @return boolean
     */
    public function exists(int $relationID): bool
    {
        return container_resolve(QueryFactory::class)
            ->select($this->relationTable)
            ->count('id')
            ->where("{$this->relationTable}.id", '=', $relationID)
            ->and("{$this->relationTable}.{$this->getHasOneColumnName()}", '=', $this->parentID)
            ->limit(1)
            ->bind([$relationID,$this->parentID])
            ->fetch()->count > 0;
    }

    /**
     * Adds a many many list item.
     *
     * @param  integer $relationID
     * @return integer|null
     */
    public function add(int $relationID):? int
    {
        if ($this->exists($relationID)) {
            return null;
        }
        return $this->updateHasOneColumn($relationID, $this->parentID);
    }

    /**
     * Removes a many many list item.
     *
     * @param  integer $relationID
     * @return boolean
     */
    public function remove(int $relationID): bool
    {
        return $this->updateHasOneColumn($relationID, 0);
    }

    /**
     * Returns the has one relation column name.
     *
     * @throws InvalidModelRelationException
     * @return string
     */
    protected function getHasOneColumnName(): string
    {
        foreach (schema($this->getRelationClass())->relations()->getHasOne() as $hasOne) {
            if ($this->relation === $hasOne->hasMany && $this->parentClass == $hasOne->class) {
                return $hasOne->name;
            }
        }
        throw new InvalidModelRelationException(
            sprintf('No matching has one relation found for has many: %s'. $this->relation)
        );
    }

    /**
     * Updates the has one ID column value.
     *
     * @param integer $relationID
     * @param integer $value
     * @return boolean
     */
    protected function updateHasOneColumn(int $relationID, int $value): bool
    {
        return container_resolve(QueryFactory::class)
            ->update($this->relationTable)
            ->column($this->getHasOneColumnName(), $value)
            ->where("{$this->relationTable}.id", '=', $relationID)
            ->bind([$relationID])
            ->execute();
    }
}
