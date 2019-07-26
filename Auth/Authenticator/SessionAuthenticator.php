<?php

namespace Cobra\Auth\Authenticator;

use Cobra\Auth\Validator\UserLoginExpiryValidator;
use Cobra\Auth\Validator\UserSingleDeviceLoginValidator;
use Cobra\Interfaces\Auth\Authenticator\AuthenticatorInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;
use Cobra\Event\Traits\EventEmitter;

/**
 * Session Authenticator
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
class SessionAuthenticator extends Authenticator
{
    use EventEmitter;

    /**
     * Array of validators
     *
     * @var array
     */
    protected $validators = [
        \Cobra\Auth\Validator\UserLoginExpiryValidator::class,
        \Cobra\Auth\Validator\UserSingleDeviceLoginValidator::class
    ];

    /**
     * Checks and mofifies the user status between requests.
     * @see SessionAuthenticator
     *
     * @return AuthenticatorInterface
     */
    public function handle(): AuthenticatorInterface
    {
        if (!$hash = $this->request->getSession()->get(self::config('active_token'))) {
            return $this;
        }
        if (!$user = container_resolve(UserInterface::class)->find(self::config('active_token'), $hash) ?: null) {
            return $this;
        }
        foreach ($this->validators as $namespace) {
            $validator = $namespace::resolve($this->request);
            if (!$validator->validate($user)) {
                $this->message = $validator->getMessage();

                $this->expired = true;

                $this->logout($user);
                return $this;
            }
        }
        $this->update($user);

        return $this;
    }

    /**
     * Logs in a user
     *
     * @param UserInterface $user
     * @return boolean
     */
    public function login(UserInterface $user): bool
    {
        $this->response->getSession()->regenerate();

        $this->update($user);

        $this->emit('LoggedIn', $user);

        return true;
    }

    /**
     * Logs out a user
     *
     * @param UserInterface|null $user
     * @return boolean
     */
    public function logout(?UserInterface $user): bool
    {
        $this->response->getSession()->destroy();

        if (!$user) {
            return false;
        }
        $user->login_expiry = null;
        $user->active_token = null;
        $user->device_id = null;
        $user->save();

        auth()->setUser(null);

        $this->emit('LoggedOut', $user);

        return true;
    }

    /**
     * Updates the user model and session data with a logged in status
     *
     * @param UserInterface $user
     * @return void
     */
    protected function update(UserInterface $user): void
    {
        $user->login_expiry = date('Y-m-d H:i:s', strtotime(env('CMS_LOGIN_EXPIRY')));
        $user->active_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->device_id = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->ip_address = $this->request->getIP();
        $user->save();

        auth()->setUser($user);

        $this->response->getSession()->setArray(
            [
                'login_time'   => time(),
                'login_expiry' => $user->login_expiry,
                'active_token' => $user->active_token,
                'device_id'    => $user->device_id
            ]
        );
    }
}
