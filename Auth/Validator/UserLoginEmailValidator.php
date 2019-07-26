<?php

namespace Cobra\Auth\Validator;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Validator\EmailValidator;

/**
 * User Login Email Validator
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
class UserLoginEmailValidator extends EmailValidator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Unknown email';

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'user-login-email';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        if (!parent::validate($value)) {
            return false;
        }
        $user = container_resolve(UserInterface::class)->find('email', $value);
        return $user ? true : false;
    }
}
