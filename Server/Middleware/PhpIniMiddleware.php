<?php

namespace Cobra\Server\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Interfaces\Server\ServerInterface;
use Cobra\Http\Middleware\Middleware;

/**
 * PHP ini Middleware
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PhpIniMiddleware extends Middleware
{
    /**
     * ServerInterface instance
     *
     * @var ServerInterface
     */
    protected $server;

    /**
     * Sets the required proeprties
     *
     * @param ServerInterface $server
     */
    public function __construct(ServerInterface $server)
    {
        $this->server = $server;
    }

    /**
     * Sets up the request and response sessions
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->server
            ->ini('session.cookie_lifetime', env('SESSION_LIFETIME'))
            ->ini('session.gc_maxlifetime', env('SESSION_LIFETIME'))
            ->ini('session.cookie_secure', env('SESSION_SECURE'))
            ->ini('session.cookie_httponly', env('SESSION_HTTP_ONLY'));
        
        return $handler->handle($request);
    }
}
