<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\Middleware\MiddlewareHandlerInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Object\AbstractObject;

/**
 * Middleware Handler
 *
 * Processes a set of middleware and returns a response instance.
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class MiddlewareHandler extends AbstractObject implements RequestHandlerInterface, MiddlewareHandlerInterface
{
    use UsesRequest, UsesResponse;

    /**
     * Array of middleware class namespaces to process
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $middleware
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, array $middleware)
    {
        $this->request = $request;
        $this->response = $response;
        $this->middleware = $middleware;
    }

    /**
     * Runs the middleware stack
     *
     * @return ResponseInterface
     */
    public function run(): ResponseInterface
    {
        return $this->handle($this->request);
    }
    
    /**
     * Processes a middleware instance and returns a response
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        if (count($this->middleware) > 0) {
            $middleware = array_shift($this->middleware);
            return $middleware::resolve()->process($request, $this);
        }
        return $this->response;
    }
}
