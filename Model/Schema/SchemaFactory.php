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
                $table = databaseTable($model);
                $factory = container_resolve(SchemaTableFactory::class, [$table]);

                $this->schemaCache->find(
                    $table->getClass(),
                    function () use ($factory) {
                        return json_encode($factory->getSchema(), JSON_PRETTY_PRINT);
                    }
                );
            },
            $this->objectCache->getInstances()
        );
    }
}
