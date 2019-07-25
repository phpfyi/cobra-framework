<?php

namespace Cobra\Interfaces\Connector;

/**
 * Connector Repository Interface
 *
 * @category  Connector
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ConnectorRepositoryInterface
{
    /**
     * Sets a new database connector.
     *
     * @param  string    $name
     * @param  ConnectorInterface $connection
     * @return ConnectorRepositoryInterface
     */
    public function set(string $name, ConnectorInterface $connection): ConnectorRepositoryInterface;

    /**
     * Returns a database connector.
     *
     * @param  string $name
     * @return ConnectorInterface
     */
    public function get(string $name): ConnectorInterface;

    /**
     * Removes a database connector.
     *
     * @param  string $name
     * @return Connector
     */
    public function unset(string $name): ConnectorRepositoryInterface;

    /**
     * Switches the database connector to a different one.
     *
     * @param  string $name
     * @return ConnectorRepositoryInterface
     */
    public function switch(string $name): ConnectorRepositoryInterface;

    /**
     * Returns the current database connector.
     *
     * @return ConnectorInterface
     */
    public function current(): ConnectorInterface;

    /**
     * Returns all registered database connectors.
     *
     * @return array
     */
    public function connectors(): array;
}
