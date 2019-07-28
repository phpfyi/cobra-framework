<?php

namespace Cobra\Connector;

use Cobra\Interfaces\Connector\ConnectorInterface;
use Cobra\Interfaces\Connector\ConnectorRepositoryInterface;
use Cobra\Object\AbstractObject;

/**
 * Connector Repository
 *
 * Database connection object repository
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
class ConnectorRepository extends AbstractObject implements ConnectorRepositoryInterface
{
    /**
     * Array of database connectors registered.
     *
     * @var array
     */
    protected $connectors = [];

    /**
     * The currently active connector
     *
     * @var ConnectorInterface
     */
    protected $current;

    /**
     * Sets the current database connector.
     *
     * @param ConnectorInterface $connector
     * @param string $name
     */
    public function __construct(ConnectorInterface $connector, string $name = 'default')
    {
        $this->connectors[$name] = $this->current = $connector;
    }

    /**
     * Sets a new database connector.
     *
     * @param  string    $name
     * @param  ConnectorInterface $connection
     * @return ConnectorRepositoryInterface
     */
    public function set(string $name, ConnectorInterface $connection): ConnectorRepositoryInterface
    {
        $this->connectors[$name] = $connection;
        return $this;
    }

    /**
     * Returns a database connector.
     *
     * @param  string $name
     * @return ConnectorInterface
     */
    public function get(string $name): ConnectorInterface
    {
        return $this->connectors[$name];
    }

    /**
     * Removes a database connector.
     *
     * @param  string $name
     * @return Connector
     */
    public function unset(string $name): ConnectorRepositoryInterface
    {
        $this->connectors[$name]->disconnect();
        unset($this->connectors[$name]);
        
        return $this;
    }

    /**
     * Switches the database connector to a different one.
     *
     * @param  string $name
     * @return ConnectorRepositoryInterface
     */
    public function switch(string $name): ConnectorRepositoryInterface
    {
        $this->current = $this->connectors[$name];
        return $this;
    }

    /**
     * Returns the current database connector.
     *
     * @return ConnectorInterface
     */
    public function current(): ConnectorInterface
    {
        return $this->current;
    }

    /**
     * Returns all registered database connectors.
     *
     * @return array
     */
    public function connectors(): array
    {
        return $this->connectors;
    }
}
