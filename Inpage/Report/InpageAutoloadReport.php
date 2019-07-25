<?php

namespace Cobra\Inpage\Report;

use Cobra\Autoloader\Log\AutoloaderLogger;

/**
 * Inpage Autoload Report
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
class InpageAutoloadReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageAutoloadReport';

    /**
     * Array of loaded classes
     *
     * @var array
     */
    protected $classes = [];

    /**
     * Autoloader logger instance
     *
     * @var AutoloaderLogger
     */
    protected $logger;

    /**
     * Sets the required properties
     *
     * @param AutoloaderLogger $logger
     */
    public function __construct(AutoloaderLogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Classes';
    }

    /**
     * Returns the autoloader logger instance
     *
     * @return AutoloaderLogger
     */
    public function getAutoloaderLogger(): AutoloaderLogger
    {
        return $this->logger;
    }
}
