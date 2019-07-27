<?php

namespace Cobra\Form\Field;

use Cobra\Interfaces\Form\Field\FormFieldInterface;
use Cobra\Interfaces\Validator\ValidatorInterface;
use Cobra\Interfaces\Validator\ValidatorResolverInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Html\HtmlElement;
use Cobra\Object\Traits\Decoratable;
use Cobra\View\Traits\RendersTemplate;

/**
 * Form Field
 *
 * Base form field class which extends the HTML element class.
 *
 * Provides a powerful and easily extendable way to build form elements that can
 * be pushed onto the Form class fields array
 *
 * This class provides a number of methods to interact with the most commonly
 * used form attributes (such as class) and advanced logic to work with
 * JavaScript and CSS handlers in the CMS
 *
 * Sub classing this or using FormFieldInterface allows you to create custom
 * implementations or expand on the functionality here
 *
 * A lot of the default fields make use of HTML5 which eliminates the need for
 * JavaScript for complex functionality.
 *
 * These forms fields are designed to work in modern browsers and if legacy
 * support is needed for older browsers such as early versions of internet
 * explorer it is highly recommended to test the form fields to ensure backward
 * compatibility with those browsers. JavaScript polyfills may be required
 * to mimic the new HTML5 functionality.
 *
 * There are dozens of possible form element subclasses from simple text fields
 * to complex recaptcha fields.
 *
 * A number of packages within the framework have their own custom fields which
 * have their own specific implementations of existing fields and / or are
 * specific in their own right.
 *
 * The basic fields available in this package include:
 *
 * - checkbox
 * - country
 * - date
 * - datetime
 * - decimal
 * - email
 * - hidden
 * - HTML
 * - numeric
 * - password
 * - phone number
 * - radio group
 * - select
 * - spam
 * - submit
 * - textarea
 * - text
 * - token
 * - url
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
class FormField extends HtmlElement implements FormFieldInterface, ViewObject
{
    use Decoratable, RendersTemplate;

    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'input';

    /**
     * Whether this element has a closing tag
     *
     * @var boolean
     */
    protected $close = false;

    /**
     * Label text
     *
     * @var string
     */
    protected $label;

    /**
     * HTML element value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Form.Field.FormField';

    /**
     * Template field holder class
     *
     * @var string
     */
    protected $holderClass = 'form-field-holder';

    /**
     * Form field description
     *
     * @var string
     */
    protected $description;

    /**
     * Form field validator instance
     *
     * @var Validator|null
     */
    protected $validator;

    /**
     * Field valdiation error message
     *
     * @var string
     */
    protected $errorMessage;

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
        $this->attributes = array_merge(
            [
                'name'  => $name,
                'value' => $value,
                'id'    => 'field-'.$name,
                'class' => 'field field-'.$this->tag
            ],
            $this->attributes
        );
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Set the field label
     *
     * @param  string $label
     * @return FormFieldInterface
     */
    public function setLabel(string $label): FormFieldInterface
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Returns in order
     * - false - this hides the label in the template
     * - text - if passed text this is returned
     * - text - the default which is the element name converted to formatted text
     *
     * @return string|bool
     */
    public function getLabel()
    {
        return $this->label === false
        ? false
        : ($this->label ?: label_text($this->name));
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
        $this->attributes['value'] = $escape === true ? htmlspecialchars($value) : $value;
        $this->value = $value;
        return $this;
    }

    /**
     * Returns the field value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the template holder CSS class
     *
     * @param  string $class
     * @return FormFieldInterface
     */
    public function setHolderClass(string $class): FormFieldInterface
    {
        $this->holderClass = $class;
        return $this;
    }

    /**
     * Adds a template holder CSS class
     *
     * @param  string $class
     * @return FormFieldInterface
     */
    public function addHolderClass(string $class): FormFieldInterface
    {
        $this->holderClass = $this->holderClass.' '.$class;
        return $this;
    }

    /**
     * Returns the template holder CSS class
     *
     * @return void
     */
    public function getHolderClass(): string
    {
        return $this->holderClass;
    }

    /**
     * Sets the field as readonly
     *
     * @return FormFieldInterface
     */
    public function setReadonly(): FormFieldInterface
    {
        $this->attributes['readonly'] = 'readonly';
        return $this;
    }

    /**
     * Sets the field as disabled
     *
     * @return FormFieldInterface
     */
    public function setDisabled(): FormFieldInterface
    {
        $this->attributes['disabled'] = 'disabled';
        return $this;
    }

    /**
     * Set the form field description message
     *
     * @param  string $description
     * @return FormField
     */
    public function setDescription(string $description): FormFieldInterface
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the form field description message
     *
     * @return string
     */
    public function getDescription():? string
    {
        return $this->description;
    }

    /**
     * Sets the validator instance for this field
     *
     * @param  ValidatorInterface|string $validator
     * @return FormFieldInterface
     */
    public function setValidator($validator): FormFieldInterface
    {
        $this->attributes['required'] = 'required';
        $this->validator = $validator instanceof ValidatorInterface
        ? $validator
        : container_resolve(ValidatorResolverInterface::class)->get($validator);
        return $this;
    }

    /**
     * Returns the validator instance for this field
     *
     * @return ValidatorInterface|null
     */
    public function getValidator():? ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * Sets the field error message
     *
     * @param  string $message
     * @return FormFieldInterface
     */
    public function setErrorMessage(string $message): FormFieldInterface
    {
        $this->attributes['class'] .= ' validation-error';
        $this->errorMessage = $message;
        return $this;
    }

    /**
     * Returns the field error message
     *
     * @return string|null
     */
    public function getErrorMessage():? string
    {
        return $this->errorMessage;
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'tag' => $this->getTag(),
            'name' => $this->getName(),
            'html' => $this->getHTML(),
            'value' => $this->getValue(),
            'label' => $this->getLabel(),
            'validator' => $this->getValidator(),
            'description' => $this->getDescription(),
            'holder_class' => $this->getHolderClass(),
            'error_message' => $this->getErrorMessage(),
        ];
    }
}
