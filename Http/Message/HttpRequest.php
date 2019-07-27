<?php

namespace Cobra\Http\Message;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Uri\RequestUriInterface;

/**
 * Http Request
 *
 * Extends server request to provide framework specific methods and logic
 * Avoids polluting the ServerRequest class with a lot of methods not
 * present in the PSR interface. This is the primary class that is interacted
 * with therought the application offering the full range of logic from
 * HttpMessage down
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
class HttpRequest extends ServerRequest implements RequestInterface
{
    /**
     * The request method
     *
     * @var string
     */
    protected $method;

    /**
     * The request IP address
     *
     * @var string
     */
    protected $ipAddress;

    /**
     * The request IP(s) hostnames
     *
     * @var array
     */
    protected $ipHostnames;

    /**
     * Is HTTPS request
     *
     * @var bool|null
     */
    protected $isHttps;

    /**
     * Is AJAX request
     *
     * @var bool|null
     */
    protected $isAjax;

    /**
     * Sets the various request properties
     *
     * @param RequestUriInterface $uri
     * @param string       $protocol
     * @param string       $method
     * @param array        $headers
     * @param array        $serverParams
     * @param array        $cookieParams
     * @param array        $uploadedFiles
     * @param mixed        $body
     */
    public function __construct(
        RequestUriInterface $uri,
        string $protocol,
        string $method,
        array $headers = [],
        array $serverParams = [],
        array $cookieParams = [],
        array $uploadedFiles = [],
        $body = null
    ) {
        $this->uri = $uri;
        $this->protocol = $protocol;
        $this->method = strtoupper($method);
        $this->headers = $headers;
        $this->serverParams = $serverParams;
        $this->cookieParams = $cookieParams;
        $this->uploadedFiles = $uploadedFiles;
        $this->body = $body;
        
        $this->parsedBody = $this->method === 'POST' ? (array) $this->body : json_decode($this->body);
    }

    /**
     * Retrieves a cookie if it exists
     *
     * @param  string $name
     * @return string|null
     */
    public function getCookieParam(string $name):? string
    {
        return array_key($name, $this->cookieParams);
    }

    /**
     * Get the HTTP referer
     *
     * @return string
     */
    public function getReferer(): string
    {
        return (string) $this->getServerParam('HTTP_REFERER');
    }

    /**
     * Get the request IP address
     *
     * @return string
     */
    public function getIP(): string
    {
        return $this->ipAddress ?? $this->ipAddress = request_ip($this);
    }

    /**
     * Get the request host by address
     *
     * @return array
     */
    public function getHostByAddr(): array
    {
        return $this->ipHostnames ?? $this->ipHostnames = ip_hostnames($this);
    }

    /**
     * Checks if the current request is HTTPS
     *
     * @return boolean
     */
    public function isHttps(): bool
    {
        return $this->isHttps ?? $this->isHttps = is_https($this);
    }

    /**
     * Checks if the request is an AJAX request
     *
     * @return boolean
     */
    public function isAjax(): bool
    {
        return $this->isAjax ?? $this->isAjax = is_ajax($this);
    }

    /**
     * Is a post request
     *
     * @return boolean
     */
    public function isPost(): bool
    {
        return $this->method == 'POST';
    }

    /**
     * Returns all request post vars
     *
     * @return array
     */
    public function postVars(): array
    {
        return (array) $this->body;
    }

    /**
     * Returns a post value
     *
     * @param  string $name
     * @return mixed
     */
    public function postVar(string $name)
    {
        return array_key($name, $this->postVars());
    }
}
