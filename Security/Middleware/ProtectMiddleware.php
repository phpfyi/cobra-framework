<?php

namespace Cobra\Security\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Http\Middleware\Middleware;

/**
 * Protect Middleware
 *
 * @category  Security
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ProtectMiddleware extends Middleware
{
    /**
     * Array of request validators
     *
     * @var array
     */
    protected $validators = [
        \Cobra\Security\Validator\IpAddressValidator::class,
        \Cobra\Security\Validator\HostnameValidator::class,
        \Cobra\Security\Validator\RefererValidator::class
    ];

    /**
     * Returns a 403 forbidden response for disallowed items
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        foreach ($this->validators as $namespace) {
            if (!$namespace::resolve()->validate($request)) {
                return http_forbidden_response($this);
            }
        }
        return $handler->handle($request);
    }
}
