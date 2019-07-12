<?php

namespace Cobra\Auth\Controller;

use Cobra\Auth\Request\LoginRequest;
use Cobra\Form\Form;
use Cobra\Form\FormFactory;
use Cobra\Form\Field\EmailField;
use Cobra\Form\Field\PasswordField;
use Cobra\Gtm\Gtm;
use Cobra\Html\HtmlElement;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Login Controller
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
class LoginController extends AuthController
{
    /**
     * Default controller action
     *
     * @param  RequestInterface $request
     * @param  Gtm $gtm
     * @return void
     */
    public function index(RequestInterface $request, Gtm $gtm)
    {
        if ($request->getSession()->get('gtm_logout')) {
            $gtm->setEvent('LogoutSuccess');
            $this->getResponse()->getSession()->remove('gtm_logout');
        }
        $form = Form::resolve('Login');
        $form->setField(EmailField::resolve('email'));
        $form->setField(PasswordField::resolve('password'));
        $form->setField(
            HtmlElement::resolve('div', 'reset', $this->getResetLink())
                ->addClass('auth-a')
        );
        $form = FormFactory::resolve($form)->getForm();
        
        view()
            ->setPage('templates.Auth.Page.Login')
            ->setData('h1', 'Login')
            ->setData('form', $form);

        $request = LoginRequest::resolve($this, $form);
        $request->process();
    }
}
