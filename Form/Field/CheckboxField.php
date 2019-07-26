<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;
use Cobra\Interfaces\Form\Field\FormFieldInterface;

/**
 * Checkbox Field
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
class CheckboxField extends FormField
{
    /**
     * Sets the unique form checkvbox attributes
     *
     * @param string  $name
     * @param string  $label
     * @param integer $value
     */
    public function __construct(string $name, $label = '', $value = 0)
    {
        parent::__construct($name, $label, 1);

        $this->attributes['type'] = 'checkbox';
        $this->attributes['class'] .= ' field-checkbox';
        
        $this->setValue($value);
    }

    /**
     * Sets the checkbox field value and marks as checked if required
     *
     * @param  string|int $value
     * @param  boolean    $escape
     * @return FormFieldInterface
     */
    public function setValue($value, $escape = true): FormFieldInterface
    {
        parent::setValue((int) $value, $escape);

        unset($this->attributes['value']);

        if ($this->value === 1) {
            $this->attributes['checked'] = 'checked';
        }
        return $this;
    }
}
