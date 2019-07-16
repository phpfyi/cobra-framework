<?php

namespace Cobra\Mail\Stream;

use Cobra\Object\AbstractObject;

/**
 * Command
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
class Command extends AbstractObject
{
    /**
     * New line string
     */
    const NEW_LINE = "\r\n";

    /**
     * Socket resource
     *
     * @var resource
     */
    protected $resource;

    /**
     * Sets the required properties
     *
     * @param resource $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Sends a command through the socket stream
     *
     * @param string $command
     * @return string
     */
    public function send(string $command): string
    {
        fputs($this->resource, $command.self::NEW_LINE);
        return $this->message();
    }

    /**
     * Sends a EHLO command through the socket stream
     *
     * @param string $hostname
     * @return string
     */
    public function helo(string $hostname): string
    {
        return $this->send(sprintf("EHLO %s", $hostname));
    }

    /**
     * Sends a MAIL FROM command through the socket stream
     *
     * @param string $email
     * @return string
     */
    public function from(string $email): string
    {
        return $this->send(sprintf("MAIL FROM: <%s>", $email));
    }

    /**
     * Sends an authentication credentials command through the socket stream
     *
     * @param string $credentials
     * @return string
     */
    public function encode(string $credentials): string
    {
        return $this->send(base64_encode($credentials));
    }

    /**
     * Sends a RCPT command through the socket stream
     *
     * @param string $credentials
     * @return string
     */
    public function rcpt(string $email): string
    {
        return $this->send(sprintf("RCPT TO: <%s>", $email));
    }

    /**
     * Constructs a message from the socket client stream
     *
     * @return string
     */
    public function message(): string
    {
        $this->message = '';
        while (is_resource($this->resource) && !feof($this->resource)) {
            $message = fgets($this->resource, 4096);
            $this->message .= $message;
            // break the loop if no data is left to access
            if (!isset($message[3]) || (isset($message[3]) && $message[3] == ' ')) {
                break;
            }
        }
        return $this->message;
    }
}
