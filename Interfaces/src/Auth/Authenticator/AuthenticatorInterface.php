<?php

namespace Cobra\Interfaces\Auth\Authenticator;

use Cobra\Interfaces\Auth\User\UserInterface;

/**
 * Authenticator Interface
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
interface AuthenticatorInterface
{
    /**
     * Returns the authenticator message
     *
     * @return string|null
     */
    public function getMessage():? string;

    /**
     * Returns whether the user status is expired
     *
     * @return boolean
     */
    public function isExpired(): bool;
    
    /**
     * Checks and mofifies the user status between requests.
     * @see SessionAuthenticator
     *
     * @return AuthenticatorInterface
     */
    public function handle(): AuthenticatorInterface;
    
    /**
     * Logs in a user
     *
     * @param UserInterface $user
     * @return boolean
     */
    public function login(UserInterface $user): bool;

    /**
     * Logs out a user
     *
     * @param  UserInterface $user
     * @return boolean
     */
    public function logout(?UserInterface $user): bool;
}
