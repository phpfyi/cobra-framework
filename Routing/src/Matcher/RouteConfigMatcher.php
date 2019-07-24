<?php

namespace Cobra\Routing\Matcher;

use Closure;
use Cobra\Interfaces\Routing\Factory\RouteFactoryInterface;
use Cobra\Routing\Route;
use Cobra\Routing\Cache\RouteCache;

/**
 * Route Config Matcher
 *
 * Attempts to match a route to a route configuration.
 *
 * @category  Routing
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RouteConfigMatcher extends RouteMatcher
{
    /**
     * Returns whether there is a matched route.
     *
     * @return boolean
     */
    public function hasMatch(): bool
    {
        foreach ($this->getRoutes() as $route) {
            $route = Route::resolve($route);
            
            if (!empty($route->getHostnames()) && !in_array($this->host, $route->getHostnames())) {
                continue;
            }
            $regex = sprintf("#^%s$#", $route->getPath());
            if (preg_match($regex, $this->path) !== 1) {
                continue;
            }
            $this->route = $route;
            return true;
        }
        return false;
    }

    /**
     * Returns the framework routes.
     *
     * @return array
     */
    protected function getRoutes(): array
    {
        return yaml_parse(
            RouteCache::resolve()->find(
                'routes',
                $this->getCacheCallback()
            )->get()
        );
    }

    /**
     * Returns the closure to build the cache data.
     *
     * @return Closure
     */
    protected function getCacheCallback(): Closure
    {
        return function () {
            return yaml_emit(
                container_resolve(
                    RouteFactoryInterface::class,
                    [
                        config('routes')
                    ]
                )->getRoutes()
            );
        };
    }
}
