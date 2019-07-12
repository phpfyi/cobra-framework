<?php

namespace Cobra\Auth\Controller;

use Cobra\Auth\Password\PasswordValidationHtmlElement;
use Cobra\Auth\Request\RegistrationRequest;
use Cobra\Form\Field\EmailField;
use Cobra\Form\Field\PasswordField;
use Cobra\Form\Field\TextField;
use Cobra\Form\Form;
use Cobra\Form\FormFactory;
use Cobra\Gtm\Gtm;
use Cobra\Html\HtmlElement;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Registration Controller
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
class RegistrationController extends AuthController
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
            ->setPage('templates.Auth.Page.Registration')
            ->setData('h1', 'Registration');
    }

    /**
     * Default controller action
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function index(RequestInterface $request)
    {
        $form = Form::resolve('Registration');
        $form->setField(TextField::resolve('username'));
        $form->setField(EmailField::resolve('email'));
        $form->setField(PasswordField::resolve('password')->addClass('password-field'));
        $form->setField(PasswordField::resolve('password_confirm')->addClass('password-field'));
        $form->setField(PasswordValidationHtmlElement::resolve('password_validator'));
        $form->getField('username')->setDescription('Allowed characters: A-Z a-z 0-9 _-');
        $form->setField(
            HtmlElement::resolve('div', 'reset', $this->getLoginLink())
                ->addClass('auth-a')
        );
        $form = FormFactory::resolve($form)->getForm();

        view()->setData('form', $form);

        $request = RegistrationRequest::resolve($this, $form);
        $request->process();
    }

    /**
     * Registration success action
     *
     * @param  RequestInterface $request
     * @param  Gtm $gtm
     * @return void
     */
    public function success(RequestInterface $request, Gtm $gtm)
    {
        if (!$request->getSession()->get('confirmation_pending')) {
            return $this->redirect(config('auth.registration_route'));
        }
        $gtm->setEvent('RegistrationSuccess');

        $this->getResponse()->getSession()->remove('confirmation_pending');

        view()
            ->setData('login_link', $this->getLoginLink())
            ->setPage('templates.Auth.Page.RegistrationSuccess');
    }
}
