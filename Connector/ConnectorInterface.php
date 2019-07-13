<?php

namespace Cobra\Interfaces\Connector;

/**
 * Connector Interface
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
interface ConnectorInterface
{
    /**
     * Connects to the database.
     *
     * @return ConnectorInterface
     */
    public function connect(): ConnectorInterface;

    /**
     * Returns the database connection object.
     *
     * @return object
     */
    public function getConnection();

    /**
     * Sets whether to enable errors on the database connection object.
     *
     * @param  boolean $errors
     * @return ConnectorInterface
     */
    public function setErrors(bool $errors): ConnectorInterface;

    /**
     * Sets the database connection hostname.
     *
     * @param  string $hostname
     * @return ConnectorInterface
     */
    public function setHostname(string $hostname): ConnectorInterface;

    /**
     * Sets the database connection database name.
     *
     * @param  string $database
     * @return ConnectorInterface
     */
    public function setDatabase(string $database): ConnectorInterface;

    /**
     * Sets the database connection username.
     *
     * @param  string $username
     * @return ConnectorInterface
     */
    public function setUsername(string $username): ConnectorInterface;

    /**
     * Sets the database connection password.
     *
     * @param  string $password
     * @return ConnectorInterface
     */
    public function setPassword(string $password): ConnectorInterface;

    /**
     * Sets the database connection params.
     *
     * @return array
     */
    public function setParams(array $params): ConnectorInterface;
}
