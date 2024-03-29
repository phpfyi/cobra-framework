<?php

namespace Cobra\Auth\Validator;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\Validator;

/**
 * User Login Expiry Validator
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
class UserLoginExpiryValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Your session has expired. Please log in again';

    /**
     * Login expiry date
     *
     * @var string
     */
    protected $expiry;

    /**
     * Sets the field name to compare
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->expiry = $request->getSession()->get('login_expiry');
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'user-login-expiry';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function validate($user): bool
    {
        if (!$this->expiry) {
            return false;
        }
        if (strtotime($this->expiry) !== strtotime($user->login_expiry)) {
            return false;
        }
        return microtime(true) <= strtotime($user->login_expiry);
    }
}
