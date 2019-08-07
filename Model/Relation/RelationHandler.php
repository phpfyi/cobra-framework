<?php

namespace Cobra\Model\Relation;

use Cobra\Model\Model;
use Cobra\Model\Relation\ModelHasManyRelation;
use Cobra\Model\Relation\ModelHasOneRelation;
use Cobra\Model\Relation\ModelManyManyRelation;
use Cobra\Object\AbstractObject;

/**
 * Relation Handler
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
class RelationHandler extends AbstractObject
{
    /**
     * Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * SchemaRelations instance
     *
     * @var SchemaRelations
     */
    protected $relations;

    /**
     * Relation schema
     *
     * @var object
     */
    protected $schema;

    /**
     * Sets the required properties.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->relations = schema($this->model)->relations();
    }

    /**
     * Handles the relation call.
     *
     * @param string $method
     * @return object
     */
    public function handle(string $method): object
    {
        $this->schema = $this->relations->get($method);

        switch (true) {
            case $this->relations->hasHasOne($method):
                return $this->getHasOne($method);
            break;
            case $this->relations->hasHasMany($method):
                return $this->getHasMany($method);
            break;
            case $this->relations->hasManyMany($method):
                return $this->getManyMany($method);
            break;
        }
    }


    /**
     * Returns a model has one relation
     *
     * @param  string $name
     * @return ModelHasOneRelation
     */
    public function getHasOne(string $name): ModelHasOneRelation
    {
        return container_resolve(
            ModelHasOneRelation::class,
            [
                $name,
                $this->schema->relationClass,
                $this->schema->hasManyRelation,

            ]
        )->setRelationID($this->model->{$name.'ID'});
    }

    /**
     * Returns a model has many relation
     *
     * @param  string $name
     * @return ModelHasManyRelation
     */
    public function getHasMany(string $name): ModelHasManyRelation
    {
        return container_resolve(
            ModelHasManyRelation::class,
            [
                $name,
                $this->schema->relationClass,
                $this->schema->relationTable,
                $this->schema->parentClass,
                $this->schema->parentTable

            ]
        )->setParentID($this->model->id);
    }

    /**
     * Returns a model many many relation
     *
     * @param  string $name
     * @return ModelManyManyRelation
     */
    public function getManyMany(string $name): ModelManyManyRelation
    {
        return container_resolve(
            ModelManyManyRelation::class,
            [
                $name,
                $this->schema->localClass,
                $this->schema->localTable,
                $this->schema->foreignClass,
                $this->schema->foreignTable,

            ]
        )->setLocalID($this->model->id);
    }
}
