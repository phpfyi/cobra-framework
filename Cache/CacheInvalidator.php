<?php

namespace Cobra\Cache;

use Cobra\Interfaces\Cache\CacheInvalidatorInterface;
use Cobra\Model\Schema\SchemaFactory;
use Cobra\Object\AbstractObject;

/**
 * Cache Invalidator
 *
 * @category  Cache
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class CacheInvalidator extends AbstractObject implements CacheInvalidatorInterface
{
    /**
     * Schema builder instance
     *
     * @var SchemaFactory
     */
    protected $schemaFactory;

    /**
     * Sets the required properties
     *
     * @param SchemaFactory $schemaFactory
     */
    public function __construct(SchemaFactory $schemaFactory)
    {
        $this->schemaFactory = $schemaFactory;
    }

    /**
     * Clear all caches and rebuilds any required configuration.
     *
     * @return void
     */
    public function clear(): void
    {
        array_map(
            function ($cache) {
                $cache::resolve()->clear();
            },
            static::config('caches')
        );

        $this->schemaFactory->cacheSchema();
    }
}
