<?php

namespace Cobra\Inpage\Report;

use Cobra\Event\EventHandler;

/**
 * Inpage Events Report
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
class InpageEventsReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageEventsReport';

    /**
     * EventHandler instance
     *
     * @var EventHandler
     */
    protected $handler;

    /**
     * Sets the required properties
     *
     * @param EventHandler $handler
     */
    public function __construct(EventHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Events';
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
            'events' => $this->handler->getFired()
        ];
    }
}
