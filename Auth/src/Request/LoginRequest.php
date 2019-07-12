<?php

namespace Cobra\Auth\Request;

use Cobra\Auth\User\User;

/**
 * Login Request
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
class LoginRequest extends AuthRequest
{
    /**
     * Form request validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'email' => 'user-login-email',
            'password' => 'user-login-password'
        ];
    }

    /**
     * On form init before initial request
     *
     * @return void
     */
    public function onInit()
    {
        if ($this->auth->getUser()) {
            return $this->controller->redirect(config('auth.login_redirect'));
        }
    }

    /**
     * On form request success
     *
     * @return void
     */
    public function onSuccess()
    {
        $user = User::find('email', $this->controller->getRequest()->postVar('email'));

        $this->auth->getAuthenticator()->login($user);
        
        if (!$uri = $this->controller->getRequest()->getUri()->getVar('redirect')) {
            $uri = config('auth.login_redirect');
        }
        return $this->controller->redirect($uri);
    }
}
