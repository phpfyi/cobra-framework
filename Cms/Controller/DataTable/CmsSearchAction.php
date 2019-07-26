<?php

namespace Cobra\Cms\Controller\DataTable;

use Cobra\Http\Stream\HtmlStream;

/**
 * CMS Search Action Controller
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
class CmsSearchAction extends CmsAction
{
    /**
     * Array of search list item
     *
     * @var array
     */
    protected $list = [];

    /**
     * Searches a list and returns a result set
     *
     * @return void
     */
    public function action()
    {
        foreach ($this->request->postVar('search-class')::get()->all() as $record) {
            $this->list[] = sprintf(
                '<li data-id="%s">%s</li>',
                $record->id,
                $record->title
            );
        }
        $this->setResponseBody(HtmlStream::resolve(), implode($this->list));
    }
}
