<?php

namespace Cobra\Auth\Request;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;

/**
 * Password Change Request
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
class PasswordChangeRequest extends AuthRequest
{
    /**
     * Matched user instance
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Form request validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => 'password',
            'password_confirm' => 'password-confirm'
        ];
    }

    /**
     * On form init before initial request
     *
     * @return void
     */
    public function onInit()
    {
        $token = $this->controller->getRequest()->getUri()->getVar('token');
        if (!$token || !$this->user = container_resolve(UserInterface::class)->find('reset_token', $token)) {
            return $this->controller->redirect(config('auth.change_error_route'));
        }
        $this->auth->logout($this->user);
    }

    /**
     * On form request success
     *
     * @return void
     */
    public function onSuccess()
    {
        $this->user->reset_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $this->user->save();

        $this->controller->getResponse()->getSession()->set('password_changed', true);
        $this->controller->redirect(config('auth.change_success_route'));
    }
}
