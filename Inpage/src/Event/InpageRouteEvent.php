<?php

namespace Cobra\Inpage\Event;

use Cobra\Inpage\Report\InpageRouteReport;
use Cobra\Interfaces\Routing\RouteInterface;

/**
 * Inpage Route Event
 *
 * @category  Inpage
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class InpageRouteEvent extends InpageEvent
{
    /**
     * Sets the route on the inpage route report
     *
     * @param RouteInterface $route
     * @return void
     */
    public function handle(RouteInterface $route): void
    {
        $this->inpage->getReport(InpageRouteReport::class)->setRoute($route);
    }
}
