<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;

/**
 * Radio Group Field
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
class RadioGroupField extends FormField
{
    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Form.Field.RadioGroupField';

    /**
     * Options data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Sets the options data
     *
     * @param  array $data
     * @return RadioGroupField
     */
    public function setData(array $data): RadioGroupField
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Returns the options data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
