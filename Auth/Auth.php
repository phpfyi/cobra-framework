<?php

namespace Cobra\Auth;

use Cobra\Interfaces\Auth\AuthInterface;
use Cobra\Interfaces\Auth\Authenticator\AuthenticatorInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Object\AbstractObject;

/**
 * Auth class
 *
 * Acts as a proxy to the current active Authenticator and holds the logged in
 * user instance.
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
class Auth extends AbstractObject implements AuthInterface
{
    /**
     * Authenticator instance
     *
     * @var AuthenticatorInterface
     */
    protected $authenticator;

    /**
     * Logged in user instance
     *
     * @var UserInterface
     */
    protected $user;
    
    /**
     * Sets the required properties
     *
     * @param AuthenticatorInterface $authenticator
     */
    public function __construct(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Sets the Authenticator instance
     *
     * @param AuthenticatorInterface $authenticator
     * @return AuthInterface
     */
    public function setAuthenticator(AuthenticatorInterface $authenticator): AuthInterface
    {
        $this->authenticator = $authenticator;
        return $this;
    }

    /**
     * Returns the Authenticator instance
     *
     * @return AuthenticatorInterface
     */
    public function getAuthenticator(): AuthenticatorInterface
    {
        return $this->authenticator;
    }

    /**
     * Sets the User instance
     *
     * @param UserInterface|null $user
     * @return AuthInterface
     */
    public function setUser(?UserInterface $user): AuthInterface
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Returns the User instance if logged in
     *
     * @return UserInterface|null
     */
    public function getUser():? UserInterface
    {
        return $this->user;
    }

    /**
     * Returns if the User instance is logged in
     *
     * @return boolean
     */
    public function isLoggedIn(): bool
    {
        return $this->user ? true : false;
    }

    /**
     * Logs out the User instance
     *
     * @return boolean
     */
    public function logout(): bool
    {
        return $this->user = $this->authenticator->logout($this->user);
    }
}
