<?php

namespace Cobra\Interfaces\Page\Routing;

use Cobra\Interfaces\Page\PageInterface;

/**
 * Page Route Interface
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
interface PageRouteInterface
{
    /**
     * Returns the Page instance
     *
     * @return PageInterface
     */
    public function getPage(): PageInterface;
}
