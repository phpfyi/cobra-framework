<?php

namespace Cobra\Http\Message;

use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Http\Traits\ImmutableHttpResponse;
use Cobra\Http\Traits\OutputsHeaders;

/**
 * Http Response
 *
 * Representation of an outgoing, server-side response.
 *
 * Per the HTTP specification, this interface includes properties for
 * each of the following:
 *
 * - Protocol version
 * - Status code and reason phrase
 * - Headers
 * - Message body
 *
 * Responses are considered immutable; all methods that might change state MUST
 * be implemented such that they retain the internal state of the current
 * message and return an instance that contains the changed state.
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
class HttpResponse extends HttpMessage implements ResponseInterface
{
    use ImmutableHttpResponse, OutputsHeaders;
    
    /**
     * HTTP status code
     *
     * @var integer
     */
    protected $statusCode = 0;

    /**
     * Sets the response default properties
     *
     * @param integer $statusCode
     * @param string  $protocol
     * @param array   $headers
     * @param mixed   $body
     */
    public function __construct(int $statusCode = 0, string $protocol = null, array $headers = [], $body = null)
    {
        $this->statusCode = $statusCode;
        $this->protocol = $protocol;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * Gets the response status code.
     *
     * @return int Status code.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Add a HTTP header to the response
     *
     * @param  string $name
     * @param  string $value
     * @return ResponseInterface
     */
    public function addHeader(string $name, string $value): ResponseInterface
    {
        if (array_key_exists($name, $this->headers)) {
            $this->headers[$name][] = $value;
            return $this;
        }
        $this->headers[$name] = [$value];
        return $this;
    }

    /**
     * Gets the response reason phrase associated with the status code.
     *
     * @return string Reason phrase; must return an empty string if none present.
     */
    public function getReasonPhrase(): string
    {
        return array_key($this->statusCode, http_status_codes(), '');
    }

    /**
     * Outputs the HTTP response
     *
     * @return void
     */
    public function output(): void
    {
        $this->outputHeaders($this->getHeaders());
        http_response_code($this->statusCode);

        echo $this->body;
    }
}
