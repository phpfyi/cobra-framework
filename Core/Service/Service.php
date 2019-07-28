<?php

namespace Cobra\Core\Service;

use Cobra\Interfaces\Core\ApplicationInterface;
use Cobra\Interfaces\Core\Service\ServiceInterface;
use Cobra\Object\AbstractObject;

/**
 * Service
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
abstract class Service extends AbstractObject implements ServiceInterface
{
    /**
     * Whether the service is enabled
     *
     * @var boolean
     */
    protected $enabled = true;

    /**
     * ApplicationInterface instance
     *
     * @var ApplicationInterface
     */
    protected $app;

    /**
     * Array of service events
     *
     * @var array
     */
    protected $events = [];

    /**
     * Sets the application instance
     *
     * @param ApplicationInterface $app
     */
    public function __construct(ApplicationInterface $app)
    {
        $this->app = $app;
    }

    /**
     * Returns whether the service is enabled
     *
     * @return bool
     */
    public function enabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Returns all service events
     *
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * Sets a container namespace reference to another namespace.
     *
     * @param string $reference
     * @param string $namespace
     * @return ServiceInterface
     */
    public function namespace(string $reference, string $namespace): ServiceInterface
    {
        contain_namespace($reference, $namespace);

        return $this;
    }

    /**
     * Sets a container namespace reference to an object instance.
     *
     * @param string $reference
     * @param string $namespace
     * @param array $args
     * @return ServiceInterface
     */
    public function instance(string $reference, string $namespace, array $args = []): ServiceInterface
    {
        contain_object(
            $reference,
            container_resolve($namespace, $args)
        );
        return $this;
    }
}
