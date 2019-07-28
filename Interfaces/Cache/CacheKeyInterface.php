<?php

namespace Cobra\Interfaces\Cache;

use Psr\Cache\InvalidArgumentException;

/**
 * Cache Key Interface
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
interface CacheKeyInterface
{
    /**
     * Validate a passed cache key
     *
     * @param  string $key
     * @return bool
     * @throws InvalidArgumentException
     */
    public function validate(string $key): bool;

    /**
     * Creates a cache key
     *
     * @param  string $identifier
     * @return string
     */
    public function create(string $identifier): string;
}
