<?php

namespace Cobra\Inpage\Report;

use Cobra\Database\Log\DatabaseQueryLogger;

/**
 * Inpage Database Report
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
class InpageDatabaseReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageDatabaseReport';

    /**
     * Database logger instance
     *
     * @var DatabaseQueryLogger
     */
    protected $logger;

    /**
     * Setes the required properties
     *
     * @param DatabaseQueryLogger $logger
     */
    public function __construct(DatabaseQueryLogger $logger)
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
        return 'Database';
    }

    /**
     * Returns the database query logger instance
     *
     * @return DatabaseQueryLogger
     */
    public function getDatabaseQueryLogger(): DatabaseQueryLogger
    {
        return $this->logger;
    }
}
