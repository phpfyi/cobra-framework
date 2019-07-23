<?php

namespace Cobra\Cms\Traits;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Model\Model;

/**
 * Model Config Validation Rules trait
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
trait ModelConfigValidationRules
{
    /**
     * Model CMS form fields override
     *
     * @param  FormInterface $form
     * @return FormInterface
     */
    public function cmsForm(FormInterface $form): FormInterface
    {
        $form->setValidators(static::config('validation_rules'));

        return $form;
    }
}
