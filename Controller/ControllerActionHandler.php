<?php

namespace Cobra\Controller;

use Cobra\Http\Stream\Stream;
use Cobra\Interfaces\Controller\ControllerActionHandlerInterface;
use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Object\AbstractObject;

/**
 * Controller Action Handler
 *
 * Fires the controller action with injected dependencies
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
class ControllerActionHandler extends AbstractObject implements ControllerActionHandlerInterface
{
    /**
     * Controller instance
     *
     * @var ControllerInterface
     */
    protected $controller;

    /**
     * Request instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Controller action name
     *
     * @var string
     */
    protected $action;

    /**
     * Sets the required properties
     *
     * @param ControllerInterface $controller
     * @param RequestInterface $request
     * @param string $action
     */
    public function __construct(
        ControllerInterface $controller,
        RequestInterface $request,
        string $action
    ) {
        $this->controller = $controller;
        $this->request = $request;
        $this->action = $action;
    }

    /**
     * Invokes a resolved controller action.
     *
     * @return void
     */
    public function invoke(): void
    {
        if (method_exists($this->controller, $this->action)) {
            $output = container_resolve_method(
                $this->controller,
                $this->action
            );
            if ($output instanceof Stream) {
                $this->controller->setResponse(
                    $this->controller->getResponse()->withBody($output)
                );
            }
        }
    }
}
