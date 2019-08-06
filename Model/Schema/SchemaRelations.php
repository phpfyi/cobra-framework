<?php

namespace Cobra\Model\Schema;

use Cobra\Object\AbstractObject;

/**
 * Schema Relations
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
class SchemaRelations extends AbstractObject
{
    /**
     * Array of schema relations
     *
     * @var array
     */
    protected $relations = [];

    /**
     * Array of schema has one relations
     *
     * @var array
     */
    protected $hasOne = [];

    /**
     * Array of schema has many relations
     *
     * @var array
     */
    protected $hasMany = [];

    /**
     * Array of schema many many relations
     *
     * @var array
     */
    protected $manyMany = [];

    /**
     * Array of schema belongs many many relations
     *
     * @var array
     */
    protected $belongsManyMany = [];

    /**
     * Sets the required properties.
     *
     * @param object $schema
     */
    public function __construct(object $schema)
    {
        $this->schema = $schema;
        $this->hierarchy = $schema->hierarchy;

        $this->hasOne = (array) $schema->hasOne;
        $this->hasMany = (array) $schema->hasMany;
        $this->manyMany = (array) $schema->manyMany;
        $this->belongsManyMany = (array) $schema->belongsManyMany;

        $this->relations = array_merge(
            $this->hasOne,
            $this->hasMany,
            $this->manyMany,
            $this->belongsManyMany
        );
    }

    /**
     * Returns a schema relation.
     *
     * @param string $name
     * @return object
     */
    public function get(string $name): object
    {
        return $this->relations[$name];
    }

    /**
     * Returns all schema relations.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->relations;
    }

    /**
     * Returns all schema has one relations.
     *
     * @return array
     */
    public function hasOne(): array
    {
        return $this->hasOne;
    }

    /**
     * Returns all schema has many relations.
     *
     * @return array
     */
    public function hasMany(): array
    {
        return $this->hasMany;
    }

    /**
     * Returns all schema many many relations.
     *
     * @return array
     */
    public function manyMany(): array
    {
        return $this->manyMany;
    }

    /**
     * Returns all schema belongs many many relations.
     *
     * @return array
     */
    public function belongsManyMany(): array
    {
        return $this->belongsManyMany;
    }

    /**
     * Returns whether a relation exists.
     *
     * @param string $name
     * @return boolean
     */
    public function hasRelation(string $name): bool
    {
        return array_key_exists($name, $this->relations);
    }

    /**
     * Returns whether a has one relation exists.
     *
     * @param string $name
     * @return boolean
     */
    public function hasHasOne(string $name): bool
    {
        return array_key_exists($name, $this->hasOne);
    }

    /**
     * Returns whether a has many relation exists.
     *
     * @param string $name
     * @return boolean
     */
    public function hasHasMany(string $name): bool
    {
        return array_key_exists($name, $this->hasMany);
    }

    /**
     * Returns whether a many many relation exists.
     *
     * @param string $name
     * @return boolean
     */
    public function hasManyMany(string $name): bool
    {
        return array_key_exists($name, $this->manyMany);
    }

    /**
     * Returns whether a belongs many many relation exists.
     *
     * @param string $name
     * @return boolean
     */
    public function hasBelongsManyMany(string $name): bool
    {
        return array_key_exists($name, $this->belongsManyMany);
    }
}
