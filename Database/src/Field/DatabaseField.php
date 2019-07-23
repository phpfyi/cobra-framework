<?php

namespace Cobra\Database\Field;

use Cobra\Interfaces\Database\Field\DatabaseFieldInterface;
use Cobra\Database\Traits\DatabaseSchema;
use Cobra\Object\AbstractObject;

/**
 * Database Field
 *
 * Object representation of a database field.
 *
 * Parent class which can be initialised and set or child classes can inherit
 * from with custom properties.
 *
 * Properties on this class correspond to particular field traits such as the
 * type or field length.
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
class DatabaseField extends AbstractObject implements DatabaseFieldInterface
{
    use DatabaseSchema;

    /**
     * Database field name
     *
     * @var string
     */
    protected $name;

    /**
     * Database field type
     *
     * @var string
     */
    protected $type;

    /**
     * Database field length
     *
     * @var string|int
     */
    protected $length;

    /**
     * Database UNSIGNED
     *
     * @var boolean
     */
    protected $unsigned = false;
    
    /**
     * Database AUTO INCREMENT
     *
     * @var boolean
     */
    protected $increment = false;
    
    /**
     * Database PRIMARY KEY
     *
     * @var boolean
     */
    protected $primary = false;
    
    /**
     * Database NULL
     *
     * @var boolean
     */
    protected $null = false;
    
    /**
     * Database NOT NULL
     *
     * @var boolean
     */
    protected $notNull = false;
    
    /**
     * Database DEFAULT
     *
     * @var string|int
     */
    protected $default;
    
    /**
     * Database ON UPDATE
     *
     * @var string
     */
    protected $onUpdate;

    /**
     * Sets the field name
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Sets the field name
     *
     * @param  string $name
     * @return DatabaseFieldInterface
     */
    public function setName(string $name): DatabaseFieldInterface
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the field name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the field type
     *
     * @param  string $type
     * @return DatabaseFieldInterface
     */
    public function setType(string $type): DatabaseFieldInterface
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the database field type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the field length
     *
     * @param  string|int $length
     * @return DatabaseFieldInterface
     */
    public function setLength($length): DatabaseFieldInterface
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Returns the field length
     *
     * @return string|int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Sets the field as UNSIGNED
     *
     * @param  boolean $unsigned
     * @return DatabaseFieldInterface
     */
    public function setUnsigned(bool $unsigned): DatabaseFieldInterface
    {
        $this->unsigned = $unsigned;
        return $this;
    }

    /**
     * Returns whether the field is UNSIGNED
     *
     * @return bool
     */
    public function isUnsigned(): bool
    {
        return $this->unsigned;
    }

    /**
     * Sets the field as AUTO INCREMENT
     *
     * @param  boolean $increment
     * @return DatabaseFieldInterface
     */
    public function setIncrement(bool $increment): DatabaseFieldInterface
    {
        $this->increment = $increment;
        return $this;
    }

    /**
     * Returns whether the field is AUTO INCREMENT
     *
     * @return bool
     */
    public function isIncremented(): bool
    {
        return $this->increment;
    }

    /**
     * Sets the field as PRIMARY
     *
     * @param  boolean $primary
     * @return DatabaseFieldInterface
     */
    public function setPrimary(bool $primary): DatabaseFieldInterface
    {
        $this->primary = $primary;
        return $this;
    }

    /**
     * Returns whether the field is PRIMARY
     *
     * @return bool
     */
    public function getPrimary(): bool
    {
        return $this->primary;
    }

    /**
     * Sets the field as NULL
     *
     * @param  boolean $null
     * @return DatabaseFieldInterface
     */
    public function setNull(bool $null): DatabaseFieldInterface
    {
        $this->null = $null;
        return $this;
    }

    /**
     * Returns whether the field is NULL
     *
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->null;
    }

    /**
     * Sets the field as NOT NULL
     *
     * @param  boolean $notNull
     * @return DatabaseFieldInterface
     */
    public function setNotNull(bool $notNull): DatabaseFieldInterface
    {
        $this->notNull = $notNull;
        return $this;
    }

    /**
     * Returns whether the field is NOT NULL
     *
     * @return bool
     */
    public function isNotNull(): bool
    {
        return $this->notNull;
    }

    /**
     * Sets the field as DEFAULT and its value
     *
     * @param  string $default
     * @return DatabaseFieldInterface
     */
    public function setDefault(string $default): DatabaseFieldInterface
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Returns whether the field is DEFAULT and its value
     *
     * @return string|void
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Sets the field as ON UPDATE and its value
     *
     * @param  string $onUpdate
     * @return DatabaseFieldInterface
     */
    public function setOnUpdate(string $onUpdate): DatabaseFieldInterface
    {
        $this->onUpdate = $onUpdate;
        return $this;
    }

    /**
     * Returns whether the field is ON UPDATE and the value
     *
     * @return string|void
     */
    public function getOnUpdate()
    {
        return $this->onUpdate;
    }
}
