<?php

namespace Cobra\Model\Schema;

use stdClass;
use Cobra\Object\AbstractObject;

/**
 * Schema Spec Factory
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
class SchemaSpecFactory extends AbstractObject
{
    /**
     * Base schema instance
     *
     * @var object
     */
    protected $schema;

    /**
     * Array of all Model schemas
     *
     * @var array
     */
    protected $schemas = [];

    /**
     * Schema spec
     *
     * @var array
     */
    protected $spec;

    /**
     * Array of properties to copy from base schema
     *
     * @var array
     */
    protected $copyProperties = [
        'table',
        'class',
        'engine',
        'charset',
        'hierarchy',
        'polymorphic'
    ];

    /**
     * Array of array keys to copy from base schema
     *
     * @var array
     */
    protected $copyArrayKeys = [
        'columns',
        'hasOne',
        'hasMany',
        'manyMany',
        'belongsManyMany'
    ];

    /**
     * Array of relations to copy
     *
     * @var array
     */
    protected $copyRelations = [
        'hasOne',
        'hasMany',
        'manyMany',
        'belongsManyMany'
    ];

    /**
     * Sets the required propeties.
     *
     * @param object $schema
     * @param array $schemas
     */
    public function __construct(object $schema, array $schemas)
    {
        $this->schema = $schema;
        $this->schemas = $schemas;

        $this->spec = new stdClass;
        $this->spec->properties = [];
        $this->spec->relations = [];
    }

    /**
     * Returns the constructed schema spec.
     *
     * @return object
     */
    public function getSpec(): object
    {
        // set empty relation arrays
        array_map(
            function (string $name) {
                $this->spec->{$name} = [];
            },
            $this->copyRelations
        );
        // copy properties from base schema object
        array_map(
            function (string $name) {
                $this->spec->{$name} = $this->schema->{$name};
            },
            $this->copyProperties
        );
        // copy array keys from base schema object
        array_map(
            function (string $name) {
                $this->spec->{'base'.ucfirst($name)} = array_keys($this->schema->{$name});
            },
            $this->copyArrayKeys
        );
        // bind hierarchy schema
        array_map(
            function (string $namespace) {
                $schema = $this->schemas[$namespace];
                $this
                    ->setProperties($schema)
                    ->setRelations($schema);
            },
            $this->schema->hierarchy
        );

        $this->spec->columns = array_keys($this->spec->properties);

        return $this->spec;
    }

    /**
     * Sets the model schema properties.
     *
     * @param object $schema
     * @return SchemaSpecFactory
     */
    protected function setProperties(object $schema): SchemaSpecFactory
    {
        array_map(
            function (object $column) use ($schema) {
                if (!array_key_exists($column->name, $column)) {
                    $column->ownerTable = $schema->table;
                    $column->ownerClass = $schema->class;

                    $this->spec->properties[$column->name] = $column;
                }
            },
            $schema->columns
        );
        return $this;
    }

    /**
     * Sets the model schema relation properties.
     *
     * @param object $schema
     * @return SchemaSpecFactory
     */
    protected function setRelations(object $schema): SchemaSpecFactory
    {
        array_map(
            function (string $relation) use ($schema) {
                array_map(
                    function (string $relationName, object $relationObject) use ($relation, $schema) {
                        $relationObject->ownerTable = $schema->table;
                        $relationObject->ownerClass = $schema->class;
                        $relationObject->method = $relation;
    
                        $this->spec->relations[$relationName] = $relationObject;

                        $this->spec->{$relation}[] = $relationName;
                    },
                    array_keys($schema->{$relation}),
                    $schema->{$relation}
                );
            },
            $this->copyRelations
        );
        return $this;
    }
}
