<?php

namespace Cobra\Auth\Controller;

use Cobra\Interfaces\Auth\AuthInterface;

/**
 * Logout Controller
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
class LogoutController extends AuthController
{
    /**
     * Default controller action
     *
     * @param  AuthInterface $auth
     * @return void
     */
    public function index(AuthInterface $auth)
    {
        if ($user = $auth->getUser()) {
            $auth->logout($user);

            $this->getResponse()->getSession()->set('gtm_logout', true);
            return $this->redirect(config('auth.logout_route'));
        }
        return $this->redirect(config('auth.login_route'));
    }
}
