<?php

namespace Cobra\Cache\Service;

use Cobra\Core\Service\Service;

/**
 * Cache Service
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
class CacheService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Cache\CacheInterface::class,
                \Cobra\Cache\Cache::class
            )->namespace(
                \Cobra\Interfaces\Cache\CacheKeyInterface::class,
                \Cobra\Cache\CacheKey::class
            );
    }
}
