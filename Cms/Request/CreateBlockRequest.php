<?php

namespace Cobra\Cms\Request;

use Cobra\Cms\Traits\RecordRequestFoundation;
use Cobra\Form\Form;
use Cobra\Form\FormRequest;

/**
 * Create Block Request
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
class CreateBlockRequest extends FormRequest
{
    use RecordRequestFoundation;

    /**
     * On form request success
     *
     * @return void
     */
    public function onSuccess()
    {
        $data = $this->controller->getRequest()->getBody();
        $model = $data['class']::resolve();
        $model
            ->bind($data)
            ->save();

        $this->messages->setSessionMessage('Record created');

        $this->parser->getManyRelation()->add($model->id);
        return $this->controller->redirect(
            $this->controller->getUpdatePath(
                $model,
                $this->controller->getRequest()->getUri()
            )
        );
    }
}
