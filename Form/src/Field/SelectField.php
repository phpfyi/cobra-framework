<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;

/**
 * Select Field
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
class SelectField extends FormField
{
    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'select';

    /**
     * Whether this element has a closing tag
     *
     * @var boolean
     */
    protected $close = true;

    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Form.Field.SelectField';

    /**
     * Options data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Empty option text
     *
     * @var string
     */
    protected $emptyOption = '- select one -';

    /**
     * Sets the options data
     *
     * @param  array $data
     * @return SelectField
     */
    public function setData(array $data): SelectField
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

    /**
     * Sets the empty option text
     *
     * @param  string $emptyOption
     * @return SelectField
     */
    public function setEmptyOption(string $emptyOption): SelectField
    {
        $this->emptyOption = $emptyOption;
        return $this;
    }

    /**
     * Gets the empty option text
     *
     * @return string
     */
    public function getEmptyOption(): string
    {
        return $this->emptyOption;
    }

    /**
     * Gets the select field options as the inner body
     *
     * @return string
     */
    public function getBody(): string
    {
        $html = sprintf('<option value="">%s</option>', $this->emptyOption);
        array_map(
            function ($value, $text) use (&$html) {
                $selected = $this->value == $value ? ' selected="selected"' : '';
                $html .= sprintf('<option value="%s"%s>%s</option>', $value, $selected, $text);
            },
            array_keys($this->data),
            $this->data
        );
        return $html;
    }

    /**
     * Returns the rendered field HTML template
     *
     * @return string
     */
    public function getHTML(): string
    {
        unset($this->attributes['value']);
        
        return parent::getHTML();
    }
}
