<?php

namespace Cobra\Interfaces\Inpage;

use Cobra\Interfaces\Inpage\Report\InpageReportInterface;

/**
 * Inpage interface
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
interface InpageInterface
{
    /**
     * Sets an inpage report instannce.
     *
     * @param InpageReportInterface $report
     * @return InpageInterface
     */
    public function setReport(InpageReportInterface $report): InpageInterface;

    /**
     * Returns an inpage report instance.
     *
     * @param string $name
     * @return InpageReportInterface
     */
    public function getReport(string $name): InpageReportInterface;

    /**
     * Returns an array of all the inpage report instances.
     *
     * @return array
     */
    public function getReports(): array;

    /**
     * Returns the application end time.
     *
     * @return float
     */
    public function getEnd(): float;
}