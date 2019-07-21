<?php

namespace Cobra\Page\Routing;

use Cobra\Interfaces\Page\PageInterface;
use Cobra\Interfaces\Page\Routing\PageRouteInterface;
use Cobra\Routing\Route;

/**
 * Page Route
 *
 * Route instance with page record property
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
class PageRoute extends Route implements PageRouteInterface
{
    /**
     * PageInterface instance
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Returns an array of class properties
     *
     * @return array
     */
    public function getProperties(): array
    {
        return array_merge(
            parent::getProperties(),
            [
                'page' => json_encode($this->page, JSON_PRETTY_PRINT),
            ]
        );
    }
    
    /**
     * Returns the Page instance
     *
     * @return PageInterface
     */
    public function getPage(): PageInterface
    {
        return $this->page;
    }
}
