<?php

namespace Cobra\Http\Service;

use Cobra\Core\Service\Service;

/**
 * HTTP Service
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
class HttpService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Http\Middleware\MiddlewareHandlerInterface::class,
            \Cobra\Http\Middleware\MiddlewareHandler::class
        );
    }
}
