<?php

namespace Cobra\Core;

use Cobra\Autoloader\Autoloader;
use Cobra\Config\Config;
use Cobra\Environment\Environment;
use Cobra\Interfaces\Core\ApplicationInterface;
use Cobra\Interfaces\Core\KernelInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Server\ServerConfiguration;

/**
 * Kernel
 *
 * The kernel performs the core start up and shut down sequences.
 *
 * - It checks the server has the required PHP version and packages.
 * - It loads the environment configuration.
 * - It registers the autoloader.
 * - It binds all service class references to the container.
 * - It hands over the request to the application for processing.
 * - Finally it performs any shutdown operations.
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
class Kernel implements KernelInterface
{
    /**
     * Minimum required PHP version
     *
     * @var string
     */
    protected $minPhpVersion = '7.3.1';

    /**
     * Maximum PHP version allowed
     *
     * @var string
     */
    protected $maxPhpVersion = '7.3.1';

    /**
     * Required PHP extensions
     *
     * @var array
     */
    protected $phpExtensions = [
        'yaml'
    ];

    /**
     * Application instance
     *
     * @var ApplicationInterface
     */
    protected $app;

    /**
     * ServerConfiguration instance
     *
     * @var ServerConfiguration
     */
    protected $serverConfiguration;

    /**
     * Array of application services
     *
     * @var array
     */
    protected $services = [];

    /**
     * Sets the required framework objects.
     *
     * @param ApplicationInterface $app
     */
    public function __construct(ApplicationInterface $app)
    {
        $this->app = $app;
        $this->serverConfiguration = new ServerConfiguration(
            $this->minPhpVersion,
            $this->maxPhpVersion,
            $this->phpExtensions
        );
        $this->serverConfiguration->verify();
    }

    /**
     * Boots the kernel
     *
     * Registers the autoloader and binds it to the container along with the
     * service class namespaces.
     *
     * @return void
     */
    public function boot(): void
    {
        gc_enable();

        Environment::instance();

        spl_autoload_register(
            [container_resolve(Autoloader::class), 'include'],
            true,
            true
        );

        array_map(
            function (string $namespace) {
                $service = $namespace::resolve($this->app);

                if ($service->enabled()) {
                    if (method_exists($service, 'namespaces')) {
                        $service->namespaces();
                    }
                    $this->app->addService($service);
                    $this->app->addEvents($service->getEvents());
                }
            },
            $this->services
        );
    }

    /**
     * Hands the request over to the application.
     *
     * @return ResponseInterface
     */
    public function handle(): ResponseInterface
    {
        return $this->app->handle(
            $this->app->getRequest()
        );
    }

    /**
     * Performs the shutdown sequence.
     *
     * @return void
     */
    public function shutdown(): void
    {
        $this->app->getResponse()->getSession()->write();

        gc_collect_cycles();
    }
}
