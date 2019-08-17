<?php

namespace Cobra\Model;

use Cobra\Database\DatabaseTable;
use Cobra\Interfaces\Database\Relation\HasManyRelationInterface;
use Cobra\Interfaces\Database\Relation\HasOneRelationInterface;
use Cobra\Interfaces\Database\Relation\ManyManyRelationInterface;
use Cobra\Model\Relation\ModelHasManyRelation;
use Cobra\Model\Relation\ModelHasOneRelation;
use Cobra\Model\Relation\ModelManyManyRelation;

/**
 * Model Database Table
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
class ModelDatabaseTable extends DatabaseTable
{
    /**
     * Set the table name
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->table = $model->getTable();
        $this->class = get_class($model);
    }

    /**
     * Set a has one relation
     *
     * @param  string $relation
     * @param  string $relationClass
     * @param  string $hasManyRelation
     * @return ModelHasOneRelationInterface
     */
    public function hasOne(string $relation, string $relationClass, string $hasManyRelation = null): HasOneRelationInterface
    {
        return $this->hasOne[$relation] = ModelHasOneRelation::resolve(
            $relation,
            $relationClass,
            $hasManyRelation
        );
    }

    /**
     * Set a has many relation
     *
     * @param  string $relation
     * @param  string $relationClass
     * @return HasManyRelationInterface
     */
    public function hasMany(string $relation, string $relationClass): HasManyRelationInterface
    {
        return $this->hasMany[$relation] = ModelHasManyRelation::resolve(
            $relation,
            $relationClass,
            get_table_for_class($relationClass),
            $this->class,
            $this->table
        );
    }
    
    /**
     * Set a many many relation
     *
     * @param  string $relation
     * @param  string $foreignClass
     * @return ManyManyRelationInterface
     */
    public function manyMany(string $relation, string $foreignClass): ManyManyRelationInterface
    {
        return $this->manyMany[$relation] = ModelManyManyRelation::resolve(
            $relation,
            $this->class,
            $this->table,
            $foreignClass,
            get_table_for_class($foreignClass)
        );
    }
}
