<?php

namespace Cobra\User\Middleware;

use Cobra\Auth\Traits\RedirectsToLogin;
use Cobra\Form\FormRequestHandler;
use Cobra\Http\Middleware\Middleware;
use Cobra\Interfaces\Auth\Authenticator\AuthenticatorInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;

/**
 * Authenticated User Middleware
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
class AuthenticatedUserMiddleware extends Middleware
{
    use RedirectsToLogin;

    /**
     * User instance logged in via the session
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Authenticator instance
     *
     * @var Authenticator
     */
    protected $authenticator;

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
     * Calls the authenticator to validate the request for a logged in status.
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->authenticator->handle()->isExpired()) {
            $handler->getResponse()->getSession()->set(
                FormRequestHandler::SESSION_KEY,
                [
                    'form-Login' => [
                        'messages' => [
                            'email' => $this->authenticator->getMessage()
                        ]
                    ]
                ]
            );
            return $this->redirectToLogin($handler);
        }
        return $handler->handle($request);
    }
}
