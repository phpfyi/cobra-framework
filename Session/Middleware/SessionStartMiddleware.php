<?php

namespace Cobra\Session\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Interfaces\Session\SessionManagerInterface;
use Cobra\Http\Middleware\Middleware;

/**
 * Session Start Middleware
 *
 * @category  Session
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class SessionStartMiddleware extends Middleware
{
    /**
     * Sets up the request and response sessions
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $manager = container_resolve(
            SessionManagerInterface::class,
            [
                $request,
                env('SESSION_CHANCE'),
                env('SESSION_NAME'),
                env('SESSION_LIFETIME'),
                env('SESSION_PATH'),
                env('SESSION_DOMAIN'),
                env('SESSION_SECURE'),
                env('SESSION_HTTP')
            ]
        );
        $manager->start();

        $request->setSession(
            $manager->getRequestSession()
        );
        $handler->getResponse()->setSession(
            $manager->getResponseSession()
        );
        return $handler->handle($request);
    }
}
