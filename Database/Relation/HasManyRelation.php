<?php

namespace Cobra\Database\Relation;

use Cobra\Interfaces\Database\Relation\HasManyRelationInterface;
use Cobra\Database\Traits\DatabaseSchema;
use Cobra\Object\AbstractObject;

/**
 * Has Many Relation
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
class HasManyRelation extends AbstractObject implements HasManyRelationInterface
{
    use DatabaseSchema {
        DatabaseSchema::getDatabaseSchema as getBaseDatabaseSchema;
    }

    /**
     * Relation name
     *
     * @var string
     */
    protected $relation;

    /**
     * Relation class
     *
     * @var string
     */
    protected $relationClass;

    /**
     * Relation table
     *
     * @var string
     */
    protected $relationTable;

    /**
     * Parent class
     *
     * @var string
     */
    protected $parentClass;

    /**
     * Parent table
     *
     * @var string
     */
    protected $parentTable;

    /**
     * Relation parent ID
     *
     * @var int
     */
    protected $parentID = 0;

    /**
     * Sets up the relation
     *
     * @param string $relation
     * @param string $relationClass
     * @param string $relationTable
     * @param string $parentClass
     * @param string $parentTable
     */
    public function __construct(
        string $relation,
        string $relationClass,
        string $relationTable,
        string $parentClass,
        string $parentTable
    ) {
        $this->relation = $relation;
        $this->relationClass = $relationClass;
        $this->relationTable = $relationTable;
        $this->parentClass = $parentClass;
        $this->parentTable = $parentTable;
    }

    /**
     * Returns the relation name
     *
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * Returns the relation class
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getRelationClass(bool $instance = false)
    {
        return $instance ? new $this->relationClass : $this->relationClass;
    }

    /**
     * Returns the relation table
     *
     * @return string
     */
    public function getRelationTable(): string
    {
        return $this->relationTable;
    }

    /**
     * Returns the parent class
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getParentClass(bool $instance = false)
    {
        return $instance ? new $this->parentClass : $this->parentClass;
    }

    /**
     * Returns the parent table
     *
     * @return string
     */
    public function getParentTable(): string
    {
        return $this->parentTable;
    }

    /**
     * Sets the relation parent ID
     *
     * @param  integer $parentID
     * @return HasManyRelationInterface
     */
    public function setParentID(int $parentID): HasManyRelationInterface
    {
        $this->parentID = $parentID;
        return $this;
    }

    /**
     * Returns the relation parent ID
     *
     * @return integer
     */
    public function getParentID(): int
    {
        return $this->parentID;
    }

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject
    {
        $schema = $this->getBaseDatabaseSchema();

        unset($schema->data);

        return $schema;
    }
}
