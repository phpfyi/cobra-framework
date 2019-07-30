<?php

namespace Cobra\Interfaces\Core;

use Composer\Autoload\ClassLoader;
use Cobra\Core\Service\Service;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Application Interface
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
interface ApplicationInterface
{
    /**
     * Returns the composer class loader instance.
     *
     * @return ClassLoader
     */
    public function getClassLoader(): ClassLoader;

    /**
     * Returns an array of event configuration.
     *
     * @return array
     */
    public function getEvents(): array;

    /**
     * Adds an application service instance.
     *
     * @param  Service $instance
     * @return ApplicationInterface
     */
    public function addService(Service $instance): ApplicationInterface;

    /**
     * Adds an application event array.
     *
     * @param array $events
     * @return ApplicationInterface
     */
    public function addEvents(array $events): ApplicationInterface;

    /**
     * Handles the request.
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface;
}
