<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\Middleware\MiddlewareInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Object\AbstractObject;

/**
 * Middleware
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
abstract class Middleware extends AbstractObject implements MiddlewareInterface
{
    /**
     * Processes the request
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    abstract public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface;
}
