<?php

namespace Cobra\Inpage\Report;

use Cobra\Config\Config;

/**
 * Inpage Config Report
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
class InpageConfigReport extends InpageReport
{
    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageConfigReport';

    /**
     * Config instance
     *
     * @var Config
     */
    protected $config;

    /**
     * Setes the required properties
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Config';
    }

    /**
     * Returns the array of loaded configuration
     *
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->config->getStore()->loaded();
    }
}
