<?php

namespace Cobra\Controller;

use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Http\Traits\RedirectsResponse;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Object\AbstractObject;

/**
 * Controller
 *
 * Base class for all Controller instances.
 *
 * Handles the request object and returns a resposne object.
 *
 * @category  Controller
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Controller extends AbstractObject implements ControllerInterface, RequestHandlerInterface
{
    use UsesRequest, UsesResponse, RedirectsResponse;

    /**
     * Sets the current request on initialization
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Handles the request object
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Sets a response to redirect back to the previous URL
     *
     * @return void
     */
    public function back(): void
    {
        $this->redirect($this->request->getReferer());
    }

    /**
     * Sets a HTTP error response
     *
     * @param  integer $code
     * @return void
     */
    public function setHttpError(int $code): void
    {
        $this->setResponse(
            $this->response->withStatus($code)
        );
    }
}
