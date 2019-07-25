<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\TextareaField;

/**
 * HTML Field
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
class HTMLField extends TextareaField
{
    /**
     * Template field holder class
     *
     * @var string
     */
    protected $holderClass = 'form-field-holder holder-tinymce';
    
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
        
        $this->attributes['class'] = 'html-field';
    }
}
