<?php

namespace Cobra\Http\Message;

use Cobra\Http\Traits\ImmutableHttpMessage;
use Cobra\Http\Traits\UsesSession;
use Cobra\Object\AbstractObject;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 * HttpMessage
 *
 * Implements the PSR-7 standard interface
 * Acts as the base class to HttpRequest and HttpResponse
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class HttpMessage extends AbstractObject implements MessageInterface
{
    use ImmutableHttpMessage, UsesSession;

    /**
     * The request URI protocol
     *
     * @var string
     */
    protected $protocol;

    /**
     * The request headers
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The request body
     *
     * @var mixed
     */
    protected $body;

    /**
     * Retrieves the HTTP protocol version as a string.
     *
     * The string MUST contain only the HTTP version number (e.g., "1.1", "1.0").
     *
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $this->protocol;
    }

    /**
     * Retrieves all message header values.
     *
     * The keys represent the header name as it will be sent over the wire, and
     * each value is an array of strings associated with the header.
     *
     *     // Represent the headers as a string
     *     foreach ($message->getHeaders() as $name => $values) {
     *         echo $name . ": " . implode(", ", $values);
     *     }
     *
     *     // Emit headers iteratively:
     *     foreach ($message->getHeaders() as $name => $values) {
     *         foreach ($values as $value) {
     *             header(sprintf('%s: %s', $name, $value), false);
     *         }
     *     }
     *
     * While header names are not case-sensitive, getHeaders() will preserve the
     * exact case in which headers were originally specified.
     *
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * This method returns an array of all the header values of the given
     * case-insensitive header name.
     *
     * If the header does not appear in the message, this method MUST return an
     * empty array.
     *
     * @param  string $name Case-insensitive header field name.
     * @return bool
     */
    public function hasHeader($name): bool
    {
        return array_key_exists($name, $this->headers);
    }

    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * This method returns an array of all the header values of the given
     * case-insensitive header name.
     *
     * @param  string $name Case-insensitive header field name.
     * @return array
     */
    public function getHeader($name): array
    {
        return array_key($name, $this->headers, []);
    }

    /**
     * Retrieves a comma-separated string of the values for a single header.
     *
     * This method returns all of the header values of the given
     * case-insensitive header name as a string concatenated together using
     * a comma.
     *
     * @param  string $name Case-insensitive header field name.
     * @return string
     */
    public function getHeaderLine($name): string
    {
        return array_key_exists($name, $this->headers) ? implode(',', $this->headers[$name]) : '';
    }

    /**
     * Gets the body of the message.
     *
     * @return StreamInterface Returns the body as a stream.
     */
    public function getBody()
    {
        return $this->body;
    }
}
