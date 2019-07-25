<?php

namespace Cobra\Interfaces\Database;

use Cobra\Database\Field\DatabaseDateField;
use Cobra\Database\Field\DatabaseDecimalField;
use Cobra\Database\Field\DatabaseIntField;
use Cobra\Database\Field\DatabaseTextField;
use Cobra\Database\Field\DatabaseTimestampField;
use Cobra\Database\Field\DatabaseTinyintField;
use Cobra\Database\Field\DatabaseVarcharField;
use Cobra\Interfaces\Database\Relation\HasManyRelationInterface;
use Cobra\Interfaces\Database\Relation\HasOneRelationInterface;
use Cobra\Interfaces\Database\Relation\ManyManyRelationInterface;
use Cobra\Object\AbstractObject;

/**
 * Database Table Interface
 *
 * @category  Database
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface DatabaseTableInterface
{
    /**
     * Returns the table name
     *
     * @return string
     */
    public function getTable(): string;

    /**
     * Returns the table class name
     *
     * @return string|null
     */
    public function getClass():? string;

    /**
     * Sets the table engine
     *
     * @param  string $engine
     * @return DatabaseTableInterface
     */
    public function setEngine(string $engine): DatabaseTableInterface;

    /**
     * Returns the table engine
     *
     * @return string
     */
    public function getEngine(): string;

    /**
     * Sets the table charset
     *
     * @param  string $charset
     * @return DatabaseTableInterface
     */
    public function setCharset(string $charset): DatabaseTableInterface;

    /**
     * Returns the table charset
     *
     * @return string
     */
    public function getCharset(): string;

    /**
     * Set a primary key field
     *
     * @param  string $name
     * @return DatabaseIntField
     */
    public function primary(string $name = 'id'): DatabaseIntField;

    /**
     * Set a created timestamp field
     *
     * @param  string $name
     * @return DatabaseTimestampField
     */
    public function created(string $name = 'created'): DatabaseTimestampField;

    /**
     * Set an updated timestamp field
     *
     * @param  string $name
     * @return DatabaseTimestampField
     */
    public function updated(string $name = 'updated'): DatabaseTimestampField;

    /**
     * Set a timestamp field
     *
     * @param  string $name
     * @return DatabaseTimestampField
     */
    public function timestamp(string $name): DatabaseTimestampField;

    /**
     * Set a varchar field
     *
     * @param  string $name
     * @return DatabaseVarcharField
     */
    public function varchar(string $name): DatabaseVarcharField;
    
    /**
     * Set a date field
     *
     * @param  string $name
     * @return DatabaseDateField
     */
    public function date(string $name): DatabaseDateField;
    
    /**
     * Set a boolean int field
     *
     * @param  string $name
     * @return DatabaseTinyintField
     */
    public function boolean(string $name): DatabaseTinyintField;
    
    /**
     * Set an int field
     *
     * @param  string $name
     * @return DatabaseIntField
     */
    public function int(string $name): DatabaseIntField;

    /**
     * Set a text field
     *
     * @param  string $name
     * @return DatabaseTextField
     */
    public function text(string $name): DatabaseTextField;

    /**
     * Set a decimal field
     *
     * @param  string $name
     * @return DatabaseDecimalField
     */
    public function decimal(string $name): DatabaseDecimalField;

    /**
     * Set a HTML text field
     *
     * @param  string $name
     * @return DatabaseTextField
     */
    public function html(string $name): DatabaseTextField;
    
    /**
     * Set a has one relation
     *
     * @param  string $relation
     * @param  string $relationClass
     * @param  string $hasManyRelation
     * @return HasOneRelationInterface
     */
    public function hasOne(string $relation, string $relationClass, string $hasManyRelation = null): HasOneRelationInterface;

    /**
     * Set a has many relation
     *
     * @param  string $relation
     * @param  string $relationClass
     * @return HasManyRelationInterface
     */
    public function hasMany(string $relation, string $relationClass): HasManyRelationInterface;
    
    /**
     * Set a many many relation
     *
     * @param  string $relation
     * @param  string $foreignClass
     * @return ManyManyRelationInterface
     */
    public function manyMany(string $relation, string $foreignClass): ManyManyRelationInterface;

    /**
     * Set a belongs many many relation
     *
     * @param  string $relation
     * @param  string $foreignClass
     * @return ManyManyRelationInterface
     */
    public function belongsManyMany(string $relation, string $foreignClass): ManyManyRelationInterface;

    /**
     * Return an array of database columns
     *
     * @return array
     */
    public function getColumns(): array;

    /**
     * Return an array of has one relations
     *
     * @return array
     */
    public function getHasOneRelations(): array;

    /**
     * Return a single has one relation
     *
     * @param string $name
     * @return HasOneRelationInterface|null
     */
    public function getHasOneRelation(string $name):? HasOneRelationInterface;

    /**
     * Return an array of has many relations
     *
     * @return array
     */
    public function getHasManyRelations(): array;

    /**
     * Return a single has many relation
     *
     * @param string $name
     * @return HasManyRelationInterface|null
     */
    public function getHasManyRelation(string $name):? HasManyRelationInterface;

    /**
     * Return an array of many many relations
     *
     * @return array
     */
    public function getManyManyRelations(): array;

    /**
     * Return a single many many relation
     *
     * @param string $name
     * @return ManyManyRelationInterface|null
     */
    public function getManyManyRelation(string $name):? ManyManyRelationInterface;

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject;
}
