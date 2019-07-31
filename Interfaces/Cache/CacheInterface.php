<?php

namespace Cobra\Interfaces\Cache;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\CacheItemInterface;

/**
 * Cache interface
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
interface CacheInterface extends CacheItemPoolInterface
{
    /**
     * Performs a cache lookup for an item
     *
     * If found the cache item is returned
     *
     * If not found, a cache item is created and returned
     *
     * @param  string   $identifier
     * @param  Callable $source
     * @return CacheItemInterface
     */
    public function find(string $identifier, callable $source): CacheItemInterface;

    /**
     * Returns the system path for a cache item key
     *
     * @param  string $key
     * @return string
     */
    public function getFilePath(string $key): string;
}
