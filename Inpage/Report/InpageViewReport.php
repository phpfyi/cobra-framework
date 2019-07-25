<?php

namespace Cobra\Inpage\Report;

/**
 * Inpage View Report
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
class InpageViewReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageViewReport';

    /**
     * Array of loaded templates
     *
     * @var array
     */
    protected $templates = [];

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'View';
    }

    /**
     * Adds a loaded template
     *
     * @param  string $template
     * @return InpageViewReport
     */
    public function addTemplate(string $template): InpageViewReport
    {
        $this->templates[] = $template;
        return $this;
    }

    /**
     * Returns the array of loaded templates
     *
     * @return array
     */
    public function getTemplates(): array
    {
        return $this->templates;
    }
}
