<?php

namespace Cobra\Page\Service;

use Cobra\Core\Service\Service;

/**
 * Page Service
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
class PageService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Page\PageInterface::class,
                \Cobra\Page\Page::class
            )->namespace(
                \Cobra\Interfaces\Page\Sitemap\XMLSitemapBuilderInterface::class,
                \Cobra\Page\Sitemap\XMLSitemapBuilder::class
            );
    }
}
