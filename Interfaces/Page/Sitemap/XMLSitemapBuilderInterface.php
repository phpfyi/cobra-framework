<?php

namespace Cobra\Interfaces\Page\Sitemap;

/**
 * XML Sitemap Builder Interface
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface XMLSitemapBuilderInterface
{
    /**
     * Returns the sitemap XML
     *
     * @return string
     */
    public function getXML(): string;
}
