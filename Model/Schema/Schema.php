<?php

namespace Cobra\Model\Schema;

use Cobra\Model\Cache\SchemaCache;
use Cobra\Object\AbstractObject;

/**
 * Schema
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
class Schema extends AbstractObject
{
    /**
     * SchemaCache instance
     *
     * @var SchemaCache
     */
    protected $cache;

    /**
     * Schema data object
     *
     * @var object
     */
    protected $data;

    /**
     * SchemaColumns instance
     *
     * @var SchemaColumns
     */
    protected $columns;

    /**
     * SchemaRelations instance
     *
     * @var SchemaRelations
     */
    protected $relations;

    /**
     * Sets the required properties
     *
     * @param string $class
     * @param SchemaCache $cache
     */
    public function __construct(string $class, SchemaCache $cache)
    {
        $this->cache = $cache;
        $this->data = json_decode($cache->getItem(md5($class))->get());

        $this->columns = container_resolve(SchemaColumns::class, [$this->data]);
        $this->relations = container_resolve(SchemaRelations::class, [$this->data]);
    }

    /**
     * Returns a schema property.
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->data->{$name};
    }

    /**
     * Returns the schema class hierarchy.
     *
     * @param boolean $reverse
     * @return array
     */
    public function hierarchy(bool $reverse = false): array
    {
        return $reverse
        ? array_reverse($this->data->hierarchy)
        : $this->data->hierarchy;
    }

    /**
     * Returns the SchemaColumns instance.
     *
     * @return SchemaColumns
     */
    public function columns(): SchemaColumns
    {
        return $this->columns;
    }

    /**
     * Returns the SchemaRelations instance.
     *
     * @return SchemaRelations
     */
    public function relations(): SchemaRelations
    {
        return $this->relations;
    }
}
