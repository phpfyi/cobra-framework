<?php

namespace Cobra\Interfaces\Routing\Matcher;

use Cobra\Interfaces\Routing\RouteInterface;

/**
 * Route Matcher Interface
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
interface RouteMatcherInterface
{
    /**
     * Returns the matched route.
     *
     * @return RouteInterface
     */
    public function getRoute(): RouteInterface;

    /**
     * Returns whether there is a matched route.
     *
     * @return boolean
     */
    public function hasMatch(): bool;
}
