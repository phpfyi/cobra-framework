<?php

namespace Cobra\Validator;

use Cobra\Validator\Validator;

/**
 * Number Validator
 *
 * Validates a value is numeric.
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
class NumberValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Invalid numeric value';

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'number';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        return is_numeric($value);
    }
}
