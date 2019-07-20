<?php

namespace Cobra\Interfaces\Inpage\Report;

/**
 * Inpage Report interface
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
interface InpageReportInterface
{
    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string;
}
