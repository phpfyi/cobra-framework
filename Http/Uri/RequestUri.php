<?php

namespace Cobra\Http\Uri;

use Cobra\Interfaces\Http\Uri\RequestUriInterface;

/**
 * Http Request Uri
 *
 * Main framework request URI instance which enhances the PSR-7 compliant request
 * URI instance class with extra methods and enhanced features.
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
class RequestUri extends Uri implements RequestUriInterface
{
    /**
     * Constructs the various URI parts from a URI string
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->scheme = (string) strtolower(uri_part($uri, 'SCHEME'));
        $this->host = (string) strtolower(uri_part($uri, 'HOST'));

        $this->port = uri_part($uri, 'PORT');
        $this->user = uri_part($uri, 'USER');
        $this->pass = uri_part($uri, 'PASS');

        $this->path = (string) uri_part($uri, 'PATH');
        $this->query = (string) uri_part($uri, 'QUERY');
        $this->fragment = (string) uri_part($uri, 'FRAGMENT');
    }

    /**
     * Checks if the current request ends with /
     *
     * @return boolean
     */
    public function endsWithSlash(): bool
    {
        if ($this->path == '/') {
            return false;
        }
        return substr($this->path, -1) === '/';
    }

    /**
     * Checks if the current host starts with www
     *
     * @return boolean
     */
    public function isWwwHostname(): bool
    {
        return substr($this->host, 0, 4) === 'www.';
    }

    /**
     * Gets a segment from the request URI path
     *
     * @param  int|null $index
     * @return string
     */
    public function getSegment($index = null): string
    {
        if ($index) {
            $segments = array_filter(explode('/', $this->path));
            return $segments[$index];
        }
        return basename($this->path);
    }

    /**
     * Returns a query string key value or null
     *
     * @param  string $name
     * @return string|null
     */
    public function getVar(string $name):? string
    {
        parse_str($this->query, $params);
        return array_key($name, $params);
    }
}
