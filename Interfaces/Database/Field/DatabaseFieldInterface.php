<?php

namespace Cobra\Interfaces\Database\Field;

use Cobra\Object\AbstractObject;

/**
 * Database Field interface
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
interface DatabaseFieldInterface
{
    /**
     * Sets the field name
     *
     * @param  string $name
     * @return DatabaseFieldInterface
     */
    public function setName(string $name): DatabaseFieldInterface;

    /**
     * Returns the field name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Sets the field type
     *
     * @param  string $type
     * @return DatabaseFieldInterface
     */
    public function setType(string $type): DatabaseFieldInterface;

    /**
     * Returns the database field type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Sets the field length
     *
     * @param  string|int $length
     * @return DatabaseFieldInterface
     */
    public function setLength($length): DatabaseFieldInterface;

    /**
     * Returns the field length
     *
     * @return string|int
     */
    public function getLength();

    /**
     * Sets the field as UNSIGNED
     *
     * @param  boolean $unsigned
     * @return DatabaseFieldInterface
     */
    public function setUnsigned(bool $unsigned): DatabaseFieldInterface;

    /**
     * Returns whether the field is UNSIGNED
     *
     * @return bool
     */
    public function isUnsigned();

    /**
     * Sets the field as AUTO INCREMENT
     *
     * @param  boolean $increment
     * @return DatabaseFieldInterface
     */
    public function setIncrement(bool $increment): DatabaseFieldInterface;

    /**
     * Returns whether the field is AUTO INCREMENT
     *
     * @return bool
     */
    public function isIncremented(): bool;

    /**
     * Sets the field as PRIMARY
     *
     * @param  boolean $primary
     * @return DatabaseFieldInterface
     */
    public function setPrimary(bool $primary): DatabaseFieldInterface;

    /**
     * Returns whether the field is PRIMARY
     *
     * @return bool
     */
    public function isPrimary(): bool;

    /**
     * Sets the field as NULL
     *
     * @param  boolean $null
     * @return DatabaseFieldInterface
     */
    public function setNull(bool $null): DatabaseFieldInterface;

    /**
     * Returns whether the field is NULL
     *
     * @return bool
     */
    public function isNull(): bool;

    /**
     * Sets the field as NOT NULL
     *
     * @param  boolean $notNull
     * @return DatabaseFieldInterface
     */
    public function setNotNull(bool $notNull): DatabaseFieldInterface;

    /**
     * Returns whether the field is NOT NULL
     *
     * @return bool
     */
    public function isNotNull(): bool;

    /**
     * Sets the field as DEFAULT and its value
     *
     * @param  string $default
     * @return DatabaseFieldInterface
     */
    public function setDefault(string $default): DatabaseFieldInterface;

    /**
     * Returns whether the field is DEFAULT and its value
     *
     * @return string|void
     */
    public function getDefault();

    /**
     * Sets the field as ON UPDATE and its value
     *
     * @param  string $onUpdate
     * @return DatabaseFieldInterface
     */
    public function setOnUpdate(string $onUpdate): DatabaseFieldInterface;

    /**
     * Returns whether the field is ON UPDATE and the value
     *
     * @return string|void
     */
    public function getOnUpdate();

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject;
}
