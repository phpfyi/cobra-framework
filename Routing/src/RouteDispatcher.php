<?php

namespace Cobra\Routing;

use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Controller\ControllerActionHandlerInterface;
use Cobra\Interfaces\Controller\ControllerHandlerInterface;
use Cobra\Interfaces\Routing\RouteDispatcherInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Page\PageInterface;
use Cobra\Interfaces\Routing\RouterInterface;
use Cobra\Object\AbstractObject;
use Cobra\Object\Exception\InvalidClassnameException;
use Cobra\Page\Controller\PageController;
use Cobra\Page\Controller\PageControllerHandler;
use Cobra\Page\Routing\PageRoute;
use Cobra\Routing\Traits\CanProcessResponse;

/**
 * Route Dispatcher
 *
 * Creates the route controller instance and invokes its actions
 *
 * @category  Routing
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RouteDispatcher extends AbstractObject implements RouteDispatcherInterface
{
    use CanProcessResponse;

    /**
     * Router instance
     *
     * @var Router
     */
    protected $router;

    /**
     * Route instance
     *
     * @var Route
     */
    protected $route;

    /**
     * Controller handler instance
     *
     * @var ControllerHandler
     */
    protected $handler;

    /**
     * Sets the required properties
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        $this->route = $router->getRoute();
    }

    /**
     * Returns the response.
     *
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        $this->setupController();
        if (!$this->controller) {
            return $this->router->getResponse()->withStatus(404);
        }
        $this->setupControllerHandler();

        $this->handler->beforeAction();
        if ($this->controller instanceof PageController) {
            $this->controller->setPage(
                $this->route instanceof PageRoute
                ? $this->route->getPage()
                : container_resolve(PageInterface::class)
            );
        }
        $this->controller->setResponse($this->router->getResponse());
        if (method_exists($this->controller, 'setup')) {
            $this->controller->setup();
        }
        if (!$this->canProcess($this->controller->getResponse())) {
            return $this->controller->getResponse();
        }
        $this->invokeControllerAction();

        if (!$this->canProcess($this->controller->getResponse())) {
            return $this->controller->getResponse();
        }
        $this->handler->afterAction();

        return $this->controller->handle($this->router->getRequest());
    }

    /**
     * Sets up the route controller
     *
     * @return void
     * @throws InvalidClassnameException
     */
    protected function setupController(): void
    {
        $namespace = $this->route->getController();
        if (!class_exists($namespace)) {
            throw new InvalidClassnameException(
                sprintf('Cannot find route controller: %s', $namespace)
            );
        }
        $this->controller = $namespace::resolve($this->router->getRequest());

        contain_object(ControllerInterface::class, $this->controller);
    }

    /**
     * Sets up the controller handler instance
     *
     * @return void
     */
    protected function setupControllerHandler(): void
    {
        $namespace = $this->controller instanceof PageController
        ? PageControllerHandler::class
        : ControllerHandlerInterface::class;

        $this->handler = container_resolve(
            $namespace,
            [
                $this->controller,
                $this->route
            ]
        );
    }

    /**
     * Invokes the controller action
     *
     * @return void
     */
    protected function invokeControllerAction(): void
    {
        $action = container_resolve(
            ControllerActionHandlerInterface::class,
            [
                $this->controller,
                $this->router->getRequest(),
                $this->route->getAction() ?: 'index'
            ]
        );
        $action->invoke();
    }
}
