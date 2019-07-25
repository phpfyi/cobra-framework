<?php

namespace Cobra\Mail\Stream;

use Cobra\Object\AbstractObject;

/**
 * Socket
 *
 * @category  Mail
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Socket extends AbstractObject
{
    /**
     * The socket remote host
     *
     * @var string
     */
    protected $remote;

    /**
     * Socket resource
     *
     * @var resource
     */
    protected $resource;

    /**
     * Connection error code
     *
     * @var integer
     */
    protected $errorCode;

    /**
     * Connection error message
     *
     * @var string
     */
    protected $errorMessage;

    /**
     * Connection timeout
     *
     * @var integer
     */
    protected $timeout = 0;

    /**
     * Socket client flags
     *
     * @var string
     */
    protected $flags;

    /**
     * Socket crypto type
     *
     * @var string
     */
    protected $crypto;

    /**
     * Sets the required properties
     *
     * @param string $remote
     * @param integer $timeout
     * @param string $flags
     * @param string $crypto
     */
    public function __construct(
        string $remote = null,
        int $timeout = 10,
        string $flags = STREAM_CLIENT_CONNECT,
        string $crypto = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
    ) {
        $this->remote = $remote;
        $this->timeout = $timeout;
        $this->flags = $flags;
        $this->crypto = $crypto;
    }

    /**
     * Performs the socket connection
     *
     * @return boolean
     */
    public function connect(): bool
    {
        $this->resource = stream_socket_client(
            $this->remote,
            $this->errorCode,
            $this->errorMessage,
            $this->timeout,
            $this->flags
        );
        if (!is_resource($this->resource)) {
            return false;
        }
        stream_set_timeout(
            $this->resource,
            $this->timeout
        );
        return true;
    }

    /**
     * Enabled the socket connection crypto
     *
     * @return void
     */
    public function crypto(): void
    {
        stream_socket_enable_crypto(
            $this->resource,
            true,
            $this->crypto
        );
    }

    /**
     * Returns the stream resource
     *
     * @return resource|null
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Returns the connection error code
     *
     * @return integer|null
     */
    public function getErrorCode():? int
    {
        return $this->errorCode;
    }

    /**
     * Returns the connection error message
     *
     * @return string|null
     */
    public function getErrorMessage():? string
    {
        return $this->errorMessage;
    }
}
