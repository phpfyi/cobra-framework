<?php

namespace Cobra\Inpage\Report;

use Cobra\Interfaces\Routing\RouteInterface;

/**
 * Inpage Route Report
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
class InpageRouteReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageRouteReport';

    /**
     * Loaded route instance
     *
     * @var RouteInterface
     */
    protected $route;

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Route';
    }

    /**
     * Sets the loaded route
     *
     * @param  RouteInterface $route
     * @return InpageRouteReport
     */
    public function setRoute(RouteInterface $route): InpageRouteReport
    {
        $this->route = $route;
        return $this;
    }
    
    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'name' => $this->getName(),
            'route' => $this->route ? $this->route->getProperties() : []
        ];
    }
}
