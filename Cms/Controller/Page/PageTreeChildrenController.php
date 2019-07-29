<?php

namespace Cobra\Cms\Controller\Page;

use Iterator;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Controller\Controller;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Page\Page;

/**
 * CMS Page Tree Children Controller
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
class PageTreeChildrenController extends Controller
{
    /**
     * Default controller action
     *
     * @param  RequestInterface $request
     * @return HtmlStream
     */
    public function index(RequestInterface $request):? HtmlStream
    {
        if (!$request->isAjax()) {
            return null;
        }
        $data = container_resolve(ViewDataInterface::class)
            ->set('children', $this->getChildren($request->postVar('id')))
            ->withTemplate('apps.cms.view.includes.tree');
            
        return output()->html($data);
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
