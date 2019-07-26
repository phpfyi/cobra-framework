<?php

namespace Cobra\Validator;

use Cobra\Validator\Validator;

/**
 * Email Validator
 *
 * Validates a value is a compliant email address.
 *
 * @category  Validator
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class EmailValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Invalid email';

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'email';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        return true;
    }
}
