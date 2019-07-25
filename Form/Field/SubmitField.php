<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;

/**
 * Submit Field
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
class SubmitField extends FormField
{
    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Form.Field.SubmitField';

    /**
     * Sets name and value
     *
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, $value = 'Submit')
    {
        $this->attributes = [
            'type'  => 'submit',
            'name'  => $name,
            'value' => $value,
            'id'    => 'field-'.$name,
            'class' => 'field field-submit'
        ];
        $this->name = $name;
        $this->value = $value;
        $this->label = false;
    }
}
