<?php

namespace Cobra\Auth\Validator;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Validator\Validator;

/**
 * User Name Validator
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
class UserNameValidator extends Validator
{
    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'user-name';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        if (!$this->hasUsernameCharacters($value)) {
            $this->message = 'Allowed characters _-';
            return false;
        }
        if (!$this->hasUsernameLength($value)) {
            $this->message = 'Please pick a username between 4 and 20 characters';
            return false;
        }
        if (container_resolve(UserInterface::class)->find('username', $value)) {
            $this->message = 'Username taken';
            return false;
        }
        return true;
    }

    /**
     * Check the user name has no disallowed characters
     *
     * @return boolean
     */
    private function hasUsernameCharacters($value): bool
    {
        $regex = "/^[a-zA-Z0-9_-]*$/";
        return filter_var($value, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $regex]]);
    }

    /**
     * Check the user name length against the allowed min and max length
     *
     * @param  mixed $value
     * @return boolean
     */
    private function hasUsernameLength($value): bool
    {
        return strlen($value) >= static::config('min_chars')
        && strlen($value) <= static::config('max_chars');
    }
}
