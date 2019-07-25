<?php

namespace Cobra\Form;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormRequestHandlerInterface;
use Cobra\Interfaces\Form\FormValidatorInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Object\AbstractObject;

/**
 * Form Request Handler
 *
 * Handles all form submission logic and performs a number of actions to
 * change the state of the form and perform validation.
 *
 * Implements the POST > redirect > GET method of deling with form submissions
 *
 * After failed submission the following actions are performed:
 * - error messages are set on the respective fields
 * - error messages and submitted values are saved to the session
 * - a response object is returned with a redirect
 *
 * After successful submission the following actions are performed:
 * - form session data is cleared
 * - a response object is returned with a redirect
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
class FormRequestHandler extends AbstractObject implements FormRequestHandlerInterface
{
    /**
     * Form session data key
     *
     * @var string
     */
    const SESSION_KEY = 'form';

    /**
     * Fork instance
     *
     * @var FormInterface
     */
    private $form;

    /**
     * Array of request body values
     *
     * @var array
     */
    private $body = [];

    /**
     * Request instance
     *
     * @var RequestInterface
     */
    private $request;

    /**
     * Response instance
     *
     * @var ResponseInterface
     */
    private $response;

    /**
     * Array of form / session error messages
     *
     * @var array
     */
    private $errors = [];

    /**
     * Array of form / session data
     *
     * @var array
     */
    private $data = [];

    /**
     * Sets the form instance
     *
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    /**
     * Handles the form request and returns a response.
     *
     * @param  RequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->body = (array) $request->getBody();
        $this->request = $request;
        $this->response = $response;

        return $this->response;
    }

    /**
     * Determines if the request is a form request.
     *
     * @return boolean
     */
    public function isRequest(): bool
    {
        return $this->form->getMethod() == $this->request->getMethod();
    }

    /**
     * Performs the form validation.
     *
     * @return FormRequestHandlerInterface
     */
    public function validate(): FormRequestHandlerInterface
    {
        $this->form->setValues($this->body);
        $this->errors = container_resolve(FormValidatorInterface::class, [$this->form])
            ->validate()
            ->getErrors();
        return $this;
    }

    /**
     * Determines if the form request has passed validation.
     *
     * @return boolean
     */
    public function isRequestSuccess(): bool
    {
        return count($this->errors) === 0;
    }

    /**
     * Sets the form validation success session data.
     *
     * @return void
     */
    public function setSessionData(): void
    {
        $this->response->getSession()->set(
            self::SESSION_KEY,
            [
                $this->form->getID() => [
                    'data' => $this->body,
                    'messages' => $this->errors
                ]
            ]
        );
    }

    /**
     * Removes the form session data.
     *
     * @return void
     */
    public function removeSessionData(): void
    {
        $this->response->getSession()->remove(self::SESSION_KEY);
    }

    /**
     * Sets the form data to the session after unsuccessful validation.
     *
     * @return void
     */
    public function setFormSessionData(): void
    {
        $session = (array) $this->request->getSession()->get(self::SESSION_KEY);

        $formId = $this->form->getID();
        if (array_key_exists($formId, $session)) {
            $data = $session[$formId];

            $this->data = array_key('data', $data, []);
            $this->errors = array_key('messages', $data, []);
        }
        array_map(
            function ($name, $message) {
                $this->form->getField($name)->setErrorMessage($message);
            },
            array_keys($this->errors),
            $this->errors
        );
        
        array_key_unset(config('form.csrf_field_name'), $this->data);
        
        $this->form->setValues($this->data);
        $this->removeSessionData();
    }
}
