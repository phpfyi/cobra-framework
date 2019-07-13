<?php

namespace Cobra\Interfaces\Form;

use Cobra\Interfaces\Form\FormRequestHandlerInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Form Request Handler Interface
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
interface FormRequestHandlerInterface
{
    /**
     * Handles the form request and returns a response
     *
     * @param  RequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * Determines if the request is a form request.
     *
     * @return boolean
     */
    public function isRequest(): bool;

    /**
     * Performs the form validation.
     *
     * @return FormRequestHandlerInterface
     */
    public function validate(): FormRequestHandlerInterface;

    /**
     * Determines if the form request has passed validation.
     *
     * @return boolean
     */
    public function isRequestSuccess(): bool;

    /**
     * Sets the form validation success session data.
     *
     * @return void
     */
    public function setSessionData(): void;

    /**
     * Removes the form session data.
     *
     * @return void
     */
    public function removeSessionData(): void;

    /**
     * Sets the form data to the session after unsuccessful validation.
     *
     * @return void
     */
    public function setFormSessionData(): void;
}
