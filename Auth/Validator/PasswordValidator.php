<?php

namespace Cobra\Auth\Validator;

use Cobra\Validator\Validator;

/**
 * Password Validator
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PasswordValidator extends Validator
{
    /**
     * Minimum password characters
     *
     * @var int
     */
    const MIN_CHARS = 8;

    /**
     * Maximum password characters
     *
     * @var int
     */
    const MAX_CHARS = 20;

    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Invalid password format';

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'password';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        if (!$this->isPasswordLength($value)) {
            $this->message = 'Invalid password length';
            return false;
        }
        if (!$this->isUppercaseLetterInPassword($value)) {
            $this->message = 'Password requires at least 1 uppercase letter';
            return false;
        }
        if (!$this->isSpecialCharacterInPassword($value)) {
            $this->message = 'Password requires at least 1 special character';
            return false;
        }
        if (!$this->isNumberInPassword($value)) {
            $this->message = 'Password requires at least 1 number';
            return false;
        }
        return true;
    }

    /**
     * Check the password length against the allowed min and max length
     *
     * @param  mixed $value
     * @return boolean
     */
    private function isPasswordLength($value): bool
    {
        return strlen($value) >= self::MIN_CHARS && strlen($value) <= self::MAX_CHARS;
    }

    /**
     * Check the posted password has one uppercase letter
     *
     * @param  mixed $value
     * @return boolean
     */
    private function isUppercaseLetterInPassword($value): bool
    {
        return preg_match('/[A-Z]/', $value);
    }

    /**
     * Check the posted password has one special character
     *
     * @param  mixed $value
     * @return boolean
     */
    private function isSpecialCharacterInPassword($value): bool
    {
        return preg_match('/[@#$%^&+=]/', $value);
    }

    /**
     * Check the posted password has one number
     *
     * @param  mixed $value
     * @return boolean
     */
    private function isNumberInPassword($value): bool
    {
        return preg_match('/\d{1}/', $value);
    }
}
