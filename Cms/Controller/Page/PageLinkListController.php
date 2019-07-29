<?php

namespace Cobra\Cms\Controller\Page;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Controller\Controller;
use Cobra\Http\Stream\JsonStream;
use Cobra\Page\Page;

/**
 * HTML Field Link List Controller
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
class PageLinkListController extends Controller
{
    /**
     * Array of HTML page links
     *
     * @var array
     */
    protected $links = [];

    /**
     * Returns a tiny MCE link list
     *
     * @param  RequestInterface $request
     * @return JsonStream
     */
    public function index(RequestInterface $request):? JsonStream
    {
        if (!$request->isAjax()) {
            return null;
        }
        array_map(
            function ($page) {
                $this->links[] = [
                    'title' => $page->title,
                    'value' => $page->segment
                ];
            },
            iterator_to_array(Page::get()->sort('title')->all())
        );

        return output()->json($this->links);
    }
}
