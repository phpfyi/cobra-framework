<?php

namespace Cobra\Interfaces\Database\Relation;

use Cobra\Object\AbstractObject;

/**
 * Has One Relation Interface
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
interface HasOneRelationInterface
{
    /**
     * Returns the relation name
     *
     * @return string
     */
    public function getRelation(): string;

    /**
     * Returns the local class name
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getRelationClass(bool $instance = false);

    /**
     * Sets the relation ID
     *
     * @param  integer $relationId
     * @return HasOneRelationInterface
     */
    public function setRelationID(int $relationId): HasOneRelationInterface;

    /**
     * Returns the relation ID
     *
     * @return integer
     */
    public function getRelationID(): int;

    /**
     * Returns the has many relation class name
     *
     * @return string
     */
    public function getHasManyRelation():? string;

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject;
}
