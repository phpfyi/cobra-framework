<?php

namespace Cobra\Form\Field;

use Cobra\Interfaces\Form\Field\FormFieldInterface;
use Cobra\Interfaces\Validator\Validator;
use Cobra\Form\Field\FormField;
use Cobra\Html\Traits\RendersAsHtml;

/**
 * Hidden Field
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class HiddenField extends FormField
{
    use RendersAsHtml;

    /**
     * Default field parameters
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'hidden'
    ];

    /**
     * Sets the validator instance for this field
     *
     * @param  Validator|string|null $validator
     * @return FormFieldInterface
     */
    public function setValidator($validator): FormFieldInterface
    {
        parent::setValidator($validator);
        
        unset($this->attributes['required']);
        return $this;
    }
}
