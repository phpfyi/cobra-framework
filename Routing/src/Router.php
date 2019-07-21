<?php

namespace Cobra\Routing;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\Middleware\MiddlewareHandlerInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Interfaces\Routing\RouteInterface;
use Cobra\Interfaces\Routing\RouterInterface;
use Cobra\Interfaces\Routing\Factory\RouteControllerFactoryInterface;
use Cobra\Event\Traits\EventEmitter;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Object\AbstractObject;
use Cobra\Routing\Traits\CanProcessResponse;

/**
 * Router
 *
 * Handles the matching of the request URI against a route.
 *
 * Runs the application / route middleware, and route guard checks before
 * handing off control to the matched controller.
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
class Router extends AbstractObject implements RouterInterface, RequestHandlerInterface
{
    use EventEmitter, UsesRequest, UsesResponse, CanProcessResponse;

    /**
     * Route instance
     *
     * @var Route
     */
    protected $route;
    
    /**
     * Array of application middleware
     *
     * @var array
     */
    protected $middleware = [];
    
    /**
     * Sets the required properties
     *
     * @param ResponseInterface $response
     * @param array             $middleware
     */
    public function __construct(ResponseInterface $response, array $middleware)
    {
        $this->response = $response;
        $this->middleware = $middleware;
    }

    /**
     * Returns the matched ruote instance.
     *
     * @return RouteInterface
     */
    public function getRoute(): RouteInterface
    {
        return $this->route;
    }

    /**
     * Handles the routing request.
     *
     * Processes the app middleware, matches the route, processes the route
     * guards and route middelware.
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $this->setRequest($request);

        if (!$this->processMiddleware()) {
            return $this->response;
        }
        if (!$this->processRouteMatchers()) {
            return $this->response->withStatus(404);
        }
        if (!$this->processRouteGuards()) {
            return $this->response;
        }
        if (!$this->processMiddleware()) {
            return $this->response;
        }
        return container_resolve(
            RouteControllerFactoryInterface::class,
            [
                $this
            ]
        )->getResponse();
    }

    /**
     * Runs a middleware stack handler
     *
     * @return boolean
     */
    protected function processMiddleware(): bool
    {
        $this->response = container_resolve(
            MiddlewareHandlerInterface::class,
            [
                $this->request,
                $this->response,
                $this->middleware
            ]
        )->run();

        return $this->canProcess($this->response);
    }

    /**
     * Runs the route matchers to find the route to use
     *
     * @return boolean
     */
    protected function processRouteMatchers(): bool
    {
        foreach (static::config('matchers') as $namespace) {
            $matcher = $namespace::resolve(
                $this->request->getUri()
            );
            if ($matcher->hasMatch()) {
                $this->route = $matcher->getRoute();
                $this->middleware = $this->route->getMiddleware();

                $this->emit('RouteLoaded', $this->route);
                return true;
            }
        }
        return false;
    }

    /**
     * Runs the route guards for route access control
     *
     * @return boolean
     */
    protected function processRouteGuards(): bool
    {
        foreach ($this->route->getGuards() as $namespace) {
            $guard = $namespace::resolve($this->route);
            if (!$guard->canActivate()) {
                $this->response = $guard->getResponse();
                return false;
            }
        }
        return true;
    }
}
