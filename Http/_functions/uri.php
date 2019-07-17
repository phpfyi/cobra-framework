<?php

use Cobra\Interfaces\Http\Uri\RequestUriInterface;

/**
 * URI function sets
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

if (! function_exists('uri_path')) {
    /**
     * Returns the path and optional query string from a URI instance
     *
     * @param RequestUriInterface $uri
     * @param boolean $query
     * @return string
     */
    function uri_path(RequestUriInterface $uri, bool $query = false): string
    {
        $path = $uri->getPath() == ''
        ? '/'
        : $uri->getPath();

        if ($query) {
            return $uri->getQuery() !== ''
            ? $path . '?' . $uri->getQuery()
            : $path;
        }
        return $path;
    }
}

if (! function_exists('uri_to_string')) {
    /**
     * Converts a URI instance into a URI string
     *
     * @param RequestUriInterface $uri
     * @return string
     */
    function uri_to_string(RequestUriInterface $uri): string
    {
        return implode(
            [
                $uri->getScheme().'://',
                $uri->getAuthority(),
                $uri->getPath(),
                $uri->getQuery() ? '?'.$uri->getQuery() : '',
                $uri->getFragment() ? '#'.$uri->getFragment() : ''
            ]
        );
    }
}

if (! function_exists('uri_join')) {
    /**
     * Returns a URL path joined by /
     *
     * @param  string[] ...$args
     * @return string
     */
    function uri_join(...$args): string
    {
        return implode('/', $args);
    }
}

if (! function_exists('uri_join_absolute')) {
    /**
     * Returns a URL path joined by / with a starting /
     *
     * @param  string[] ...$args
     * @return string
     */
    function uri_join_absolute(...$args): string
    {
        $path = uri_join(...$args);
        return substr($path, 0, 1) == '/' ? $path : '/'.$path;
    }
}

if (! function_exists('uri_join_host')) {
    /**
     * Returns a URL path joined by / prefixed with the full domain path
     *
     * @param  string[] ...$args
     * @return string
     */
    function uri_join_host(...$args): string
    {
        $args[0] = $args[0] == '/home' ? '' : $args[0];
        $path = uri_join(...$args);
        if (substr($path, 0, 1) == '/') {
            $path = substr($path, 1);
        }
        return BASE_URL_SLASH.$path;
    }
}
