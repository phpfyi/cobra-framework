<?php

namespace Cobra\Auth\Request;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;
use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Mail\Smtp\SmtpMailer;

/**
 * Registration Request
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
class RegistrationRequest extends AuthRequest
{
    /**
     * Form request validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'user-name',
            'email' => 'user-email',
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
        $user = container_resolve(UserInterface::class);
        $user->bind($this->controller->getRequest()->getBody());

        $user->account = 3;
        $user->login_expiry = date('Y-m-d H:i:s', strtotime(env('CMS_LOGIN_EXPIRY')));
        $user->device_id = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->confirm_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->save();

        $data = container_resolve(ViewDataInterface::class)
            ->set('title', 'Confirm Account')
            ->set('confirm_url', $this->getConfirmAccountUrl($user))
            ->withTemplate(config('mailer.registration_success_template'));
            
        SmtpMailer::resolve()
            ->setSubject('Confirm Account')
            ->setBody($data)
            ->setTo($user->email)
            ->send();

        $this->controller->getResponse()->getSession()->set('confirmation_pending', true);
        $this->controller->redirect(config('auth.registration_success_route'));
    }

    /**
     * Returns the user account confirmation URL
     *
     * @param  UserInterface $user
     * @return string
     */
    protected function getConfirmAccountUrl(UserInterface $user): string
    {
        return uri_join_host(config('auth.confirm_route')).'?token='.$user->confirm_token;
    }
}
