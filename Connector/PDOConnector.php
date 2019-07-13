<?php

namespace Cobra\Interfaces\Connector;

/**
 * PDO Connector Interface
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
interface PDOConnectorInterface
{
    /**
     * Sets whether to persist the database connector.
     *
     * @param  boolean $persist
     * @return PDOConnectorInterface
     */
    public function setPersist(bool $persist): PDOConnectorInterface;

    /**
     * Sets the database connector timeout.
     *
     * @param  integer $timeout
     * @return PDOConnectorInterface
     */
    public function setTimeout(int $timeout): PDOConnectorInterface;

    /**
     * Sets the database connector charset.
     *
     * @param  string $charset
     * @return PDOConnectorInterface
     */
    public function setCharset(string $charset): PDOConnectorInterface;
}
