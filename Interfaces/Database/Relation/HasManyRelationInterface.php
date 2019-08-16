<?php

namespace Cobra\Interfaces\Database\Relation;

use Cobra\Object\AbstractObject;

/**
 * Has Many Relation Interface
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
interface HasManyRelationInterface
{
    /**
     * Returns the relation name
     *
     * @return string
     */
    public function getRelation(): string;

    /**
     * Returns the relation class
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getRelationClass(bool $instance = false);

    /**
     * Returns the relation table
     *
     * @return string
     */
    public function getRelationTable(): string;

    /**
     * Returns the parent class
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getParentClass(bool $instance = false);

    /**
     * Returns the parent table
     *
     * @return string
     */
    public function getParentTable(): string;

    /**
     * Sets the relation parent ID
     *
     * @param  integer $parentID
     * @return HasManyRelationInterface
     */
    public function setParentID(int $parentID): HasManyRelationInterface;

    /**
     * Returns the relation parent ID
     *
     * @return integer
     */
    public function getParentID(): int;

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject;
}
