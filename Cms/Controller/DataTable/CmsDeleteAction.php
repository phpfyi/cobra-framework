<?php

namespace Cobra\Cms\Controller\DataTable;

use Cobra\Http\Stream\HtmlStream;

/**
 * CMS Delete Action Controller
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
class CmsDeleteAction extends CmsAction
{
    /**
     * Deletes a CMS record
     *
     * @return HtmlStream
     */
    public function action(): HtmlStream
    {
        if ($relation = $this->parser->getManyRelation()) {
            $relation->remove($this->id);
        }
        $record = $this->class::find('id', $this->id);
        $record->delete();

        $data = $relation ? $relation->get() : $this->class::get()->all();

        return $this->getTableResponse($record, $data);
    }
}
