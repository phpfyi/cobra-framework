<?php

namespace Cobra\Auth\Controller;

use Cobra\Auth\Request\PasswordResetRequest;
use Cobra\Form\Field\EmailField;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormFactoryInterface;
use Cobra\Interfaces\Gtm\GtmInterface;
use Cobra\Interfaces\Html\HtmlElementInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Password Reset Controller
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
class PasswordResetController extends AuthController
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
            ->setPage('templates.Auth.Page.PasswordReset')
            ->setData('h1', 'Reset Password');
    }

    /**
     * Default controller action
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function index(RequestInterface $request)
    {
        $form = container_resolve(FormInterface::class, ['PasswordReset']);

        $form->setField(EmailField::resolve('email'));
        $form->setField(
            container_resolve(HtmlElementInterface::class, ['div', 'reset', $this->getLoginLink()])
                ->addClass('auth-a')
        );
        $form = container_resolve(FormFactoryInterface::class, [$form])->getForm();
        
        view()->setData('form', $form);

        $request = PasswordResetRequest::resolve($this, $form);
        $request->process();
    }

    /**
     * Password reset success action
     *
     * @param  RequestInterface $request
     * @param  GtmInterface $gtm
     * @return void
     */
    public function success(RequestInterface $request, GtmInterface $gtm)
    {
        if (!$request->getSession()->get('password_reset')) {
            return $this->redirect(config('auth.login_route'));
        }
        $gtm->setEvent('PasswordResetSuccess');

        $this->getResponse()->getSession()->remove('password_reset');

        view()
            ->setData('login_link', $this->getLoginLink())
            ->setPage('templates.Auth.Page.PasswordResetSuccess');
    }
}
