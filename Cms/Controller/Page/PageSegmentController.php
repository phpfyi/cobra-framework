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
     * @return HtmlStream
     */
    public function index(RequestInterface $request):? HtmlStream
    {
        $parent = Page::get()->column('segment')->where('id', '=', $request->postVar('id'))->one();
        $segment = $parent ? $parent->segment : '';

        return output()->html($segment);
    }
}
