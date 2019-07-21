<?php

namespace Cobra\Routing\Matcher;

use Cobra\Interfaces\Http\Uri\RequestUriInterface;
use Cobra\Interfaces\Routing\Matcher\RouteMatcherInterface;
use Cobra\Interfaces\Routing\RouteInterface;
use Cobra\Object\AbstractObject;

/**
 * Route Matcher
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
abstract class RouteMatcher extends AbstractObject implements RouteMatcherInterface
{
    /**
     * RouteInterface instance
     *
     * @var RouteInterface
     */
    protected $route;

    /**
     * Request URI path
     *
     * @var string
     */
    protected $path;

    /**
     * Request URI hostname
     *
     * @var string
     */
    protected $host;

    /**
     * Sets the required properties
     *
     * @param RequestUriInterface $uri
     */
    public function __construct(RequestUriInterface $uri)
    {
        $this->path = $uri->getPath();
        $this->host = $uri->getHost();
    }

    /**
     * Returns the matched route.
     *
     * @return RouteInterface
     */
    public function getRoute(): RouteInterface
    {
        return $this->route;
    }

    /**
     * Returns whether there is a matched route.
     *
     * @return boolean
     */
    abstract public function hasMatch(): bool;
}
