<?php

namespace Cobra\Controller;

use Cobra\Interfaces\Controller\ControllerHandlerInterface;
use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Object\AbstractObject;
use Cobra\Routing\Route;

/**
 * Controller Handler
 *
 * Handles the before and after request actions for a controller
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
class ControllerHandler extends AbstractObject implements ControllerHandlerInterface
{
    /**
     * Controller instance
     *
     * @var ControllerInterface
     */
    protected $controller;

    /**
     * Route instance
     *
     * @var Route
     */
    protected $route;

    /**
     * Sets the required properties
     *
     * @param ControllerInterface $controller
     */
    public function __construct(ControllerInterface $controller, Route $route)
    {
        $this->controller = $controller;
        $this->route = $route;
    }

    /**
     * Called before the controller action
     *
     * @return void
     */
    public function beforeAction(): void
    {
    }

    /**
     * Called after the controller action
     *
     * @return void
     */
    public function afterAction(): void
    {
    }
}
