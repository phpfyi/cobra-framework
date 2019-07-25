<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;

/**
 * HTTP Headers Middleware
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
class HttpHeadersMiddleware extends Middleware
{
    /**
     * Enables default headers set through the framework / user config files
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $headers = config('headers');
        array_map(
            function ($name, $value) use ($handler) {
                $handler->getResponse()->addHeader($name, $value);
            },
            array_keys($headers),
            $headers
        );
        
        return $handler->handle($request);
    }
}
