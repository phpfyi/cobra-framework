<?php

namespace Cobra\Inpage;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Inpage\InpageInterface;
use Cobra\Interfaces\Inpage\Report\InpageReportInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Object\AbstractObject;
use Cobra\View\Traits\RendersTemplate;

/**
 * Inpage
 *
 * Application reporting class which collects and outputs data on a variety
 * of features to a powerful and easy to use browser interface.
 *
 * The reports can be used to optimise the application startup, debug problems,
 * inspect things like requests and sessions and generally improve the overall
 * application experience and state.
 *
 * While not a substitute for proper testing and debugging it can help identify
 * the sequence of events that lead to a particular state such as showing the
 * order of class and configuration loading.
 *
 * The main reports are:
 * - Classes
 * - Headers
 * - Session
 * - Statements
 * - Configuration
 * - Templates
 * - Route
 * - DataLayer
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
class Inpage extends AbstractObject implements InpageInterface, ViewObject
{
    use UsesRequest, UsesResponse, RendersTemplate;

    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Inpage';

    /**
     * The application start time
     *
     * @var float
     */
    protected $start = 0.0;

    /**
     * Array of inpage reports
     *
     * @var array
     */
    protected $reports = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->start = APP_START;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Sets an inpage report instannce.
     *
     * @param InpageReportInterface $report
     * @return InpageInterface
     */
    public function setReport(InpageReportInterface $report): InpageInterface
    {
        $this->reports[] = $report;
        return $this;
    }

    /**
     * Returns an inpage report instance.
     *
     * @param string $name
     * @return InpageReportInterface
     */
    public function getReport(string $name): InpageReportInterface
    {
        foreach ($this->reports as $report) {
            if (get_class($report) === $name) {
                return $report;
            }
        }
    }

    /**
     * Returns an array of all the inpage report instances.
     *
     * @return array
     */
    public function getReports(): array
    {
        return $this->reports;
    }

    /**
     * Returns the application end time.
     *
     * @return float
     */
    public function getEnd(): float
    {
        return subtract_microtime($this->start, microtime());
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'reports'  => $this->getReports(),
            'end_time' => $this->getEnd(),
            'hostname' => $this->getRequest()->getUri()->getHost()
        ];
    }
}
