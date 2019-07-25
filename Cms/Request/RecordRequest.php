<?php

namespace Cobra\Cms\Request;

use Cobra\Cms\Traits\RecordRequestFoundation;
use Cobra\Form\FormRequest;

/**
 * Record Request
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
class RecordRequest extends FormRequest
{
    use RecordRequestFoundation;

    /**
     * On form request success
     *
     * @return void
     */
    public function onSuccess()
    {
        $record  = $this->parser->getRecord();

        $this->messages->setSessionMessage(
            $record->id > 0 ? 'Record updated' : 'Record created'
        );
        $record
            ->bind($this->controller->getRequest()->getBody())
            ->save();
        
        $relation = $this->parser->getManyRelation();
        if ($relation instanceof ManyManyRelation) {
            $relation->add($record->id);
        }
        return $this->controller->redirect(
            $this->controller->getUpdatePath(
                $record,
                $this->controller->getRequest()->getUri()
            )
        );
    }
}
