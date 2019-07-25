<?php

namespace Cobra\Http\Traits;

use InvalidArgumentException;
use Cobra\Http\Traits\CloneRequest;
use Cobra\Object\Traits\CloneObject;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Immutable HTTP Message trait
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
trait ImmutableHttpMessage
{
    use CloneRequest, CloneObject;

    /**
     * Return an instance with the specified HTTP protocol version.
     *
     * The version string MUST contain only the HTTP version number (e.g.,
     * "1.1", "1.0").
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * new protocol version.
     *
     * @param  string $version HTTP protocol version
     * @return static
     */
    public function withProtocolVersion($version): MessageInterface
    {
        return $this->cloneWithProperty('protocol', $version);
    }

    /**
     * Return an instance with the provided value replacing the specified header.
     *
     * While header names are case-insensitive, the casing of the header will
     * be preserved by this function, and returned from getHeaders().
     *
     * @param  string          $name  Case-insensitive header field name.
     * @param  string|string[] $value Header value(s).
     * @return static
     * @throws InvalidArgumentException for invalid header names or values.
     */
    public function withHeader($name, $value): MessageInterface
    {
        return $this->cloneWithHeader($name, $value);
    }

    /**
     * Return an instance with the specified header appended with the given value.
     *
     * Existing values for the specified header will be maintained. The new
     * value(s) will be appended to the existing list. If the header did not
     * exist previously, it will be added.
     *
     * @param  string          $name  Case-insensitive header field name to add.
     * @param  string|string[] $value Header value(s).
     * @return static
     * @throws InvalidArgumentException for invalid header names or values.
     */
    public function withAddedHeader($name, $value): MessageInterface
    {
        if (array_key_exists($name, $this->headers)) {
            $value = array_merge((array) $value, $this->headers[$name]);
        }
        return $this->cloneWithHeader($name, $value);
    }

    /**
     * Return an instance without the specified header.
     *
     * Header resolution MUST be done without case-sensitivity.
     *
     * @param  string $name Case-insensitive header field name to remove.
     * @return static
     */
    public function withoutHeader($name): MessageInterface
    {
        return $this->cloneWithProperty(
            'headers',
            array_filter(
                $this->headers,
                function ($key) use ($name) {
                    return strtolower($key) !== strtolower($name);
                },
                ARRAY_FILTER_USE_KEY
            )
        );
    }

    /**
     * Return an instance with the specified message body.
     *
     * The body MUST be a StreamInterface object.
     *
     * @param  StreamInterface $body Body.
     * @return static
     * @throws InvalidArgumentException When the body is not valid.
     */
    public function withBody(StreamInterface $body): MessageInterface
    {
        return $this->cloneWithProperty('body', $body);
    }
}
