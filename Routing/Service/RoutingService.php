<?php

namespace Cobra\Routing\Service;

use Cobra\Core\Service\Service;

/**
 * Routing Service
 *
 * @category  Routing
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RoutingService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Routing\RouterInterface::class,
                \Cobra\Routing\Router::class
            )->namespace(
                \Cobra\Interfaces\Routing\RouteInterface::class,
                \Cobra\Routing\Route::class
            )->namespace(
                \Cobra\Interfaces\Routing\RouteDispatcherInterface::class,
                \Cobra\Routing\RouteDispatcher::class
            )->namespace(
                \Cobra\Interfaces\Routing\Factory\RouteFactoryInterface::class,
                \Cobra\Routing\Factory\RouteFactory::class
            );
    }
}
