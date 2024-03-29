<?php

namespace Cobra\Auth\Controller;

use Cobra\Interfaces\Auth\AuthInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Gtm\GtmInterface;
use Cobra\Interfaces\Http\Uri\RequestUriInterface;
use Cobra\Interfaces\Security\Token\SecurityTokenInterface;

/**
 * Confirm Account Controller
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
class ConfirmAccountController extends AuthController
{
    /**
     * Controller setup method
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();

        view()
            ->setData('h1', 'Confirm Account')
            ->setData('login_link', $this->getLoginLink());
    }

    /**
     * Default controller action
     *
     * @param  RequestUriInterface $uri
     * @param  AuthInterface $auth
     * @param  GtmInterface $gtm
     * @return void
     */
    public function index(RequestUriInterface $uri, AuthInterface $auth, GtmInterface $gtm)
    {
        if ($user = $auth->getUser()) {
            return $this->redirect(config('auth.login_redirect'));
        }
        if (!$user = container_resolve(UserInterface::class)->find('confirm_token', $uri->getVar('token'))) {
            $gtm->setEvent('ConfirmAccountError');

            view()->setPage('templates.Auth.Page.ConfirmAccountError');
            return;
        }
        $gtm->setEvent('ConfirmAccountSuccess');

        $user->account = 2;
        $user->confirm_token = container_resolve(SecurityTokenInterface::class)::bin2hex();
        $user->save();

        view()->setPage('templates.Auth.Page.ConfirmAccountSuccess');
    }
}
