<?php

namespace Cobra\Database\Relation;

use Cobra\Interfaces\Database\Relation\ManyManyRelationInterface;
use Cobra\Database\DatabaseTable;
use Cobra\Object\AbstractObject;

/**
 * Many Many Relation
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
class ManyManyRelation extends DatabaseTable implements ManyManyRelationInterface
{
    /**
     * Model relation name
     *
     * @var string
     */
    protected $relation;

    /**
     * Local column name
     *
     * @var string
     */
    protected $localColumn;

    /**
     * Local class name
     *
     * @var string
     */
    protected $localClass;

    /**
     * Local table name
     *
     * @var string
     */
    protected $localTable;

    /**
     * Relation local ID
     *
     * @var int
     */
    protected $localID = 0;

    /**
     * Foreign column name
     *
     * @var string
     */
    protected $foreignColumn;

    /**
     * Foreign class name
     *
     * @var string
     */
    protected $foreignClass;

    /**
     * Foreign table name
     *
     * @var string
     */
    protected $foreignTable;

    /**
     * Sets the local and foreign table details
     *
     * @param string $relation
     * @param string $localClass
     * @param string $localTable
     * @param string $foreignClass
     * @param string $foreignTable
     */
    public function __construct(
        string $relation,
        string $localClass,
        string $localTable,
        string $foreignClass,
        string $foreignTable
    ) {
        $this->relation = $relation;
        $this->localColumn = sprintf('%sID', $localTable);
        $this->localClass = $localClass;
        $this->localTable = $localTable;
        $this->foreignColumn = sprintf('%sID', $foreignTable);
        $this->foreignClass = $foreignClass;
        $this->foreignTable = $foreignTable;

        $this->table = sprintf('%s_%s', $this->localTable, $this->relation);

        $this->primary();
        $this->int($this->localColumn);
        $this->int($this->foreignColumn);
    }

    /**
     * Returns the model relation name
     *
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * Returns the local column name
     *
     * @return string
     */
    public function getLocalColumn(): string
    {
        return $this->localColumn;
    }

    /**
     * Returns the local class name
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getLocalClass(bool $instance = false)
    {
        return $instance ? new $this->localClass : $this->localClass;
    }

    /**
     * Returns the local table name
     *
     * @return string
     */
    public function getLocalTable(): string
    {
        return $this->localTable;
    }

    /**
     * Sets the relation local ID
     *
     * @param  integer $localId
     * @return ManyManyRelationInterface
     */
    public function setLocalID(int $localId): ManyManyRelationInterface
    {
        $this->localID = $localId;
        return $this;
    }

    /**
     * Returns the relation local ID
     *
     * @return integer
     */
    public function getLocalID(): int
    {
        return $this->localID;
    }

    /**
     * Returns the foreign column name
     *
     * @return string
     */
    public function getForeignColumn(): string
    {
        return $this->foreignColumn;
    }

    /**
     * Returns the foreign class name
     *
     * @param  boolean $instance
     * @return string|object
     */
    public function getForeignClass(bool $instance = false)
    {
        return $instance ? new $this->foreignClass : $this->foreignClass;
    }

    /**
     * Returns the foreign table name
     *
     * @return string
     */
    public function getForeignTable(): string
    {
        return $this->foreignTable;
    }

    /**
     * Returns an object representation of the schema
     *
     * @return Object
     */
    public function getDatabaseSchema(): AbstractObject
    {
        $schema = parent::getDatabaseSchema();
        $schema->columns = [];
        array_map(
            function ($column) use (&$schema) {
                $schema->columns[$column->getName()] = $column->getDatabaseSchema();
            },
            $this->getColumns()
        );

        unset($schema->data);
        
        return $schema;
    }
}
