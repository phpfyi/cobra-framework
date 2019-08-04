<?php

namespace Cobra\Model\Schema;

use Cobra\Interfaces\Model\ModelInterface;
use Cobra\Model\Cache\ObjectCache;
use Cobra\Model\Cache\SchemaCache;
use Cobra\Object\AbstractObject;

/**
 * Schema Factory
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
class SchemaFactory extends AbstractObject
{
    /**
     * ObjectCache instance
     *
     * @var ObjectCache
     */
    protected $objectCache;

    /**
     * SchemaCache instance
     *
     * @var SchemaCache
     */
    protected $schemaCache;

    /**
     * Array of model schema specs.
     *
     * @var array
     */
    protected $schemas = [];

    /**
     * Sets the required properties.
     *
     * @param ObjectCache $objectCache
     * @param SchemaCache $schemaCache
     */
    public function __construct(ObjectCache $objectCache, SchemaCache $schemaCache)
    {
        $this->objectCache = $objectCache;
        $this->schemaCache = $schemaCache;
    }

    /**
     * Caches the database table schema.
     *
     * @return void
     */
    public function cacheSchema(): void
    {
        array_map(
            function (ModelInterface $model) {
                $schema = container_resolve(SchemaTableFactory::class, [databaseTable($model)])->getSchema();

                $this->schemas[$schema->class] = $schema;
            },
            $this->objectCache->getInstances()
        );
        array_map(
            function (object $schema) {
                $this->sendToCache(
                    container_resolve(
                        SchemaSpecFactory::class,
                        [$schema, $this->schemas]
                    )->getSpec()
                );
            },
            $this->schemas
        );
    }

    /**
     * Sends the schema to the cache.
     *
     * @param object $schema
     * @return void
     */
    protected function sendToCache(object $schema): void
    {
        $this->schemaCache->find(
            $schema->class,
            function () use ($schema) {
                return json_encode($schema, JSON_PRETTY_PRINT);
            }
        );
    }
}
