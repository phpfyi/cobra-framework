<?php

namespace Cobra\Auth\Request;

use Cobra\Auth\User\User;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;
use Cobra\Mail\Smtp\SmtpMailer;
use Cobra\View\ViewData;

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
        $user = User::resolve();
        $user->bind($this->controller->getRequest()->getBody());

        $user->account = 3;
        $user->login_expiry = date('Y-m-d H:i:s', strtotime(env('CMS_LOGIN_EXPIRY')));
        $user->device_id = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->confirm_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->save();

        $data = ViewData::resolve()
            ->set('title', 'Confirm Account')
            ->set('confirm_url', $this->getConfirmAccountUrl($user))
            ->withTemplate(config('mailer.registration_success_template'));
            
        $mailer = SmtpMailer::resolve()
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
     * @param  User $user
     * @return string
     */
    protected function getConfirmAccountUrl(User $user): string
    {
        return BASE_URL.config('auth.confirm_route').'?token='.$user->confirm_token;
    }
}
