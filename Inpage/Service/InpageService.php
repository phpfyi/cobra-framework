<?php

namespace Cobra\Inpage\Service;

use Cobra\Core\Service\Service;
use Cobra\Inpage\Inpage;
use Cobra\Interfaces\Inpage\InpageInterface;

/**
 * Inpage Service
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
class InpageService extends Service
{
    /**
     * Array of inpage reports
     *
     * @var array
     */
    protected $reports = [
        \Cobra\Inpage\Report\InpageAutoloadReport::class,
        \Cobra\Inpage\Report\InpageConfigReport::class,
        \Cobra\Inpage\Report\InpageDatabaseReport::class,
        \Cobra\Inpage\Report\InpageHeadersReport::class,
        \Cobra\Inpage\Report\InpageRouteReport::class,
        \Cobra\Inpage\Report\InpageSessionReport::class,
        \Cobra\Inpage\Report\InpageTagManagerReport::class,
        \Cobra\Inpage\Report\InpageViewReport::class,
    ];

    /**
     * Array of app events
     *
     * @var array
     */
    protected $events = [
        'RouteLoaded' => [
            \Cobra\Inpage\Event\InpageRouteEvent::class
        ],
        'LoadingTemplate' => [
            \Cobra\Inpage\Event\InpageTemplateEvent::class
        ],
        'ControllerBeforeActionComplete' => [
            \Cobra\Inpage\Event\InpageAssetsEvent::class
        ],
        'AfterViewRendered' => [
            \Cobra\Inpage\Event\InpageRenderEvent::class
        ]
    ];

    /**
     * Returns whether the service is enabled
     *
     * @return bool
     */
    public function enabled(): bool
    {
        return env('INPAGE_ENABLED') === true;
    }

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        $this
            ->instance(
                \Cobra\Interfaces\Inpage\InpageInterface::class,
                \Cobra\Inpage\Inpage::class
            );

        $inpage = container_object(
            \Cobra\Interfaces\Inpage\InpageInterface::class
        );

        array_map(function (string $namespace) use ($inpage) {
            $inpage->setReport(
                $namespace::resolve()
            );
        }, $this->reports);
    }
}
