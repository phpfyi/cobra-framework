<?php

namespace Cobra\Form\Validator;

use Cobra\Validator\Validator;

/**
 * Spam Validator
 *
 * Validates a spam prevention form field.
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
class FormSpamValidator extends Validator
{
    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'form-spam';
    }

    /**
     * Main method to validate the passed value
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value = null): bool
    {
        return trim($value) === '';
    }
}
