<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Http\Middleware\Middleware;

/**
 * Cms Allowed IPs Middleware
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class CmsAllowedIpsMiddleware extends Middleware
{
    /**
     * Array of allowed IPs
     *
     * @var array
     */
    protected $ips = [];

    /**
     * Sets the required properties
     */
    public function __construct()
    {
        $this->ips = (array) env('CMS_ALLOWED_IPS');
    }

    /**
     * Returns a 403 forbidden response if not allowed CMS access
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!empty($this->ips) && !in_array($request->getIP(), $this->ips)) {
            return http_forbidden_response($handler);
        }
        return $handler->handle($request);
    }
}
