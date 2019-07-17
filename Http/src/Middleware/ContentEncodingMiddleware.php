<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;

/**
 * Content Encoding Middleware
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
class ContentEncodingMiddleware extends Middleware
{
    /**
     * Enables gzip compression on a response if supported
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($encoding = $request->getServerParam('HTTP_ACCEPT_ENCODING')) {
            if (strpos($encoding, 'gzip') !== false) {
                ob_start('ob_gzhandler');
            }
        }
        return $handler->handle($request);
    }
}
