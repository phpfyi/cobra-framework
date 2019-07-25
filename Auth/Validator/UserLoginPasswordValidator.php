<?php

namespace Cobra\Auth\Validator;

use Cobra\Auth\User\User;
use Cobra\Interfaces\Auth\Password\PasswordEncrypterInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\RequiredValidator;

/**
 * User Password Email Validator
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
class UserLoginPasswordValidator extends RequiredValidator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Invalid password';

    /**
     * Sets the required parameters
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'user-login-password';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        if (!parent::validate($value)) {
            return false;
        }
        $user = User::find('email', $this->request->postVar('email'));
        if (!$user) {
            return false;
        }
        return container_resolve(PasswordEncrypterInterface::class)::verify(
            $this->request->postVar('password'),
            $user->password_token
        );
    }
}
