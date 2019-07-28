<?php

namespace Cobra\Cache\Middleware;

use Cobra\Cache\CacheInvalidator;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Http\Middleware\Middleware;

/**
 * Flushes all caches on each request
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
class FlushCacheMiddleware extends Middleware
{
    /**
     * CacheInvalidator instance
     *
     * @var CacheInvalidator
     */
    protected $cacheInvalidator;

    /**
     * Sets the required properties
     *
     * @param CacheInvalidator $cacheInvalidator
     */
    public function __construct(CacheInvalidator $cacheInvalidator)
    {
        $this->cacheInvalidator = $cacheInvalidator;
    }

    /**
     * Flushes all config on each request
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (env('FLUSH_CACHE') === true) {
            $this->cacheInvalidator->clear();
        }
        return $handler->handle($request);
    }
}
