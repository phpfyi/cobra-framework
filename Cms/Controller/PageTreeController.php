<?php

namespace Cobra\Cms\Controller;

use Iterator;
use Cobra\Cms\Controller\AppController;
use Cobra\Page\Page;

/**
 * CMS Page Tree Controller
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PageTreeController extends AppController
{
    /**
     * Controller setup method
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();

        view()
            ->setPage('apps.cms.view.page.tree')
            ->setData('children', $this->getChildren(0));
    }

    /**
     * Returns the child pages of a page
     *
     * @param  integer $parentID
     * @return Iterator
     */
    public function getChildren(int $parentID): Iterator
    {
        return Page::get()->where('parentID', '=', $parentID)->all();
    }
}
