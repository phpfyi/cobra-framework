<?php

namespace Cobra\Interfaces\Form;

/**
 * Form Interface
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
interface FormInterface
{
    /**
     * Sets the form request method
     *
     * Can be one of GET, POST etc
     *
     * @param  string $method
     * @return FormInterface
     */
    public function setMethod(string $method): FormInterface;

    /**
     * Returns the form method
     *
     * Can be one of GET, POST etc
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Sets the form action
     *
     * This is the endpoint / URL the form is submitted to.
     *
     * @param  string $action
     * @return FormInterface
     */
    public function setAction(string $action): FormInterface;

    /**
     * Sets the form field values.
     * The passed array should be an associative array in the format:
     * [field_name] => [value]
     *
     * @param  array $values
     * @return FormInterface
     */
    public function setValues(array $values): FormInterface;

    /**
     * Sets a array of fields as readonly
     *
     * @param  array $fields
     * @return FormInterface
     */
    public function setReadonly(array $fields): FormInterface;
}
