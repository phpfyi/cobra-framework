<?php

namespace Cobra\Connector;

use PDO;
use PDOException;
use Cobra\Connector\Exception\DatabaseConnectionException;
use Cobra\Interfaces\Connector\ConnectorInterface;
use Cobra\Interfaces\Connector\PDOConnectorInterface;

/**
 * PDO Connector
 *
 * PDO database connection object
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
class PDOConnector extends Connector implements PDOConnectorInterface
{
    /**
     * Persist PDO connection
     *
     * @var boolean
     */
    protected $persist = false;

    /**
     * PDO connection timeout in seconds
     *
     * @var int
     */
    protected $timeout = 30;

    /**
     * PDO database connection character set
     *
     * @var string
     */
    protected $charset = 'utf8';

    /**
     * Sets whether to persist the database connector.
     *
     * @param  boolean $persist
     * @return PDOConnectorInterface
     */
    public function setPersist(bool $persist): PDOConnectorInterface
    {
        $this->persist = $persist;
        return $this;
    }

    /**
     * Sets the database connector timeout.
     *
     * @param  integer $timeout
     * @return PDOConnectorInterface
     */
    public function setTimeout(int $timeout): PDOConnectorInterface
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Sets the database connection charset
     *
     * @param  string $charset
     * @return PDOConnectorInterface
     */
    public function setCharset(string $charset): PDOConnectorInterface
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * Sets the database connector charset.
     *
     * @throws PDOException
     * @return ConnectorInterface
     */
    public function connect(): ConnectorInterface
    {
        $params = [
            PDO::ATTR_TIMEOUT => $this->timeout,
            PDO::ATTR_PERSISTENT => $this->persist,
            PDO::MYSQL_ATTR_INIT_COMMAND => sprintf("SET NAMES %s;", $this->charset)
        ];
        if ($this->errors === true) {
            $params[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        }
        $params = array_merge($params, $this->params);
        try {
            $this->connection = new PDO(
                sprintf('mysql:host=%s;dbname=%s', $this->hostname, $this->database),
                $this->username,
                $this->password,
                $params
            );
        } catch (PDOException $e) {
            throw new DatabaseConnectionException(
                $this->errors === true ? $e->getMessage() : 'Cannot connect to database'
            );
        }
        return $this;
    }
}
