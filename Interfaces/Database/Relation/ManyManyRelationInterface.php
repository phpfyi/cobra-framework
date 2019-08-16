<?php

namespace Cobra\Interfaces\Database\Relation;

use Cobra\Object\AbstractObject;

/**
 * Many Many Relation Interface
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
interface ManyManyRelationInterface
{
    /**
     * Returns the model relation name
     *
     * @return string
     */
    public function getRelation(): string;

    /**
     * Returns the local column name
     *
     * @return string
     */
    public function getLocalColumn(): string;

    /**
     * Returns the local class name
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getLocalClass(bool $instance = false);

    /**
     * Returns the local table name
     *
     * @return string
     */
    public function getLocalTable(): string;

    /**
     * Sets the relation local ID
     *
     * @param  integer $localId
     * @return ManyManyRelationInterface
     */
    public function setLocalID(int $localId): ManyManyRelationInterface;

    /**
     * Returns the relation local ID
     *
     * @return integer
     */
    public function getLocalID(): int;

    /**
     * Returns the foreign column name
     *
     * @return string
     */
    public function getForeignColumn(): string;

    /**
     * Returns the foreign class name
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getForeignClass(bool $instance = false);

    /**
     * Returns the foreign table name
     *
     * @return string
     */
    public function getForeignTable(): string;

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject;
}
