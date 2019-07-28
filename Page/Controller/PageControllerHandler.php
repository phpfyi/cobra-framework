<?php

namespace Cobra\Page\Controller;

use Cobra\Controller\ControllerHandler;
use Cobra\Event\Traits\EventEmitter;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\View\Loader\ViewLoaderInterface;
use Cobra\Interfaces\View\ViewInterface;
use Cobra\Routing\Route;

/**
 * Page Controller Handler
 *
 * Handles the before and after request actions for a page controller
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PageControllerHandler extends ControllerHandler
{
    use EventEmitter;

    /**
     * ViewInterface instance
     *
     * @var ViewInterface
     */
    protected $view;

    /**
     * HtmlStream instance
     *
     * @var HtmlStream
     */
    protected $stream;

    /**
     * Html output
     *
     * @var string
     */
    protected $output;

    /**
     * Sets the required properties
     *
     * @param ControllerInterface $controller
     * @param Route $route
     * @param ViewInterface $view
     * @param HtmlStream $stream
     */
    public function __construct(ControllerInterface $controller, Route $route, ViewInterface $view, HtmlStream $stream)
    {
        parent::__construct($controller, $route);

        $this->view = $view;
        $this->stream = $stream;
    }

    /**
     * The before request action
     *
     * @return void
     */
    public function beforeAction(): void
    {
        parent::beforeAction();

        $this->controller->setView($this->view);
        
        contain_object(ViewInterface::class, $this->view);
    }

    /**
     * The after request action
     *
     * @return void
     */
    public function afterAction(): void
    {
        parent::afterAction();

        $this->emit('BeforeViewRendered', $this->controller);

        $this->output = container_resolve(
            ViewLoaderInterface::class,
            [
                $this->controller->getTemplate(),
                $this->controller->getView()->getData()
            ]
        )->getOutput();

        $this->emit('AfterViewRendered', $this->output);
        
        $this->controller->setResponseBody(
            $this->stream,
            $this->output
        );

        $this->controller->getResponse()->getSession()
            ->set(config('form.csrf_field_name'), csrf());
    }
}
