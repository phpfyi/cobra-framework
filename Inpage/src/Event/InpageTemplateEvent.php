<?php

namespace Cobra\Inpage\Event;

use Cobra\Inpage\Report\InpageViewReport;

/**
 * Inpage Template Event
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
class InpageTemplateEvent extends InpageEvent
{
    /**
     * Sets a template on the page view report
     *
     * @param string $template
     * @return void
     */
    public function handle(string $template): void
    {
        $this->inpage->getReport(InpageViewReport::class)->addTemplate($template);
    }
}
