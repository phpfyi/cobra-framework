<?php

namespace Cobra\Inpage\Report;

use Cobra\Gtm\Gtm;

/**
 * Inpage Tag Manager Report
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
class InpageTagManagerReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageTagManagerReport';

    /**
     * Google Tag Manager instance
     *
     * @var string
     */
    protected $gtm;

    /**
     * Sets the required properties
     *
     * @param Gtm $gtm
     */
    public function __construct(Gtm $gtm)
    {
        $this->gtm = $gtm;
    }

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Tag Manager';
    }

    /**
     * Returns the GTM instance
     *
     * @return string
     */
    public function getGtm():? Gtm
    {
        return $this->gtm;
    }
}
