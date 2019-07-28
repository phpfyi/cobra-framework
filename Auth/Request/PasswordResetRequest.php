<?php

namespace Cobra\Auth\Request;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;
use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Mail\Smtp\SmtpMailer;

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
        $user = container_resolve(UserInterface::class)
            ->find('email', $this->controller->getRequest()->postVar('email'));

        $user->reset_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->save();

        $data = container_resolve(ViewDataInterface::class)
            ->set('title', 'Password Reset')
            ->set('reset_url', $this->getChangePasswordUrl($user))
            ->withTemplate(config('mailer.password_reset_template'));
            
        SmtpMailer::resolve()
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
     * @param  UserInterface $user
     * @return string
     */
    protected function getChangePasswordUrl(UserInterface $user): string
    {
        return uri_join_host(config('auth.change_route')).'?token='.$user->reset_token;
    }
}
