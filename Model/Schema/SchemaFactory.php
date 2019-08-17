<?php

namespace Cobra\Model\Schema;

use Cobra\Interfaces\Model\ModelInterface;
use Cobra\Model\Cache\SchemaCache;
use Cobra\Model\Factory\ClassFactory;
use Cobra\Model\Schema\SchemaTransformer;
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
     * ClassFactory instance
     *
     * @var ClassFactory
     */
    protected $classFactory;

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
     * @param ClassFactory $classFactory
     * @param SchemaCache $schemaCache
     */
    public function __construct(ClassFactory $classFactory, SchemaCache $schemaCache)
    {
        $this->classFactory = $classFactory;
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
            function (object $schema) {
                $this->sendToCache(
                    container_resolve(
                        SchemaTransformer::class,
                        [
                            array_map(function (string $namespace) {
                                return $this->schemas[$namespace];
                            }, $schema->hierarchy)
                        ]
                    )->getData()
                );
            },
            $this->getDatabaseSchemas()
        );
    }

    /**
     * Sets up all the schema data instances.
     *
     * @return array
     */
    protected function getDatabaseSchemas(): array
    {
        array_map(
            function (ModelInterface $model) {
                $schema = container_resolve(
                    SchemaTableFactory::class,
                    [database_table($model)]
                )->getSchema();

                $this->schemas[$schema->class] = $schema;
            },
            $this->classFactory->getReflectionClasses()
        );
        return $this->schemas;
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
