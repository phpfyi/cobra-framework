<?php

namespace Cobra\Cms\Controller\Page;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Controller\Controller;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Page\Page;

/**
 * Page Segment Controller
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
class PageSegmentController extends Controller
{
    /**
     * Default controller action
     *
     * @param  RequestInterface $request
     * @param HtmlStream $htmlStream
     * @return void
     */
    public function index(RequestInterface $request, HtmlStream $htmlStream): void
    {
        if (!$request->isAjax()) {
            return;
        }

        $parent = Page::get()->column('segment')->where('id', '=', $request->postVar('id'))->one();
        $segment = $parent ? $parent->segment : '';

        $this->setResponseBody($htmlStream, $segment);
    }
}
