<?php

namespace Cobra\Routing\Factory;

use Cobra\Interfaces\Routing\Factory\RouteFactoryInterface;
use Cobra\Interfaces\Routing\RouteInterface;
use Cobra\Object\AbstractObject;
use Cobra\Routing\Route;

/**
 * Route Factory
 *
 * Transformed an array of nested routes into a flat route map.
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
class RouteFactory extends AbstractObject implements RouteFactoryInterface
{
    /**
     * Array of routes configuration
     *
     * @var array
     */
    protected $config = [];

    /**
     * Array of routes
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Sets the routes configuration property
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Returns the transformed routes
     *
     * @return array
     */
    public function getRoutes(): array
    {
        array_map(
            function ($route) {
                $this->setRoute(Route::resolve($route));
            },
            $this->config
        );
        return $this->routes;
    }

    /**
     * Returns a transformed route
     *
     * @param  RouteInterface $route
     * @param  RouteInterface $parent
     * @return void
     */
    protected function setRoute(RouteInterface $route, RouteInterface $parent = null): void
    {
        if ($children = $route->getChildren()) {
            array_map(
                function ($child) use ($route) {
                    $child = Route::resolve($child);
                    $child->setParent($route);
                    $this->setRoute($child, $route);
                },
                $children
            );
        }
        if ($route->getController()) {
            $this->routes[] = $route->getProperties();
        }
    }
}
