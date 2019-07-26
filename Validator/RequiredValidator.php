<?php

namespace Cobra\Validator;

use Cobra\Validator\Validator;

/**
 * Required Validator
 *
 * Validates a value is present and of any non empty type.
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
class RequiredValidator extends Validator
{
    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'required';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        return trim((string) $value) !== '';
    }
}
