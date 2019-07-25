<?php

namespace Cobra\Interfaces\Http\Middleware;

use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Middleware Handler Interface
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
interface MiddlewareHandlerInterface
{
    /**
     * Runs the middleware stack
     *
     * @return ResponseInterface
     */
    public function run(): ResponseInterface;
}
