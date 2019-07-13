<?php

namespace Cobra\Interfaces\Form\Field;

use Cobra\Interfaces\Validator\Validator;

/**
 * Form Field Interface
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
interface FormFieldInterface
{

    /**
     * Set the field label
     *
     * @param  string $label
     * @return FormFieldInterface
     */
    public function setLabel(string $label): FormFieldInterface;

    /**
     * Returns in order
     * - false - this hides the label in the template
     * - text - if passed text this is returned
     * - text - the default which is the element name converted to formatted text
     *
     * @return string|bool
     */
    public function getLabel();
    
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
    public function setValue($value, $escape = true): FormFieldInterface;

    /**
     * Returns the field value
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Sets the template holder CSS class
     *
     * @param  string $class
     * @return FormFieldInterface
     */
    public function setHolderClass(string $class): FormFieldInterface;

    /**
     * Adds a template holder CSS class
     *
     * @param  string $class
     * @return FormFieldInterface
     */
    public function addHolderClass(string $class): FormFieldInterface;

    /**
     * Returns the template holder CSS class
     *
     * @return void
     */
    public function getHolderClass(): string;

    /**
     * Sets the field as readonly
     *
     * @return FormFieldInterface
     */
    public function setReadonly(): FormFieldInterface;

    /**
     * Sets the field as disabled
     *
     * @return FormFieldInterface
     */
    public function setDisabled(): FormFieldInterface;

    /**
     * Set the form field description message
     *
     * @param  string $description
     * @return FormField
     */
    public function setDescription(string $description): FormFieldInterface;

    /**
     * Returns the form field description message
     *
     * @return string
     */
    public function getDescription():? string;

    /**
     * Sets the validator instance for this field
     *
     * @param  Validator|string|null $validator
     * @return FormFieldInterface
     */
    public function setValidator($validator): FormFieldInterface;

    /**
     * Returns the validator instance for this field
     *
     * @return Validator|null
     */
    public function getValidator():? Validator;

    /**
     * Sets the field error message
     *
     * @param  string $message
     * @return FormFieldInterface
     */
    public function setErrorMessage(string $message): FormFieldInterface;

    /**
     * Returns the field error message
     *
     * @return string|null
     */
    public function getErrorMessage():? string;
}
