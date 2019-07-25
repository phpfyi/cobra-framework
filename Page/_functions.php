<?php

use Cobra\Controller\Controller;
use Cobra\Interfaces\Page\PageInterface;
use Cobra\Page\Controller\PageController;
use Cobra\Page\Page;
use Cobra\Page\PageBlock;

/**
 * Page function sets
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

if (! function_exists('parent_path')) {
    /**
     * Returns the parent page path
     *
     * @param PageInterface $page
     * @return string
     */
    function parent_path(PageInterface $page): string
    {
        if (!$page->parentID) {
            return '';
        }
        $parent = Page::get()->column('segment')->where('id', '=', $page->parentID)->one();
        return $parent ? $parent->segment : '';
    }
}

if (! function_exists('page_controllers')) {
    /**
     * Returns an array of controller class options.
     *
     * @return array
     */
    function page_controllers(): array
    {
        return array_combine_from(subclasses(PageController::class, true));
    }
}

if (! function_exists('page_classes')) {
    /**
     * Returns an array of page class options
     *
     * @return array
     */
    function page_classes(): array
    {
        return array_combine_from(subclasses(Page::class));
    }
}

if (! function_exists('page_block_classes')) {
    /**
     * Returns a list of all PageBlock instance classes
     *
     * @return array
     */
    function page_block_classes(): array
    {
        $data = [];
        array_map(
            function ($namespace) use (&$data) {
                $record = new $namespace;
                $data[$record->getTable()] = $record;
            },
            subclasses(PageBlock::class)
        );
        return $data;
    }
}
