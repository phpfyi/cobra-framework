<?php

namespace Cobra\Interfaces\Cache;

/**
 * Cache Interface
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
interface CacheInvalidatorInterface
{
    /**
     * Clear all caches and rebuilds any required configuration.
     *
     * @return void
     */
    public function clear(): void;
}
