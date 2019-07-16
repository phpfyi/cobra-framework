<?php

namespace Cobra\Auth\Service;

use Cobra\Core\Service\Service;

/**
 * Auth Service
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
class AuthService extends Service
{
    /**
     * Array of app events
     *
     * @var array
     */
    protected $events = [
        'LoggedIn' => [
            \Cobra\Auth\Event\LoggedInEvent::class
        ],
    ];

    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Auth\Password\PasswordEncrypterInterface::class,
            \Cobra\Auth\Password\PasswordEncrypter::class
        );
        contain_namespace(
            \Cobra\Interfaces\Auth\Password\PasswordGeneratorInterface::class,
            \Cobra\Auth\Password\PasswordGenerator::class
        );
        contain_namespace(
            \Cobra\Interfaces\Auth\User\UserInterface::class,
            \Cobra\Auth\User\User::class
        );
        contain_namespace(
            \Cobra\Interfaces\Auth\User\UserLogInterface::class,
            \Cobra\Auth\User\UserLog::class
        );
    }

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        contain_object(
            \Cobra\Interfaces\Auth\Authenticator\AuthenticatorInterface::class,
            \Cobra\Auth\Authenticator\SessionAuthenticator::resolve()
        );
        contain_object(
            \Cobra\Interfaces\Auth\AuthInterface::class,
            \Cobra\Auth\Auth::resolve()
        );
    }
}
