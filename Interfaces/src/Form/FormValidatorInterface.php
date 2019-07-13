<?php

namespace Cobra\Interfaces\Form;

/**
 * Form Validator Interface
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
interface FormValidatorInterface
{
    /**
     * Returns the form error messages
     *
     * @return array
     */
    public function getErrors(): array;

    /**
     * Validates the form fields and sets error messages
     *
     * @return FormValidatorInterface
     */
    public function validate(): FormValidatorInterface;
}
