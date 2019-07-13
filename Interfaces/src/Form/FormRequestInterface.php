<?php

namespace Cobra\Interfaces\Form;

/**
 * Form Request Interface
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
interface FormRequestInterface
{
    /**
     * Returns the form request validation rules.
     *
     * @return array
     */
    public function rules(): array;

    /**
     * Fires on form submission and validation success.
     *
     * @return mixed
     */
    public function onSuccess();

    /**
     * Fires on the form load.
     *
     * @return mixed
     */
    public function onInit();

    /**
     * Fires on form submission.
     *
     * @return mixed
     */
    public function onRequest();

    /**
     * Fires on form submission and validation error.
     *
     * @return mixed
     */
    public function onError();

    /**
     * Processes the form request.
     *
     * @return mixed
     */
    public function process();

    /**
     * Sets the form request handler class.
     *
     * @param  string $namespace
     * @return FormRequestInterface
     */
    public function setHandler(string $namespace): FormRequestInterface;
}
