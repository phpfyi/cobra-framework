<?php

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Uri\RequestUriInterface;
use Cobra\Interfaces\Http\Factory\ContentFactoryInterface;
use Cobra\Http\Message\HttpForbiddenResponse;
use Cobra\Http\Message\HttpRedirectResponse;

/**
 * HTTP function sets
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

if (! function_exists('output')) {
    /**
     * Returns the content factory instance.
     *
     * @return ContentFactoryInterface
     */
    function output(): ContentFactoryInterface
    {
        return container_resolve(ContentFactoryInterface::class);
    }
}

if (! function_exists('request_ip')) {
    /**
     * Returns the IP address from a request
     *
     * @param RequestInterface $request
     * @return string
     */
    function request_ip(RequestInterface $request): string
    {
        $ips = [];
        $params = $request->getServerParams();
        array_map(
            function ($header) use (&$ips, $params) {
                if (array_key_exists($header, $params)) {
                    array_map(
                        function ($ipAddress) use (&$ips) {
                            $ips[] = trim($ipAddress);
                        },
                        explode(',', $params[$header])
                    );
                }
            },
            config('http.ip_headers')
        );
        return (string) implode(',', array_unique($ips));
    }
}

if (! function_exists('ip_hostnames')) {
    /**
     * Returns an array of hostnames from an IP address list
     *
     * @param RequestInterface $request
     * @return array
     */
    function ip_hostnames(RequestInterface $request): array
    {
        return array_map(function ($ipAddress) use (&$hostnames) {
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                return gethostbyaddr($ipAddress);
            }
        }, explode(',', $request->getIP()));
    }
}

if (! function_exists('in_ip_range')) {
    /**
     * Checks if an IP address is in a range
     *
     * @param string $ipAddress
     * @param string $min
     * @param string $max
     * @return boolean
     */
    function ip_in_range(string $ipAddress, string $min, string $max): bool
    {
        $ipAddress = ip2long($ipAddress);
        $min = ip2long($min);
        $max = ip2long($max);

        return $ipAddress >= $min && $ipAddress <= $max;
    }
}

if (! function_exists('http_status_codes')) {
    /**
     * Returns an array of HTTP codes
     *
     * @return array
     */
    function http_status_codes(): array
    {
        return array_merge(
            config('http.200_codes'),
            config('http.300_codes'),
            config('http.400_codes'),
            config('http.500_codes')
        );
    }
}

if (! function_exists('is_https')) {
    /**
     * Cheks if a request is HTTPS
     *
     * @param RequestInterface $request
     * @return boolean
     */
    function is_https(RequestInterface $request): bool
    {
        return strtolower(
            $request->getServerParam('HTTPS')
        ) == 'on'
        || $request->getServerParam('SERVER_PORT') == 443;
    }
}

if (! function_exists('is_ajax')) {
    /**
     * Cheks if a request is via AJAX
     *
     * @param RequestInterface $request
     * @return boolean
     */
    function is_ajax(RequestInterface $request): bool
    {
        return strtolower(
            $request->getServerParam('HTTP_X_REQUESTED_WITH')
        ) === 'xmlhttprequest'
        || $request->getUri()->getVar('__amp_source_origin');
    }
}

if (! function_exists('http_forbidden_response')) {
    /**
     * Returns a HttpForbiddenResponse instance
     *
     * @param object $object
     * @return HttpForbiddenResponse
     */
    function http_forbidden_response(object $object): HttpForbiddenResponse
    {
        return HttpForbiddenResponse::resolve()->setSession(
            $object->getResponse()->getSession()
        );
    }
}

if (! function_exists('http_redirect_response')) {
    /**
     * Returns a HttpRedirectResponse instance
     *
     * @param object $object
     * @param string $location
     * @param integer $code
     * @return HttpRedirectResponse
     */
    function http_redirect_response(object $object, string $location, int $code = 301): HttpRedirectResponse
    {
        return HttpRedirectResponse::resolve($code)
            ->addHeader('Location', $location)
            ->setSession($object->getResponse()->getSession());
    }
}

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

if (! function_exists('uri_part')) {
    /**
     * Returns a URI part. Proxy function to parse_url.
     *
     * @param string $uri
     * @param string $identifier
     * @return void
     */
    function uri_part(string $uri, string $identifier)
    {
        $part = constant(
            sprintf('PHP_URL_%s', strtoupper($identifier))
        );
        return parse_url($uri, $part);
    }
}

if (! function_exists('extract_vars')) {
    /**
     * Returns a passed query string vars as an array
     *
     * @param string $query
     * @return array
     */
    function extract_vars(string $query): array
    {
        parse_str($query, $params);
        return $params;
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
