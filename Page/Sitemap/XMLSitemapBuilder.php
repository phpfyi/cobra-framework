<?php

namespace Cobra\Page\Sitemap;

use DOMDocument;
use Cobra\Interfaces\Page\PageInterface;

/**
 * XML Sitemap Builder
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
class XMLSitemapBuilder
{
    /**
     * Array of sitemap Page models
     *
     * @var array
     */
    protected $pages = [];

    /**
     * DOMDocument instance
     *
     * @var DOMDocument
     */
    protected $dom;

    /**
     * <urlset> DOMElement
     *
     * @var DOMElement
     */
    protected $urlset;

    /**
     * Sets the page model array
     *
     * @param array $pages
     */
    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    /**
     * Returns the sitemap XML
     *
     * @return string
     */
    public function getXML(): string
    {
        $this->dom = new DOMDocument('1.0', "UTF-8");
        $this->dom->formatOutput = true;

        $this->createUrlset();
        
        array_map(
            function ($page) {
                $this->createUrl($page);
            },
            $this->pages
        );

        $this->dom->appendChild($this->urlset);

        return $this->dom->saveHTML();
    }

    /**
     * Creates the sitemap <urlset>
     *
     * @return void
     */
    protected function createUrlset(): void
    {
        $this->urlset = $this->dom->createElement('urlset');

        $attribute = $this->dom->createAttribute('xmlns');
        $attribute->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $this->urlset->appendChild($attribute);

        $attribute = $this->dom->createAttribute('xmlns:image');
        $attribute->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $this->urlset->appendChild($attribute);
    }

    /**
     * Creates a sitemap <url>
     *
     * @param  PageInterface $page
     * @return void
     */
    protected function createUrl(PageInterface $page): void
    {
        $url = $this->dom->createElement('url');
        $url->appendChild(
            $this->dom->createElement('loc', $page->getAbsoluteURL())
        );
        $url->appendChild(
            $this->dom->createElement('lastmod', date('c', strtotime($page->updated)))
        );
        $url->appendChild(
            $this->dom->createElement('changefreq', $page->change_frequency)
        );
        $url->appendChild(
            $this->dom->createElement('priority', $page->priority)
        );
        $this->urlset->appendChild($url);
    }
}
