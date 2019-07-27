<?php

namespace Cobra\Inpage\Report;

use Cobra\Interfaces\Inpage\Report\InpageReportInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Object\AbstractObject;
use Cobra\View\Traits\RendersTemplate;

/**
 * Inpage Report
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
abstract class InpageReport extends AbstractObject implements InpageReportInterface, ViewObject
{
    use RendersTemplate;

    /**
     * Returns the report name
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Returns an array of view data
     *
     * @return array
     */
    abstract public function getViewData(): array;
}
