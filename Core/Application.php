<?php

namespace Cobra\Core;

use Composer\Autoload\ClassLoader;
use Cobra\Container\Container;
use Cobra\Interfaces\Core\ApplicationInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Core\Service\Service;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\Routing\Router;

/**
 * Application
 *
 * The application instance which boots any service instances before passing
 * the request to the router.
 *
 * @category  Core
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Application implements ApplicationInterface, RequestHandlerInterface
{
    use UsesRequest, UsesResponse;

    /**
     * Composer class loader instance
     *
     * @var ClassLoader
     */
    protected $classLoader;

    /**
     * Array of service instances
     *
     * @var array
     */
    protected $services = [];

    /**
     * Array of event config
     *
     * @var array
     */
    protected $events = [];

    /**
     * Array of application middleware namespaces
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Undocumented function
     *
     * @param ClassLoader $classLoader
     */
    public function __construct(ClassLoader $classLoader)
    {
        $this->classLoader = $classLoader;
    }

    /**
     * Returns the composer class loader instance.
     *
     * @return ClassLoader
     */
    public function getClassLoader(): ClassLoader
    {
        return $this->classLoader;
    }

    /**
     * Returns an array of event configuration.
     *
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * Adds an application service instance.
     *
     * @param  Service $instance
     * @return ApplicationInterface
     */
    public function addService(Service $instance): ApplicationInterface
    {
        $this->services[get_class($instance)] = $instance;
        return $this;
    }

    /**
     * Adds an application event array.
     *
     * @param array $events
     * @return ApplicationInterface
     */
    public function addEvents(array $events): ApplicationInterface
    {
        $this->events = array_merge_recursive($this->events, $events);
        return $this;
    }

    /**
     * Handles the request.
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        array_map(
            function ($service) {
                if ($service->enabled()) {
                    if (method_exists($service, 'instances')) {
                        container_resolve_method($service, 'instances');
                    }
                }
            },
            $this->services
        );

        return $this->response = Router::resolve(
            $this->response,
            $this->middleware
        )->handle($request);
    }
}
