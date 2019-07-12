<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;
use Cobra\Interfaces\Form\Field\FormFieldInterface;

/**
 * Datetime Field
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
class DatetimeField extends FormField
{
    /**
     * Default field parameters
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'datetime-local'
    ];
    
    /**
     * Sets the field value.
     *
     * Escapes input by default but can be overridden by passing false as the
     * second argument
     *
     * @param  mixed   $value
     * @param  boolean $escape
     * @return FormFieldInterface
     */
    public function setValue($value, $escape = true): FormFieldInterface
    {
        $value = date('Y-m-d\TH:i:s', strtotime($value));
        $this->attributes['value'] = $escape === true ? htmlspecialchars($value) : $value;
        $this->value = $value;
        return $this;
    }
}
