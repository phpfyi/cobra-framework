<?php

namespace Cobra\Auth\Request;

use Cobra\Auth\User\User;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;
use Cobra\Mail\Smtp\SmtpMailer;
use Cobra\View\ViewData;

/**
 * Password Reset Request
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
class PasswordResetRequest extends AuthRequest
{
    /**
     * Matched user instance
     *
     * @var User
     */
    private $user;

    /**
     * Form request validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'user-login-email'
        ];
    }

    /**
     * On form request success
     *
     * @return void
     */
    public function onSuccess()
    {
        $user = User::find('email', $this->controller->getRequest()->postVar('email'));

        $user->reset_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->save();

        $data = ViewData::resolve()
            ->set('title', 'Password Reset')
            ->set('reset_url', $this->getChangePasswordUrl($user))
            ->withTemplate(config('mailer.password_reset_template'));
            
        $mailer = SmtpMailer::resolve()
            ->setSubject('Password Reset')
            ->setBody($data)
            ->setTo($user->email)
            ->send();

        $this->auth->logout($user);
            
        $this->controller->getResponse()->getSession()->set('password_reset', true);
        $this->controller->redirect(config('auth.reset_success_route'));
    }

    /**
     * Returns the user change password URL
     *
     * @param  User $user
     * @return string
     */
    protected function getChangePasswordUrl(User $user): string
    {
        return BASE_URL.config('auth.change_route').'?token='.$user->reset_token;
    }
}
