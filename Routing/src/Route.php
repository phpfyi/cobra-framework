<?php

namespace Cobra\Routing;

use Cobra\Interfaces\Routing\RouteInterface;
use Cobra\Object\AbstractObject;

/**
 * Route
 *
 * Object representing a application route
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
class Route extends AbstractObject implements RouteInterface
{
    /**
     * Allowed hostnames for this route
     *
     * @var array
     */
    protected $hostnames = [];

    /**
     * Route name
     *
     * @var string|null
     */
    protected $name = null;

    /**
     * Route path
     *
     * @var string|null
     */
    protected $path = null;

    /**
     * Route controller namespace
     *
     * @var string|null
     */
    protected $controller = null;

    /**
     * Route controller action
     *
     * @var string|null
     */
    protected $action = null;

    /**
     * Route HTTP request method
     *
     * @var string|null
     */
    protected $method = null;

    /**
     * Route controller request validation object namespace
     *
     * @var string|null
     */
    protected $request = null;

    /**
     * Array of child routes
     *
     * @var array
     */
    protected $children = [];

    /**
     * Array of route middleware
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Route name
     *
     * @var array
     */
    protected $guards = [];

    /**
     * Sets the Route object properties from an array.
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        array_map(
            function ($property, $value) {
                $this->$property = $value;
            },
            array_keys($properties),
            $properties
        );
    }

    /**
     * Merges a parent route configuration to this route
     *
     * @param  RouteInterface $parent
     * @return void
     */
    public function setParent(RouteInterface $parent): void
    {
        $this->path = $parent->getPath().$this->getPath();
        $this->hostnames = array_merge($parent->getHostnames(), $this->hostnames);
        $this->middleware = array_merge($parent->getMiddleware(), $this->middleware);
        $this->guards = array_merge($parent->getGuards(), $this->guards);
    }

    /**
     * Returns an array of class properties
     *
     * @return array
     */
    public function getProperties(): array
    {
        return [
            'hostnames' => $this->hostnames,
            'name' => $this->name,
            'path' => $this->path,
            'controller' => $this->controller,
            'action' => $this->action,
            'method' => $this->method,
            'request' => $this->request,
            'children' => $this->children,
            'middleware' => $this->middleware,
            'guards' => $this->guards
        ];
    }

    /**
     * Returns an array of allowed route hostnames
     *
     * @return array
     */
    public function getHostnames(): array
    {
        return (array) $this->hostnames;
    }

    /**
     * Returns the route name
     *
     * @return string|null
     */
    public function getName():? string
    {
        return $this->name;
    }

    /**
     * Returns the route path
     *
     * @return string|null
     */
    public function getPath():? string
    {
        return $this->path;
    }

    /**
     * Returns the route controller namespace
     *
     * @return string|null
     */
    public function getController():? string
    {
        return $this->controller;
    }

    /**
     * Returns the route controller action
     *
     * @return string|null
     */
    public function getAction():? string
    {
        return $this->action;
    }

    /**
     * Returns the route controller action
     *
     * @return string|null
     */
    public function getMethod():? string
    {
        return $this->action;
    }

    /**
     * Returns the route controller request validation object namespace
     *
     * @return string|null
     */
    public function getRequest():? string
    {
        return $this->request;
    }

    /**
     * Returns an array of child routes
     *
     * @return array
     */
    public function getChildren(): array
    {
        return (array) $this->children;
    }

    /**
     * Returns an array of route middleware
     *
     * @return array
     */
    public function getMiddleware(): array
    {
        return (array) $this->middleware;
    }

    /**
     * Returns an array of route guards
     *
     * @return array
     */
    public function getGuards(): array
    {
        return $this->guards;
    }
}
