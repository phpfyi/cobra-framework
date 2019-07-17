<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;

/**
 * Redirect trailing URL / Middleware
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
class RedirectSlashMiddleware extends Middleware
{
    /**
     * Processes the HTTP request and returns a response
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getUri()->endsWithSlash() && env('FORCE_SLASH') !== true) {
            return http_redirect_response(
                $handler,
                $request->getUri()->withPath(
                    substr($request->getUri()->getPath(), 0, -1)
                )
            );
        }
        return $handler->handle($request);
    }
}
