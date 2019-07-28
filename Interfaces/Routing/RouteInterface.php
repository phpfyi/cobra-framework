<?php

namespace Cobra\Interfaces\Routing;

/**
 * Route Interface
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
interface RouteInterface
{
    /**
     * Merges a parent route configuration to this route
     *
     * @param  Route $parent
     * @return void
     */
    public function setParent(RouteInterface $parent): void;

    /**
     * Returns an array of class properties
     *
     * @return array
     */
    public function getProperties(): array;

    /**
     * Returns an array of allowed route hostnames
     *
     * @return array
     */
    public function getHostnames(): array;

    /**
     * Returns the route name
     *
     * @return string|null
     */
    public function getName():? string;

    /**
     * Returns the route path
     *
     * @return string|null
     */
    public function getPath():? string;

    /**
     * Returns the route controller namespace
     *
     * @return string|null
     */
    public function getController():? string;

    /**
     * Returns the route controller action
     *
     * @return string|null
     */
    public function getAction():? string;

    /**
     * Returns the route controller action
     *
     * @return string|null
     */
    public function getMethod():? string;

    /**
     * Returns the route controller request validation object namespace
     *
     * @return string|null
     */
    public function getRequest():? string;

    /**
     * Returns an array of child routes
     *
     * @return array
     */
    public function getChildren(): array;

    /**
     * Returns an array of route middleware
     *
     * @return array
     */
    public function getMiddleware(): array;

    /**
     * Returns an array of route guards
     *
     * @return array
     */
    public function getGuards(): array;
}
