<?php

namespace Cobra\Page\Routing;

use Cobra\Interfaces\Page\PageInterface;
use Cobra\Page\Routing\PageRoute;
use Cobra\Routing\Matcher\RouteMatcher;

/**
 * Route Page Matcher
 *
 * Attempts to match a route to a database page record.
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
class PageRouteMatcher extends RouteMatcher
{
    /**
     * PageInterface instance
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Returns whether there is a matched route
     *
     * @return boolean
     */
    public function hasMatch(): bool
    {
        $this->page = container_resolve(PageInterface::class)
            ->find('segment', $this->getPagePath()) ?: null;

        if (!$this->page) {
            return false;
        }
        if (in_array($this->host, env('WEBSITE_HOSTNAMES'))) {
            $this->setPageRoute($this->page->controller);
            return true;
        }
        if (in_array($this->host, env('AMP_HOSTNAMES'))) {
            $this->setPageRoute($this->page->amp_controller);
            return true;
        }
        return false;
    }

    /**
     * Returns the request page path
     *
     * @return string
     */
    private function getPagePath(): string
    {
        return $this->path == '/' ? '/home' : $this->path;
    }

    /**
     * Sets the page route instance
     *
     * @param string $controller
     * @return void
     */
    private function setPageRoute(string $controller): void
    {
        $this->route = PageRoute::resolve(
            [
                'controller' => $controller,
                'page' => $this->page
            ]
        );
    }
}
