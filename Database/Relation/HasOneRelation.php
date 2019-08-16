<?php

namespace Cobra\Database\Relation;

use Cobra\Interfaces\Database\Relation\HasOneRelationInterface;
use Cobra\Database\Field\DatabaseIntField;
use Cobra\Object\AbstractObject;

/**
 * Has One Relation
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
class HasOneRelation extends DatabaseIntField implements HasOneRelationInterface
{
    /**
     * Whether the column is NOT NULL
     *
     * @var boolean
     */
    protected $null = true;

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
     * Relation id
     *
     * @var string
     */
    protected $relationID = 0;

    /**
     * Has many reference relation
     *
     * @var string
     */
    protected $hasManyRelation = null;

    /**
     * Sets up column properties
     *
     * @param string $name
     * @param string $relationClass
     * @param string $foreignClass
     */
    public function __construct(string $relation, string $relationClass, string $hasManyRelation = null)
    {
        $this->name = sprintf('%sID', $relation);
        $this->relation = $relation;
        $this->relationClass = $relationClass;
        $this->hasManyRelation = $hasManyRelation;
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
     * Returns the local class name
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getRelationClass(bool $instance = false)
    {
        return $instance ? new $this->relationClass : $this->relationClass;
    }

    /**
     * Sets the relation ID
     *
     * @param  integer $relationId
     * @return HasOneRelationInterface
     */
    public function setRelationID(int $relationId): HasOneRelationInterface
    {
        $this->relationID = $relationId;
        return $this;
    }

    /**
     * Returns the relation ID
     *
     * @return integer
     */
    public function getRelationID(): int
    {
        return $this->relationID;
    }

    /**
     * Returns the has many relation class name
     *
     * @return string
     */
    public function getHasManyRelation():? string
    {
        return $this->hasManyRelation;
    }

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject
    {
        $schema = parent::getDatabaseSchema();

        $schema->class = $this->getRelationClass();
        $schema->hasMany = $this->getHasManyRelation();

        unset($schema->data);

        return $schema;
    }
}
