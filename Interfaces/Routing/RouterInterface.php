<?php

namespace Cobra\Interfaces\Routing;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Routing\RouteInterface;

/**
 * Router Interface
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
interface RouterInterface
{
    /**
     * Returns the matched ruote instance.
     *
     * @return RouteInterface
     */
    public function getRoute(): RouteInterface;

    /**
     * Handles the routing request.
     *
     * Processes the app middleware, matches the route, processes the route
     * guards and route middelware.
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface;
}
