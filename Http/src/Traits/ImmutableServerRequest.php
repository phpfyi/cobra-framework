<?php

namespace Cobra\Http\Traits;

use InvalidArgumentException;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;

/**
 * Immutable Server Request trait
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
trait ImmutableServerRequest
{
    /**
     * Return an instance with the specific request-target.
     *
     * If the request needs a non-origin-form request-target — e.g., for
     * specifying an absolute-form, authority-form, or asterisk-form —
     * this method may be used to create an instance with the specified
     * request-target, verbatim.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * changed request target.
     *
     * @param  mixed $requestTarget
     * @return RequestInterface
     */
    public function withRequestTarget($requestTarget): RequestInterface
    {
        return $this->cloneWithProperty('requestTarget', $requestTarget);
    }

    /**
     * Return an instance with the provided HTTP method.
     *
     * @param  string $method Case-sensitive method.
     * @return RequestInterface
     * @throws InvalidArgumentException for invalid HTTP methods.
     */
    public function withMethod($method): RequestInterface
    {
        return $this->cloneWithProperty(
            'method',
            arg_in_array(
                $method,
                config('http.methods')
            )
        );
    }

    /**
     * Returns an instance with the provided URI.
     *
     * This method MUST update the Host header of the returned request by
     * default if the URI contains a host component. If the URI does not
     * contain a host component, any pre-existing Host header MUST be carried
     * over to the returned request.
     *
     * You can opt-in to preserving the original state of the Host header by
     * setting `$preserveHost` to `true`. When `$preserveHost` is set to
     * `true`, this method interacts with the Host header in the following ways:
     *
     * - If the Host header is missing or empty, and the new URI contains
     *   a host component, this method MUST update the Host header in the returned
     *   request.
     * - If the Host header is missing or empty, and the new URI does not contain a
     *   host component, this method MUST NOT update the Host header in the returned
     *   request.
     * - If a Host header is present and non-empty, this method MUST NOT update
     *   the Host header in the returned request.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * new UriInterface instance.
     *
     * @param  UriInterface $uri          New request URI to use.
     * @param  bool         $preserveHost Preserve the original state of the Host header.
     * @return RequestInterface
     */
    public function withUri(UriInterface $uri, $preserveHost = false): UriInterface
    {
        $clone = clone $this;
        $clone->uri = $uri;
        return(
            $preserveHost === true
            && $uri->getHost() !== ''
            && !$clone->hasHeader('Host')
        )
        ? $clone->withAddedHeader('Host', $uri->getHost())
        : $clone;
    }

    /**
     * Return an instance with the specified cookies.
     *
     * The data IS NOT REQUIRED to come from the $_COOKIE superglobal, but MUST
     * be compatible with the structure of $_COOKIE. Typically, this data will
     * be injected at instantiation.
     *
     * This method MUST NOT update the related Cookie header of the request
     * instance, nor related values in the server params.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated cookie values.
     *
     * @param  array $cookies Array of key/value pairs representing cookies.
     * @return RequestInterface
     */
    public function withCookieParams(array $cookies): RequestInterface
    {
        return $this->cloneWithProperty('cookies', $cookies);
    }

    /**
     * Return an instance with the specified query string arguments.
     *
     * These values SHOULD remain immutable over the course of the incoming
     * request. They MAY be injected during instantiation, such as from PHP's
     * $_GET superglobal, or MAY be derived from some other value such as the
     * URI. In cases where the arguments are parsed from the URI, the data
     * MUST be compatible with what PHP's parse_str() would return for
     * purposes of how duplicate query parameters are handled, and how nested
     * sets are handled.
     *
     * Setting query string arguments MUST NOT change the URI stored by the
     * request, nor the values in the server params.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated query string arguments.
     *
     * @param  array $query
     * @return RequestInterface
     */
    public function withQueryParams(array $query): RequestInterface
    {
        return (clone $this)->withUri(
            $this->uri->withQuery(http_build_query($query))
        );
    }

    /**
     * Create a new instance with the specified uploaded files.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated body parameters.
     *
     * @param  array $uploadedFiles An array tree of UploadedFileInterface instances.
     * @return RequestInterface
     * @throws InvalidArgumentException
     */
    public function withUploadedFiles(array $uploadedFiles): RequestInterface
    {
        return $this->cloneWithProperty(
            'uploadedFiles',
            args_is_instanceof($uploadedFiles, UploadedFileInterface::class)
        );
    }

    /**
     * Return an instance with the specified body parameters.
     *
     * These MAY be injected during instantiation.
     *
     * If the request Content-Type is either application/x-www-form-urlencoded
     * or multipart/form-data, and the request method is POST, use this method
     * ONLY to inject the contents of $_POST.
     *
     * The data IS NOT REQUIRED to come from $_POST, but MUST be the results of
     * deserializing the request body content. Deserialization/parsing returns
     * structured data, and, as such, this method ONLY accepts arrays or objects,
     * or a null value if nothing was available to parse.
     *
     * As an example, if content negotiation determines that the request data
     * is a JSON payload, this method could be used to create a request
     * instance with the deserialized parameters.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated body parameters.
     *
     * @param  null|array|object $data The deserialized body data.
     * @return RequestInterface
     * @throws InvalidArgumentException
     */
    public function withParsedBody($data): RequestInterface
    {
        return $this->cloneWithProperty(
            'parsedBody',
            strtolower($this->method) === 'POST' ? (array) $data : $data
        );
    }

    /**
     * Return an instance with the specified derived request attribute.
     *
     * This method allows setting a single derived request attribute as
     * described in getAttributes().
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated attribute.
     *
     * @see getAttributes()
     * @param  string $name  The attribute name.
     * @param  mixed  $value The value of the attribute.
     * @return RequestInterface
     */
    public function withAttribute($name, $value): RequestInterface
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Return an instance that removes the specified derived request attribute.
     *
     * This method allows removing a single derived request attribute as
     * described in getAttributes().
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that removes
     * the attribute.
     *
     * @see getAttributes()
     * @param  string $name The attribute name.
     * @return RequestInterface
     */
    public function withoutAttribute($name): RequestInterface
    {
        array_key_unset($name, $this->attributes);
        return $this;
    }
}
