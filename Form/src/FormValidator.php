<?php

namespace Cobra\Form;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormValidatorInterface;
use Cobra\Object\AbstractObject;

/**
 * Form Validator
 *
 * Performs validation on a Form instance.
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
class FormValidator extends AbstractObject implements FormValidatorInterface
{
    /**
     * Form instance
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Array of form error messages
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Sets the form instance
     *
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    /**
     * Returns the form error messages
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Validates the form fields and sets error messages
     *
     * @return FormValidatorInterface
     */
    public function validate(): FormValidatorInterface
    {
        array_map(
            function ($field) {
                if (method_exists($field, 'getValidator') && $validator = $field->getValidator()) {
                    if (!$validator->validate($field->getValue())) {
                        $this->errors[$field->getName()] = $validator->getMessage();
                    }
                }
            },
            $this->form->getFields()
        );
        return $this;
    }
}
