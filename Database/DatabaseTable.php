<?php

namespace Cobra\Database;

use Cobra\Interfaces\Database\DatabaseTableInterface;
use Cobra\Interfaces\Database\Relation\HasManyRelationInterface;
use Cobra\Interfaces\Database\Relation\HasOneRelationInterface;
use Cobra\Interfaces\Database\Relation\ManyManyRelationInterface;
use Cobra\Database\Field\DatabaseDateField;
use Cobra\Database\Field\DatabaseDecimalField;
use Cobra\Database\Field\DatabaseIntField;
use Cobra\Database\Field\DatabaseTextField;
use Cobra\Database\Field\DatabaseTimestampField;
use Cobra\Database\Field\DatabaseTinyintField;
use Cobra\Database\Field\DatabaseVarcharField;
use Cobra\Database\Relation\HasManyRelation;
use Cobra\Database\Relation\HasOneRelation;
use Cobra\Database\Relation\ManyManyRelation;
use Cobra\Database\Traits\DatabaseSchema;
use Cobra\Object\AbstractObject;

/**
 * Database Table
 *
 * Object represntation of a database table.
 *
 * This class provides a simple yet powerful API for creating database tables,
 * columns and relations.
 *
 * There are methods on this class to create each type of database column as
 * well as each type of database relation.
 *
 * Methods on the class here which create database field instances will set
 * sensible default properties on the column objects. For instance calling
 * the @method DatabaseIntField primary() will create a DatabaseIntField that
 * is unsigned and auto increments.
 *
 * The class contains a @method object getDatabaseSchema() which will convert
 * all the protecte and inaccessible class properties into a simpler object
 * with all these properties as public. This can be exteremly useful for
 * creating a detailed database schema for migrations or inspecting database
 * table / column definitions without having to call the methods.
 *
 * This class can be easily subclassed to create even more detailed and powerful
 * database objects.
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
class DatabaseTable extends AbstractObject implements DatabaseTableInterface
{
    use DatabaseSchema;

    /**
     * The database table name
     *
     * @var string
     */
    protected $table;

    /**
     * The database model class name
     *
     * @var string
     */
    protected $class;

    /**
     * The database table engine
     *
     * @var string
     */
    protected $engine = 'InnoDB';

    /**
     * The database table charset
     *
     * @var string
     */
    protected $charset = 'latin1';

    /**
     * The database table columns
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The database table has one relations
     *
     * @var array
     */
    protected $hasOne = [];

    /**
     * The database table has many relations
     *
     * @var array
     */
    protected $hasMany = [];

    /**
     * The database table many many relations
     *
     * @var array
     */
    protected $manyMany = [];

    /**
     * The database table belongs many many relations
     *
     * @var array
     */
    protected $belongsManyMany = [];

    /**
     * Set the table name and class
     *
     * @param string $table
     * @param string $class
     */
    public function __construct(string $table, string $class)
    {
        $this->table = $table;
        $this->class = $class;
    }

    /**
     * Returns the table name
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Returns the table class name
     *
     * @return string|null
     */
    public function getClass():? string
    {
        return $this->class;
    }

    /**
     * Sets the table engine
     *
     * @param  string $engine
     * @return DatabaseTableInterface
     */
    public function setEngine(string $engine): DatabaseTableInterface
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * Returns the table engine
     *
     * @return string
     */
    public function getEngine(): string
    {
        return $this->engine;
    }

    /**
     * Sets the table charset
     *
     * @param  string $charset
     * @return DatabaseTableInterface
     */
    public function setCharset(string $charset): DatabaseTableInterface
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * Returns the table charset
     *
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * Set a primary key field
     *
     * @param  string $name
     * @return DatabaseIntField
     */
    public function primary(string $name = 'id'): DatabaseIntField
    {
        return $this->columns[$name] = DatabaseIntField::resolve($name)
            ->setUnsigned(true)
            ->setIncrement(true)
            ->setPrimary(true);
    }

    /**
     * Set a created timestamp field
     *
     * @param  string $name
     * @return DatabaseTimestampField
     */
    public function created(string $name = 'created'): DatabaseTimestampField
    {
        return $this->columns[$name] = DatabaseTimestampField::resolve($name)
            ->setNull(true)
            ->setDefault('NULL');
    }

    /**
     * Set an updated timestamp field
     *
     * @param  string $name
     * @return DatabaseTimestampField
     */
    public function updated(string $name = 'updated'): DatabaseTimestampField
    {
        return $this->columns[$name] = DatabaseTimestampField::resolve($name)
            ->setNotNull(true)
            ->setDefault('CURRENT_TIMESTAMP')
            ->setOnUpdate('CURRENT_TIMESTAMP');
    }

    /**
     * Set a timestamp field
     *
     * @param  string $name
     * @return DatabaseTimestampField
     */
    public function timestamp(string $name): DatabaseTimestampField
    {
        return $this->columns[$name] = DatabaseTimestampField::resolve($name)
            ->setNull(true)
            ->setDefault('NULL');
    }

    /**
     * Set a varchar field
     *
     * @param  string $name
     * @return DatabaseVarcharField
     */
    public function varchar(string $name): DatabaseVarcharField
    {
        return $this->columns[$name] = DatabaseVarcharField::resolve($name)
            ->setNull(true)
            ->setLength(512);
    }
    
    /**
     * Set a date field
     *
     * @param  string $name
     * @return DatabaseDateField
     */
    public function date(string $name): DatabaseDateField
    {
        return $this->columns[$name] = DatabaseDateField::resolve($name)
            ->setNull(true);
    }
    
    /**
     * Set a boolean int field
     *
     * @param  string $name
     * @return DatabaseTinyintField
     */
    public function boolean(string $name): DatabaseTinyintField
    {
        return $this->columns[$name] = DatabaseTinyintField::resolve($name)
            ->setLength(1)
            ->setNotNull(true)
            ->setDefault("'0'");
    }
    
    /**
     * Set an int field
     *
     * @param  string $name
     * @return DatabaseIntField
     */
    public function int(string $name): DatabaseIntField
    {
        return $this->columns[$name] = DatabaseIntField::resolve($name)
            ->setNull(true);
    }

    /**
     * Set a text field
     *
     * @param  string $name
     * @return DatabaseTextField
     */
    public function text(string $name): DatabaseTextField
    {
        return $this->columns[$name] = DatabaseTextField::resolve($name)
            ->setNull(true);
    }

    /**
     * Set a decimal field
     *
     * @param  string $name
     * @return DatabaseDecimalField
     */
    public function decimal(string $name): DatabaseDecimalField
    {
        return $this->columns[$name] = DatabaseDecimalField::resolve($name)
            ->setLength('5,2')
            ->setNull(true);
    }

    /**
     * Set a HTML text field
     *
     * @param  string $name
     * @return DatabaseTextField
     */
    public function html(string $name): DatabaseTextField
    {
        return $this->columns[$name] = DatabaseTextField::resolve($name)
            ->setNull(true);
    }
    
    /**
     * Set a has one relation
     *
     * @param  string $relation
     * @param  string $relationClass
     * @param  string $hasManyRelation
     * @return HasOneRelationInterface
     */
    public function hasOne(string $relation, string $relationClass, string $hasManyRelation = null): HasOneRelationInterface
    {
        return $this->hasOne[$relation] = HasOneRelation::resolve(
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
        return $this->hasMany[$relation] = HasManyRelation::resolve(
            $relation,
            $relationClass,
            singleton($relationClass)->getTable(),
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
        return $this->manyMany[$relation] = ManyManyRelation::resolve(
            $relation,
            $this->class,
            $this->table,
            $foreignClass,
            singleton($foreignClass)->getTable()
        );
    }

    /**
     * Set a belongs many many relation
     *
     * @param  string $relation
     * @param  string $foreignClass
     * @return ManyManyRelationInterface
     */
    public function belongsManyMany(string $relation, string $foreignClass): ManyManyRelationInterface
    {
        return $this->belongsManyMany[$relation] = ManyManyRelation::resolve(
            $relation,
            $this->class,
            $this->table,
            $foreignClass,
            singleton($foreignClass)->getTable()
        );
    }

    /**
     * Return an array of database columns
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Return an array of has one relations
     *
     * @return array
     */
    public function getHasOneRelations(): array
    {
        return $this->hasOne;
    }

    /**
     * Return a single has one relation
     *
     * @param string $name
     * @return HasOneRelationInterface|null
     */
    public function getHasOneRelation(string $name):? HasOneRelationInterface
    {
        return array_key($name, $this->hasOne);
    }

    /**
     * Return an array of has many relations
     *
     * @return array
     */
    public function getHasManyRelations(): array
    {
        return $this->hasMany;
    }

    /**
     * Return a single has many relation
     *
     * @param string $name
     * @return HasManyRelationInterface|null
     */
    public function getHasManyRelation(string $name):? HasManyRelationInterface
    {
        return array_key($name, $this->hasMany);
    }

    /**
     * Return an array of many many relations
     *
     * @return array
     */
    public function getManyManyRelations(): array
    {
        return $this->manyMany;
    }

    /**
     * Return a single many many relation
     *
     * @param string $name
     * @return ManyManyRelationInterface|null
     */
    public function getManyManyRelation(string $name):? ManyManyRelationInterface
    {
        return array_key($name, $this->manyMany);
    }
}
