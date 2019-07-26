<?php

namespace Cobra\Cms\Controller\DataTable;

/**
 * CMS Sort Action Controller
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
class CmsSortAction extends CmsAction
{
    /**
     * Sorts a relation list
     *
     * @return void
     */
    public function action()
    {
        $relation = $this->parser->getManyRelation();
        array_map(
            function ($record) use ($relation) {
                $record = (object) $record;
                $relation->sort(
                    $record->id,
                    $record->sort
                );
            },
            $this->request->postVar('records')
        );
        $this->setTableResponse(
            singleton($this->parser->getManyRelationClass()),
            $relation->get()
        );
    }
}
