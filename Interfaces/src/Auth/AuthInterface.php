<?php

namespace Cobra\Interfaces\Auth;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Auth\Authenticator\AuthenticatorInterface;

/**
 * Auth Interface
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
interface AuthInterface
{
    /**
     * Sets the Authenticator instance
     *
     * @param AuthenticatorInterface $authenticator
     * @return AuthInterface
     */
    public function setAuthenticator(AuthenticatorInterface $authenticator): AuthInterface;

    /**
     * Returns the Authenticator instance
     *
     * @return AuthenticatorInterface
     */
    public function getAuthenticator(): AuthenticatorInterface;

    /**
     * Sets the User instance
     *
     * @param UserInterface|null $user
     * @return AuthInterface
     */
    public function setUser(?UserInterface $user): AuthInterface;

    /**
     * Returns the User instance if logged in
     *
     * @return UserInterface|null
     */
    public function getUser():? UserInterface;

    /**
     * Returns if the User instance is logged in
     *
     * @return boolean
     */
    public function isLoggedIn(): bool;

    /**
     * Logs out the User instance
     *
     * @return boolean
     */
    public function logout(): bool;
}
