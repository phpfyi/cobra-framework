<?php

namespace Cobra\Auth\Authenticator;

use Cobra\Interfaces\Auth\Authenticator\AuthenticatorInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Object\AbstractObject;

/**
 * Authenticator
 *
 * Abstract base class for custom Authenticator implementations
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
abstract class Authenticator extends AbstractObject implements AuthenticatorInterface
{
    use UsesRequest, UsesResponse;

    /**
     * User status message
     *
     * @var string
     */
    protected $message;

    /**
     * Whether the user status is expired
     *
     * @var boolean
     */
    protected $expired = false;
    
    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Returns the authenticator message
     *
     * @return string|null
     */
    public function getMessage():? string
    {
        return $this->message;
    }

    /**
     * Returns whether the user status is expired
     *
     * @return boolean
     */
    public function isExpired(): bool
    {
        return $this->expired;
    }
    
    /**
     * Checks and mofifies the user status between requests.
     * @see SessionAuthenticator
     *
     * @return AuthenticatorInterface
     */
    abstract public function handle(): AuthenticatorInterface;
    
    /**
     * Logs in a user
     *
     * @param UserInterface $user
     * @return boolean
     */
    abstract public function login(UserInterface $user): bool;

    /**
     * Logs out a user
     *
     * @param  UserInterface $user
     * @return boolean
     */
    abstract public function logout(?UserInterface $user): bool;
}
