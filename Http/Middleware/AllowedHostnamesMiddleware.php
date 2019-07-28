<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;

/**
 * Allowed Hostnames Middleware
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
class AllowedHostnamesMiddleware extends Middleware
{
    /**
     * Array of hostnames
     *
     * @var array
     */
    protected $hostnames = [];

    /**
     * Sets the required properties
     */
    public function __construct()
    {
        $this->hostnames = (array) env('VALID_HOSTNAMES');
    }

    /**
     * Returns a 403 forbidden response if not allowed hostname
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!empty($this->hostnames) && !in_array($request->getUri()->getHost(), $this->hostnames)) {
            return http_forbidden_response($handler);
        }
        return $handler->handle($request);
    }
}
