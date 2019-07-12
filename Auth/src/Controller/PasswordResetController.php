<?php

namespace Cobra\Auth\Controller;

use Cobra\Auth\Request\PasswordResetRequest;
use Cobra\Form\Form;
use Cobra\Form\Field\EmailField;
use Cobra\Gtm\Gtm;
use Cobra\Html\HtmlElement;
use Cobra\Interfaces\Form\FormFactoryInterface;
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
        $form = Form::resolve('Login');
        $form->setField(EmailField::resolve('email'));
        $form->setField(
            HtmlElement::resolve('div', 'reset', $this->getLoginLink())
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
     * @param  Gtm $gtm
     * @return void
     */
    public function success(RequestInterface $request, Gtm $gtm)
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
