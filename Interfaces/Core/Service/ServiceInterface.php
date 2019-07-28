<?php

namespace Cobra\Interfaces\Core\Service;

/**
 * Service interface
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
interface ServiceInterface
{
    /**
     * Returns whether the service is enabled
     *
     * @return bool
     */
    public function enabled(): bool;

    /**
     * Returns all service events
     *
     * @return array
     */
    public function getEvents(): array;

    /**
     * Sets a container namespace reference to another namespace.
     *
     * @param string $reference
     * @param string $namespace
     * @return ServiceInterface
     */
    public function namespace(string $reference, string $namespace): ServiceInterface;

    /**
     * Sets a container namespace reference to an object instance.
     *
     * @param string $reference
     * @param string $namespace
     * @param array $args
     * @return ServiceInterface
     */
    public function instance(string $reference, string $namespace, array $args = []): ServiceInterface;
}
