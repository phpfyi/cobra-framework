<?php

namespace Cobra\Cache;

use Cobra\Interfaces\Cache\CacheInterface;
use Cobra\Interfaces\Cache\CacheKeyInterface;
use Cobra\Interfaces\Server\Storage\FileSystemInterface;
use Cobra\Object\AbstractObject;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;

/**
 * Cache
 *
 * Main cache base class
 *
 * Physically a cache in a sub folder within the cache main folder that deals
 * with a specific type of cache data
 *
 * Many framework classes inherit from this base class to provide their own
 * implementations which have their own properties to specify the cache to use.
 * Some examples are:
 * - autoloader class groupings
 * - configuration
 * - model schema
 * - routes
 * - views
 *
 * The individual caches can be flushed and rebuild on the next request using
 * the clear() method
 *
 * FlushCacheMiddleware can be enabled in dev environments to rebuild the cache
 * on every request.
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
abstract class Cache extends AbstractObject implements CacheInterface
{
    /**
     * Array of loaded cache items
     *
     * @var array
     */
    protected $items = [];

    /**
     * Array of deferred cache items
     *
     * @var array
     */
    protected $deferred = [];

    /**
     * Main cache sub directory
     *
     * @var string
     */
    protected $directory;

    /**
     * Main cache item file extension
     *
     * @var string
     */
    protected $extension;

    /**
     * CacheKeyInterface instance
     *
     * @var CacheKeyInterface
     */
    protected $cacheKey;

    /**
     * FileSystemInterface instance
     *
     * @var FileSystemInterface
     */
    protected $fileSystem;

    /**
     * Sets the required properties
     *
     * @param CacheKeyInterface $cacheKey
     * @param FileSystemInterface $fileSystem
     */
    public function __construct(
        CacheKeyInterface $cacheKey,
        FileSystemInterface $fileSystem
    ) {
        $this->cacheKey = $cacheKey;
        $this->fileSystem = $fileSystem;
    }

    /**
     * Returns a Cache Item representing the specified key.
     *
     * This method must always return a CacheItemInterface object, even in case of
     * a cache miss. It MUST NOT return null.
     *
     * @param  string $key
     * @return CacheItemInterface
     * @throws InvalidArgumentException
     */
    public function getItem($key): CacheItemInterface
    {
        $path = $this->getFilePath($key);
        $item = CacheItem::resolve($key);

        return $this->fileSystem->exists($path)
        ? $item->set($this->fileSystem->get($path))
        : $item;
    }

    /**
     * Returns a traversable set of cache items.
     *
     * @param  array $keys
     * @return array|Traversable
     * @throws InvalidArgumentException
     */
    public function getItems(array $keys = []): array
    {
        $items = [];
        array_map(
            function ($key) use (&$items) {
                $items[$key] = $this->getItem($key);
            },
            $keys
        );
        return $items;
    }

    /**
     * Confirms if the cache contains specified cache item.
     *
     * @param  string $key
     * @return bool
     * @throws InvalidArgumentException
     */
    public function hasItem($key): bool
    {
        return array_key_exists($key, $this->items)
        || $this->fileSystem->exists($this->getFilePath($key));
    }

    /**
     * Deletes all items in the pool.
     *
     * @return bool
     */
    public function clear(): bool
    {
        $this->items = [];
        $this->deferred = [];

        return $this->fileSystem->removeDirectory(
            normalize_directory(CACHE_DIRECTORY, $this->directory)
        );
    }
    
    /**
     * Removes the item from the pool.
     *
     * @param  string $key
     * @return boolean
     * @throws InvalidArgumentException
     */
    public function deleteItem($key): bool
    {
        array_key_unset($key, $this->items);
        array_key_unset($key, $this->deferred);

        return $this->fileSystem->remove($this->getFilePath($key));
    }
    
    /**
     * Removes multiple items from the pool.
     *
     * @param  array $keys
     * @return boolean
     * @throws InvalidArgumentException
     */
    public function deleteItems(array $keys): bool
    {
        array_map(
            function ($key) {
                $this->deleteItem($key);
            },
            $keys
        );
        return true;
    }

    /**
     * Persists a cache item immediately.
     *
     * @param  CacheItemInterface $item
     * @return bool
     */
    public function save(CacheItemInterface $item): bool
    {
        $this->items[$item->getKey()] = $item;

        $this->fileSystem->createDirectory(
            normalize_directory(CACHE_DIRECTORY, $this->directory)
        );

        return $this->fileSystem->put(
            $this->getFilePath($item->getKey()),
            $item->get()
        );
    }

    /**
     * Sets a cache item to be persisted later.
     *
     * @param  CacheItemInterface $item
     * @return boolean
     */
    public function saveDeferred(CacheItemInterface $item): bool
    {
        $this->deferred[$item->getKey()] = $item;
        return true;
    }

    /**
     * Persists any deferred cache items.
     *
     * @return bool
     */
    public function commit(): bool
    {
        array_map(
            function ($item) {
                $this->save($item);
            },
            $this->deferred
        );
        return true;
    }

    /**
     * Performs a cache lookup for an item
     *
     * If found the cache item is returned
     *
     * If not found, a cache item is created and returned
     *
     * This is the main method used to interact with the physical cache fodlers
     * and files
     *
     * @param  string   $identifier
     * @param  Callable $source
     * @return CacheItemInterface
     */
    public function find(string $identifier, callable $source): CacheItemInterface
    {
        $key = $this->cacheKey->create($identifier);
        
        if (!$this->hasItem($key)) {
            $item = CacheItem::resolve($key)->set($source());
            $this->save($item);
            return $item;
        }
        return $this->getItem($key);
    }

    /**
     * Returns the system path for a cache item jey
     *
     * @param  string $key
     * @return string
     */
    public function getFilePath(string $key): string
    {
        return path_join_root(CACHE_DIRECTORY, $this->directory, $key.'.'.$this->extension);
    }
}
