<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;
use Cobra\Interfaces\Form\Field\FormFieldInterface;

/**
 * Password Field
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
class PasswordField extends FormField
{
    /**
     * Default field parameters
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'password'
    ];

    /**
     * Sets the default form field attributes
     *
     * All form elements by default are assigned a unique ID
     *
     * Related form elements are assigned a class specific to their type
     *
     * @param string $name
     * @param string $label
     * @param mixed  $value
     */
    public function __construct(string $name, $label = '', $value = null)
    {
        parent::__construct($name, $label, $value);

        $this->attributes['value'] = '';
    }
    
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
        parent::setValue($value, $escape);
        
        unset($this->attributes['value']);

        return $this;
    }
}
