<?php

namespace Cobra\Form;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Html\HtmlElement;
use Cobra\Html\Traits\ChildElements;
use Cobra\Html\Traits\RendersChildElements;
use Cobra\Validator\Traits\UsesValidators;
use Cobra\View\Traits\RendersTemplate;

/**
 * Form
 *
 * Base form HTML element class
 *
 * Responsible for the presenation / UI of the form.
 *
 * Inherits from the base HTML element class but adds logic to render to a
 * template instead of just outputting pure HTML.
 *
 * Form field values and field validators can be passed in and set on individual
 * fields or across the while form.
 *
 * The class does not deal with form request handling and advanced logic
 * relating to validation. This has been abstracted out into the form request
 * handler class.
 *
 * The body of the form is an array of HTML elements instead of string content
 * that are rendered when the form itself is rendered. Form fields are an
 * associative array in the format:
 *
 * [field name] => [HTML element object]
 *
 * Fields can be inseted before and after existing form elements or removed
 * as required.
 *
 * Custom forms can be created by sub-classing this class.
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
class Form extends HtmlElement implements FormInterface, ViewObject
{
    use ChildElements, UsesValidators, RendersChildElements, RendersTemplate {
        ChildElements::setElement as setField;
        ChildElements::getElement as getField;
        ChildElements::setElements as setFields;
        ChildElements::getElements as getFields;
        ChildElements::removeElement as removeField;
        ChildElements::removeElements as removeFields;
    }

    /**
     * Template path
     *
     * @var string
     */
    protected $template = 'templates.Form.Form';

    /**
     * Form request method
     *
     * Defaults to POST
     *
     * @var string
     */
    protected $method = 'POST';

    /**
     * Form HTML elemnent tag name
     *
     * @var string
     */
    protected $tag = 'form';

    /**
     * Array of form field values
     *
     * @var array
     */
    protected $values = [];

    /**
     * Sets up the default form attributes
     *
     * Differs to the constructor of the parent HTML elements class in the
     * properties that are passed.
     *
     * @param string      $name
     * @param string      $method
     * @param string|null $action
     */
    public function __construct(string $name, $method = 'POST', $action = null)
    {
        $this->method = $method;
        $this->attributes = [
            'name'   => $name,
            'method' => $method,
            'action' => $action,
            'id'     => 'form-'.$name,
            'class'  => 'form'
        ];
    }

    /**
     * Sets the form request method
     *
     * Can be one of GET, POST etc
     *
     * @param  string $method
     * @return FormInterface
     */
    public function setMethod(string $method): FormInterface
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Returns the form method
     *
     * Can be one of GET, POST etc
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Sets the form action
     *
     * This is the endpoint / URL the form is submitted to.
     *
     * @param  string $action
     * @return FormInterface
     */
    public function setAction(string $action): FormInterface
    {
        $this->attributes['action'] = $action;
        return $this;
    }

    /**
     * Sets the form field values.
     * The passed array should be an associative array in the format:
     * [field_name] => [value]
     *
     * @param  array $values
     * @return FormInterface
     */
    public function setValues(array $values): FormInterface
    {
        set_form_values($this, $values);
        return $this;
    }

    /**
     * Sets a array of fields as readonly
     *
     * @param  array $fields
     * @return FormInterface
     */
    public function setReadonly(array $fields): FormInterface
    {
        array_map(
            function ($name) {
                $this->getField($name)->setReadonly();
            },
            $fields
        );
        return $this;
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'html' => $this->getHTML()
        ];
    }
}
