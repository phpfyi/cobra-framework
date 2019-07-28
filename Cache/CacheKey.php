<?php

namespace Cobra\Cache;

use InvalidArgumentException;
use Cobra\Interfaces\Cache\CacheKeyInterface;
use Cobra\Object\AbstractObject;

/**
 * Cache Key
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
class CacheKey extends AbstractObject implements CacheKeyInterface
{
    /**
     * Validate a passed cache key
     *
     * @param  string $key
     * @return bool
     * @throws InvalidArgumentException
     */
    public function validate(string $key): bool
    {
        if (!preg_match('/^[a-f0-9]{32}$/', $key)) {
            throw new InvalidArgumentException(
                sprintf('Invalid cache key passed: %s', $key)
            );
        }
        return true;
    }

    /**
     * Creates a cache key
     *
     * @param  string $identifier
     * @return string
     */
    public function create(string $identifier): string
    {
        return md5($identifier);
    }
}
