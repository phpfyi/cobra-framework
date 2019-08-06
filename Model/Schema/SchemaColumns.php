<?php

namespace Cobra\Model\Schema;

use Cobra\Object\AbstractObject;

/**
 * Schema Columns
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
class SchemaColumns extends AbstractObject
{
    /**
     * Schema object
     *
     * @var object
     */
    protected $schema;

    /**
     * Array of schema database columns
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Schema class hierarchy
     *
     * @var array
     */
    protected $hierarchy = [];

    /**
     * Array of has one database columns
     *
     * @var array
     */
    protected $hasOne = [];

    /**
     * Sets the required properties
     *
     * @param object $schema
     */
    public function __construct(object $schema)
    {
        $this->schema = $schema;
        $this->columns = (array) $schema->columns;
        $this->hasOne = (array) $schema->hasOne;
        $this->hierarchy = $schema->hierarchy;
    }

    /**
     * Returns a database column or has one column object.
     *
     * @param string $name
     * @return object
     */
    public function get(string $name): object
    {
        return $this->getColumnsWithHasOne(true)[$this->getHasOneName($name)];
    }

    /**
     * Returns a database column object.
     *
     * @param string $name
     * @return object
     */
    public function getColumn(string $name): object
    {
        return $this->columns[$name];
    }

    /**
     * Returns a database has one column object.
     *
     * @param string $name
     * @return object
     */
    public function getHasOne(string $name): object
    {
        return $this->hasOne[$this->getHasOneName($name)];
    }

    /**
     * Returns all database column names.
     *
     * @param boolean $hierarchy
     * @return array
     */
    public function getNames(bool $hierarchy = false): array
    {
        return $hierarchy
        ? array_keys($this->columns)
        : array_keys($this->fromBaseClass($this->columns));
    }

    /**
     * Returns all database has one column names.
     *
     * @param boolean $hierarchy
     * @return array
     */
    public function getHasOneNames(bool $hierarchy = false): array
    {
        $names = $hierarchy
        ? array_keys($this->hasOne)
        : array_keys($this->fromBaseClass($this->hasOne));

        return array_map(function (string $name) {
            return $name.'ID';
        }, $names);
    }

    /**
     * Returns all database column and has one column names.
     *
     * @param boolean $hierarchy
     * @return array
     */
    public function getNamesWithHasOne(bool $hierarchy = false): array
    {
        return array_merge(
            $this->getNames($hierarchy),
            $this->getHasOneNames($hierarchy)
        );
    }

    /**
     * Returns all database column objects.
     *
     * @param boolean $hierarchy
     * @return array
     */
    public function getColumns(bool $hierarchy = false): array
    {
        return $hierarchy
        ? $this->columns
        : $this->fromBaseClass($this->columns);
    }

    /**
     * Returns all has one column objects.
     *
     * @param boolean $hierarchy
     * @return array
     */
    public function getHasOneColumns(bool $hierarchy = false): array
    {
        return $hierarchy
        ? $this->hasOne
        : $this->fromBaseClass($this->hasOne);
    }

    /**
     * Returns all database column and has one column objects.
     *
     * @param boolean $hierarchy
     * @return array
     */
    public function getColumnsWithHasOne(bool $hierarchy = false): array
    {
        return array_merge(
            $this->getColumns($hierarchy),
            $this->getHasOneColumns($hierarchy)
        );
    }

    /**
     * Returns the named objects from the base class.
     *
     * @param array $objects
     * @return array
     */
    protected function fromBaseClass(array $objects): array
    {
        return array_filter($objects, function (object $object) {
            return $object->ownerClass === $this->schema->class;
        });
    }

    /**
     * Returns a has one name without ID.
     *
     * @param string $name
     * @return string
     */
    protected function getHasOneName(string $name): string
    {
        return substr($name, -2) === 'ID' ? substr($name, 0, -2) : $name;
    }
}
