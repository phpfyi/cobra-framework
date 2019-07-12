<?php

namespace Cobra\Auth\Controller;

use Cobra\Auth\Password\PasswordValidationHtmlElement;
use Cobra\Auth\Request\PasswordChangeRequest;
use Cobra\Form\Field\PasswordField;
use Cobra\Form\Form;
use Cobra\Gtm\Gtm;
use Cobra\Html\HtmlElement;
use Cobra\Interfaces\Form\FormFactoryInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Password Change Controller
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
class PasswordChangeController extends AuthController
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
            ->setPage('templates.Auth.Page.PasswordChange')
            ->setData('h1', 'Change Password');
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
        $form->setField(PasswordField::resolve('password')->addClass('password-field'));
        $form->setField(PasswordField::resolve('password_confirm')->addClass('password-field'));
        $form->setField(PasswordValidationHtmlElement::resolve('password_validator'));
        $form->setField(
            HtmlElement::resolve('div', 'reset', $this->getResetLink())
                ->addClass('auth-a')
        );
        $form = container_resolve(FormFactoryInterface::class, [$form])->getForm();
        
        view()->setData('form', $form);

        $request = PasswordChangeRequest::resolve($this, $form);
        $request->process();
    }

    /**
     * Password change success action
     *
     * @param  RequestInterface $request
     * @param  Gtm $gtm
     * @return void
     */
    public function success(RequestInterface $request, Gtm $gtm)
    {
        if (!$request->getSession()->get('password_changed')) {
            return $this->redirect(config('auth.reset_route'));
        }
        $gtm->setEvent('PasswordChangeSuccess');

        $this->getResponse()->getSession()->remove('password_changed');

        view()
            ->setData('login_link', $this->getLoginLink())
            ->setPage('templates.Auth.Page.PasswordChangeSuccess');
    }

    /**
     * Password change error action
     *
     * @param  RequestInterface $request
     * @param  Gtm $gtm
     * @return void
     */
    public function error(RequestInterface $request, Gtm $gtm)
    {
        $gtm->setEvent('PasswordChangeError');

        view()
            ->setData('reset_link', $this->getResetLink())
            ->setPage('templates.Auth.Page.PasswordChangeError');
    }
}
