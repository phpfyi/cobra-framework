<?php

namespace Cobra\Cms\Controller\DataTable;

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
     * @return void
     */
    public function action()
    {
        if ($relation = $this->parser->getManyRelation()) {
            $relation->remove($this->id);
        }
        $record = $this->class::find('id', $this->id);
        $record->delete();

        $data = $relation ? $relation->get() : $this->class::get()->all();

        $this->setTableResponse($record, $data);
    }
}
