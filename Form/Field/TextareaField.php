<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;
use Cobra\Interfaces\Form\Field\FormFieldInterface;

/**
 * Textarea Field
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
class TextareaField extends FormField
{
    /**
     * Element tag name
     *
     * @var string
     */
    protected $tag = 'textarea';

    /**
     * HTML element attributes
     *
     * @var array
     */
    protected $attributes = [
        'rows' => 4
    ];

    /**
     * Whether this element has a closing tag
     *
     * @var boolean
     */
    protected $close = true;

    /**
     * Sets name, label, and value
     *
     * @param string $name
     * @param string $label
     * @param mixed  $value
     */
    public function __construct(string $name, $label = '', $value = null)
    {
        parent::__construct($name, $label, $value);

        unset($this->attributes['value']);

        $this->body = $value;
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
        $this->body = $escape === true ? htmlspecialchars($value) : $value;
        $this->value = $value;
        
        return $this;
    }
}
