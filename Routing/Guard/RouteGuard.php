<?php

namespace Cobra\Routing\Guard;

use Cobra\Interfaces\Auth\AuthInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Routing\RouteInterface;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Object\AbstractObject;

/**
 * Route Guard
 *
 * Abstract base class to protect routes from being activated / vistited.
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
abstract class RouteGuard extends AbstractObject
{
    use UsesResponse, UsesRequest;

    /**
     * RouteInterface instance
     *
     * @var RouteInterface
     */
    protected $route;

    /**
     * AuthInterface instance
     *
     * @var AuthInterface
     */
    protected $auth;

    /**
     * Sets the required properties
     *
     * @param RouteInterface $route
     * @param AuthInterface $auth
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        RouteInterface $route,
        AuthInterface $auth,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $this->route = $route;
        $this->auth = $auth;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Returns whether the current route can be activated.
     *
     * @return boolean
     */
    abstract public function canActivate(): bool;
}
