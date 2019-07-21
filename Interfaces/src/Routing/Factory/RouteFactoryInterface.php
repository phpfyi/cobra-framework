<?php

namespace Cobra\Interfaces\Routing\Factory;

/**
 * Route interface
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
interface RouteFactoryInterface
{
    /**
     * Returns the transformed routes
     *
     * @return array
     */
    public function getRoutes(): array;
}
