<?php

namespace Cobra\Form;

use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormRequestHandlerInterface;
use Cobra\Interfaces\Form\FormRequestInterface;
use Cobra\Http\Message\HttpForbiddenResponse;
use Cobra\Object\AbstractObject;

/**
 * Form Request
 *
 * Base class for abstracted form request logic
 *
 * It handles the form request success / error actions and hooks into
 * various points in the form request life cycle
 *
 * This class removes the need to add complex form logic to controllers and
 * instead splits the form presentation (to the controller) and the form
 * request logic (to here)
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
abstract class FormRequest extends AbstractObject implements FormRequestInterface
{
    /**
     * Controller instance
     *
     * @var ControllerInterface
     */
    protected $controller;
    
    /**
     * Form instance
     *
     * @var FormInterface
     */
    protected $form;
    
    /**
     * Form request handler instance
     *
     * @var FormRequestHandlerInterface
     */
    protected $handler;

    /**
     * Sets the controller and form instances
     *
     * @param ControllerInterface $controller
     * @param FormInterface       $form
     */
    public function __construct(ControllerInterface $controller, FormInterface $form)
    {
        $this->controller = $controller;
        $this->form = $form;

        $this->setHandler(FormRequestHandlerInterface::class);
    }

    /**
     * Returns the form request validation rules.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Fires on form submission and validation success.
     *
     * @return mixed
     */
    abstract public function onSuccess();

    /**
     * Fires on the form load.
     *
     * @return mixed
     */
    public function onInit()
    {
    }

    /**
     * Fires on form submission.
     *
     * @return mixed
     */
    public function onRequest()
    {
    }

    /**
     * Fires on form submission and validation error.
     *
     * @return mixed
     */
    public function onError()
    {
        return $this->controller->back();
    }

    /**
     * Handles the form request and returns a response.
     *
     * @return mixed
     */
    public function process()
    {
        $this->onInit();

        array_map(
            function ($name, $validator) {
                $this->form->getField($name)->setValidator($validator);
            },
            array_keys($this->rules()),
            $this->rules()
        );

        $this->handler->handle(
            $this->controller->getRequest(),
            $this->controller->getResponse()
        );
        if ($this->handler->isRequest()) {
            $this->onRequest();
            if ($this->controller->getResponse() instanceof HttpForbiddenResponse) {
                return $this->onError();
            }
            if ($this->handler->validate()->isRequestSuccess()) {
                $this->handler->removeSessionData();
                return $this->onSuccess();
            }
            $this->handler->setSessionData();
            return $this->onError();
        }
        $this->handler->setFormSessionData();
    }

    /**
     * Sets the form request handler class.
     *
     * @param  string $namespace
     * @return FormRequestInterface
     */
    public function setHandler(string $namespace): FormRequestInterface
    {
        $this->handler = container_resolve($namespace, [$this->form]);
        return $this;
    }
}
