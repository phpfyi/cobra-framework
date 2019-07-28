<?php

namespace Cobra\Connector;

use Cobra\Interfaces\Connector\ConnectorInterface;
use Cobra\Object\AbstractObject;

/**
 * Connector
 *
 * Base class for all database Connector instances
 *
 * All child classes should implement @method connect()
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
abstract class Connector extends AbstractObject implements ConnectorInterface
{
    /**
     * Database connection instance
     *
     * @var object
     */
    protected $connection;

    /**
     * Errors enabled
     *
     * @var boolean
     */
    protected $errors = false;

    /**
     * Database connection hostname
     *
     * @var string
     */
    protected $hostname;

    /**
     * Database connection database name
     *
     * @var string
     */
    protected $database;

    /**
     * Database connection username
     *
     * @var string
     */
    protected $username;

    /**
     * Database connection password
     *
     * @var string
     */
    protected $password;

    /**
     * Database connection params
     *
     * @var array
     */
    protected $params = [];

    /**
     * Connects to the database.
     *
     * @return ConnectorInterface
     */
    abstract public function connect(): ConnectorInterface;

    /**
     * Returns the database connection object.
     *
     * @return object
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Sets whether to enable errors on the database connection object.
     *
     * @param  boolean $errors
     * @return ConnectorInterface
     */
    public function setErrors(bool $errors): ConnectorInterface
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * Sets the database connection hostname.
     *
     * @param  string $hostname
     * @return ConnectorInterface
     */
    public function setHostname(string $hostname): ConnectorInterface
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * Sets the database connection database name.
     *
     * @param  string $database
     * @return ConnectorInterface
     */
    public function setDatabase(string $database): ConnectorInterface
    {
        $this->database = $database;
        return $this;
    }

    /**
     * Sets the database connection username.
     *
     * @param  string $username
     * @return ConnectorInterface
     */
    public function setUsername(string $username): ConnectorInterface
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Sets the database connection password.
     *
     * @param  string $password
     * @return ConnectorInterface
     */
    public function setPassword(string $password): ConnectorInterface
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Sets the database connection params.
     *
     * @param array $params
     * @return ConnectorInterface
     */
    public function setParams(array $params): ConnectorInterface
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Closes the database connection.
     *
     * @return ConnectorInterface
     */
    public function disconnect(): ConnectorInterface
    {
        $this->connection = null;
        return $this;
    }
}
