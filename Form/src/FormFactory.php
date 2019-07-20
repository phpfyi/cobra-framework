<?php

namespace Cobra\Form;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormFactoryInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Form\Field\SpamField;
use Cobra\Form\Field\SubmitField;
use Cobra\Form\Field\TokenField;
use Cobra\Form\Validator\FormTokenValidator;
use Cobra\Object\AbstractObject;

/**
 * Form Factory
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class FormFactory extends AbstractObject implements FormFactoryInterface
{
    /**
     * Form instance
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Sets the form instance
     *
     * @param FormInterface $form
     * @param RequestInterface $request
     */
    public function __construct(FormInterface $form, RequestInterface $request)
    {
        $this->form = $form;
        $this->request = $request;
    }

    /**
     * Returns the constructed form instance.
     *
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        $this->form
            ->setField(TokenField::resolve(config('form.csrf_field_name'))
                ->setValue(csrf()))
            ->setField(SpamField::resolve(config('form.spam_field_name')))
            ->setField(SubmitField::resolve('form-submit'));

        $this->form->setValidators(
            [
                config('form.csrf_field_name') => FormTokenValidator::resolve(
                    $this->getFormRequestToken(),
                    $this->getFormSessionToken()
                ),
                config('form.spam_field_name') => 'form-spam'
            ]
        );
        return $this->form;
    }

    /**
     * Returns the form CSRF token
     *
     * @return string
     */
    protected function getFormRequestToken():? string
    {
        $body = (array) $this->request->getBody();
        return trim((string) array_key(config('form.csrf_field_name'), $body, ''));
    }

    /**
     * Returns the session CSRF token
     *
     * @return string
     */
    protected function getFormSessionToken():? string
    {
        return trim((string) $this->request->getSession()->get(config('form.csrf_field_name')));
    }
}
